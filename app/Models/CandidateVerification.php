<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_slug',
        'verification_token',
        'verification_key',
        'verification_code',
        'verification_type',
        'verification_receiver'
    ];
}
