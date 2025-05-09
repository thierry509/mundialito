<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'category' => 'required|in:resume,interview,annonce,changement',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'video_url' => 'nullable|url',
            'status' => 'required|in:published,draft',
            'tags' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'featured_image.required' => 'Une image mise en avant est requise',
            'featured_image.image' => 'Le fichier doit être une image',
            'featured_image.max' => "L'image ne doit pas dépasser 5MB",
            'slug.required' => 'Le slug est requis',
            'slug.unique' => 'Le slug doit être unique',
            'category.required' => 'La catégorie est requise',
            'excerpt.required' => 'L\'extrait est requis',
            'content.required' => 'Le contenu est requis',
            'status.required' => 'Le statut est requis',
            'tags.max' => 'Les tags ne doivent pas dépasser 255 caractères',
        ];
    }
}
