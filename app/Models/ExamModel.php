<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ExamModel extends Model
{
    use HasFactory;
    protected $table = 'exam';

    public static function getRecord()
    {
        $return = ExamModel::select('exam.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'exam.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('exam.name', 'like',
                '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('exam.created_at', '=',
                Request::get('date'));
        }
        $return = $return->where('exam.is_delete', '=', 0)

            ->orderBy('exam.id', 'desc')
            ->paginate(20);
        return $return;
        //$return = $return->orderBy('class.id', 'desc')
        //    ->paginate(10);
    }
    public static function getExamR()
    {
        $return = ExamModel::select('exam.*', )
            ->join('users', 'users.id', 'exam.created_by')
            ->where('exam.is_delete', '=', 0)
            ->orderBy('exam.name', 'asc')
            ->get();
        return $return;

    }

    public static function getExam($id)
    {
        return self::find($id);

    }
}