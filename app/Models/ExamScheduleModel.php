<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;
    protected $table = 'exam_schedule';

    public static function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return ExamScheduleModel::where('exam_id', '=', $exam_id)
            ->where('class_id', '=', $class_id)
            ->where('subject_id', '=', $subject_id)->first();
    }

    public static function deleteRecord($exam_id, $class_id)
    {
        return ExamScheduleModel::where('exam_id', '=', $exam_id)
            ->where('class_id', '=', $class_id)
            ->delete();

    }

    public static function getExam($class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
            ->where('exam_schedule.class_id', '=', $class_id)
            ->groupBy('exam_schedule.exam_id')
            ->orderBy('exam_schedule.id', 'desc')
            ->get();
    }
    public static function getExamTeacher($teacher_id)
    {
        return ExamScheduleModel::select('exam_schedule.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'exam_schedule.class_id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->groupBy('exam_schedule.exam_id')
            ->orderBy('exam_schedule.id', 'desc')
            ->get();
    }

    public static function getExamTimetable($exam_id, $class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*',
            'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)

            ->get();
    }
    public static function getSubject($exam_id, $class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*',
            'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)

            ->get();
    }

    public static function getExamTimetableTeacher($teacher_id)
    {
        return ExamScheduleModel::select('exam_schedule.*',
            'class.name as class_name', 'subject.name as subject_name',
            'exam.name as exam_name')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'exam_schedule.class_id')
            ->join('class', 'class.id', '=', 'exam_schedule.class_id')
            ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)

            ->get();
    }

    public static function getMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarksRegisterModel::CheckAlreadyMark($student_id,
            $exam_id, $class_id, $subject_id);
    }

    public static function getSingle($id)
    {
        return self::find($id);

    }
}