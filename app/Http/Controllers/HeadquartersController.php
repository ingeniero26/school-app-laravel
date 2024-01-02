<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadquartersModel;
use Illuminate\Support\Facades\Auth;

class HeadquartersController extends Controller
{
    public function list()
    {
       $data['getRecord'] = HeadquartersModel::getheadquartersList();
        $data['header_title'] = 'Headquarter List';
        return view('admin.headquarter.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Sede';
        return view('admin.headquarter.add', $data);
    }

    public function insert(Request $request)
    {
        //valida si el nombrede la clase si ya esta en el sistema
        // request()->validate([
        //     'name'=> 'required|name|unique:class'
        // ]);

        $class = new HeadquartersModel;
        $class->name = $request->name;
        $class->address = $request->address;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;

        $class->save();

        return redirect('admin/headquarter/list')->with('success', 'Sede registrado con exito');
    }

      // eliminar admin
      public function delete($id)
      {
          $class = HeadquartersModel::getHeadquarters($id);
          $class->is_delete = 1;
          $class->save();
          return redirect()->back()->with('success', 'Sede eliminado con exito');

      }

      public function edit($id)
      {
          $data['getRecord'] = HeadquartersModel::getHeadquarters($id);
          if (!empty($data['getRecord'])) {
              $data['header_title'] = 'Editar Sede';
              return view('admin.headquarter.edit', $data);
          } else {
              abort(404);
          }

      }

      public function update($id, Request $request)
      {
          // request()->validate([
          //     'email'=> 'required|email|unique:users,email,',$id
          // ]);
          $class = HeadquartersModel::getHeadquarters($id);
          $class->name = $request->name;
          $class->address = $request->address;
          $class->status = $request->status;
          $class->save();

          return redirect('admin/headquarter/list')->with('success', 'Sede editado con exito');
      }
}
