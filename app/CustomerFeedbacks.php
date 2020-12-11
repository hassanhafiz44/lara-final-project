<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedbacks extends Model
{
    //
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'id');
    }
}
