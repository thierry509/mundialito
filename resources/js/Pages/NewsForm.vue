<template>
    <!-- Hero Section -->
    <HeroSection title="Créer une Nouvelle Actualité" subtitle="Remplissez le formulaire pour publier une nouvelle"
        gradient-from="from-blue-500" gradient-to="to-purple-500" opacity="30" height="py-24" text-color="text-white" />
    <!-- Main Form -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-7xl mx-auto">
            <form @submit.prevent="submit" class="space-y-8" enctype="multipart/form-data">
                <!-- Afficher les erreurs de validation -->
                <div v-if="Object.keys($page.props.errors).length > 0"
                    class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Il y a {{ Object.keys($page.props.errors).length }} erreur(s) dans votre formulaire
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li v-for="(error, field) in $page.props.errors" :key="field">
                                        {{ error }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section 1: Informations de base -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Informations de base
                    </h2>

                    <!-- Titre -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'actualité
                            *</label>
                        <input type="text" id="title" name="title" required v-model="news.title"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Ex: Les Lions remportent le match d'ouverture">
                    </div>
                    <!-- Slug -->
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                        <input type="text" id="slug" name="slug" required v-model="news.slug"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Ex: les-lions-remportent-le-match-d-ouverture">
                        <p class="mt-1 text-sm text-gray-500">Le slug est utilisé dans l'URL de l'article. Utilisez des
                            tirets pour séparer les mots.</p>
                    </div>

                    <!-- Catégorie -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie
                            *</label>
                        <select id="category" name="category" required v-model="news.category"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="resume">Résumé de match</option>
                            <option value="interview">Interview</option>
                            <option value="annonce">Annonce</option>
                            <option value="changement">Changement de programme</option>
                        </select>
                    </div>

                    <!-- Extrait -->
                    <div class="mb-6">
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Extrait *</label>
                        <textarea id="excerpt" name="excerpt" rows="3" required v-model="news.excerpt"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Résumé court qui apparaîtra dans la liste des actualités"></textarea>
                    </div>
                </div>

                <!-- Section 2: Contenu -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        Contenu détaillé
                    </h2>

                    <!-- Contenu -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu *</label>
                        <textarea id="content" name="content" rows="10" required v-model="news.content"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Rédigez votre article ici..."></textarea>
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

                <!-- Section 3: Médias -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Médias
                    </h2>

                    <!-- Image mise en avant -->
                    <div class="mb-6">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Image mise
                            en avant *</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-light border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="featured_image"
                                        class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                        <span>Téléverser une image</span>
                                        <input id="featured_image" name="featured_image"
                                            @change="handleFeaturedImageChange" type="file" class="sr-only"
                                            accept="image/*" required>
                                    </label>
                                    <p class="pl-1">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG jusqu'à 5MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vidéo -->
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">Lien vidéo
                            (YouTube)</label>
                        <input type="url" id="video_url" name="video_url" v-model="news.video_url"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                </div>

                <!-- Section 4: Paramètres -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Paramètres
                    </h2>

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
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Ex: Lions, Tigres, Match d'ouverture">
                        <p class="mt-1 text-sm text-gray-500">Séparez les tags par des virgules</p>
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6">
                    <button type="button"
                        class="px-6 py-3 border border-primary text-primary font-medium rounded-lg hover:bg-primary/10 transition duration-200">
                        Prévisualiser
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition duration-200"
                        :disabled="processing">
                        <span v-if="processing">En cours...</span>
                        <span v-else>Publier l'actualité</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup lang="ts">
import HeroSection from '../components/HeroSection.vue'
import { useForm } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const processing = ref(false)
// Définition du type
interface CreateNews {
    title: string
    slug: string
    category: string
    excerpt: string
    content: string
    featured_image: File | null
    video_url: string
    status: string
    tags: string
}

// Utilisation de useForm d'Inertia
const news = useForm<CreateNews>({
    title: '',
    slug: '',
    category: '',
    excerpt: '',
    content: '',
    featured_image: null,
    video_url: '',
    status: 'draft',
    tags: ''
})

const validationErrors = ref<string[]>([])

// Génération automatique du slug
watch(() => news.title, (newTitle) => {
    news.slug = generateSlug(newTitle)
})
// Validation du formulaire
const validateForm = (): boolean => {
    validationErrors.value = []

    // Titre
    if (!news.title.trim()) {
        validationErrors.value.push("Le titre est obligatoire")
    } else if (news.title.length > 75) {
        validationErrors.value.push("Le titre ne peut pas dépasser 75 caractères")
    }

    // Slug
    if (!news.slug.trim()) {
        validationErrors.value.push("Le slug est obligatoire")
    } else if (news.slug.length > 75) {
        validationErrors.value.push("Le slug ne peut pas dépasser 75 caractères")
    } else if (!/^[a-z0-9-]+$/.test(news.slug)) {
        validationErrors.value.push("Le slug ne peut contenir que des lettres minuscules, chiffres et tirets")
    }

    // Catégorie
    if (!news.category) {
        validationErrors.value.push("La catégorie est obligatoire")
    }

    // Extrait
    if (!news.excerpt.trim()) {
        validationErrors.value.push("L'extrait est obligatoire")
    } else if (news.excerpt.length > 200) {
        validationErrors.value.push("L'extrait ne peut pas dépasser 200 caractères")
    }

    // Contenu
    if (!news.content.trim()) {
        validationErrors.value.push("Le contenu est obligatoire")
    } else if (news.content.length < 100) {
        validationErrors.value.push("Le contenu doit faire au moins 100 caractères")
    }

    // Image
    if (!news.featured_image) {
        validationErrors.value.push("L'image mise en avant est obligatoire")
    } else if (news.featured_image.size > 5 * 1024 * 1024) {
        validationErrors.value.push("L'image ne peut pas dépasser 5MB")
    }

    // URL vidéo (si fournie)
    if (news.video_url && !isValidUrl(news.video_url)) {
        validationErrors.value.push("L'URL de la vidéo n'est pas valide")
    }

    return validationErrors.value.length === 0
}

const isValidUrl = (url: string): boolean => {
    try {
        new URL(url)
        return true
    } catch {
        return false
    }
}


function generateSlug(text: string): string {
    return text
        .toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-')
        .replace(/^-+|-+$/g, '')
        .substring(0, 75) // Limite à 75 caractères
}

// Gestion de la soumission
const submit = () => {
    if (!validateForm()) {
        console.log('Erreurs de validation:', validationErrors.value)
        return
    }
    processing.value = true
    news.post('', {
        preserveScroll: true,
        onSuccess: () => {
            // Réinitialiser le formulaire ou rediriger si nécessaire
            news.reset()
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors)
        }
    })
}

// Gestion du fichier image
const handleFeaturedImageChange = (event: Event) => {
    const target = event.target as HTMLInputElement
    if (target.files && target.files[0]) {
        const file = target.files[0]

        // Vérification du type de fichier
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg']
        if (!validTypes.includes(file.type)) {
            validationErrors.value.push("Le format de l'image doit être JPG, JPEG ou PNG")
            return
        }

        news.featured_image = file
    }
}
</script>
