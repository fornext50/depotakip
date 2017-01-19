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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'malzemesayisi' => \App\Malzemeler::all()->count(),
            'hareketsayisi' => \App\MalzemeCikis::all()->count()
        ];
       // return response()->json($data);
        return view('index')->with('data',$data);
    }

}
