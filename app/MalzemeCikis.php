<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalzemeCikis extends Model
{
    protected $table = "malzeme_cikis";

    public function malzemecikis()
    {
        return $this->belongsTo('App\Malzemeler');
    }
}
