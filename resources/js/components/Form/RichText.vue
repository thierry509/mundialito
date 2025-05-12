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
import { onMounted } from 'vue';
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import MarkdownConverter from '../../Utils/MarkdownConverter.js';
const props = defineProps({
    modelValue: [String, Number],
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

onMounted(() => {
    const container = document.getElementById('editor');

    if (!container) {
        console.error("Élément #editor introuvable");
        return;
    }

    const quill = new Quill(container, {
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

    quill.on('text-change', () => {
        const content = quill.root.innerHTML;
        const markdown = MarkdownConverter.toMarkdown(quill.root.innerHTML);
        const html = MarkdownConverter.toHtml(markdown);

        emit('update:modelValue', markdown);
    });
});

</script>
