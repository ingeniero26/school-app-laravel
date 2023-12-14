<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassModel::getClassList();
        $data['header_title'] = 'Class List';
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Class';
        return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
        //valida si el nombrede la clase si ya esta en el sistema
        // request()->validate([
        //     'name'=> 'required|name|unique:class'
        // ]);

        $class = new ClassModel;
        $class->name = $request->name;
        $class->years = $request->years;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;

        $class->save();

        return redirect('admin/class/list')->with('success', 'Clase registrado con exito');
    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getClass($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Editar Clase';
            return view('admin.class.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        // request()->validate([
        //     'email'=> 'required|email|unique:users,email,',$id
        // ]);
        $class = ClassModel::getClass($id);
        $class->name = $request->name;
        $class->years = $request->years;
        $class->status = $request->status;
        $class->save();

        return redirect('admin/class/list')->with('success', 'Clase editado con exito');
    }

    // eliminar admin
    public function delete($id)
    {
        $class = ClassModel::getClass($id);
        $class->is_delete = 1;
        $class->save();
        return redirect()->back()->with('success', 'Clase eliminado con exito');

    }

}
