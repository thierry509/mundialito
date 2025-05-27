<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnpostponeGameRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'L\'identifiant du Match est obligatoire.',
            'id.exists' => 'Le Match spécifié n\'existe pas.',
            'date.required' => 'La date est obligatoire.',
            'date.date' => 'La date doit être une date valide.',
            'time.required' => 'L\'heure est obligatoire.',
            'time.date_format' => 'L\'heure doit être au format HH:MM.',
            'location.required' => 'Le lieu est obligatoire.',
            'location.string' => 'Le lieu doit être une chaîne de caractères.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }
}
