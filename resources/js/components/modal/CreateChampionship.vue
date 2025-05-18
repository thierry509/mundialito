<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Input from '../ui/Input.vue';
import BaseModal from './BaseModal.vue';
import Select from '../ui/Select.vue';

const props = defineProps({
    show: Boolean
});

const emit = defineEmits(['close']);

const form = useForm({
    year: null,
    hasGroupStage: false,
    knockout_round: '4',
});

const processing = ref(false);
const validationErrors = ref([]);

const roundOptions = [
    { value: '4', label: 'Huitièmes de finale' },
    { value: '3', label: 'Quarts de finale' },
    { value: '2', label: 'Demi-finales' },
    { value: '1', label: 'Finale' },
];

const submit = () => {
    form.post('/edition/championnat/', {
        preserveScroll: true,
        onStart: () => {
            processing.value = true
            validationErrors.value = []
        },
        onFinish: () => {
            processing.value = false
        },
        onSuccess: () => {
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
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Enregistrer Edition</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <Input v-model="form.year" type="number" id="year" label="Année de l'édition" placeholder="Ex: 2025"
                :error="form.errors.year" required />

            <div class="flex items-center space-x-2">
                <input v-model="form.hasGroupStage" type="checkbox" id="hasGroupStage"
                    class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="hasGroupStage">Phase de groupes</label>
            </div>

            <Select v-model="form.startingRound" id="startingRound" label="Round de départ" :options="roundOptions"
                :error="form.errors.startingRound" required />

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