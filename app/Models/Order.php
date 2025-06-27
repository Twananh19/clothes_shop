<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'stripe_payment_intent_id',
        'payment_status',
        'order_items'
    ];

    protected $casts = [
        'order_items' => 'array',
        'total_amount' => 'decimal:2'
    ];
}
