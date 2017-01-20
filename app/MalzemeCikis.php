<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalzemeCikis extends Model
{
    protected $table = "malzeme_cikis";

    public function malzemeler()
    {
       return $this->hasOne('App\Malzemeler','id','malzeme_id');
    }
    protected $primaryKey = 'malzeme_id'; // or null
    public $incrementing = false;
    protected $fillable = [
        'malzeme_id','cikaran_kisi','cikarma_tarihi','cikarilan_kisi','gerekce', 'aciklama', 'ip'
    ];

    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = $_SERVER['REMOTE_ADDR'];
    }
}
