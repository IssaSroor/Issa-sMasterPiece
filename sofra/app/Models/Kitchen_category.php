<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'kitchen_id',
        'category_id',
    ];

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class);
    }

    /**
     * The category that belongs to a kitchen.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}