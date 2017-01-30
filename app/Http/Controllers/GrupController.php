<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grup;
use App\Tblog;
use Validator;
class GrupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$gruplar = $this->getDataGrup(true);
    	return view('tanimlamalar.gruptanim',compact("gruplar"));
    }

    public function create()
    {
        return view('errors.404');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grpname' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }
        else
        {
			$grup       = new Grup();
			$grup->name = $request->grpname;
			$grup->save();

			$yazi       = sprintf('%s grup EKLEDİ.',$grup->name);
			Tblog::loglama('Tanımlama->Grup',$yazi,'grup');
			return $grup;
        }
    }

    public function show($id)
    {

    }

    public function edit($id,Request $request)
    {
    	if($request->ajax()){
            $data = $this->getDataGrupID($id);
            return response()->json($data);
        }
        else
            return view('errors.404');
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'grpname' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }
        else
        {
			$grup = Grup::findOrFail($id);
	       	$grup->name = $request->grpname;
	       	$grup->save();
	       	$yazi = sprintf('%s Grup adını GÜNCELLEDİ',$grup->name);
		    Tblog::loglama('Tanımlama->Grup',$yazi,'grup');
		    return response()->json($grup);
        }
    }

    public function destroy(Request $req,$id)
    {
    	$grup = Grup::findOrFail($id);
    	if($req->durum == 'active')
    		$grup->state = !$grup->state;
    	else
    		$grup->deleted = true;
    	$grup->save();
    	if(!$req->durum == 'active'){
    		$yazi = sprintf('%s grup adını SİLDİ',$grup->name);
    		Tblog::loglama('Tanımlama->Grup',$yazi,'grup');
    	}
    	return response()->json($grup);
    }

    private function getDataGrup($state){
    	return $state ? Grup::where('deleted',false)->get() :  Grup::where('deleted',false)->where('state',$state);
    }
    private function getDataGrupID($id){
    	return Grup::where('deleted',false)->where('id',$id)->first();
    }
}
