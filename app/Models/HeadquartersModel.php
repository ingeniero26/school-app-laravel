<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class HeadquartersModel extends Model
{
    use HasFactory;
    protected $table = 'headquarters';

    public static function getheadquartersList()
    {
        $return = HeadquartersModel::select('headquarters.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'headquarters.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('headquarters.name', 'like',
                '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('headquarters.created_at', '=',
                Request::get('date'));
        }
        $return = $return->where('headquarters.is_delete', '=', 0)

            ->orderBy('headquarters.id', 'desc')
            ->paginate(20);
        return $return;
        //$return = $return->orderBy('class.id', 'desc')
        //    ->paginate(10);

    }

     // mostrar datos del admin por ID
     public static function getHeadquarters($id)
     {
         return self::find($id);
     }

     // COMBO
     public static function getHeadquaterSelect() {
        $return = HeadquartersModel::select('headquarters.*')
        ->join('users', 'users.id', 'headquarters.created_by')
        ->where('headquarters.is_delete', '=', 0)
        ->where('headquarters.status', '=', 0)
        ->orderBy('headquarters.name', 'asc')
        ->get();
    return $return;
    }
}
