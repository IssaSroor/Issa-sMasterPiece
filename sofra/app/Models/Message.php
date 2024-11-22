<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'kitchen_id',
        'message_subject',
        'message_text',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }
}
