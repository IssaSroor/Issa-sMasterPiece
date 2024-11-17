<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen_review extends Model
{
    use HasFactory;

    protected $fillable = [
        'kitchen_id',
        'customer_id',
        'rating',
        'reviewText',
        'accepted_by',
    ];

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
