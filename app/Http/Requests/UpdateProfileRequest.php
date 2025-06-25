<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'phone' => 'nullable|string|max:20',
            // 'image_id' => 'nullable|integer|exists:images,id',
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
