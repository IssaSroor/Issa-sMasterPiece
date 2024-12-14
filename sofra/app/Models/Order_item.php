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

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'item_id', 'order_id')
            ->withPivot('quantity', 'price');
    }

    public function foodItem()
    {
        return $this->belongsTo(Food_item::class, 'item_id');
    }
}
