<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected function authenticated(Request $request){
        $request->session()->flash('toastr', config('toastr.login'));
        return redirect('/view');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return 'name';
    }

    use AuthenticatesUsers {
        logout as performLogout;
    }
    public function logout(Request $request){
        $this->performLogout($request);
        $request->session()->invalidate();
        $request->session()->regenerate();
        $request->session()->flash('toastr', config('toastr.logout'));
        return redirect('/view');
    }

}
