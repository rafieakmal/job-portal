<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class VoteOption extends Model
{
    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('d M Y H:i');
    }

    protected $fillable = [
        'image',
        'name',
        'vote_slug',
        'total_vote'
    ];
}
