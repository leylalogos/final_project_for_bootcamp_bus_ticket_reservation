<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'bus_id',
        'origin',//city_id
        'destination',
        'departure-time',
        'arrival-time',
    ];
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function from()
    {
        return $this->belongsTo(City::class, 'origin', 'id');
    }
    public function to()
    {
        return $this->belongsTo(City::class, 'destination', 'id');
    }
}
