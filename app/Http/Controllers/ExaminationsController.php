<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationsController extends Controller
{
    public function exam_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = 'Examen List';
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_add()
    {
        $data['header_title'] = 'Add Exam';
        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request)
    {
        //valida si el nombrede la clase si ya esta en el sistema
        // request()->validate([
        //     'name'=> 'required|name|unique:class'
        // ]);

        $class = new ExamModel;
        $class->name = $request->name;
        $class->note = $request->note;
        //$class->status = $request->status;
        $class->created_by = Auth::user()->id;

        $class->save();

        return redirect('admin/examinations/exam/list')->with('success', 'Nota registrado con exito');
    }

    public function exam_delete($id)
    {
        $exam = ExamModel::getExam($id);
        $exam->is_delete = 1;
        $exam->save();
        return redirect()->back()->with('success', 'Examen eliminado con exito');

    }

    public function exam_edit($id)
    {
        $data['getRecord'] = ExamModel::getExam($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Editar Examen';
            return view('admin.examinations.exam.edit', $data);
        } else {
            abort(404);
        }

    }

    public function exam_update($id, Request $request)
    {
        // request()->validate([
        //     'email'=> 'required|email|unique:users,email,',$id
        // ]);
        $exam = ExamModel::getExam($id);
        $exam->name = $request->name;
        $exam->note = $request->note;
        // $class->status = $request->status;
        $exam->save();

        return redirect('admin.examinations.exam.list')->with('success', 'Examen editado con exito');
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClassSubject();
        $data['getExamR'] = ExamModel::getExamR();
        $result = array();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getSubject = ClassSubjectModel::MySubject($request->get('class_id'));
            foreach ($getSubject as $value) {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;

                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);

                if (!empty($ExamSchedule)) {
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                    $dataS['full_marks'] = $ExamSchedule->full_marks;
                    $dataS['passing_mark'] = $ExamSchedule->passing_mark;

                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_marks'] = '';
                    $dataS['passing_mark'] = '';

                }
                $result[] = $dataS;
            }
        }

        $data['getRecord'] = $result;
        $data['header_title'] = 'Horario Examen';
        return view('admin.examinations.exam_schedule', $data);
    }
    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);

        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (!empty($schedule['subject_id'])
                    && !empty($schedule['exam_date'])
                    && !empty($schedule['start_time'])
                    && !empty($schedule['end_time'])
                    && !empty($schedule['room_number'])
                    && !empty($schedule['full_marks'])
                    && !empty($schedule['passing_mark'])) {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->full_marks = $schedule['full_marks'];
                    $exam->passing_mark = $schedule['passing_mark'];
                    $exam->created_by = Auth::user()->id;

                    $exam->save();
                }

            }

        }
        return redirect()->back()->with('success', 'registro con exito');

    }
}