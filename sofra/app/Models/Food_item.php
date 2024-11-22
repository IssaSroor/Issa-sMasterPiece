<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'kitchen_id',
        'category_id',
        'item_name',
        'item_price',
        'discount',
        'item_image',
        'item_availability',
    ];

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orderItems', 'item_id', 'order_id')
            ->withPivot('quantity', 'price');
    }
}
