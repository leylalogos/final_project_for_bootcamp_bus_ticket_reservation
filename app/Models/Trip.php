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
        'origin', //city_id
        'destination',
        'departure_time',
        'arrival_time',
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

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    public function scopeDate($query, $date)
    {
        if ($date) {
            return $query->whereBetween('departure_time', [$date . ' 00:00:00', $date . ' 23:59:59']);
        }
        return $query;
    }
    public function scopeOrigin($query, $origin)
    {
        return ($origin ? $query->where('origin', $origin) : $query);
    }
    public function scopePrice($query, $sort)
    {
        return $sort ? $query->orderBy('price', $sort) : $query;
    }
    public function scopeBusModel($query, $model)
    {
        return $model ? $query->join('buses', 'buses.id', 'trips.bus_id')->orderBy('buses.name', $model) : $query;
    }
    public function scopeCapacity($query, $capacity)
    {
        return $capacity ? $query->join('buses', 'buses.id', 'trips.bus_id')->orderBy('buses.capacity', $capacity) : $query;
    }
}
