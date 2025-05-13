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

const { year } = useYearStore()
const newGroup = useForm({
    name: '',
    year: year
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

</script>

<template>
    <BaseModal :isOpen="isOpen">
        <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-4">Créer un nouveau groupe</h2>
                <Input v-model="newGroup.name" type="text" placeholder="Nom du groupe" />

                <div class="flex justify-end">
                    <button @click="submit" type="button"
                        class="mt-4 px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                        Créer le groupe
                    </button>
                </div>
            </div>
    </BaseModal>
</template>