<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Malzemeler extends Model
{
    protected $table = "malzemeler";

    public function malzeme_cikis()
    {
        return $this->belongsTo('App\MalzemeCikis');
    }

    protected $fillable = [
        'madi','mkimlik','mgrubu', 'mmarka', 'mmodel','mfiyat','mdurum','mozellik','ip'
    ];

    public static function create(array $attributes = [])
    {
        if (!is_array($attributes)) {
            return false;
        }
       // print_r( parent::where('deleted','false')->get());
        if(parent::where('deleted',false)->where('mkimlik',$attributes['mkimlik'])->count() > 0)
        {
            $message = "Bu kimlik numarasına ait var malzeme mevcut!";
            return response()->json(['mesaj' => $message],500);
        }
        else
            return parent::create($attributes);
    }

    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = $_SERVER['REMOTE_ADDR'];
    }

}
