<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();

        $rules = [
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];

        if ($user && $user->password) {
            $rules['current_password'] = ['required', 'current_password:web'];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'mot de passe actuel',
            'password' => 'nouveau mot de passe',
            'password_confirmation' => 'confirmation du mot de passe',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Le champ :attribute est obligatoire.',
            'current_password.current_password' => 'Le :attribute est incorrect.',
            'password.required' => 'Le champ :attribute est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le :attribute doit contenir au moins :min caractères.',
            'password.mixed' => 'Le :attribute doit contenir des lettres majuscules et minuscules.',
            'password.numbers' => 'Le :attribute doit contenir au moins un chiffre.',
            'password.symbols' => 'Le :attribute doit contenir au moins un symbole.',
            'password.uncompromised' => 'Ce :attribute est apparu dans une fuite de données. Veuillez en choisir un autre.',
        ];
    }
}
