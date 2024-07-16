<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function message(){
        return[
            'name.required' => 'il campo nome non puo essere vuoto',
            'name.max' => 'il campo nome non puo contenere meno di 3 caratteri',
            'name.max' => 'il campo nome non puo contenere piu di 30 caratteri',
            'email.lowercase' => 'il campo email deve essere scritto tutto in minuscolo',
            'eamil.unique'  => 'questa email è gia registrata nel nostro database'

        ];
    }
}
