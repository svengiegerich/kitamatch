<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
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
        $user = User::create([
            'email' => $data['email'],
            'account_type' => $data['accountType'],
            'password' => Hash::make($data['password'])
        ]);
        
        if ($data['accountType'] == 1) {
            //account-type is guardian
            $request = new Request();
            $request->setMethod('POST');
            $request->request->add(['uid' => $user->id]);
            app('App\Http\Controllers\GuardianController')->store($request);
        } else if ($data['accountType'] == 2 || $data['accountType'] == 3) {
            //account-type private or public
            //2: public, 3:private
            
            $request = new Request();
            $request->setMethod('POST');
            if ($data['accountType'] == 2) { 
                $p_kind = 1; 
                $coordination = 1; 
            } else if ($data['accountType'] == 3) { 
                $p_kind = 2; 
                $coordination = 0; 
            }
            
            $request->request->add(['uid' => $user->id,
                                   'coordination' => $coordination,
                                   'p_kind' => $p_kind]);
            app('App\Http\Controllers\ProgramController')->store($request);
        } else {
            //error
        }
        
        return $user;
    }
}
