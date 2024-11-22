<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'owner_email',
        'owner_password',
        'owner_address',
    ];

    public function kitchen()
    {
        return $this->hasOne(Kitchen::class, 'owner_id');
    }
}
