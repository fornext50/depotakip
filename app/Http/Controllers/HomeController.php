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
        //return \App\Malzemeler::all()->take(1);
        $malzemeler = \App\Malzemeler::all();
        $data = [
            'malzemesayisi' => $malzemeler->count(),
            'hareketsayisi' => \App\MalzemeCikis::all()->count(),
            'malzemeler' =>\App\Malzemeler::orderBy('created_at','desc')->take(5)->get()
        ];
       // return response()->json($data);
        return view('index')->with('data',$data);
    }

}
