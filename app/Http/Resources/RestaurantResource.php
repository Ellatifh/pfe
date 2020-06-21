<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'reference' => $this->reference,
            'name' => $this->name,
            'description' => $this->description,
            'adresse1' => $this->adresse1,
            'adresse2' => $this->adresse2,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'website' => $this->website,
            'startTime' => $this->startTime,
            'endTime' => $this->endtTime,
            'zipcode' => $this->zipcode,
            'longitude' => $this->longitude,
            'category' => $this->categories,
            'city' => $this->cities,
            'medias' => $this->medias,
            'extra' => $this->restaurants
        ];
    }
}
