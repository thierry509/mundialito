<template>
    <div class="flex flex-col bg-white rounded-lg w-60 p-1 text-sm">
        <div v-if="true" class="px-1">
            <div class="flex justify-between">
                <span>Real Madrid</span>
                <span>10</span>
            </div>
            <div class="flex justify-between">
                <span>FC Barcelone</span>
                <span>0</span>
            </div>
        </div>
        <div v-else
            class="flex justify-center items-center border-2 border-dotted border-gray-300 w-full rounded-lg py-2 px-4 hover:bg-gray-50 cursor-pointer transition-colors">
            <div class="flex items-center gap-2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="font-medium">Planifier un match</span>
            </div>
        </div>
    </div>
</template>

<script setup>
    defineProps()
</script>
