<?php

namespace App\Http\Requests;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;

class DeleteGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:games,id',
                // Vérifier que les scores sont null
                function ($attribute, $value, $fail) {
                    $game = Game::find($value);
                    if ($game && (!is_null($game->team_a_goal) || !is_null($game->team_b_goal))) {
                        $fail('Le match ne peut pas être supprimé car il a des scores enregistrés');
                    }
                },
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'L\'identifiant est obligatoire',
            'id.integer' => 'L\'identifiant doit être un nombre entier',
            'id.exists' => 'Le match spécifié n\'existe pas',
            'id.not_exists' => 'Le match a des prédictions associées et ne peut être supprimé'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }
}
