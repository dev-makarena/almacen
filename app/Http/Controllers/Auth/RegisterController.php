<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
         return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'rut' => 'required|string|max:255|unique:usuario',
            'email' => 'required|string|email|max:255|unique:usuario',
            'numero' => 'required|numeric|min:0|not_in:0',
            'password' => 'required|string|min:6|confirmed',
          ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre' => $data['nombre'],
            'rut' => $data['rut'],
            'email' => $data['email'],
            'numero' => $data['numero'],
            'password' => bcrypt($data['password']),
            'id_tipo_user' => 1,
        ]);
    }
}
