<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Input from '../ui/Input.vue';
import BaseModal from './BaseModal.vue';
import { useToasterStore } from '@/store/Toast';
const props = defineProps({
    show: Boolean
});

const emit = defineEmits(['close']);

// Initialisation du formulaire Inertia
const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: ''
});

const processing = ref(false);
const validationErrors = ref([]);
const submit = () => {
    form.put('/edition/modifier-mots-de-passe', {
        preserveScroll: true,
        onStart: () => {
            processing.value = true
            validationErrors.value = []
        },
        onFinish: () => {
            processing.value = false
        },
        onSuccess: () => {
            useToasterStore().success({ text: 'Mot de passe modifier avec succès' });
            emit('close');
            form.reset()
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors)
        }
    })
}

</script>

<template>
    <BaseModal :show="show" @close="emit('close')">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le mot de passe</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <div class="space-y-1 pt-4 border-t border-gray-100">
                <label class="block text-sm font-medium text-gray-500">Changer le mot de
                    passe</label>
                <div class="space-y-4">
                    <Input v-model="form.current_password" type="password" placeholder="Mot de passe actuel"
                        :error="form.errors.current_password" />
                    <Input v-model="form.password" type="password" placeholder="Nouveau mot de passe"
                        :error="form.errors.password" />
                    <Input v-model="form.password_confirmation" type="password"
                        placeholder="Confirmer le nouveau mot de passe" :error="form.errors.password_confirmation" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-2">
                <button type="button" @click="emit('close')"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                    Annuler
                </button>
                <button type="submit" :disabled="form.processing"
                    class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition flex items-center disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span v-if="form.processing">Enregistrement...</span>
                    <span v-else>Enregistrer</span>
                </button>
            </div>
        </form>
    </BaseModal>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
