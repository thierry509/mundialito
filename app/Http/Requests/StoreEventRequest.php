<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->user()->isEditor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'event_type' => [
                'required',
                Rule::in(['goal', 'yellow_card', 'red_card'])
            ],
            'minute' => 'required|integer|min:0|max:120',
            'added_time' => 'nullable|integer|min:0|max:30',
            'player_name' => 'required|string|max:100',
            'team' => [
                'required',
                Rule::in(['team_a', 'team_b'])
            ],
            // Si vous avez besoin de lier à un match
            'game_id' => 'required|exists:games,id'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'event_type.required' => 'Le type d\'événement est obligatoire',
            'event_type.in' => 'Type d\'événement non valide',
            'minute.required' => 'La minute est obligatoire',
            'minute.integer' => 'La minute doit être un nombre',
            'minute.min' => 'La minute ne peut pas être négative',
            'minute.max' => 'La minute ne peut pas dépasser 120',
            'player.required' => 'Le nom du joueur est obligatoire',
            'team.required' => 'Veuillez spécifier l\'équipe',
            'game_id.required' => 'L\'association à un match est obligatoire',
            'game_id.exists' => 'Le match spécifié n\'existe pas'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Si vous avez besoin de modifier les données avant validation
        $this->merge([
            'added_time' => $this->added_time ?? 0 // Valeur par défaut
        ]);
    }
}