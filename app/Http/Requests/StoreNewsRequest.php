<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin() || $this->user()->isReporter();
    }

    public function rules()
    {
        $rules = [
            'category' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:500',
            'featured_image' => 'image|mimes:jpeg,png,jpg|max:5120',
            'image_description' => 'required_with:featured_image|string',
            'status' => 'required|in:published,draft',
            'tags' => 'nullable|string|max:255',
        ];
        if ($this->form) {
            // En mode update
            $rules['slug'] = 'required|string|max:255|unique:news,slug,' . $this->form->id;
            // featured_image n'est pas toujours requise en update
            $rules['featured_image'] = 'nullable|image|mimes:jpeg,png,jpg|max:5120';
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaîne de caractères',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères',
            'video_url.url' => 'L\'URL de la vidéo doit être valide',
            'video_url.mimes' => 'Le fichier vidéo doit être au format mp4, avi, mov, mkv',
            'video_url.max' => 'La vidéo ne doit pas dépasser 10MB',
            'featured_image.mimes' => 'Le fichier doit être au format jpeg, png, jpg',
            'featured_image.dimensions' => 'L\'image doit avoir une largeur et une hauteur minimales de 300x300 pixels',
            'featured_image.required' => 'Une image mise en avant est requise',
            'featured_image.image' => 'Le fichier doit être une image',
            'featured_image.max' => "L'image ne doit pas dépasser 5MB",
            'slug.required' => 'Le slug est requis',
            'slug.unique' => 'Le slug doit être unique',
            'category.required' => 'La catégorie est requise',
            'excerpt.required' => 'L\'extrait est requis',
            'excerpt.max' => 'L\'extrait ne doit pas dépasser 500 caractères',
            'content.required' => 'Le contenu est requis',
            'status.required' => 'Le statut est requis',
            'tags.max' => 'Les tags ne doivent pas dépasser 255 caractères',
        ];
    }
}
