<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class StudentAttendanceModel extends Model
{
    use HasFactory;
    protected $table = 'student_attendance';
//CheckAlreadyAttendance
    public static function CheckAlreadyAttendance($student_id, $class_id, $attendance_date)
    {
        return StudentAttendanceModel::where('student_id', '=', $student_id)
            ->where('class_id', '=', $class_id)
            ->where('attendance_date', '=', $attendance_date)
            ->first();
    }

    public static function getRecord()
    {
        $return = StudentAttendanceModel::select('student_attendance.*',
            'users.name as created_by_name',
            'class.name as class_name', 'student.name as student_name',
            'student.last_name as student_last_name')
            ->join('users', 'users.id', 'student_attendance.created_by')
            ->join('users as student', 'student.id', 'student_attendance.student_id')
            ->join('class', 'class.id', '=', 'student_attendance.class_id');

        if (!empty(Request::get('student_id'))) {
            $return = $return->where('student_attendance.student_id', 'like',
                '%' . Request::get('student_id') . '%');
        }
        if (!empty(Request::get('student_last_name'))) {
            $return = $return->where('student_attendance.student_last_name', 'like',
                '%' . Request::get('student_last_name') . '%');
        }
        if (!empty(Request::get('student_name'))) {
            $return = $return->where('student_attendance.student_name', 'like',
                '%' . Request::get('student_name') . '%');
        }

        if (!empty(Request::get('class_id'))) {
            $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
        }

        if (!empty(Request::get('start_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '>=',
                Request::get('start_attendance_date'));
        }
        if (!empty(Request::get('end_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '<=',
                Request::get('end_attendance_date'));
        }
        if (!empty(Request::get('attendance_type'))) {
            $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
        }

        $return = $return->orderBy('student_attendance.id', 'desc')
            ->paginate(50);
        return $return;
    }
    public static function getRecordTeacher($class_ids)
    {
        if (!empty($class_ids)) {
            $return = StudentAttendanceModel::select('student_attendance.*',
                'users.name as created_by_name',
                'class.name as class_name', 'student.name as student_name',
                'student.last_name as student_last_name')
                ->join('users', 'users.id', 'student_attendance.created_by')
                ->join('users as student', 'student.id', 'student_attendance.student_id')
                ->join('class', 'class.id', '=', 'student_attendance.class_id')
                ->whereIn('student_attendance.class_id', $class_ids);

            if (!empty(Request::get('student_id'))) {
                $return = $return->where('student_attendance.student_id', 'like',
                    '%' . Request::get('student_id') . '%');
            }
            if (!empty(Request::get('student_last_name'))) {
                $return = $return->where('student_attendance.student_last_name', 'like',
                    '%' . Request::get('student_last_name') . '%');
            }
            if (!empty(Request::get('student_name'))) {
                $return = $return->where('student_attendance.student_name', 'like',
                    '%' . Request::get('student_name') . '%');
            }

            if (!empty(Request::get('class_id'))) {
                $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
            }

            if (!empty(Request::get('start_attendance_date'))) {
                $return = $return->where('student_attendance.attendance_date', '>=',
                    Request::get('start_attendance_date'));
            }
            if (!empty(Request::get('end_attendance_date'))) {
                $return = $return->where('student_attendance.attendance_date', '<=',
                    Request::get('end_attendance_date'));
            }
            if (!empty(Request::get('attendance_type'))) {
                $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
            }

            $return = $return->orderBy('student_attendance.id', 'desc')
                ->paginate(50);
            return $return;

        } else {
            return "";
        }

    }

    public static function getRecordStudent($student_id)
    {
        $return = StudentAttendanceModel::select('student_attendance.*',
            'class.name as class_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id);

        if (!empty(Request::get('start_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '>=',
                Request::get('start_attendance_date'));
        }
        if (!empty(Request::get('end_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '<=',
                Request::get('end_attendance_date'));
        }

        if (!empty(Request::get('attendance_type'))) {
            $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
        }

        if (!empty(Request::get('class_id'))) {
            $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
        }

        $return = $return->orderBy('student_attendance.id', 'desc')
            ->paginate(50);
        return $return;
    }

    public static function getClassStudent($student_id)
    {
        return StudentAttendanceModel::select('student_attendance.*',
            'class.name as class_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id)
            ->groupBy('student_attendance.class_id')
            ->get();
    }
}