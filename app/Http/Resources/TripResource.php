<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'departure_time' =>$this->departure_time,
            'arrival_time' =>$this->arrival_time,
            'origin' => $this->from->name,
            'destination' => $this->to->name,
            'bus'=>new BusResource($this->bus),
        ];
    }
}
