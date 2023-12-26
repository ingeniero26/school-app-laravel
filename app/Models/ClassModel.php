<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    public static function getClassList()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('class.name', 'like',
                '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class.created_at', '=',
                Request::get('date'));
        }
        $return = $return->where('class.is_delete', '=', 0)

            ->orderBy('class.id', 'desc')
            ->paginate(20);
        return $return;
        //$return = $return->orderBy('class.id', 'desc')
        //    ->paginate(10);

    }

    public static function getClassSubject() {
        $return = ClassModel::select('class.*')
        ->join('users', 'users.id', 'class.created_by')
        ->where('class.is_delete', '=', 0)
        ->where('class.status', '=', 0)
        ->orderBy('class.name', 'asc')
        ->get();
    return $return;
    }

    // mostrar datos del admin por ID
    public static function getClass($id)
    {
        return self::find($id);
    }
}
