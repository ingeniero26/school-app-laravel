<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ClassSubjectModel::getAssignList();
        $data['header_title'] = 'Asign List';
        return view('admin.assign_subject/list', $data);
    }

    public function add()
    {
        $data['getClassSubject'] = ClassModel::getClassSubject();
        $data['getSubjectClass'] = SubjectModel::getSubjectClass();
        $data['header_title'] = 'Add  Class';
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) {

                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                } else {
                    $subject = new ClassSubjectModel;
                    $subject->class_id = $request->class_id;
                    $subject->subject_id = $subject_id;
                    $subject->status = trim($request->status);
                    $subject->created_by = Auth::user()->id;

                    $subject->save();
                }

            }
            return redirect('admin/assign_subject/list')->with('success', 'Asignatura registrado con exito');

        } else {
            return redirect()->back()->with('error', 'No selecciono ninguna materia para esa clase');
        }
    }

    public function edit($id)
    {
        $getRecord = ClassSubjectModel::getAssingClass($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id);
            $data['getClassSubject'] = ClassModel::getClassSubject();
            $data['getSubjectClass'] = SubjectModel::getSubjectClass();
            $data['header_title'] = 'Editar Asignacion';
            return view('admin.assign_subject.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update(Request $request)
    {
        ClassSubjectModel::deleteSubject($request->class_id);
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) {

                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                } else {
                    $subject = new ClassSubjectModel;
                    $subject->class_id = $request->class_id;
                    $subject->subject_id = $subject_id;
                    $subject->status = trim($request->status);
                    $subject->created_by = Auth::user()->id;

                    $subject->save();
                }

            }

        }
        return redirect('admin/assign_subject/list')->with('success', 'Asignatura registrado con exito');

    }

    // eliminar admin
    public function delete($id)
    {
        $subject_class = ClassSubjectModel::getAssingClass($id);
        $subject_class->is_delete = 1;
        $subject_class->save();
        return redirect()->back()->with('success', 'Registro eliminado con exito');

    }


    public function edit_single($id)
    {
        $getRecord = ClassSubjectModel::getAssingClass($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClassSubject'] = ClassModel::getClassSubject();
            $data['getSubjectClass'] = SubjectModel::getSubjectClass();
            $data['header_title'] = 'Editar Asignacion';
            return view('admin.assign_subject.edit_single', $data);
        } else {
            abort(404);
        }
    }

    //editar un solo registro
    public function update_single($id, Request $request)
    {
        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);
            if (!empty($getAlreadyFirst)) {

                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                    return redirect('admin/assign_subject/list')->with('success', 'Estado editado con exito');

                } else {
                    $subject_asiign =ClassSubjectModel::getAssingClass($id);
                    $subject_asiign->class_id = $request->class_id;
                    $subject_asiign->subject_id = $request->subject_id;
                    $subject_asiign->status = $request->status;
                    $subject_asiign->save();

                    return redirect('admin/assign_subject/list')->with('success', 'Asignatura registrado con exito');

                }


    }
}
