<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'adminName',
        'adminEmail',
        'adminPassword',
        'adminRole',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'created_by');
    }

    public function resolvedQuestions()
    {
        return $this->hasMany(Question::class, 'resolved_by');
    }

    public function managedOrders()
    {
        return $this->hasMany(Order::class, 'managed_by');
    }

    public function acceptedKitchens()
    {
        return $this->hasMany(Kitchen::class, 'accepted_by');
    }

    public function acceptedReviews()
    {
        return $this->hasMany(Kitchen_review::class, 'accepted_by');
    }
}
