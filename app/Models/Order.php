<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'items',
        'total',
        'status',
        'payment_method',
        'reference',
        'shipping_status',
        'tracking_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
