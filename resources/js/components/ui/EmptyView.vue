<template>
    <div class="flex flex-col items-center justify-center h-48">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" viewBox="0 0 24 24" fill="none"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 7v14a2 2 0 002 2h14a2 2 0 002-2V7m-6-4h-4m4 0a2 2 0 012 2v1m-6-3a2 2 0 00-2 2v1m6-1h4m-4 0H7m4 0V3m0 1v1m0-1h4" />
        </svg>

        <h2 class="text-lg font-semibold text-gray-400 mb-2">Aucun {{ model }} n'est enregistrée</h2>
        <p class="text-sm text-gray-500">Veuillez enregistrer {{ model }}.</p>
        <slot>
        </slot>
    </div>
</template>
<script lang="ts" setup>
defineProps({
    model: {
        required: true,
        type: String,
    }

})
</script>
