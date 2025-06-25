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
                        <img v-if="form.avatar" id="profile-image" :src="form.avatar" alt="Photo de profil"
                            class="w-36 h-36 rounded-full object-cover shadow-md group-hover:opacity-90 transition duration-300" />
                        <div v-else class="border rounded-full p-4 bg-gray-300">
                            <svg class="h-[150px]" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="m 8 1 c -1.65625 0 -3 1.34375 -3 3 s 1.34375 3 3 3 s 3 -1.34375 3 -3 s -1.34375 -3 -3 -3 z m -1.5 7 c -2.492188 0 -4.5 2.007812 -4.5 4.5 v 0.5 c 0 1.109375 0.890625 2 2 2 h 8 c 1.109375 0 2 -0.890625 2 -2 v -0.5 c 0 -2.492188 -2.007812 -4.5 -4.5 -4.5 z m 0 0"
                                        fill="#2e3436"></path>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-1 capitalize">{{ form.first_name }} {{
                        form.last_name }}
                    </h2>
                    <div class="flex items-center text-primary-600 mb-4">
                        <i class="fas fa-user-tag mr-1"></i>
                        <span class="text-sm font-medium capitalize">{{ roles(user.roles) }}</span>
                    </div>
                </div>

                <!-- Informations personnelles -->
                <div class="w-full bg-white rounded-xl shadow-md p-8">
                    <h3
                        class="md:text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-100 flex justify-between">
                        Informations Personnelles
                        <button @click="toggleEditMode"
                            class="text-xs px-4 py-2 bg-primary/70 hover:bg-primary text-white rounded-lg font-medium transition duration-300 flex items-center">
                            <svg v-if="!editMode" class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <svg v-else class="h-4 w-4 text-white" viewBox="0 0 512 512" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>cancel</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="work-case" fill="currentColor"
                                            transform="translate(91.520000, 91.520000)">
                                            <polygon id="Close"
                                                points="328.96 30.2933333 298.666667 1.42108547e-14 164.48 134.4 30.2933333 1.42108547e-14 1.42108547e-14 30.2933333 134.4 164.48 1.42108547e-14 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48">
                                            </polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <span class="ml-2 hidden md:block">{{ editMode ? 'Annuler' : 'Modifier le profil' }}</span>
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

                                    <Input v-else v-model="form.first_name" type="text"
                                        :error="form.errors.first_name" />
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-500">Nom</label>
                                    <div v-if="!editMode" class="flex items-center justify-between group">
                                        <p class="text-gray-800">{{ user.last_name }}</p>
                                    </div>
                                    <Input v-else v-model="form.last_name" type="text" :error="form.errors.last_name" />
                                </div>
                            </div>

                            <!-- Email -->
                            <div v-if="!editMode" class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <div class="flex items-center justify-between group">
                                    <p class="text-gray-800">{{ user.email }}</p>
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Téléphone</label>
                                <div v-if="!editMode" class="flex items-center justify-between group">
                                    <p class="text-gray-800">{{ user.phone || 'Non renseigné' }}</p>
                                </div>
                                <Input v-else v-model="form.phone" type="tel" placeholder="Ex: 509 40281374"
                                    :error="form.errors.phone" />
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
                        <div class="mt-4 flex justify-end">
                            <button type="button" @click="editPassMode = true"
                                class="py-2 px-4 bg-gray-100 hover:bg-gray-200 text-primary rounded-lg font-medium transition duration-300 flex items-center justify-center gap-2">
                                <svg class="h-4 w-4 text-primary" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg> Modifier le mot de passe
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <EditPassword :show="editPassMode" @close="editPassMode = false" />
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Input from '../../components/ui/Input.vue'
import EditPassword from '../../components/modal/EditPassword.vue';
import { useToasterStore } from '../../store/Toast';
import {roles} from '../../Utils/utils'
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
        })
    }
});

const editMode = ref(false);
const editPassMode = ref(false);
const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    phone: props.user.phone,
    avatar: props.user.avatar,
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
            useToasterStore().success({ text: "Profile modifer avec success" })
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors)
        }
    });
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
