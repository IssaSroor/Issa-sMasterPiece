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
        'review_text',
        'accepted_by',
        'review_status'
    ];

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function kitchens()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }
    
}
