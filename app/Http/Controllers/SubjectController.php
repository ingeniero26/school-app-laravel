<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getSubjectList();
        $data['header_title'] = 'Class List';
        return view('admin.subject.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Subject';
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
        //valida si el nombrede la clase si ya esta en el sistema
        // request()->validate([
        //     'name'=> 'required|name|unique:class'
        // ]);

        $subject = new SubjectModel;
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->created_by = Auth::user()->id;

        $subject->save();

        return redirect('admin/subject/list')->with('success', 'Asignatura registrado con exito');
    }

    // eliminar admin
    public function delete($id)
    {
        $subject = SubjectModel::getSubject($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect()->back()->with('success', 'Asignatura eliminado con exito');

    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSubject($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Editar Clase';
            return view('admin.subject.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        // request()->validate([
        //     'email'=> 'required|email|unique:users,email,',$id
        // ]);
        $subject = SubjectModel::getSubject($id);
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);

        $subject->save();

        return redirect('admin/subject/list')->with('success', 'Asignatura editado con exito');
    }
}
