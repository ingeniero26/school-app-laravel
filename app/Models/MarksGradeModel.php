<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksGradeModel extends Model
{
    use HasFactory;
    protected $table = 'marks_grade';

    public static function getRecord()
    {
        $return = MarksGradeModel::select('marks_grade.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'marks_grade.created_by');
        $return = $return->where('marks_grade.is_delete', '=', 0)
            ->orderBy('marks_grade.id', 'asc')
            ->get();
        return $return;
    }

    public static function getMarkGrade($id)
    {
        return self::find($id);
    }

    public static function getGrade($porcentage)
    {
        $return = MarksGradeModel::select('marks_grade.*')
            ->where('percent_from', '<=', $porcentage)
            ->where('percent_to', '>=', $porcentage)
            ->first();
        return !empty($return->name) ? $return->name : '';
    }
}