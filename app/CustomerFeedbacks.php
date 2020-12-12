<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedbacks extends Model
{
    protected $fillable = [ 'customer_id', 'message', 'status', ];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'id');
    }
}
