<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteData extends Model
{
    protected $fillable = [
        'user_id',
        'vote_id',
        'vote_slug',
        'vote_option',
        'is_verified',
    ];
}
