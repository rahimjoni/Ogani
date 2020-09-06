<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $username;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    =>'required',
            'password'    =>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('validationerror','')
                ->withErrors($validator->errors()->merge(['userSignUp'=>'userSignup']))
                ->withInput();
        }
        $user=Auth::attempt ( array (
            'username' => $request->input ( 'login' ),
            'password' => $request->input ( 'password' )
        ) );
        if($user){
            $request->session()->flash('message', 'You have successfully logged in');
            $request->session()->flash('message_type', 'success');
            return redirect()->back();
        }else{
            $request->session()->flash('message', 'Your Information Is wrong! Try again');
            $request->session()->flash('message_type', 'error');
            return redirect()->back();
        }

    }

    public function username()
    {
        return $this->username;
    }
}
