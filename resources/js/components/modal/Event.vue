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
    event_type: '',
    minute: '',
    added_time: '',
    player_name: '',
    team: '',
    game_id: props.game.id,
});

const processing = ref(false);

const submit = () => {
    form.post(`/edition/championnat/match/event`, {
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
                <div class="mx-2 md:mx-10 py-8 ">
                    <h1 class="text-xl font-bold text-center mb-6">Ajouter un événement</h1>

                    <form method="POST" action="/api/events" class="space-y-4">
                        <!-- Type d'événement -->
                        <!-- Équipe -->

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Équipe</label>
                            <DropdownInput name="team" label="Équipe" :options="[
                                { value: 'team_a', label: game.team_a.name },
                                { value: 'team_b', label: game.team_b.name },
                            ]" v-model="form.team" required class="w-full" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Type d'événement *</label>
                            <DropdownInput name="event_type" :options="[
                                { value: 'goal', label: 'But' },
                                { value: 'yellow_card', label: 'Carton Jaune' },
                                { value: 'red_card', label: 'Carton Rouge' }
                            ]" v-model="form.event_type" required class="w-full" />
                        </div>

                        <!-- Temps de jeu -->
                         <Input v-model="form.minute" name="minute" type="number" label="Minute"
                            placeholder="Ex: 45" required class="w-full" />
                        <Input v-model="form.added_time" name="added_time" type="number" label="Temps additionnel"
                            placeholder="Ex: 2" class="w-full" />
                                        <!-- Joueur -->
                        <Input v-model="form.player_name" name="player_name" type="text" label="Joueur"
                            placeholder="Nom du joueur" required class="w-full" />
                    </form>
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
