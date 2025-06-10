<template>
    <Head>
        <title v-if="!news">Ecrire une article</title>
        <title v-else>Modifier l'article {{ news.title }}</title>
    </Head>
    <div class="p-6 md:p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white inline-flex items-center">
                <svg class="w-8 h-8 mr-3 p-1.5 bg-primary/10 text-primary rounded-full" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="border-l-2 border-primary pl-3">Ecrire une article</span>
            </h1>
        </div>

        <div class="max-w-7xl">
            <form @submit.prevent="submit" class="space-y-8" enctype="multipart/form-data">
                <ErrorModal :errors="$page.props.errors" />
                <!-- Section 1: Informations de base -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100 bg-white">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Informations de base
                    </h2>
                    <!-- Titre -->
                    <Input v-model="form.title" name="title" label="Titre de l'article" placeholder="Entrez le titre"
                        :error="form.errors.title" required />

                    <!-- Slug -->
                    <Input v-model="form.slug" name="slug" label="Slug" placeholder="Entrez le slug"
                        :error="form.errors.slug" required
                        helper-text="Le slug est utilisé dans l'URL de l'article. Utilisez des tirets pour séparer les mots." />

                    <!-- Catégorie -->

                    <Select :options="[
                        { value: '', label: 'Sélectionnez une catégorie' },
                        ...categories.map(category => ({ value: category.id, label: category.name }))

                    ]" name="category" v-model="form.category" label="Catégorie"
                        placeholder="Sélectionnez une catégorie" :error="form.errors.category" required
                        helper-text="Sélectionnez la catégorie qui correspond le mieux à votre article." />


                    <!-- Extrait -->
                    <Textarea v-model="form.excerpt" name="excerpt" label="Extrait de l'article"
                        placeholder="Entrez un extrait de l'article" :error="form.errors.excerpt" required
                        helper-text="Résumé court qui apparaîtra dans la liste des actualités." />
                </div>

                <!-- Section 2: Contenu -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100 bg-white">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        Contenu détaillé
                    </h2>
                    <RichText v-model="form.content" name="content" label="Contenu de l'article"
                        placeholder="Rédigez le contenu de votre article ici..." :error="form.errors.content"
                        required />
                </div>

                <!-- Section 3: Médias -->
                <div class="rounded-xl shadow-md p-6 border border-gray-100 bg-white">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Médias
                    </h2>

                    <ImageUpload v-model="form.featured_image" label="Image mise en avant" :initial-image="props.news?.image?.url"
                        :error="form.errors.featured_image" required file-requirements="PNG, JPG, JPEG jusqu'à 10MB" />


                    <Input v-if="form.featured_image != null" v-model="form.image_description" name="image_description" label="Description de l'image"
                        placeholder="Entrez une description de l'image" :error="form.errors.image_description"
                        helper-text="Ajoutez une description pour l'image mise en avant." required/>
                </div>

                <!-- Section 4: Paramètres -->
                <!-- <div class="rounded-xl shadow-md p-6 border border-gray-100 bg-white"> -->
                <!-- <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Paramètres
                    </h2> -->

                <!-- Statut -->
                <!-- <div class="mb-6">
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
                    </div> -->

                <!-- Tags -->
                <!-- <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="outline-none w-full rounded-lg border border-light focus:border-primary focus:ring-2 focus:ring-primary/50 p-3"
                            placeholder="Ex: Lions, Tigres, Match d'ouverture">
                        <p class="mt-1 text-sm text-gray-500">Séparez les tags par des virgules</p>
                    </div> -->
                <!-- </div> -->

                <!-- Boutons de soumission -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6">
                    <!-- <button type="button"
                        class="px-6 py-3 border border-primary text-primary font-medium rounded-lg hover:bg-primary/10 transition duration-200">
                        Prévisualiser
                    </button> -->
                    <button type="submit"
                        class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition duration-200"
                        :disabled="processing">
                        <span v-if="processing">En cours...</span>
                        <span v-else>Publier l'actualité</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import Input from '../../components/ui/Input.vue'
import Textarea from '../../components/ui/Textarea.vue'
import Select from '../../components/ui/Select.vue'
import RichText from '../../components/Form/RichText.vue'
import ImageUpload from '../../components/ui/ImageUpload.vue'
import ErrorModal from '../../components/modal/ErrorModal.vue'
import {Head} from '@inertiajs/vue3'
const processing = ref(false)

const props = defineProps({
    categories: {
        type: Array,
        default: () => []
    },
    news: Object,
})
// const { categories } = usePage<{ props: { categories: { id: string; name: string }[] } }>().props

// Utilisation de useForm d'Inertia
const form = useForm({
    id: props?.news?.id || null,
    title: props?.news?.title,
    slug: props?.news?.slug,
    category: props?.news?.category_id,
    excerpt: props?.news?.excerpt,
    content: props?.news?.content,
    featured_image: undefined,
    image_description: props?.news?.image?.description,
    status: 'draft',
    tags: ''
})

const validationErrors = ref([])

// Génération automatique du slug
watch(() => form.title, (newTitle) => {
    form.slug = generateSlug(newTitle)
})
// Validation du formulaire




function generateSlug(text) {
    return text
        .toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-')
        .replace(/^-+|-+$/g, '')
        .substring(0, 75) // Limite à 75 caractères
}

// Gestion de la soumission
const submit = () => {
    // Configuration commune
    const config = {
        preserveScroll: true,
        onStart: () => {
            processing.value = true;
            validationErrors.value = [];
        },
        onFinish: () => {
            processing.value = false;
        },
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors);
        },
        forceFormData: true // Essentiel pour les uploads de fichiers
    };


    if (!props.news) {
        // Cas création (POST)
        form.post('', config);
    } else {
        // Cas modification (PUT avec fichiers)
        form.transform((data) => ({
            ...data,
            _method: 'PUT', // Laravel reconnaîtra cela comme une requête PUT
            _token: usePage().props.csrf_token // Token CSRF explicite
        })).post('', config);
    }
};

// Gestion du fichier image
// const handleFeaturedImageChange = (event: Event) => {
//     const target = event.target as HTMLInputElement
//     if (target.files && target.files[0]) {
//         const file = target.files[0]

//         // Vérification du type de fichier
//         const validTypes = ['image/jpeg', 'image/png', 'image/jpg']
//         if (!validTypes.includes(file.type)) {
//             validationErrors.value.push("Le format de l'image doit être JPG, JPEG ou PNG")
//             return
//         } else if (file.size > 5 * 1024 * 1024) {
//             validationErrors.value.push("L'image ne peut pas dépasser 5MB")
//             return
//         } else if (file.size === 0) {
//             validationErrors.value.push("L'image ne peut pas être vide")
//             return
//         }
//         news.featured_image = file
//     }
// }
</script>
