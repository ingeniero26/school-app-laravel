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
    //PERFIL DOCENTE
    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['getTeacher'] = User::getSingle(Auth::user()->id);
        $data['getStudent'] = User::getSingle(Auth::user()->id);
        $data['getParent'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = 'Cambiar Perfil';

        if (Auth::user()->user_type == 1) {
            return view('admin.my_account', $data);

        }else if (Auth::user()->user_type == 2) {
            return view('teacher.my_account', $data);

        } elseif (Auth::user()->user_type == 3) {
            return view('student.my_account', $data);

        } elseif (Auth::user()->user_type == 4) {
            return view('parent.my_account', $data);
        }
    }


    public function UpdateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email'=> 'required|email|unique:users,email,'.$id
        ]);
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        $user->save();
        return redirect()->back()->with('success', 'Perfil editado al sistema');

    }
    public function UpdateMyAccount(Request $request)
    {
        //valida si el correo ya esta en el sistema
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'max:250',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',

            'mobile_number' => 'max:20|min:10',

            'eps' => 'max:50',
            'blood_group' => 'max:10',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->document_type = trim($request->document_type);
        $teacher->email = trim($request->email);
        $teacher->admission_number = trim($request->admission_number);
        $teacher->roll_number = trim($request->roll_number);

        $teacher->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->occupation = trim($request->occupation);
        $teacher->marital_status = trim($request->marital_status);

        if (!empty($request->file('profile_pic'))) {

            if (!empty($teacher->getProfile())) {
                unlink('upload/profile/' . $teacher->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->work_experiencie = trim($request->work_experiencie);
        $teacher->eps = trim($request->eps);
        $teacher->blood_group = trim($request->blood_group);
        $teacher->notes = trim($request->notes);

        $teacher->save();

        return redirect()->back()->with('success', 'Perfil editado al sistema');
    }

    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'max:250',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',

            'mobile_number' => 'max:20|min:10',

            'eps' => 'max:50',
            'blood_group' => 'max:10',
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->document_type = trim($request->document_type);
        $student->email = trim($request->email);
        $student->roll_number = trim($request->roll_number);

        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        $student->mobile_number = trim($request->mobile_number);
        $student->occupation = trim($request->occupation);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($student->getProfile())) {
                unlink('upload/profile/' . $student->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }

        $student->address = trim($request->address);
        $student->eps = trim($request->eps);
        $student->blood_group = trim($request->blood_group);

        $student->save();

        return redirect()->back()->with('success', 'Perfil editado al sistema');
    }

    public function UpdateMyAccountParent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'max:250',

            'roll_number' => 'max:50',

            'mobile_number' => 'max:20|min:10',

        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->document_type = trim($request->document_type);
        $parent->email = trim($request->email);
        $parent->roll_number = trim($request->roll_number);
        $parent->gender = trim($request->gender);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($parent->getProfile())) {
                unlink('upload/profile/' . $parent->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $parent->profile_pic = $filename;
        }
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->occupation = trim($request->occupation);
        $parent->eps = trim($request->eps);
        $parent->blood_group = trim($request->blood_group);
        $parent->save();

        return redirect()->back()->with('success', 'Perfil editado al sistema');
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "La clave se actualizo");

        } else {
            return redirect()->back()->with('error', "La clave anterior no coincide con la nuestro base de datos");
        }
    }

    //PERFIL ESTUDIANTE

}
