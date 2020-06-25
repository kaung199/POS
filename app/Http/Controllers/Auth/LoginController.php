<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }

    public function redirectTo(){
        
        // User role
        $role = Auth::user()->id; 
        
        // Check user role
        switch ($role) {
            case 2:
                    return '/pawn';
                break;
            case 3:
                    return '/pawn';
                break;
            case 4:
                    return '/sales';
                break;
            case 5:
                    return '/online_shop';
                break;
            case 6:
                    return '/products';
                break;
            case 7:
                    return '/stock-check';
                break;
            default:
                    return '/login'; 
                break;
        }
    }
}
