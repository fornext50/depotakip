<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalzemeCikis extends Model
{
    protected $table = "malzeme_cikis";

    public function malzemeler()
    {
       return $this->hasMany('App\Malzemeler','id','malzeme_id');
    }
    
    protected $fillable = [
        'malzeme_id','cikaran_kisi','cikarma_tarihi','cikarilan_kisi','gerekce', 'aciklama', 'ip','onay','teslim_birimi'
    ];

    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = $_SERVER['REMOTE_ADDR'];
    }
}
