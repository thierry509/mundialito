<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShootOnGoalRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shootout_score_a' => 'required|integer|min:0',
            'shootout_score_b' => 'required|integer|min:0',
            'game_id' => 'required|exists:games,id',
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
            'shootout_score_a.required' => 'Le score de l\'équipe A est requis.',
            'shootout_score_b.required' => 'Le score de l\'équipe B est requis.',
            'shootout_score_a.integer' => 'Le score de l\'équipe A doit être un entier.',
            'shootout_score_b.integer' => 'Le score de l\'équipe B doit être un entier.',
            'shootout_score_a.min' => 'Le score de l\'équipe A doit être supérieur ou égal à 0.',
            'shootout_score_b.min' => 'Le score de l\'équipe B doit être supérieur ou égal à 0.',
            'game_id.required' => 'L\'ID du match est requis.',
            'game_id.exists' => 'Le match spécifié n\'existe pas.',
        ];
    }
}
