<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['user_type']!='company'){
            return Validator::make($data, [
                'user_type' => ['required', 'string', 'max:255'],
                'company' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else{
            return Validator::make($data, [
                'user_type' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //print_r($data); exit;
        
        if($data['user_type']!='company'){
            $userc= User::create([
                'user_type' => $data['user_type'],
                'company' => $data['company'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } else{
            $userc =  User::create([
                'user_type' => $data['user_type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

        }
        if(!empty($data['event_id'])){
            $rdata['event_id']=$data['event_id'];
            $rdata['user_id']=$userc->id;
            $rdata['user_type']=$data['user_type'];
            $query=DB::table('event_user')->insertGetId($rdata);
        }
        return $userc;
        
    }
    protected function showRegistrationForm()
    {
        //DB::enableQueryLog();
        $data['companies']=User::where('user_type','company')->pluck('name','id')->toArray();
        //print_r($data['companies']); exit();
        //$query = DB::getQueryLog();
        //print_r(end($query)); exit;
        return view('auth.register')->with(compact('data'));
    }


}
