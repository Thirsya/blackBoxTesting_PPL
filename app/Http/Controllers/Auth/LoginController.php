<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     //protected

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function username()
    {
        return 'username';
    }

    public function redirectTo (){
//  dd(auth()->user()->hasRole('admin'));
//  die;
        if (auth()->user()->hasRole('user')){
            Alert::success('Sukses Masuk Sebagai Pembeli', 'Success');
            return '/dashboardU';     
        }

        else if (auth()->user()->hasRole('admin')){
            Alert::success('Sukses Masuk Sebagai Admin', 'Success');
            return '/dashboard';   
        } else {
            return '/dashboard'; 
        }
    }
        }
