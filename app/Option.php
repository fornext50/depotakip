<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
   	public static function getKeyValue($key){
   		$key = Option::where('key',$key)->first();
   		return $key->value;
   	}
}
