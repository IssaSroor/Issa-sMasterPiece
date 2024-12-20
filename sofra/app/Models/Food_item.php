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

    public function showOrder($id)
{
    $order = auth()->user()->orders()->with('items')->findOrFail($id);

    return response()->json([
        'id' => $order->id,
        'created_at' => $order->created_at->format('d-m-Y'),
        'total' => $order->order_total_amount,
        'order_status' => $order->order_status,
        'food_items' => $order->items->map(function ($item) {
            return [
                'name' => $item->item_name,
                'quantity' => $item->pivot->quantity, // Quantity from pivot table
                'price' => $item->pivot->item_price, // Price from pivot table
            ];
        }),
    ]);
}

}
