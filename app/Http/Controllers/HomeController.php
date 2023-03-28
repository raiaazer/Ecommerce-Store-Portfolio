<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
        return view('home', ["msg"=>"I'm User Role"]);
    }

    public function editorHome()
    {
        return view('home', ["msg"=>"I'm Editor Role"]);
    }

    public function adminDashboard()
    {
        return view('admin.dashboard', ["msg"=>"Successfully Login!"]);
    }
}
