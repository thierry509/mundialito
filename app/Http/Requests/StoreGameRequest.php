<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'team1Id' => 'required',
            'team2Id' => 'required|different:team1Id',
            'type' => 'required|in:group,knockout',
            'groupId' => 'required_if:type,group|exists:groups,id',
            'position' => 'required_if:type,knockout',
            'stage' => 'required',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'location' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'groupId.required' => 'Le groupe est obligatoire.',
            'groupId.exists' => 'Le groupe sélectionné est invalide.',
            'team1Id.required' => 'L\'équipe 1 est obligatoire.',
            'team2Id.required' => 'L\'équipe 2 est obligatoire.',
            'team2Id.different' => 'Les équipes doivent être différentes.',
            'date.required' => 'La date est obligatoire.',
            'date.date' => 'La date doit être une date valide.',
            'time.required' => 'L\'heure est obligatoire.',
            'time.date_format' => 'L\'heure doit être au format HH:MM.',
            'stage.required' => 'La tour droit etre mentionner',
        ];
    }
}
