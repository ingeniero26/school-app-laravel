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

    public static function getExamTimetable($exam_id, $class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*',
            'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)

            ->get();
    }
}
