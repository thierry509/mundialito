<template>
    <div class="mb-6">
        <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 mb-1">
            {{ label }} <span v-if="required" class="text-red-500">*</span>
        </label>
        <div id="editor"></div>

        <p v-if="error" class="mt-1 text-sm text-red-600">
            {{ error }}
        </p>
        <p v-else-if="helperText" class="mt-1 text-sm text-gray-500">
            {{ helperText }}
        </p>
    </div>
</template>

<script setup>
import Quill from 'quill';
import { onMounted, watch, ref } from 'vue';
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    name: String,
    label: String,
    placeholder: String,
    helperText: String,
    error: String,
    required: {
        type: Boolean,
        default: false
    },
});

const emit = defineEmits(['update:modelValue', 'blur']);
const quillInstance = ref(null);

onMounted(() => {
    const container = document.getElementById('editor');

    if (!container) {
        console.error("Élément #editor introuvable");
        return;
    }

    quillInstance.value = new Quill(container, {
        modules: {
            toolbar: [
                [{ header: [2, false] }],
                ['bold', 'italic', 'underline', 'blockquote'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link'],
            ],
        },
        placeholder: props.placeholder || 'Compose an epic...',
        theme: 'snow',
    });

    // Set initial content if modelValue exists
    if (props.modelValue) {
        quillInstance.value.root.innerHTML = props.modelValue;
    }

    quillInstance.value.on('text-change', () => {
        const content = quillInstance.value.root.innerHTML;
        emit('update:modelValue', content);
    });
});

// Watch for changes in modelValue from parent
watch(() => props.modelValue, (newValue) => {
    if (quillInstance.value && newValue !== quillInstance.value.root.innerHTML) {
        quillInstance.value.root.innerHTML = newValue;
    }
});
</script>
