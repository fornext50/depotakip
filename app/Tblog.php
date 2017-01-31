<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tblog extends Model
{
    public static function loglama($modules,$detay,$tableName)
    {
        $user            = \Auth::user()->name;
        $tarih           = date('d/m/Y');
        $aciklama        = $user ." kullanıcısı ". $tarih . " tarihinde ".$tableName." tablosunda ".$detay;
        $loglama         = new Tblog();
        $loglama->module = $modules;
        $loglama->detail = $aciklama;
        return $loglama->save();
    	//return parent::create(['module'=>$modules, 'detail' => $detay ]);
    	//$flight = App\Tblog::create(['module' => $module,'detail' => $detay]);
    }
}
