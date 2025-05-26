<template>
    <Head>
        <title>Les Groups de la compétition </title>
    </Head>
    <div class="p-6 md:p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 inline-flex items-center">
                <svg class="w-8 h-8 mr-3 p-1.5 bg-primary/10 text-primary rounded-full"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            <button @click="createGroup"
                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                Ajouter un groupe
            </button>
        </div>
        <div>
            <div v-if="groups.length === 0" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <EmptyView model="groupe">
                    <button @click="createGroup"
                        class="px-4 py-2 mt-4 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                        Ajouter un groupe
                    </button>
                </EmptyView>
            </div>
            <div v-for="group in groups" :key="group.id">
                <SingleGroup :teams="teams" :group="group" />
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import SingleGroup from '../../components/Championship/SingleGroupes.vue'
import EmptyView from '../../components/ui/EmptyView.vue';
import { router, Head } from '@inertiajs/vue3'
import { useToasterStore } from '../../store/Toast'
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

const createGroup = () => {
    router.post('', {}, {
        onSuccess: () => {
            useToasterStore().success({ text: 'Groupe créé avec succès' })
        },
        onError: () => {
            console.log(router)
        }
    })
}

</script>
