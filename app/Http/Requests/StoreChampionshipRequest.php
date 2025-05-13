<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChampionshipRequest extends FormRequest
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
            'year' => 'required|integer|min:1900|max:2100|unique:championships,year',
        ];
    }

    public function messages()
    {
        return [
            'year.required' => 'Le champ année est requis.',
            'year.integer' => 'L\'année doit être un nombre entier.',
            'year.min' => 'L\'année doit être supérieure ou égale à 1900.',
            'year.max' => 'L\'année doit être inférieure ou égale à 2100.',
            'year.unique' => 'Cette année existe déjà dans la base de données.',
        ];
    }
}
