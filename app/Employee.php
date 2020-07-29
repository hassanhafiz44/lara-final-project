<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function user()
    {
    	return $this->hasOne('App\User', 'id');
    }
}
