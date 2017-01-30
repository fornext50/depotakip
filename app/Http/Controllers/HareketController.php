<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MalzemeCikis;
use App\Malzemeler;
use App\Tblog;
use Validator;

class HareketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hareketler = MalzemeCikis::orderBy('created_at','desc')->get();
        $malzemeler = \App\Malzemeler::orderBy('created_at','desc')->where('deleted',false)->get();
        return view('envanter.mclist',['hareketler' => $hareketler,'malzemeler'=>$malzemeler,'pagetype'=>'0']);
    }

    public function create()
    {
        return view('errors.404');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'malzeme_id' => 'required',
            'cikarilan_kisi' => 'required|max:255',
            'gerekce'        => 'required|max:255',
            'cikarma_tarihi' => 'required',
            'teslim_birimi' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],404); // Status code here
        }
        else
        {
            $malzeme                 = new MalzemeCikis();
            $malzeme->malzeme_id     = $request->malzeme_id;
            $malzeme->cikaran_kisi   = \Auth::user()->name;
            $malzeme->cikarilan_kisi = $request->cikarilan_kisi;
            $malzeme->cikarma_tarihi = $request->cikarma_tarihi;
            $malzeme->teslim_birimi  = $request->teslim_birimi;
            $malzeme->teslim_turu    = $request->teslim_turu;
            $malzeme->gerekce        = $request->gerekce;
            $malzeme->aciklama       = $request->aciklama;
            $malzeme->ip             = $_SERVER['REMOTE_ADDR'];
            $malzeme->save();
            $yazi = sprintf('%s kimlik numaralı %s malzemeyi,  %s gerekçe ile %s kişisi tarafından %s kişiye çıkış isteği yapıldı.',$malzeme->malzemeler[0]->mkimlik,$malzeme->malzemeler[0]->madi,$malzeme->gerekce,$malzeme->cikaran_kisi,$malzeme->cikarilan_kisi);
            Tblog::loglama('MalzemeCikis',$yazi,'malzeme_cikis');
            return $malzeme;
        }
    }

    public function show($id)
    {
       $hareketler = MalzemeCikis::orderBy('created_at','desc')->where('teslim_turu','0')->where('gerial',false)->get();
       //return $hareketler;
       return view('envanter.mclist',['hareketler' => $hareketler,'pagetype'=>'1']);
    }

    public function edit($id,Request $request)
    {
        if($request->ajax()){
             $data = MalzemeCikis::findOrFail($id);
        return response()->json($data);
        }
        else
            return view('errors.404');
    }

    public function update(Request $request, $id)
    {
        $hareketler                 = MalzemeCikis::findOrFail($id);
        $hareketler->cikaran_kisi   = \Auth::user()->name;
        $hareketler->cikarilan_kisi = $request->cikarilan_kisi;
        $hareketler->cikarma_tarihi = $request->cikarma_tarihi;
        $hareketler->teslim_birimi  =  $reques->teslim_birimi;
        $hareketler->teslim_turu    = $request->teslim_turu;
        $hareketler->gerekce        = $request->gerekce;
        $hareketler->aciklama       = $request->aciklama;
        $hareketler->save();

        return response()->json($hareketler);
    }

    public function destroy($id)
    {
        $hareket2 = MalzemeCikis::findOrFail($id);
        $hareket = MalzemeCikis::destroy($id);
        $yazi = sprintf('%s kişiye yapılan %s malzemesinin çıkış isteğini SİLDİ(İPTAL ETTİ)',$hareket2->cikarilan_kisi,$hareket2->malzemeler[0]->madi);
        Tblog::loglama('MalzemeKayit',$yazi,'malzeme_cikis');
        return response()->json($hareket);
    }

    public function setMalzemeDeleted(){

    }
}
