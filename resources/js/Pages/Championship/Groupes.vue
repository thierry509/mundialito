<template>
    <DropdownInput :options="['Option 1', 'Option 2', 'Option 3']" />
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white inline-flex items-center">
            <svg class="w-8 h-8 mr-3 p-1.5 bg-primary/10 text-primary rounded-full" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <g stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                    <path d="M20.586 3.586a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </g>
            </svg>
            <span class="border-l-2 border-primary pl-3">Les Groups
                <span class="text-primary font-semibold">de la compétition</span>
            </span>
        </h1>
    </div>
    <div class="flex justify-between items-center mb-4">
        <div class=""></div>
        <button @click="addGroup" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
            Ajouter un groupe
        </button>
    </div>

    <div>
        <div v-for="group in groups" :key="group.id">
            <SingleGroup :teams="teams" :group="group" />
        </div>
        <div v-if="creatgroup" class="">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-4">Créer un nouveau groupe</h2>
                <Input v-model="newGroup.name" type="text" placeholder="Nom du groupe"
                     />

                <div class="flex justify-end">
                    <button @click="submit" type="button"
                        class="mt-4 px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                        Créer le groupe
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import SingleGroup from '../../components/Championship/SingleGroupes.vue'
import Input from '../../components/ui/Input.vue'
import { useForm } from '@inertiajs/vue3'
import DropdownInput from '../../components/Form/DropdownInput.vue'
defineProps({
    groups: {
        type: Array,
        default: () => []
    },
    teams: {
        type: Array,
        default: () => []
    },
})

const newGroup = useForm({
    name: '',
})
const submit = () => {
    newGroup.post('', {
        onSuccess: () => {
            creatgroup.value = false
        },
        onError: () => {
            console.log('error')
        }
    })
}
const creatgroup = ref(false)
const addGroup = () => {
    creatgroup.value = true
}

</script>
