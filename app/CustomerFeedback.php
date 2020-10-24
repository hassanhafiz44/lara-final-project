<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\Customer', 'id');
    }
}
