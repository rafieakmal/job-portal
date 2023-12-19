<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Vote extends Model
{
    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('d M Y H:i');
    }

    protected $fillable = [
        'owner_id',
        'title',
        'slug',
        'date',
        'time',
        'description',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_password' => 'boolean',
    ];
}
