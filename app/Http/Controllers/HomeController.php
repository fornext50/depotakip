<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use Hash;
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
        //$malzemeler = \App\Malzemeler::all()->where('deleted',false);
        $malzemeler = \App\Malzemeler::orderBy('created_at','desc')->where('deleted','0');
        $hareketler2 = \App\MalzemeCikis::where('teslim_turu','0')->where('gerial',false);
        $data = [
            'malzemesayisi' => \App\Malzemeler::where('deleted','0')->count(),
            'hareketsayisi' => \App\MalzemeCikis::all()->count(),
            'emanetsayisi' => \App\MalzemeCikis::where('teslim_turu','0')->where('gerial',false)->count(),
            'malzemeler' =>$malzemeler->take(10)->get(),
            'emanetler' => $hareketler2->take(10)->get(),
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

    public function changePassword(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'oldpassword'     => 'required',
            'newpassword'     => 'required',
            'confirmpassword' => 'required|same:newpassword', 
        ]);
        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }

        $current_password = Auth::User()->password;           
        if(Hash::check($req['oldpassword'], $current_password))
        {           
            $user_id = Auth::User()->id;                       
            $obj_user = \App\User::find($user_id);
            $obj_user->password = Hash::make($req['newpassword']);;
            $obj_user->save(); 
            return response()->json($obj_user);
        }
        else
        {           
            $error = array('current-password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);   
        }
    }

    public function postEdit(Request $request){
        $validator = Validator::make($request->all(), [
            'username'   => 'required|max:255',
            'mail' => 'required|email',
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
