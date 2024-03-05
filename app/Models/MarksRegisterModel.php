<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksRegisterModel extends Model
{
    use HasFactory;
    protected $table = 'marks_register';
    public static function CheckAlreadyMark($student_id,
        $exam_id, $class_id, $subject_id) {
        return MarksRegisterModel::where('student_id', '=', $student_id)
            ->where('exam_id', '=', $exam_id)
            ->where('class_id', '=', $class_id)
            ->where('subject_id', '=', $subject_id)
            ->first();
    }
    public static function getExam($student_id)
    {
        return MarksRegisterModel::select('marks_register.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'marks_register.exam_id')
            ->where('marks_register.student_id', '=', $student_id)
            ->groupBy('marks_register.exam_id')
            ->get();
    }
    public static function getExamSubject($exam_id, $student_id)
    {
        return MarksRegisterModel::select('marks_register.*',
            'exam.name as exam_name', 'subject.name as subject_name')
            ->join('exam', 'exam.id', '=', 'marks_register.exam_id')
            ->join('subject', 'subject.id', '=', 'marks_register.subject_id')

        //->join('exam_schedule', 'exam_schedule.exam_id', '=', 'marks_register.exam_id')
        // ->join('exam_schedule as exam_schedule_class', 'exam_schedule_class.class_id', '=', 'marks_register.class_id')
        // ->join('exam_schedule as exam_schedule_subject', 'exam_schedule_subject.subject_id', '=', 'marks_register.subject_id')

            ->where('marks_register.student_id', '=', $student_id)
            ->where('marks_register.exam_id', '=', $exam_id)

            ->get();
    }
}