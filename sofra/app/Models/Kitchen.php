<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'kitchen_name',
        'kitchen_short_desc',
        'kitchen_description',
        'kitchen_phone',
        'kitchen_address',
        'kitchen_image',
        'free_delivery',
        'time_for_delivery',
        'kitchen_status',
        'kitchen_state',
        'kitchen_rating',
        'accepted_by',
    ];
    public function getKitchenImageAttribute($value)
    {
        return $value ? 'storage/kitchens/' . $value : 'images/default-kitchen.jpg';
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'kitchen_categories', 'kitchen_id', 'category_id');
    }

    public function foodItems()
{
    return $this->belongsToMany(Food_item::class, 'kitchen_food_items', 'kitchen_id', 'item_id');
}

    public function orders()
    {
        return $this->hasMany(Order::class, 'kitchen_id');
    }

    public function reviews()
    {
        return $this->hasMany(Kitchen_review::class, 'kitchen_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'kitchen_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'accepted_by');
    }

}
