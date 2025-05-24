<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gameId' => 'required|exists:games,id',
            'teamAGoals' => 'required|integer|min:0',
            'teamBGoals' => 'required|integer|min:0',
            'teamAYellowCards' => 'required|integer|min:0',
            'teamBYellowCards' => 'required|integer|min:0',
            'teamARedCards' => 'required|integer|min:0',
            'teamBRedCards' => 'required|integer|min:0',
            'teamAScorers' => 'nullable|string',
            'teamBScorers' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'gameId.required' => 'L\'identifiant du match est obligatoire',
            'gameId.exists' => 'Le match spécifié n\'existe pas',

            'teamAGoals.required' => 'Le score de l\'équipe A est requis',
            'teamBGoals.required' => 'Le score de l\'équipe B est requis',
            'teamAYellowCards.required' => 'Le nombre de cartons jaunes de l\'équipe A est requis',
            'teamBYellowCards.required' => 'Le nombre de cartons jaunes de l\'équipe B est requis',
            'teamARedCards.required' => 'Le nombre de cartons rouges de l\'équipe A est requis',
            'teamBRedCards.required' => 'Le nombre de cartons rouges de l\'équipe B est requis',

            '*.integer' => 'La valeur doit être un nombre entier',
            '*.min' => 'La valeur ne peut pas être négative'
        ];
    }

    // // Préparation des données pour la validation
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'gameId' => $this->route('game') // Si vous utilisez le paramètre de route
    //     ]);
    // }
}
