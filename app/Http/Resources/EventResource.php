<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'type' => $this->events['type'],
            'startDate' => $this->events['startDate'],
            'endDate' => $this->events['endDate'],
            'category' => new CategorieResource($this->categories),
            'city' => new CitieResource($this->cities),
            'medias' => new MediaResource($this->medias)
        ];
    }
}
