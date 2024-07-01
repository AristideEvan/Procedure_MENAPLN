<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User\User;
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
       // $this->middleware('guest');
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
            'identifiant'=>['required','string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telephone'=>['required','string'],
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
       // dd($data);
        //return 
        User::create([
            'profil_id' => $data['profil_type'],
            'niveauAction' => $data['zone'],
            'username' => $data['identifiant'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'actif' => $data['actif'],
            'password' => Hash::make($data['password']),
            'region_id'=>(array_key_exists("nomRegion", $data))?$data['nomRegion']:0,
            'province_id'=>(array_key_exists("nomProvince", $data))?$data['nomProvince']:0,
            'commune_id'=>(array_key_exists("nomCommune", $data))?$data['nomCommune']:0,
        ]);
    }
}
