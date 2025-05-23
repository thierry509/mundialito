<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:teams,name',
            'location' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de l\'équipe est requis.',
            'name.unique' => 'Le nom de l\'équipe doit être unique.',
            'location.required' => 'La localisation de l\'équipe est requise.',
            'name.string' => 'Le nom de l\'équipe doit être une chaîne de caractères.',
            'location.string' => 'La localisation de l\'équipe doit être une chaîne de caractères.',
            'name.max' => 'Le nom de l\'équipe ne peut pas dépasser 255 caractères.',
            'location.max' => 'La localisation de l\'équipe ne peut pas dépasser 255 caractères.',
        ];
    }
}
