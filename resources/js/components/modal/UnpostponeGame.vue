<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Input from '../ui/Input.vue';
import BaseModal from './BaseModal.vue';
import { useToasterStore } from '@/store/Toast';
import { dateTime } from '../../Utils/utils';
import Select from '../ui/Select.vue';
const props = defineProps({
    show: Boolean,
    game: Object,
});

const emit = defineEmits(['close']);

const {date, time} = dateTime(props?.game?.date_time)
// Initialisation du formulaire Inertia
const form = useForm({
    date: date,
    time: time,
    location: props.game.location,
});

const processing = ref(false);
const validationErrors = ref([]);
const submit = () => {
    form.put(`/edition/championnat/match/replanifer/${props.game.id}`, {
        preserveScroll: true,
        onStart: () => {
            processing.value = true
            validationErrors.value = []
        },
        onFinish: () => {
            processing.value = false
        },
        onSuccess: () => {
            useToasterStore().success({ text: 'Équipe enregistrée avec succès' });
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
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Replanifier Match</h2>
        <div class="flex items-center justify-between space-x-3 bg-gray-50 rounded-full py-2 px-6 w-5/6 mx-auto mb-6">
            <span class="font-bold text-gray-800">{{ game.team_a.name }}</span>
            <span class="bg-primary text-white text-xs font-bold py-1 px-2 rounded-full">VS</span>
            <span class="font-bold text-gray-800">{{ game.team_b.name }}</span>
        </div>
        <form @submit.prevent="submit" class="space-y-4">
            <div class="">
                <!-- Date et Heure -->
                <div class="grid grid-cols-2 gap-4">

                    <Input v-model="form.date" type="date" id="date" label="Date" placeholder="Sélectionnez une date"
                        :error="form.errors?.date" />
                    <Input v-model="form.time" type="time" id="time" label="Heure" :error="form.errors?.time"
                        placeholder="Sélectionnez une heure" />
                </div>

                <!-- Stade -->
                <div>
                    <Select v-model="form.location" type="text" id="location" label="Lieu" :options="[  
                        { label: 'Parc Vincent', value: 'Parc Vincent' },
                    ]" :errors="form.errors?.location" />
                </div>
            </div>
            <!-- Boutons -->
            <div class="flex justify-end space-x-4 pt-4">
                <button type="reset"
                    @click="emit('close')"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    Créer le match
                </button>
            </div>

            <div>
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
