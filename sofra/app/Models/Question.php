<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_email',
        'subject',
        'question',
        'resolved_by',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'resolved_by');
    }
}
