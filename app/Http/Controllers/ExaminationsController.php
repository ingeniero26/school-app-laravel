<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use App\Models\MarksGradeModel;
use App\Models\MarksRegisterModel;
use App\Models\User;
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

        return redirect('admin/examinations/exam/list')->with('success', 'Examen editado con exito');
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

    //horario examenes del estudiante
    public function MyExamTimetable(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['subject_type'] = $valueS->subject_type;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_marks'] = $valueS->full_marks;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'Examen Estudiante';
        return view('student.my_exam_timetable', $data);

    }
    //horario examen docente
    public function MyExamTimetableTeacher()
    {
        $result = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach ($getClass as $class) {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;

            $getExam = ExamScheduleModel::getExam($class->class_id);
            $examArray = array();

            foreach ($getExam as $exam) {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;

                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);
                $subjectArray = array();

                foreach ($getExamTimetable as $valueS) {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['subject_type'] = $valueS->subject_type;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_marks'] = $valueS->full_marks;
                    $dataS['passing_mark'] = $valueS->passing_mark;
                    $subjectArray[] = $dataS;
                }
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray;
            $result[] = $dataC;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'Examenes Docente';
        return view('teacher.my_exam_timetable', $data);
    }

    //horario examenis hijo padre familia
    public function ParentMyExamTimetable($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id = $getStudent->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['subject_type'] = $valueS->subject_type;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_marks'] = $valueS->full_marks;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['getStudent'] = $getStudent;
        $data['header_title'] = 'Examen Estudiante';
        return view('parent.my_exam_timetable', $data);

    }
    //register marks
    public function marks_register(Request $request)
    {
        $data['getClass'] = ClassModel::getClassSubject();
        $data['getExamR'] = ExamModel::getExamR();

        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));

        }

        $data['header_title'] = 'Registro ';
        return view('admin.examinations.marks_register', $data);

    }
    //docente
    public function marks_register_teacher(Request $request)
    {

        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getExamR'] = ExamScheduleModel::getExamTeacher(Auth::user()->id);

        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));

        }

        $data['header_title'] = 'Registro ';
        return view('teacher.marks_register', $data);

    }

    public function submit_marks_register(Request $request)
    {
        $validation = 0;
        if (!empty($request->mark)) {
            foreach ($request->mark as $mark) {
                $getExamSchedule = ExamScheduleModel::getSingle($mark['id']);
                $full_marks = $getExamSchedule->full_marks;

                $class_work = !empty($mark['class_work']) ? $mark['class_work'] : 0;
                $home_work = !empty($mark['home_work']) ? $mark['home_work'] : 0;
                $test_work = !empty($mark['test_work']) ? $mark['test_work'] : 0;
                $exam = !empty($mark['exam']) ? $mark['exam'] : 0;

                $full_marks = !empty($mark['full_marks']) ? $mark['full_marks'] : 0;
                $passing_mark = !empty($mark['passing_mark']) ? $mark['passing_mark'] : 0;

                $total_mark = $class_work + $home_work + $test_work + $exam;

                if ($full_marks >= $total_mark) {

                    $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
                    if (!empty($getMark)) {
                        $save = $getMark;
                    } else {
                        $save = new MarksRegisterModel;
                        $save->created_by = Auth::user()->id;

                    }

                    $save->student_id = $request->student_id;
                    $save->exam_id = $request->exam_id;
                    $save->class_id = $request->class_id;

                    $save->subject_id = $mark['subject_id'];
                    $save->class_work = $class_work;
                    $save->home_work = $home_work;
                    $save->test_work = $test_work;
                    $save->exam = $exam;
                    $save->full_marks = $full_marks;
                    $save->passing_mark = $passing_mark;

                    $save->save();
                } else {
                    $validation = 1;
                }
            }
        }
        if ($validation == 0) {
            $json['message'] = "Registro exitoso";

        } else {
            $json['message'] = "Las notas ingresadas superan el valor maximo";

        }

        echo json_encode($json);
    }
    public function single_submit_marks_register(Request $request)
    {
        $id = $request->id;
        $getExamSchedule = ExamScheduleModel::getSingle($id);
        $full_marks = $getExamSchedule->full_marks;
        $passing_mark = $getExamSchedule->passing_mark;

        $class_work = !empty($request->class_work) ? $request->class_work : 0;
        $home_work = !empty($request->home_work) ? $request->home_work : 0;
        $test_work = !empty($request->test_work) ? $request->test_work : 0;
        $exam = !empty($request->exam) ? $request->exam : 0;

        $total_mark = $class_work + $home_work + $test_work + $exam;
        if ($full_marks >= $total_mark) {
            $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id);
            if (!empty($getMark)) {
                $save = $getMark;
            } else {
                $save = new MarksRegisterModel;
                $save->created_by = Auth::user()->id;

            }

            $save->student_id = $request->student_id;
            $save->exam_id = $request->exam_id;
            $save->class_id = $request->class_id;

            $save->subject_id = $request->subject_id;
            $save->class_work = $class_work;
            $save->home_work = $home_work;
            $save->test_work = $test_work;
            $save->exam = $exam;

            $full_marks = $getExamSchedule->full_marks;
            $passing_mark = $getExamSchedule->passing_mark;

            $save->save();

            $json['message'] = "Registro exitoso";

        } else {
            $json['message'] = "tu nota total es mayor que la nota maxima";

        }
        echo json_encode($json);

    }

    //estudiante
    public function myExamResult()
    {
        $result = array();
        $getExam = MarksRegisterModel::getExam(Auth::user()->id);
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $getExamSubject = MarksRegisterModel::getExamSubject($value->exam_id, Auth::user()->id);

            $dataSubject = array();
            foreach ($getExamSubject as $exam) {
                $total_score = $exam['class_work'] + $exam['home_work'] + $exam['test_work'] + $exam['exam'];
                $dataS = array();
                $dataS['subject_name'] = $exam['subject_name'];
                $dataS['class_work'] = $exam['class_work'];
                $dataS['home_work'] = $exam['home_work'];
                $dataS['test_work'] = $exam['test_work'];
                $dataS['exam'] = $exam['exam'];
                $dataS['total_score'] = $total_score;
                $dataS['full_marks'] = $exam['full_marks'];
                $dataS['passing_mark'] = $exam['passing_mark'];
                $dataSubject[] = $dataS;

            }
            $dataE['subject'] = $dataSubject;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'Resultado Examenes ';
        return view('student.my_exam_result', $data);
    }

    //padre de familia resultadode examenes hijo
    public function ParentMyExamResult($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $result = array();
        $getExam = MarksRegisterModel::getExam($student_id);
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $getExamSubject = MarksRegisterModel::getExamSubject($value->exam_id, $student_id);

            $dataSubject = array();
            foreach ($getExamSubject as $exam) {
                $total_score = $exam['class_work'] + $exam['home_work'] + $exam['test_work'] + $exam['exam'];
                $dataS = array();
                $dataS['subject_name'] = $exam['subject_name'];
                $dataS['class_work'] = $exam['class_work'];
                $dataS['home_work'] = $exam['home_work'];
                $dataS['test_work'] = $exam['test_work'];
                $dataS['exam'] = $exam['exam'];
                $dataS['total_score'] = $total_score;
                $dataS['full_marks'] = $exam['full_marks'];
                $dataS['passing_mark'] = $exam['passing_mark'];
                $dataSubject[] = $dataS;

            }
            $dataE['subject'] = $dataSubject;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'Resultado Examenes ';
        return view('parent.my_exam_result', $data);
    }

    //registro grados academicos
    public function marks_grade()
    {
        $data['getRecord'] = MarksGradeModel::getRecord();

        $data['header_title'] = 'Grados';
        return view('admin.examinations.marks_grade.list', $data);
    }

    public function marks_grade_add()
    {
        $data['header_title'] = 'Add Grado';
        return view('admin.examinations.marks_grade.add', $data);
    }

    public function marks_grade_insert(Request $request)
    {
        //valida si el nombrede la clase si ya esta en el sistema
        // request()->validate([
        //     'name'=> 'required|name|unique:class'
        // ]);

        $grade = new MarksGradeModel;
        $grade->name = $request->name;
        $grade->percent_from = $request->percent_from;
        $grade->percent_to = $request->percent_to;
        //$class->status = $request->status;
        $grade->created_by = Auth::user()->id;

        $grade->save();

        return redirect('admin/examinations/marks_grade')->with('success', 'registrado con exito');
    }

    public function marks_grade_delete($id)
    {
        $exam = MarksGradeModel::getMarkGrade($id);
        $exam->is_delete = 1;
        $exam->save();
        return redirect()->back()->with('success', 'grado eliminado con exito');

    }

    public function marks_grade_edit($id)
    {
        $data['getRecord'] = MarksGradeModel::getMarkGrade($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Editar Examen';
            return view('admin.examinations.marks_grade.edit', $data);
        } else {
            abort(404);
        }

    }

    public function marks_grade_update($id, Request $request)
    {
        // request()->validate([
        //     'email'=> 'required|email|unique:users,email,',$id
        // ]);
        $grade = MarksGradeModel::getMarkGrade($id);
        $grade->name = $request->name;

        $grade->percent_from = $request->percent_from;
        $grade->percent_to = $request->percent_to;
        // $class->status = $request->status;
        $grade->save();

        return redirect('admin/examinations/marks_grade')->with('success', 'Examen editado con exito');
    }

}