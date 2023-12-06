<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPaswwordMail;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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

//recuperar contraseña
    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
        $user =User::getEmailSingle($request->email);
        if(!empty($user))
        {
           $user->remember_token = Str::random(30);
           $user->save();
            Mail::to($user->email)->send(new ForgotPaswwordMail($user));
            return redirect()->back()->with('success','Verifica tu correo, y reestablce tu contraseña');

        }
        else
        {
            return redirect()->back()->with('error','Error, el email no esta en nuestro sistema');
        }
    }

    public function reset($remember_token)
    {
        $user =User::getTokenSingle($remember_token);
        if(!empty($user))
         {
            $data['user']= $user;

            return view('auth.reset', $data);
        } else
         {
            abort(404);
        }
    }

    //nueva contraseña
    public function PostReset($token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user =User::getTokenSingle($token);
            $user->password =Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect(url(''))->with('success','Contraseña cambiada con exito');

        } else
        {
            return redirect()->back()->with('error','Error, las contraseñas no conciden, verifiquelas');

        }
    }



//cerrar session
    public function logout() {

        Auth::logout();
        return redirect(url(''));
    }
}
