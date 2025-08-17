<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
        return [
            'content' => 'required|string|max:1000',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
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
            'content.required' => 'Le contenu du commentaire est obligatoire.',
            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'content.max' => 'Le commentaire ne peut pas dépasser :max caractères.',

            'commentable_id.required' => 'L\'ID de l\'élément commentable est obligatoire.',
            'commentable_id.integer' => 'L\'ID de l\'élément commentable doit être un nombre entier.',

            'commentable_type.required' => 'Le type d\'élément commentable est obligatoire.',
            'commentable_type.string' => 'Le type d\'élément commentable doit être une chaîne de caractères.',

            'parent_id.exists' => 'Le commentaire parent sélectionné n\'existe pas.',
        ];
    }
}
