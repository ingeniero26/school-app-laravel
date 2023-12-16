<?php

namespace App\Http\Controllers;

use App\Models\JourneysModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JourneysController extends Controller
{
    public function list()
    {
        $data['getRecord'] = JourneysModel::getJourneysList();
        $data['header_title'] = 'Journeys List';
        return view('admin.journeys.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Journeys';
        return view('admin.journeys.add', $data);
    }

    public function insert(Request $request)
    {
        //valida si el nombrede la clase si ya esta en el sistema
        // request()->validate([
        //     'name'=> 'required|name|unique:class'
        // ]);

        $journeys = new JourneysModel;
        $journeys->name = $request->name;
        $journeys->abbreviation = $request->abbreviation;

        $journeys->status = $request->status;
        $journeys->created_by = Auth::user()->id;

        $journeys->save();

        return redirect('admin/journeys/list')->with('success', 'Jornada registrado con exito');
    }

    public function delete($id)
    {
        $journeys = JourneysModel::getJourneys($id);
        $journeys->is_delete = 1;
        $journeys->save();
        return redirect()->back()->with('success', 'Jornada eliminado con exito');

    }
    public function edit($id)
    {
        $data['getRecord'] = JourneysModel::getJourneys($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Editar Jornada';
            return view('admin.journeys.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        // request()->validate([
        //     'email'=> 'required|email|unique:users,email,',$id
        // ]);
        $journeys = JourneysModel::getJourneys($id);
        $journeys->name = $request->name;
        $journeys->abbreviation = $request->abbreviation;
       
        $journeys->status = $request->status;
        $journeys->save();

        return redirect('admin/journeys/list')->with('success', 'Jornada editado con exito');
    }


}
