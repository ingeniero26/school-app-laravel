<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

// mostrar datos del admin por ID
    public static function getSingle($id)
    {
        return self::find($id);
    }

//getStudent estudiante


public static function getStudent()
{
    $return = self::select('users.*')
        ->where('user_type', '=', 3)
        ->where('is_delete', '=', 0);

    if (!empty(Request::get('name'))) {
        $return = $return->where('name', 'like',
            '%' . Request::get('name') . '%');
    }

    if (!empty(Request::get('email'))) {
        $return = $return->where('email', 'like',
            '%' . Request::get('email') . '%');
    }
    if (!empty(Request::get('date'))) {
        $return = $return->whereDate('created_at', '=',
            Request::get('date'));
    }
    $return = $return->orderBy('id', 'desc')
        ->paginate(10);
    return $return;
}
//type_user = 1 , admin
//type_user = 2 , docente
//type_user = 3 , estudiantes
//type_user = 4 , padre de familia

//listado de administradores
    public static function getAdmin()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 1)
            ->where('users.is_delete', '=', 0);
        $return = $return->orderBy('users.id', 'desc')
            ->paginate(10);
        return $return;
    }

    public static function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    public static function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }


    //OBTENER LA IMAGEN
    public function getProfile()
    {
        if(!empty($this->profile_pic)&& file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return "";
        }
    }
}
