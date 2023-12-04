<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check()))
        {
            return redirect('admin/dashboard');
        }
        return view('auth.login');
    }
    //valida los datos en la bd
    public function AuthLogin(Request $request)
    {
       $remember =!empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request ->email,
                        'password' =>$request-> password],true)) {
                        return redirect('admin/dashboard');
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
