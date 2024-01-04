<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = 'Docentes';
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Docente';
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request) {

        //valida si el correo ya esta en el sistema
        request()->validate([
            'email' => 'required|email|unique:users',
             'name' => 'max:250',
             'admission_number' => 'max:50',
             'roll_number' => 'max:50',

             'mobile_number' => 'max:20|min:10',

             'eps' => 'max:50',
             'blood_group' => 'max:10'
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->document_type = trim($request->document_type);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->admission_number = trim($request->admission_number);
        $teacher->roll_number = trim($request->roll_number);

        $teacher->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->admission_date))
        {
            $teacher->admission_date = trim($request->admission_date);
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->occupation = trim($request->occupation);
        $teacher->marital_status = trim($request->marital_status);


        if(!empty($request->file('profile_pic')))
        {

            $ext=$request->file('profile_pic')->getClientOriginalExtension();
            $file =$request->file('profile_pic');
            $randomStr=date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $teacher->profile_pic=$filename;
        }

        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->work_experiencie = trim($request->work_experiencie);
        $teacher->eps = trim($request->eps);
        $teacher->blood_group = trim($request->blood_group);

        $teacher->notes = trim($request->notes);
        $teacher->status = trim($request->status);

        $teacher->user_type = 2;

        $teacher->save();

        return redirect('admin/teacher/list')->with('success','Docente agregado al sistema');
    }

      public function delete($id) {
        $teacher = User::getSingle($id);
        $teacher->is_delete = 1;
        $teacher->save();
        return redirect('admin/teacher/list')->with('success','Docente eliminado con exito');

        }

    public function edit($id)
    {
        $data['getTeacher'] = User::getSingle($id);
        if(!empty($data['getTeacher']))
        {

            $data['header_title'] = 'Editar Docente';
                return view('admin.teacher.edit',$data);
            }
            else
        {
                abort(404);
        }

    }

    public function update($id,Request $request) {

        //valida si el correo ya esta en el sistema
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
             'name' => 'max:250',
             'admission_number' => 'max:50',
             'roll_number' => 'max:50',

             'mobile_number' => 'max:20|min:10',

             'eps' => 'max:50',
             'blood_group' => 'max:10'
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->document_type = trim($request->document_type);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->admission_number = trim($request->admission_number);
        $teacher->roll_number = trim($request->roll_number);

        $teacher->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->admission_date))
        {
            $teacher->admission_date = trim($request->admission_date);
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->occupation = trim($request->occupation);
        $teacher->marital_status = trim($request->marital_status);


        if(!empty($request->file('profile_pic')))
        {

            $ext=$request->file('profile_pic')->getClientOriginalExtension();
            $file =$request->file('profile_pic');
            $randomStr=date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $teacher->profile_pic=$filename;
        }

        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->work_experiencie = trim($request->work_experiencie);
        $teacher->eps = trim($request->eps);
        $teacher->blood_group = trim($request->blood_group);
        $teacher->notes = trim($request->notes);
        $teacher->status = trim($request->status);



        $teacher->save();

        return redirect('admin/teacher/list')->with('success','Docente editado al sistema');
      }


}
