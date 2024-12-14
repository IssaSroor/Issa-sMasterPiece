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
        'item_description',
        'item_price',
        'item_discount',
        'item_image',
        'item_availability',
    ];

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class, 'kitchen_food_items', 'item_id', 'kitchen_id');
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
