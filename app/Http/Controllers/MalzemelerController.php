<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Malzemeler;
use Validator;
class MalzemelerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        return view('envanter.mlist')->with('malzemeler',json_decode($this->getData()));
    }

    public function create()
    {
        //return view('envanter.mdetail', ['type' => 'new','data' => null]);
    }

    public function show($id)
    {
        $data = Malzemeler::all()->where('id',$id);
        return view('envanter.mlist')->with('malzemeler',json_decode($data));
    }

    public  function store(Request $request){
         $validator = Validator::make($request->all(), [
            'madi' => 'required|max:255',
            'mkimlik' => 'required|max:255',
            'mgrubu' => 'required|max:255',
            'mfiyat' => 'required',
            'mdurum' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }
        else{
             $malzeme = \App\Malzemeler::create($request->all());
            return $malzeme;
        }
       
    }

    public function edit($id,Request $request)
    {
        if($request->ajax()){
             $data = $this->getDataByID($id);
        return response()->json($data);
        }
        else
            return view('errors.404');
        //return Request::json($data);
    }


    public function update(Request $request, $id)
    {
       // echo $id;
       // print_r($request->all());
        $malzeme = Malzemeler::find($id);
        $malzeme->madi = $request->madi;
        $malzeme->mkimlik = $request->mkimlik;
        $malzeme->mgrubu = $request->mgrubu;
        $malzeme->mdurum = $request->mdurum;
        $malzeme->mmarka = $request->mmarka;
        $malzeme->mmodel = $request->mmodel;
        $malzeme->mfiyat = $request->mfiyat;
        $malzeme->mozellik = $request->mozellik;
        $malzeme->save();

        return response()->json($malzeme);
        //
        //$malzeme  = \App\Malzemeler::find($id);
        //$malzeme->all($request->all());
        //print_r($malzeme);
        //$malzeme->save();
        //return response()->json($malzeme);
    }
    public function destroy($id)
    {
        $malzeme = Malzemeler::destroy($id);
        return response()->json($malzeme);
    }

    private function getData(){
        $data =Malzemeler::all();
        return json_encode($data);
    }
    private function getDataByID($id){
        $data = Malzemeler::find($id);
        return $data;
    }

}
