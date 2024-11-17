<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'kitchenName',
        'kitchenShortDesc',
        'kitchenDescription',
        'kitchenPhoneNumber',
        'kitchenRating',
        'kitchenAddress',
        'kitchenStatus',
        'kitchenWorkingHours',
        'accepted_by',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'kitchenCategories', 'kitchen_id', 'category_id');
    }

    public function foodItems()
    {
        return $this->hasMany(Food_item::class, 'kitchen_id');
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
    
}
