<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Auth;
// use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check()))
        {
              //validaciones
              if(Auth::user()->user_type ==1) {

                return redirect('admin/dashboard');

               } else
               if(Auth::user()->user_type ==2) {

                return redirect('teacher/dashboard');

               } else
                if(Auth::user()->user_type ==3) {

                    return redirect('student/dashboard');

               } else
               if(Auth::user()->user_type ==4) {

                return redirect('parent/dashboard');

               } else {

                return redirect('schooll/dashboard');

               }
        }
        return view('auth.login');
    }
    //valida los datos en la bd
    public function AuthLogin(Request $request)
    {
       $remember =!empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request ->email,
                        'password' =>$request-> password],true)) {
                       //validaciones
                       if(Auth::user()->user_type ==1) {

                        return redirect('admin/dashboard');

                       } else
                       if(Auth::user()->user_type ==2) {

                        return redirect('teacher/dashboard');

                       } else
                        if(Auth::user()->user_type ==3) {

                            return redirect('student/dashboard');

                       } else
                       if(Auth::user()->user_type ==4) {

                        return redirect('parent/dashboard');

                       } else {

                        return redirect('schooll/dashboard');

                       }

                    } else {
                     return redirect()->back()->with('error','Error, correo o clave incorrectos');
                }

        //dd($request->all());
    }
    public function logout() {

        Auth::logout();
        return redirect(url(''));
    }
}
