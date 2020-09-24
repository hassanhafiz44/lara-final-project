<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function products()
    {
        return $this->hasMany('App\InvoiceProduct');
    }

    public function customer()
    {
       return $this->belongsTo('App\Customer');
    }
}
