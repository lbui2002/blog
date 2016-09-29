<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function getRegister()
    {
        return view('admin.register');
    }

    public function postRegister(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = $this->create($request->all());
//        event(new Registered($admin = $this->create($request->all())));
        $this->guard()->login($admin);
        return redirect(route('admin.index'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:16',
            'email' => 'required|email|max:32|unique:admin',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
