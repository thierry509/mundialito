<template>

    <Head>
        <title>Mon Profil</title>
    </Head>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="overflow-hidden">
            <div class="flex flex-col gap-8">
                <!-- Photo de profil -->
                <div class="w-full flex flex-col items-center">
                    <div class="relative group mb-6">
                        <img id="profile-image"
                            :src="form.avatar || 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80'"
                            alt="Photo de profil"
                            class="w-36 h-36 rounded-full object-cover shadow-md group-hover:opacity-90 transition duration-300">
                        <button v-if="editMode" @click="openAvatarModal"
                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            <span class="bg-white p-2 rounded-full text-primary-600">
                                <svg width="64px" height="64px" viewBox="0 -2 32 32" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>camera</title>
                                        <desc>Created with Sketch Beta.</desc>
                                        <defs> </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                            sketch:type="MSPage">
                                            <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                                transform="translate(-258.000000, -467.000000)" fill="#000000">
                                                <path
                                                    d="M286,471 L283,471 L282,469 C281.411,467.837 281.104,467 280,467 L268,467 C266.896,467 266.53,467.954 266,469 L265,471 L262,471 C259.791,471 258,472.791 258,475 L258,491 C258,493.209 259.791,495 262,495 L286,495 C288.209,495 290,493.209 290,491 L290,475 C290,472.791 288.209,471 286,471 Z M274,491 C269.582,491 266,487.418 266,483 C266,478.582 269.582,475 274,475 C278.418,475 282,478.582 282,483 C282,487.418 278.418,491 274,491 Z M274,477 C270.687,477 268,479.687 268,483 C268,486.313 270.687,489 274,489 C277.313,489 280,486.313 280,483 C280,479.687 277.313,477 274,477 L274,477 Z"
                                                    id="camera" sketch:type="MSShapeGroup"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg> </span>
                        </button>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-1 capitalize">{{ form.first_name }} {{
                        form.last_name }}
                    </h2>
                    <div class="flex items-center text-primary-600 mb-4">
                        <i class="fas fa-user-tag mr-1"></i>
                        <span class="text-sm font-medium capitalize">{{ user.role }}</span>
                    </div>

                    <div v-if="editMode" class="w-full mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Changer la photo</label>
                        <input type="file" @change="handleAvatarChange" accept="image/*" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-primary-50 file:text-primary-700
                                    hover:file:bg-primary-100">
                    </div>
                </div>

                <!-- Informations personnelles -->
                <div class="w-full bg-white rounded-xl shadow-md p-8">
                    <h3
                        class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-100 flex justify-between">
                        Informations Personnelles
                        <button @click="toggleEditMode"
                            class="text-xs px-4 py-2 bg-primary/70 hover:bg-primary text-white rounded-lg font-medium transition duration-300 flex items-center">
                            <i class="fas" :class="editMode ? 'fa-times' : 'fa-pencil-alt'"></i>
                            <span>{{ editMode ? 'Annuler' : 'Modifier le profil' }}</span>
                        </button>
                    </h3>


                    <form @submit.prevent="submit">
                        <div class="space-y-5">
                            <!-- Prénom et Nom -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-500">Prénom</label>
                                    <div v-if="!editMode" class="flex items-center justify-between group">
                                        <p class="text-gray-800">{{ user.first_name }}</p>
                                    </div>

                                    <Input v-else v-model="form.first_name" type="text" />
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-500">Nom</label>
                                    <div v-if="!editMode" class="flex items-center justify-between group">
                                        <p class="text-gray-800">{{ user.last_name }}</p>
                                    </div>
                                    <Input v-else v-model="form.last_name" type="text" />
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <div v-if="!editMode" class="flex items-center justify-between group">
                                    <p class="text-gray-800">{{ user.email }}</p>
                                </div>
                                <Input v-else v-model="form.email" type="email" />
                            </div>

                            <!-- Téléphone -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Téléphone</label>
                                <div v-if="!editMode" class="flex items-center justify-between group">
                                    <p class="text-gray-800">{{ user.phone || 'Non renseigné' }}</p>
                                </div>
                                <Input v-else v-model="form.phone" type="tel" />
                            </div>

                            <!-- Mot de passe -->
                            <div v-if="editMode" class="space-y-1 pt-4 border-t border-gray-100">
                                <label class="block text-sm font-medium text-gray-500">Changer le mot de
                                    passe</label>
                                <div class="space-y-4">
                                    <Input v-model="form.current_password" type="password"
                                        placeholder="Mot de passe actuel" />
                                    <Input v-model="form.password" type="password" placeholder="Nouveau mot de passe" />
                                    <Input v-model="form.password_confirmation" type="password"
                                        placeholder="Confirmer le nouveau mot de passe" />
                                </div>
                            </div>
                        </div>

                        <!-- Bouton principal -->
                        <div class="mt-8" v-if="editMode">
                            <button type="submit" :disabled="form.processing"
                                class="w-full py-3 bg-primary hover:bg-primary-700 text-white rounded-lg font-medium transition duration-300 shadow-md flex justify-center items-center gap-2"
                                :class="{ 'opacity-70 cursor-not-allowed': form.processing }">
                                <span v-if="!form.processing">Enregistrer les modifications</span>
                                <span v-else>Enregistrement en cours...</span>
                                <i v-if="form.processing" class="fas fa-circle-notch animate-spin"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Input from '../../components/ui/Input.vue'
defineOptions({
  inheritAttrs: false,
});
const props = defineProps({
    user: {
        type: Object,
        required: true,
        default: () => ({
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            avatar: null
        })
    }
});

const editMode = ref(false);

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    phone: props.user.phone,
    avatar: props.user.avatar,
    current_password: '',
    password: '',
    password_confirmation: ''
});

const toggleEditMode = () => {
    editMode.value = !editMode.value;
    if (!editMode.value) {
        // Reset form when canceling edit
        form.reset();
    }
};

const submit = () => {
    form.put('', {
        preserveScroll: true,
        onSuccess: () => {
            editMode.value = false;
            form.reset('password', 'password_confirmation', 'current_password');
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors)
        }
    });
};

const handleAvatarChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            form.avatar = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const openAvatarModal = () => {
    // Implement avatar modal logic here
    console.log('Open avatar modal');
};
</script>

<style scoped>
/* Animation pour le bouton de chargement */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Transition pour le mode édition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
