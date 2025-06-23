<template>

    <Head>
        <title>Les Groups de la compétition </title>
    </Head>
    <div class="p-6 md:p-8">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Groupes de Compétition</h1>
            <p class="text-gray-600 mt-2">Composition et classements</p>
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
