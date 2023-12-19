<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use DateTimeInterface;
use Illuminate\Support\Str;
use Illuminate\Auth\Passwords\CanResetPassword;

class Candidate extends Authenticatable implements JWTSubject
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }
    
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'candidate_name',
        'candidate_username',
        'candidate_role',
        'candidate_phone',
        'candidate_email',
        'candidate_gender',
        'candidate_slug',
        'password',
        'candidate_profile_picture',
        'password_verified_at',
        'email_verified_at',
        'phone_verified_at',
        'candidate_last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password_verified_at' => 'datetime',
        'candidate_last_login' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function routeNotificationForMail($notification)
    // {
    //     return $this->candidate_email;
    // }
    

    public function getEmailForPasswordReset()
    {
        return $this->candidate_email;
    }

    public function routeNotificationFor($driver)
    {
        if (method_exists($this, $method = 'routeNotificationFor' . Str::studly($driver))) {
            return $this->{$method}();
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->candidate_email;
            case 'nexmo':
                return $this->candidate_phone;
        }
    }
}
