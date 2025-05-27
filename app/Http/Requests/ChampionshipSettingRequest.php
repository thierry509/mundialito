<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChampionshipSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }
    public function rules(): array
    {
        return [
            'ranking_rules' => 'required|array',
            'ranking_rules.*.code' => [
                'required',
                'string',
                'exists:ranking_rules,code'
            ],
            'ranking_rules.*.position' => 'required|integer|min:1',
            'knockout_round' => 'required|integer|in:1,2,3,4'
        ];
    }

    public function messages(): array
    {
        return [
            'ranking_rules.required' => 'Les règles de classement sont requises',
            'ranking_rules.*.code.required' => 'Le code de la règle est requis',
            'ranking_rules.*.code.in' => 'Le code de règle est invalide',
            'ranking_rules.*.position.required' => 'La position de la règle est requise',
            'ranking_rules.*.position.integer' => 'La position doit être un nombre entier',
            'ranking_rules.*.position.min' => 'La position ne peut pas être inférieure à 1',
            'knockout_round.required' => 'Le round de départ est requis',
            'knockout_round.in' => 'Le round de départ est invalide'
        ];
    }
}
