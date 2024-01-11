<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\HeadquartersModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = AssignClassTeacherModel::getRecord();
        $data['header_title'] = 'Modelos Docentes';
        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getClassSubject'] = ClassModel::getClassSubject();
        $data['getTeacher'] = User::getTeacherClass();
        $data['header_title'] = 'Add  Class';
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $request->teacher_id);
                if (!empty($getAlreadyFirst)) {

                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                } else {
                    $subject_class_teacher = new AssignClassTeacherModel;
                    $subject_class_teacher->class_id = $request->class_id;
                    $subject_class_teacher->teacher_id = $teacher_id;
                    $subject_class_teacher->status = trim($request->status);
                    $subject_class_teacher->created_by = Auth::user()->id;

                    $subject_class_teacher->save();
                }

            }
            return redirect('admin/assign_class_teacher/list')->with('success', 'Asignatura registrado con exito');

        } else {
            return redirect()->back()->with('error', 'No selecciono ninguna materia para esa clase');
        }
    }

    public function edit($id)
    {
        $getRecord = AssignClassTeacherModel::getAssignClassTeacher($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherID'] = AssignClassTeacherModel::getAssignTeacherID($getRecord->teacher_id);
            $data['getClassSubject'] = ClassModel::getClassSubject();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = 'Editar Asignacion';
            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        AssignClassTeacherModel::deleteAssignTeacher($request->class_id);
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $request->headquarter_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {

                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                } else {
                    $subject_class_teacher = new AssignClassTeacherModel;
                    $subject_class_teacher->class_id = $request->class_id;
                    $subject_class_teacher->headquarter_id = $request->headquarter_id;
                    $subject_class_teacher->teacher_id = $teacher_id;
                    $subject_class_teacher->status = trim($request->status);
                    $subject_class_teacher->created_by = Auth::user()->id;

                    $subject_class_teacher->save();
                }

            }

        }
        return redirect('admin/assign_class_teacher/list')->with('success', 'Asignatura registrado con exito');

    }

    public function delete($id)
    {
        $assign_class_teacher = AssignClassTeacherModel::getAssignClassTeacher($id);
        $assign_class_teacher->is_delete = 1;
        $assign_class_teacher->save();
        return redirect()->back()->with('success', 'Registro eliminado con exito');

    }

    public function edit_single($id)
    {
        $getRecord = AssignClassTeacherModel::getAssignClassTeacher($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClassSubject'] = ClassModel::getClassSubject();
            $data['getHeadquater'] = HeadquartersModel::getheadquartersList();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = 'Editar Asignacion';
            return view('admin.assign_class_teacher.edit_single', $data);
        } else {
            abort(404);
        }
    }

    public function update_single($id, Request $request)
    {
        $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $request->headquarter_id, $request->teacher_id);
        if (!empty($getAlreadyFirst)) {

            $getAlreadyFirst->status = trim($request->status);
            $getAlreadyFirst->save();
            return redirect('admin/assign_class_teacher/list')->with('success', 'Estado editado con exito');

        } else {
            $subject_class_teacher = AssignClassTeacherModel::getAssignClassTeacher($id);
            $subject_class_teacher->class_id = $request->class_id;
            $subject_class_teacher->headquarter_id = $request->headquarter_id;
            $subject_class_teacher->teacher_id = $request->teacher_id;
            $subject_class_teacher->status = $request->status;
            $subject_class_teacher->save();

            return redirect('admin/assign_class_teacher/list')->with('success', 'Docente registrado con exito');

        }

    }

    // DOCENTE
    public function MyClassSubject()
    {

        $data['getRecord'] =AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);
        $data['header_title'] = 'Programas -Modulos Asignados';
        return view('teacher.my_class_subject', $data);
    }

}
