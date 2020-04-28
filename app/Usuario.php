<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyResetPassword;


class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','password','rut', 'email','numero','id_tipo_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getKeyName(){
        return "id_user";
    }

    /**
     *
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

}
