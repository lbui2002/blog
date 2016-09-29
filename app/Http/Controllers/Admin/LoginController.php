<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
//    protected $redirectTo = '/xxx';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'Logout']);
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);

        //  return redirect(route('admin.login'))->withInput($request->except('password'))->with('msg', '用户名或密码错误');
    }

    /**
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);
    }

    protected function credentials(Request $request)
    {
        $identity = $request->only('email', 'password');
        $identity['is_lock'] = 0;
        return $identity;
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        //$this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended(route('admin.index'));
    }

    protected function authenticated(Request $request, $user)
    {

    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'auth.failed',
            ]);
    }

    protected function Logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();


        return redirect()->route('admin.index');
    }
}
