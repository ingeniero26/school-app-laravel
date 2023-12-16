<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class JourneysModel extends Model
{
    use HasFactory;
    protected $table = 'journeys';

    public static function getJourneysList()
    {
        $return = JourneysModel::select('journeys.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'journeys.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('journeys.name', 'like',
                '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('journeys.created_at', '=',
                Request::get('date'));
        }
        $return = $return->where('journeys.is_delete', '=', 0)

            ->orderBy('journeys.id', 'desc')
            ->paginate(20);
        return $return;
        //$return = $return->orderBy('class.id', 'desc')
        //    ->paginate(10);

    }

     // mostrar datos del admin por ID
     public static function getJourneys($id)
     {
         return self::find($id);
     }
}
