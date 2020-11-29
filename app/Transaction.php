<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['type', 'description', 'amount', 'retail_amount', 'invoice_id'];
}
