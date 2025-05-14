<script setup lang="ts">
import BaseModal from './BaseModal.vue';
import Input from '../../components/ui/Input.vue'
import { useForm } from '@inertiajs/vue3'
import DropdownInput from '../../components/Form/DropdownInput.vue'
import { useYearStore } from '../../store/year'
import { computed, onMounted, ref } from 'vue'

defineProps({
    isOpen: Boolean
})

const yearStore = useYearStore()

const newGroup = useForm({
    name: '',
    year: yearStore.year
})


const submit = () => {
    newGroup.post('', {
        onSuccess: () => {
            creatgroup.value = false
        },
        onError: () => {
            console.log(newGroup.errors)
        }
    })
}
const creatgroup = ref(false)

</script>

<template>
    <BaseModal :show="isOpen">
        <form action="" @submit.prevent="submit">
            <h2 class="text-xl font-semibold mb-4">Créer un nouveau groupe</h2>
            <Input v-model="newGroup.name" type="text" placeholder="Nom du groupe" />

            <div class="flex justify-end">
                <button @click="submit" type="button"
                    class="mt-4 px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                    Créer le groupe
                </button>
            </div>
        </form>
    </BaseModal>
</template>
