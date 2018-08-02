<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Profile::getDoctors();

        return view('home', compact('doctors'));
        // return Auth::user()->is_admin ? view('admin.dashboard') : view('home');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
