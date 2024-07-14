<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateDishRequest extends FormRequest
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
            'name'              => ['required', 'min:3','max:25', Rule::unique('dishes')->ignore($this->dish)],
            'image'             => ['nullable', 'image', 'mimes: jpeg,jpg,png', 'max:2048'],
            'description'       => ['required', 'min:5', 'max:255'],
            'slug'              => ['nullable'],
        ];
    }

    public function messages()
    {
        return
        [
            'required'          => 'Il campo :attribute è vuoto',
            'min'               => 'Il campo :attribute deve contenere almeno :min caratteri',
            'max'               => 'il campo :attribute deve contenere massimo :max caratteri',
            'unique'            => 'non si possono avere due :attribute uguali',
            'image.image'       => ' il campo :attribute deve essere una foto',
            'image.mimes'       => 'formato consentito jpg,jpeg o png',
            'image.max'         => 'dimensione massima 2 mb',
        ];
    }
}
