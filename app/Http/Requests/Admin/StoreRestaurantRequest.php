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
            'name' => ['required', 'min:3'],
            'address' => ['required', 'min:5'],
            'image' => ['required'],
            'description' => ['required', 'min:5', 'max:255'],
            'p_iva' => ['required', 'min:11', 'max:11'],
            'slug' => ['nullable'],
        ]; 
        
    }

    public function messages():array
    {
        return   
        [
            'name'  => 'Il nome del ristorante non può essere vuoto e deve contenere almeno 3 caratteri',
            'address'          => "L'indirizzo non può essere vuoto e deve contenere almeno 5 caratteri",
            'image'      => "E' necessaria un'immagine",
            'description'      => "La descrizione è necessaria e deve contenere almeno 5 caratteri",
            'p_iva'            => "La partita iva è necessaria e deve essere lunga 11 caratteri",
        
        ];
    }
}
