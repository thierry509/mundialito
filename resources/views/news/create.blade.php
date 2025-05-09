@extends('app')

@section('content')
    <!-- Hero Section -->
    <x-hero
        title="Créer une Nouvelle Actualité"
        subtitle="Remplissez le formulaire pour publier une nouvelle"
        backgroundImage="/images/form-hero.jpg"
        variant="accent"
    />

    <!-- Formulaire -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-7xl mx-auto">
            <form id="newsForm" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Section 1 : Informations de base -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Informations de base
                    </h2>

                    <!-- Titre -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'actualité *</label>
                        <input type="text" id="title" name="title" required
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Ex: Les Lions remportent le match d'ouverture">
                        @error('title')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catégorie -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                        <select id="category" name="category" required
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="resume">Résumé de match</option>
                            <option value="interview">Interview</option>
                            <option value="annonce">Annonce</option>
                            <option value="changement">Changement de programme</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Extrait -->
                    <div class="mb-6">
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Extrait *</label>
                        <textarea id="excerpt" name="excerpt" rows="3" required
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Résumé court qui apparaîtra dans la liste des actualités"></textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Section 2 : Contenu -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Contenu détaillé
                    </h2>

                    <!-- Contenu -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu *</label>
                        <textarea id="content" name="content" rows="10" required
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Rédigez votre article ici..."></textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Conseils de rédaction -->
                    <div class="bg-light/50 p-4 rounded-lg border-l-4 border-secondary">
                        <h3 class="font-bold text-secondary mb-2">Conseils de rédaction :</h3>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            <li>Utilisez des titres (h2, h3) pour structurer votre article</li>
                            <li>Les paragraphes courts sont plus faciles à lire</li>
                            <li>Insérez des images pour illustrer vos propos</li>
                            <li>Vérifiez l'orthographe avant publication</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 3 : Médias -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Médias
                    </h2>

                    <!-- Image mise en avant -->
                    <div class="mb-6">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Image mise en avant *</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-light border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="featured_image" class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                        <span>Téléverser une image</span>
                                        <input id="featured_image" name="featured_image" type="file" class="sr-only" accept="image/*" required>
                                    </label>
                                    <p class="pl-1">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG jusqu'à 5MB</p>
                            </div>
                        </div>
                        @error('featured_image')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Galerie d'images -->
                    <div class="mb-6">
                        <label for="gallery" class="block text-sm font-medium text-gray-700 mb-1">Galerie d'images</label>
                        <input type="file" id="gallery" name="gallery[]" multiple
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            accept="image/*">
                        @error('gallery')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vidéo -->
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">Lien vidéo (YouTube)</label>
                        <input type="url" id="video_url" name="video_url"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="https://www.youtube.com/watch?v=...">
                        @error('video_url')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Section 4 : Paramètres -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Paramètres
                    </h2>

                    <!-- Date de publication -->
                    <div class="mb-6">
                        <label for="publish_date" class="block text-sm font-medium text-gray-700 mb-1">Date de publication *</label>
                        <input type="datetime-local" id="publish_date" name="publish_date" required
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3">
                        @error('publish_date')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="status_published" name="status" type="radio" value="published" checked
                                    class="h-4 w-4 text-primary focus:ring-primary">
                                <label for="status_published" class="ml-3 block text-sm font-medium text-gray-700">
                                    Publié
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="status_draft" name="status" type="radio" value="draft"
                                    class="h-4 w-4 text-primary focus:ring-primary">
                                <label for="status_draft" class="ml-3 block text-sm font-medium text-gray-700">
                                    Brouillon
                                </label>
                            </div>
                        </div>
                        @error('status')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Ex: Lions, Tigres, Match d'ouverture">
                        <p class="mt-1 text-sm text-gray-500">Séparez les tags par des virgules</p>
                        @error('tags')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6">
                    <button type="button" id="previewBtn" class="px-6 py-3 border border-primary text-primary font-medium rounded-lg hover:bg-primary/10 transition duration-200">
                        Prévisualiser
                    </button>
                    <button type="submit" class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition duration-200">
                        Publier l'actualité
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Modal de prévisualisation -->
    <div id="previewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Prévisualisation de l'article</h3>
                    <div id="previewContent" class="prose max-w-none">
                        <!-- Le contenu de la prévisualisation sera injecté ici par JavaScript -->
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="closePreview" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Prévisualisation de l'article
        document.getElementById('previewBtn').addEventListener('click', function() {
            const form = document.getElementById('newsForm');
            const previewContent = document.getElementById('previewContent');

            // Créer un objet FormData à partir du formulaire
            const formData = new FormData(form);

            // Envoyer les données via AJAX pour traitement
            fetch('/admin/news/preview', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    previewContent.innerHTML = data.html;
                    document.getElementById('previewModal').classList.remove('hidden');
                } else {
                    alert('Erreur lors de la prévisualisation');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Fermer la modal
        document.getElementById('closePreview').addEventListener('click', function() {
            document.getElementById('previewModal').classList.add('hidden');
        });

        // Gestion de l'affichage de l'image sélectionnée
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.createElement('img');
                    preview.src = event.target.result;
                    preview.className = 'mt-2 max-h-40 rounded-lg';

                    const container = e.target.closest('div').querySelector('.mt-1');
                    const existingPreview = container.querySelector('img');
                    if (existingPreview) {
                        existingPreview.replaceWith(preview);
                    } else {
                        container.appendChild(preview);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        .prose {
            max-width: 100%;
        }
        .prose h2 {
            @apply text-xl font-bold mt-6 mb-3;
        }
        .prose h3 {
            @apply text-lg font-bold mt-5 mb-2;
        }
        .prose p {
            @apply mb-4;
        }
        .prose img {
            @apply rounded-lg my-4;
        }
    </style>
@endpush
