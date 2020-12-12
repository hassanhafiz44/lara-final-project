<?php

namespace App;

use App\Notifications\customPasswordResetNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'cnic', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\CustomerFeedbacks');
    }

    public function paid_invoices() 
    {
        return $this->invoices()->where('payment_status', '=', 'paid');
    }

    public function unpaid_invoices()
    {
        return $this->invoices()->where('payment_status', '=', 'due');
    }

    public function unread_messages()
    {
        return $this->feedbacks()->where('status', '=', 'unread');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new customPasswordResetNotification($token));
    }
}
