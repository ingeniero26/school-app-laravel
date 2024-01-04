<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

class UserController extends Controller
{
    public function change_password()
    {
        $data['header_title'] = 'Cambiar contraseña';
        return view('profile.change_password', $data);
    }
    //PERFIL
    public function MyAccount()
    {
        $data['getTeacher'] =User::getSingle(Auth::user()->id);
        $data['header_title'] = 'Cambiar Perfil';
        return view('teacher.my_account', $data);
    }

    public function UpdateMyAccount(Request $request)
    {
            //valida si el correo ya esta en el sistema
        $id=Auth::user()->id;
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
        $teacher->admission_number = trim($request->admission_number);
        $teacher->roll_number = trim($request->roll_number);

        $teacher->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
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



        $teacher->save();

        return redirect()->back()->with('success','Perfil editado al sistema');
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password =Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "La clave se actualizo");

        } else {
            return redirect()->back()->with('error', "La clave anterior no coincide con la nuestro base de datos");
        }
    }
}
