<?php

namespace App\Http\Requests;

class EndroitRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'adresse1' => 'required|string',
            'adresse2' => 'required|string',
            'email' => 'required|string|email',
            'telephone' => 'string',
            'website' => 'string',
            'startTime' => 'string',
            'endTime' => 'string',
            'zipcode' => 'integer',
            'longitude' => 'string',
            'latitude' => 'string',
            'categorie' => 'required|integer',
            'city' => 'required|integer',
            'pictures'=> 'sometimes|required|array|min:1',
            'type' => 'sometimes|required|string',
            'startDate' => 'sometimes|required|date',
            'endDate' => 'sometimes|required|date',
            'ranking' => 'sometimes|required|integer',
            'wifi' => 'sometimes|required|integer',
            'piscine' => 'sometimes|required|integer',
            'restaurant' => 'sometimes|required|integer',
            'spa' => 'sometimes|required|integer',
            'fitness' => 'sometimes|required|integer',
            'rooms' => 'sometimes|required|integer',
            'specialite' => 'sometimes|required|string',
            'prixCarte' => 'sometimes|required|integer',
            'prixMoyenne' => 'sometimes|required|integer'
        ];
    }
}
