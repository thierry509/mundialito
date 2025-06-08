<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Input from '../ui/Input.vue';
import BaseModal from './BaseModal.vue';
import { useToasterStore } from '@/store/Toast';
import DropdownInput from '../Form/DropdownInput.vue'
import Select from '../ui/Select.vue';
const props = defineProps({
    show: Boolean,
    groups: {
        type: Array,
        default: () => []
    },
    type: String,
    stage: String
});

const emit = defineEmits(['close']);

// Initialisation du formulaire Inertia
const form = useForm({
    groupId: '',
    team1Id: '',
    team2Id: '',
    type: props.type,
    date: '',
    stage: props.stage || '',
    time: '',
    location: '',
});

const processing = ref(false);
const validationErrors = ref([]);
const submit = () => {
    form.post('', {
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
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Planifier un nouveau match </h2>
        <form @submit.prevent="submit" class="space-y-4">

            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <label for="group" class="block text-sm font-medium text-gray-700">Groupe</label>
                    <DropdownInput v-model="form.groupId"
                        :options="[...groups.map(group => ({ value: group.id, label: `Groupe ${group.name}` }))]"
                        id="groupId" label="Groupe" placeholder="Ex: Groupe A" :error="form.errors?.groupId" />
                </div>

                <Select v-model="form.stage" label="Tours" :options="[
                    { label: 'Journer 1', value: '1' },
                    { label: 'Journer 2', value: '2' },
                    { label: 'Journer 3', value: '3' },
                    { label: 'Journer 4', value: '4' },
                ]" :error="form.errors?.stage" />
            </div>
            <div v-if="form.groupId" class="">
                <!-- Équipes en ligne -->
                <div class="md:flex md:flex-row md:space-x-4 space-y-4 md:space-y-0 mb-4">
                    <!-- Équipe 1 -->
                    <div class="md:flex-1">
                        <label for="team1" class="block text-sm font-medium text-gray-700">Équipe 1</label>
                        <DropdownInput v-model="form.team1Id"
                            :options="[...groups.find(group => group.id === form.groupId).teams.map(team => ({ value: team.id, label: team.name }))]"
                            id="team1Id" label="Équipe 1" placeholder="Ex: Équipe 1" :error="form.errors?.team1Id" />
                    </div>

                    <!-- VS au centre -->
                    <div class="flex items-center justify-center md:justify-center md:items-end md:pb-7">
                        <span class="text-xl font-bold text-gray-500">VS</span>
                    </div>

                    <!-- Équipe 2 -->
                    <div class="md:flex-1">
                        <label for="team2" class="block text-sm font-medium text-gray-700">Équipe 2</label>
                        <DropdownInput v-model="form.team2Id"
                            :options="[...groups.find(group => group.id === form.groupId).teams.map(team => ({ value: team.id, label: team.name }))]"
                            id="team2Id" label="Équipe 2" placeholder="Ex: Équipe 2" :error="form.errors?.team2Id" />
                    </div>
                </div>

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
                        { label: 'Selectionner un terrain', value: '' },
                        { label: 'Parc stenio vincent', value: 'Parc stenio vincent' },
                    ]" :error="form.errors?.location" />
                </div>
            </div>
            <!-- Boutons -->
            <div class="flex justify-end space-x-4 pt-4">
                <button type="reset"
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
