<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Charts\UserChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // halaman ini hanya bisa di akses jika sudah login dan memiliki role admin 
        // menggunakan middleware custom
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // get data users and grafik
    public function index()
    {

        return view('home');
    }

}
