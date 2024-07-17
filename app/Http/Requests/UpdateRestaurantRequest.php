<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxTipologies;

class UpdateRestaurantRequest extends FormRequest
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
                'name'              => ['required', 'min:3', 'max:25', Rule::unique('restaurants')->ignore($this->restaurant)],
                'address'           => ['required', 'min:5', 'max: 50'],
                'image'             => ['nullable', 'image', 'mimes: jpeg,jpg,png', 'max:2048'],
                'description'       => ['required', 'min:5', 'max:255'],
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
            ];
    }
}
