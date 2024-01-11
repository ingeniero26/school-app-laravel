<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassSubjectModel extends Model
{
    use HasFactory;

    protected $table = 'class_subject';
    public static function getAssignList()
    {
        $return = self::select('class_subject.*',
         'class.name as class_name',
         'headquarters.name as headquarter_name',
            'subject.name as subject_name', 'users.name as created_by_name')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->join('headquarters', 'headquarters.id', '=', 'class_subject.headquarter_id')
            ->join('users', 'users.id', 'class_subject.created_by');
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like',
                '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like',
                '%' . Request::get('subject_name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class_subject.created_at', '=',
                Request::get('date'));
        }

        $return = $return->where('class_subject.is_delete', '=', 0);
        $return = $return->orderBy('class_subject.id', 'desc')
            ->paginate(20);
        return $return;
    }

    public static function getAlreadyFirst($class_id, $subject_id,$headquarter_id)
    {
        return self::where('class_id', '=', $class_id)
        ->where('headquarter_id', '=', $headquarter_id)
            ->where('subject_id', '=', $subject_id)->first();
    }

    // mostrar datos del admin por ID
    public static function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)
            ->delete();
    }

    public static function getAssignSubjectID($class_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('is_delete', '=', 0)
            ->get();
    }

    public static function getAssingClass($id)
    {
        return self::find($id);
    }
// listado de asignaturas del estudiante
    public static function MySubject($class_id)
    {
        return self::select('class_subject.*', 'subject.name as subject_name', 'subject.type')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->join('users', 'users.id', 'class_subject.created_by')
            ->where('class_subject.class_id', '=', $class_id)
            ->where('class_subject.is_delete', '=', 0)
            ->where('class_subject.status', '=', 0)
            ->orderBy('class_subject.id', 'desc')
            ->get();

    }
}
