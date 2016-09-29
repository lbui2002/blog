<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function Index()
    {

        //print_r(Auth::guard('admin')->user());
       // print_r(Auth::guard('user')->user());

//        print_r(Auth::user());


        //return view('admin.index');
    }
}
