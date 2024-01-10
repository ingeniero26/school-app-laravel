<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignClassTeacherModel extends Model
{
    use HasFactory;
    protected $table = 'assign_class_teacher';

    public static function getAlreadyFirst($class_id, $headquarter_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('headquarter_id', '=', $headquarter_id)
            ->where('teacher_id', '=', $teacher_id)->first();
    }

    //LISTADO DE DOCENTE-MODULOS-PROGRAMAS
    public static function getRecord()
    {
        $return = self::select('assign_class_teacher.*',
            'class.name as class_name',
            'headquarters.name as headquarter ', 'teacher.name as teacher_name', 'teacher.last_name as last_name',
            'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', 'assign_class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
        // ->join('headquarters', 'headquarters.id', '=', 'users.headquarter_id', 'left')

            ->join('headquarters', 'headquarters.id', '=', 'assign_class_teacher.headquarter_id')
            ->join('users', 'users.id', 'assign_class_teacher.created_by')
            ->where('assign_class_teacher.is_delete', '=', 0);
        $return = $return->orderBy('assign_class_teacher.id', 'desc')
            ->paginate(20);
        return $return;
    }

    public static function getAssignClassTeacher($id)
    {
        return self::find($id);
    }

    public static function getAssignTeacherID($teacher_id)
    {
        return self::where('teacher_id', '=', $teacher_id)
            ->where('is_delete', '=', 0)
            ->get();
    }

    public static function deleteAssignTeacher($class_id)
    {
        return self::where('class_id', '=', $class_id)
            ->delete();
    }

}
