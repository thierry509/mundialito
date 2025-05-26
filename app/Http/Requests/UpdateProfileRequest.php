<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
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
        $userId = auth()->id();

        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email,'.$userId,
            'phone' => 'nullable|string|max:20',
            'image_id' => 'nullable|integer|exists:images,id',

            // Règles conditionnelles pour le mot de passe
            'current_password' => [
                'nullable',
                'required_with:new_password',
                'current_password:web'
            ],
            'new_password' => [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'new_password_confirmation' => 'nullable|required_with:new_password',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prénom est obligatoire',
            'first_name.max' => 'Le prénom ne peut pas dépasser :max caractères',

            'last_name.required' => 'Le nom est obligatoire',
            'last_name.max' => 'Le nom ne peut pas dépasser :max caractères',

            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être une adresse valide',
            'email.max' => 'L\'email ne peut pas dépasser :max caractères',
            'email.unique' => 'Cet email est déjà utilisé',

            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser :max caractères',

            'image_id.exists' => 'L\'image sélectionnée est invalide',

            'current_password.required_with' => 'Le mot de passe actuel est requis pour changer le mot de passe',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect',

            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'new_password.min' => 'Le mot de passe doit contenir au moins :min caractères',
            'new_password.mixed_case' => 'Le mot de passe doit contenir des majuscules et minuscules',
            'new_password.numbers' => 'Le mot de passe doit contenir des chiffres',
            'new_password.symbols' => 'Le mot de passe doit contenir des caractères spéciaux',
            'new_password.uncompromised' => 'Ce mot de passe a été compromis dans une fuite de données',

            'new_password_confirmation.required_with' => 'La confirmation du mot de passe est requise',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/[^0-9+]/', '', $this->phone)
            ]);
        }
    }
}
