<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function foodItem()
    {
        return $this->belongsTo(Food_item::class, 'item_id');
    }
}
