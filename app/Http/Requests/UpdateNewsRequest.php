<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin() || $this->user()->isReporter();;
    }

    public function rules()
    {
        $newsId = $this->route('news') ? $this->route('news')->id : ($this->id ?? 'NULL');
        $rules = [
            'id' => 'required|exists:news,id',
            'title' => 'required|string|max:255',
            'category' => 'nullable|exists:categories,id',
            'slug' => 'required|string|max:255|unique:news,slug,' . $newsId,
            'content' => 'required|string',
            'excerpt' => 'required|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'image_description' => 'nullable|required_if:featured_image,true|string',
            'status' => 'required|in:published,draft',
            'video_url' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\//',
            ],
            'tags' => 'nullable|string|max:255',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'id.required' => 'L\'ID est requis',
            'id.exists' => 'L\'ID spécifié n\'existe pas',
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaîne de caractères',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères',
            'category.exists' => 'La catégorie sélectionnée n\'existe pas',
            'slug.required' => 'Le slug est requis',
            'slug.string' => 'Le slug doit être une chaîne de caractères',
            'slug.max' => 'Le slug ne doit pas dépasser 255 caractères',
            'slug.unique' => 'Ce slug est déjà utilisé par un autre article',
            'content.required' => 'Le contenu est requis',
            'content.string' => 'Le contenu doit être une chaîne de caractères',
            'excerpt.required' => 'L\'extrait est requis',
            'excerpt.string' => 'L\'extrait doit être une chaîne de caractères',
            'excerpt.max' => 'L\'extrait ne doit pas dépasser 500 caractères',
            'featured_image.image' => 'Le fichier doit être une image',
            'featured_image.mimes' => 'L\'image doit être au format jpeg, png ou jpg',
            'featured_image.max' => 'L\'image ne doit pas dépasser 5MB',
            'image_description.required_with' => 'La description de l\'image est requise lorsque vous ajoutez une image',
            'image_description.string' => 'La description de l\'image doit être une chaîne de caractères',
            'status.required' => 'Le statut est requis',
            'status.in' => 'Le statut doit être "published" ou "draft"',
            'tags.string' => 'Les tags doivent être une chaîne de caractères',
            'tags.max' => 'Les tags ne doivent pas dépasser 255 caractères',
            'video_url.url' => 'Le lien vidéo doit être une URL valide.',
            'video_url.regex' => 'Seuls les liens YouTube sont autorisés.',
        ];
    }
}
