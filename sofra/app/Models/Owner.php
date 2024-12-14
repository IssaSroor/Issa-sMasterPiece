<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'email',
        'password',
        'owner_address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    // In App\Models\Owner.php
    public function kitchen()
    {
        return $this->hasOne(Kitchen::class, 'owner_id');
    }

}
