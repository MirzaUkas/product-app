<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        if(\Auth::guard('web')->attempt($request->only(['user','password']), $request->get('remember')))
        {
            $request->session()->regenerate();
            return redirect()->route('home')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'user' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('user');

    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['route' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'user'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('admin')->attempt($request->only(['user','password']), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput($request->only('user', 'remember'));
    }

    public function showStaffLoginForm()
    {
        return view('auth.login', ['route' => route('staff.login-view'), 'title'=>'Staff']);
    }

    public function staffLogin(Request $request)
    {
        $this->validate($request, [
            'user'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('staff')->attempt($request->only(['user','password']), $request->get('remember'))){
            return redirect()->intended('/staff/dashboard');
        }

        return back()->withInput($request->only('user', 'remember'));
    }
}
