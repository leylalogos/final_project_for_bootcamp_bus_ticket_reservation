<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'role_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    const USER_TYPE_ADMIN = 1;
    const USER_TYPE_SUPER_USER = 2;
    const USER_TYPE_NORMAL_USER = 3;
    const USER_TYPE_COMPANY = 4;

    protected $attributes = ['role_id' => self::USER_TYPE_NORMAL_USER];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getGenderAttribute()
    {
        return $this->is_male ? 'man' : 'woman';
    }
}
