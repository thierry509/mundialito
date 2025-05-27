<?php

namespace App\Http\Requests;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Event\Test\Prepared;

class EndGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:games,id',
            function ($attribute, $value, $fail) {
                $game = Game::find($value);
                if ($game && (is_null($game->team_a_goal) || is_null($game->team_b_goal))) {
                    $fail('Le match ne peut pas être terminer car il a les scores ne sont pas encore enregistrés');
                }
            },
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'L\'identifiant du Match est obligatoire.',
            'id.exists' => 'Le Match spécifié n\'existe pas.',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }
}
