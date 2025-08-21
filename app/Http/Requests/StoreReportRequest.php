<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user = $this->user();
        $commentId = $this->route('comment') ? $this->route('comment')->id : $this->comment_id;
        return [
            'reason' => [
                'required',
                'string',
                'min:10',
                'max:500'
            ],
            'comment_id' => [
                'required',
                'exists:comments,id',
                // Empêche de signaler son propre commentaire
                function ($attribute, $value, $fail) use ($user) {
                    $userCommentIds = $user->comments()->pluck('id')->toArray();
                    if (in_array($value, $userCommentIds)) {
                        $fail('Vous ne pouvez pas signaler votre propre commentaire');
                    }
                },
                // Vérifie que l'utilisateur n'a pas déjà signalé ce commentaire
                function ($attribute, $value, $fail) use ($user) {
                    $existingReport = \App\Models\Report::where('comment_id', $value)
                        ->where('user_id', $user->id)
                        ->exists();

                    if ($existingReport) {
                        $fail('Vous avez déjà signalé ce commentaire');
                    }
                }
            ],
            'category' => [
                'nullable',
                'string',
                'in:spam,hate_speech,inappropriate,harassment,other'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'reason.required' => 'Veuillez indiquer la raison du signalement',
            'reason.min' => 'La raison doit contenir au moins :min caractères',
            'reason.max' => 'La raison ne peut pas dépasser :max caractères',

            'comment_id.required' => 'Le commentaire est requis',
            'comment_id.exists' => 'Le commentaire spécifié n\'existe pas',

            'category.in' => 'La catégorie sélectionnée n\'est pas valide'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'reason' => 'raison du signalement',
            'comment_id' => 'commentaire',
            'category' => 'catégorie'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Si comment_id vient de la route (/reports/{comment})
        if ($this->route('comment')) {
            $this->merge([
                'comment_id' => $this->route('comment')->id
            ]);
        }

        // Définir une catégorie par défaut si non fournie
        if (!$this->has('category')) {
            $this->merge([
                'category' => 'other'
            ]);
        }
    }
}
