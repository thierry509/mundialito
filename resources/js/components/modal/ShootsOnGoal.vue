<script setup>
import { ref, computed, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import BaseModal from './BaseModal.vue';
import { useToasterStore } from '@/store/Toast';
import DropdownInput from '../Form/DropdownInput.vue'
import Input from '../ui/Input.vue';

const props = defineProps({
    show: Boolean,
    game: Object
});

const emit = defineEmits(['close']);

const form = useForm({
    shootout_score_a: '',
    shootout_score_b: '',
    game_id: props.game.id,
});

const processing = ref(false);

const submit = () => {
    form.put(`/edition/championnat/match/tir-au-but`, {
        preserveScroll: true,
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
        onSuccess: () => {
            useToasterStore().success({ text: 'Match mis à jour avec succès' });
            emit('close');
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors);
        }
    });
};

const close = () => {
    emit('close');
};
</script>

<template>
    <BaseModal :show="show" @close="close">
        <form @submit.prevent="submit" class="space-y-4">
            <div class="overflow-hidden">
                <h1 class="text-2xl font-semibold text-center mb-6 text-gray-800">
                    Score des Tirs au But
                </h1>

                <!-- Noms des équipes -->
                <div class="flex justify-center items-center mb-8 bg-gray-50 p-3 rounded-lg">
                    <span
                        class="font-medium text-lg text-gray-700 px-3 py-1 bg-white rounded-md border border-gray-200">
                        {{ game.team_a.name }}
                    </span>

                    <span class="mx-3 text-gray-400 font-medium">vs</span>

                    <span
                        class="font-medium text-lg text-gray-700 px-3 py-1 bg-white rounded-md border border-gray-200">
                        {{ game.team_b.name }}
                    </span>
                </div>

                <!-- Score -->
                <div class="flex justify-center items-center my-8 space-x-5">
                    <div class="text-center">
                        <input type="number" min="0" v-model="form.shootout_score_a" class="w-16 h-16 text-3xl font-medium text-center border-2 border-gray-300 rounded-lg
                      focus:border-primary-500 focus:ring-1 focus:ring-primary-200 focus:outline-none
                      hover:border-gray-400 transition-colors">
                        <div class="mt-2 text-sm text-gray-500 font-medium">
                            Score
                        </div>
                    </div>

                    <span class="text-2xl font-medium text-gray-400">-</span>

                    <div class="text-center">
                        <input type="number" min="0" v-model="form.shootout_score_b" class="w-16 h-16 text-3xl font-medium text-center border-2 border-gray-300 rounded-lg
                      focus:border-primary-500 focus:ring-1 focus:ring-primary-200 focus:outline-none
                      hover:border-gray-400 transition-colors">
                        <div class="mt-2 text-sm text-gray-500 font-medium">
                            Score
                        </div>
                    </div>
                </div>
                <!-- Actions -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t">
                    <button type="button" @click="close"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm hover:bg-gray-100 transition">
                        Annuler
                    </button>
                    <button type="submit" :disabled="processing"
                        class="px-4 py-2 bg-primary text-white rounded-lg text-sm hover:bg-blue-700 transition disabled:opacity-50">
                        <span v-if="processing">Enregistrement...</span>
                        <span v-else>Enregistrer</span>
                    </button>
                </div>
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
