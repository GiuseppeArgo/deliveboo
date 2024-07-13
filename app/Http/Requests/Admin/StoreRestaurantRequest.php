<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_restaurant' => ['required', 'min:3'],
            'address' => ['required', 'min:5'],
            'cover_image' => ['required'],
            'description' => ['required', 'min:5', 'max:255'],
            'p_iva' => ['required', 'min:11', 'max:11'],
            'user_id' => ['required'],
        ]; 
        
    }

    public function messages():array
    {
        return   
        [
            'name_restaurant'  => 'Il nome del ristorante non può essere vuoto e deve contenere almeno 3 caratteri',
            'address'          => "L'indirizzo non può essere vuoto e deve contenere almeno 5 caratteri",
            'cover_image'      => "E' necessaria un'immagine",
            'description'      => "La descrizione è necessaria e deve contenere almeno 5 caratteri",
            'p_iva'            => "La partita iva è necessaria e deve essere lunga 11 caratteri",
        
        ];
    }
}
