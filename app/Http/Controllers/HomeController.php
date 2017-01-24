<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
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
        $malzemeler = \App\Malzemeler::all()->where('deleted',false);
        $data = [
            'malzemesayisi' => $malzemeler->count(),
            'hareketsayisi' => \App\MalzemeCikis::all()->count(),
            'malzemeler' =>\App\Malzemeler::orderBy('created_at','desc')->take(5)->get()
        ];
       // return response()->json($data);
        return view('index')->with('data',$data);
    }

    public function about(){
        return view('about');
    }

    public function profil(){
        return response()->json(Auth::user());
    }

    public function postEdit(Request $request){
        $validator = Validator::make($request->all(), [
            'username'   => 'required|max:255',
            'mail' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }
        $user = \App\User::find($request->uid);
        $user->name = $request->username;
        $user->email = $request->mail;
        $user->save();
        return response()->json($user);
    }

}
