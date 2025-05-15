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
            'teamAGoal' => 'required|integer|min:0',
            'teamBGoal' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
            return [
                'gameId.required' => 'L\'identifiant du match est obligatoire',
                'gameId.exists' => 'Le match spécifié n\'existe pas',

                '*.required' => 'Les scores des deux équipes sont requis',
                '*.integer' => 'Les scores doivent être des nombres entiers',
                '*.min' => 'Les scores ne peuvent pas être négatifs',
            ];
    }
}
