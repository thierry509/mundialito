<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return;
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
            'image_description' => 'required_with:featured_image|string',
            'status' => 'required|in:published,draft',
            'tags' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|mimes:mp4,avi,mov,mkv|max:10240',
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
            'video_url.url' => 'L\'URL de la vidéo doit être valide',
            'video_url.mimes' => 'Le format vidéo doit être mp4, avi, mov ou mkv',
            'video_url.max' => 'La vidéo ne doit pas dépasser 10MB',
        ];
    }
}