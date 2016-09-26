<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Auth;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:31',
            'studentID' => array('required', 'unique:users', 'regex:/^[a-zA-Z][0-9]{8}$/'),
            'password' => 'required|min:6|max:20|confirmed',
            //'verify' => 'required|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'studentID' => $data['studentID'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        /*$check_verify = DB::table('verify_codes')->where('verify', $request->verify)->get();

        if (current($check_verify) != null) {
            $this->guard()->login($this->create($request->all()));
            DB::table('verify_codes')->where('verify', $request->verify)->delete();
            DB::table('users')->where('studentID', Auth::user()->studentID)->update(['online' => 'on']);
        } else {
            return redirect('/register')->with('NotFound', true)->with('message', '通行碼不對喔');
        }*/

        $this->guard()->login($this->create($request->all()));
        DB::table('users')->where('studentID',Auth::user()->studentID)->update(['online' => 'on']);

        //return redirect($this->redirectPath());
        return Redirect::to("/sendmail");
    }

}
