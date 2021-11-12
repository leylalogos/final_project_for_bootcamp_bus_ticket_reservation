<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['name'];

    public function tripsFrom()
    {
        return $this->hasMany(Trip::class, 'origin', 'id');
    }
    public function tripsTo()
    {
        return $this->hasMany(Trip::class, 'destination', 'id');
    }
}
