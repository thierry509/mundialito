<template>
    <BaseModal :show="confirmStore.isOpen" @close="cancel">
        <h3 class="text-xl font-semibold mb-2">{{ confirmStore?.payload?.title }}</h3>
        <p class="text-gray-600 mb-6">{{ confirmStore?.payload?.message }}</p>
        <div class="flex justify-end space-x-4">
            <button @click="confirm"
                class="px-3 py-2.5 text-xs font-medium rounded-md bg-primary/10 text-primary hover:bg-primary/20 transition">
                {{ "Confirmer" }}
            </button>
            <button @click="cancel" class="px-3 py-2.5 text-xs font-medium rounded-md bg-red-500/10 text-red-500 hover:bg-red-500/20 transition ">
                {{ "Anuler" }}
            </button>
        </div>
    </BaseModal>
</template>
<script setup>
import BaseModal from './BaseModal.vue';
import { useConfirmStore } from '../../store/confirmStore';

const confirmStore = useConfirmStore();


const confirm = () => {
    confirmStore.confirm()
}

const cancel = () => {
    confirmStore.cancel()
}
</script>
