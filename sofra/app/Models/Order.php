<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kitchen_id',
        'orderTotalAmount',
        'deliveryAddress',
        'orderStatus',
        'orderPaymentStatus',
        'managed_by',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
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
