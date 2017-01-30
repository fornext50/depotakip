<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Malzemeler;
use App\Tblog;
use Validator;
class MalzemelerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //return json_decode($this->getData());
        return view('envanter.mlist',[
            'malzemeler'=>json_decode($this->getData()),
            'gruplar' => \App\Grup::where('state',true)->get()
            ]);
        //return view('envanter.mlist')->with('malzemeler',,'pagetype','0');
    }

    public function create()
    {
        return view('envanter.mdetail', ['type' => 'new','data' => null]);
    }

    public function show($id)
    {
        $data = Malzemeler::all()->where('id',$id)->where('deleted','0');
        return view('envanter.mlist')->with('malzemeler',json_decode($data));
    }

    public  function store(Request $request){
        $validator = Validator::make($request->all(), [
            'madi'    => 'required|max:255',
            'mkimlik' => 'required|max:255',
            'mgrubu'  => 'required|max:255',
            'mfiyat'  => 'required',
            'mdurum'  => 'required|max:255'
            ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }
        else
        {
           $malzeme = \App\Malzemeler::create($request->all());
           if(!isset($malzeme->mkimlik))
           {
                $message = $malzeme->original;
                return response()->json(['mesaj' => $message],500);
           }
           else
           {
                $yazi = sprintf('%s kimlik numaralı %s malzemesini EKLEDİ',$malzeme->mkimlik,$malzeme->madi);
                Tblog::loglama('MalzemeKayit',$yazi,'Malzemeler');
           }
           
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
    $malzeme           = Malzemeler::findOrFail($id);
    $malzeme->madi     = $request->madi;
    $malzeme->mkimlik  = $request->mkimlik;
    $malzeme->mgrubu   = $request->mgrubu;
    $malzeme->mdurum   = $request->mdurum;
    $malzeme->mmarka   = $request->mmarka;
    $malzeme->mmodel   = $request->mmodel;
    $malzeme->mfiyat   = $request->mfiyat;
    $malzeme->mozellik = $request->mozellik;
    $malzeme->save();
    $yazi = sprintf('%s kimlik numaralı %s malzemesini GÜNCELLEDİ',$malzeme->mkimlik,$malzeme->madi);
    Tblog::loglama('MalzemeKayit',$yazi,'Malzeme');
    return response()->json($malzeme);
}
public function destroy(Request $req,$id)
{   
    $malzeme = Malzemeler::findOrFail($id);

    if($req->durum == 'onay')
    {
        if($req->types == '0')
            $malzeme->deleted = '2';
        else
            $malzeme->deleted = '1';
        $har = \App\MalzemeCikis::findOrFail($req->hareket_id);
        $har->gerial = false;
        $har->save();
    }
    else
        $malzeme->deleted = '0';

    $malzeme->save();
    $yazi = sprintf('%s kimlik numaralı %s malzemesini SİLDİ',$malzeme->mkimlik,$malzeme->madi);
    if($req->durum == 'onay')
    {
        if($req->types == '0')
            $yazi = sprintf('%s kimlik numaralı %s malzemesinin çıkışını ONAYLAYIP emanet verildi',$malzeme->mkimlik,$malzeme->madi);
        else
            $yazi = sprintf('%s kimlik numaralı %s malzemesinin çıkışını ONAYLAYIP zimmet edildi',$malzeme->mkimlik,$malzeme->madi);

        Tblog::loglama('MalzemeKayit',$yazi,'Malzeme');
    }
    if($req->durum == 'gerial'){
        $har = \App\MalzemeCikis::findOrFail($req->hareket_id);
        $har->onay = false;
        $har->gerial = true;
        $har->save();
        $yazi = sprintf('%s kimlik numaralı %s malzemesini geri stoğa EKLEDİ',$malzeme->mkimlik,$malzeme->madi);
        Tblog::loglama('MalzemeKayit',$yazi,'Malzeme');
    }

    return response()->json($malzeme);
}

private function getData(){
    $data =Malzemeler::orderBy('created_at','desc')->where('deleted',false)->get();
    return json_encode($data);
}
private function getDataByID($id){
    $data = Malzemeler::findOrFail($id);
    return $data;
}

}
