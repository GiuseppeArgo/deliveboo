<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxTipologies;

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
            'name'              => ['required', 'min:3','max:25', Rule::unique('restaurants')->ignore($this->restaurant)],
            'address'           => ['required', 'min:5','max: 50'],
            'image'             => ['required', 'image', 'mimes: jpeg,jpg,png', 'max:2048'],
            'description'       => ['required', 'min:5', 'max:255'],
            'p_iva'             => ['required', 'min:11', 'max:11',Rule::unique('restaurants')->ignore($this->restaurant)],
            'tipologies'        => ['required', new MaxTipologies(2)],
            'slug'              => ['nullable'],
        ];
    }

    public function messages()
    {
        return
        [
            'required'          => 'Il campo è obbligatorio',
            'min'               => 'Deve contenere almeno :min caratteri',
            'max'               => 'Deve contenere massimo :max caratteri',
            'unique'            => 'Il valore inserito è gia esistente',
            'image.image'       => 'Deve essere una foto',
            'image.mimes'       => 'formato consentito jpg,jpeg o png',
            'image.max'         => 'dimensione massima 2 mb',
            'p_iva.min'         => 'deve avere 11 caratteri numerici',
            'p_iva.max'         => 'deve avere 11 caratteri numerici',

        ];
    }
}
