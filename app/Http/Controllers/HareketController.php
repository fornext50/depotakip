<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MalzemeCikis;
use App\Malzemeler;
use Validator;

class HareketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hareketler = MalzemeCikis::all();
        $malzemeler = Malzemeler::all();
        if(count($malzemeler)<=0)
            return redirect('/malzemeler');
        else
            return view('envanter.mclist',['hareketler' => $hareketler,'malzemeler'=>$malzemeler]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('errors.404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cikaran_kisi' => 'required|max:255',
            'cikarilan_kisi' => 'required|max:255',
            'gerekce' => 'required|max:255',
            'cikarma_tarihi' => 'required'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return response()->json(['mesaj' => $message],500); // Status code here
        }
        else
        {
            $malzeme = MalzemeCikis::create($request->all());
            return $malzeme;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Olusacak";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        if($request->ajax()){
             $data = MalzemeCikis::find($id);
        return response()->json($data);
        }
        else
            return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hareketler = MalzemeCikis::find($id);
        $hareketler->cikaran_kisi = $request->cikaran_kisi;
        $hareketler->cikarilan_kisi = $request->cikarilan_kisi;
        $hareketler->cikarma_tarihi = $request->cikarma_tarihi;
        $hareketler->gerekce = $request->gerekce;
        $hareketler->aciklama = $request->aciklama;
        $hareketler->save();

        return response()->json($hareketler);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hareket = MalzemeCikis::destroy($id);
        return response()->json($hareket);
    }
}
