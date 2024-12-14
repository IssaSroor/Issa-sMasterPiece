<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'kitchen_id',
        'order_total_amount',
        'order_address',
        'order_status',
        'order_payment_status',
        'managed_by',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id'); 
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    public function items()
    {
        return $this->hasMany(Order_item::class, 'order_id');
    }
}
