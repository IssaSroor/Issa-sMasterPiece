<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen_food_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'kitchen_id',
        'item_id',
    ];

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class, 'kitchen_food_items', 'item_id', 'kitchen_id');
    }

}