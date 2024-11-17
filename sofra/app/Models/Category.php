<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryName',
        'categoryImage',
        'created_by',
    ];

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class, 'kitchenCategories', 'category_id', 'kitchen_id');
    }

    public function foodItems()
    {
        return $this->hasMany(Food_item::class, 'category_id');
    }
}
