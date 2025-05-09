<template>
    <div class="mb-4">
      <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }}<span v-if="isRequired" class="text-red-600">*</span>
      </label>
      <div class="relative rounded-md shadow-sm">
        <div v-if="icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <MaterialIcon :icon="icon" class="h-5 w-5 text-gray-400" />
        </div>
        <select
          :id="name"
          v-model="value"
          :class="[
            'block w-full rounded-md border-gray-300 py-2 pl-10 pr-10 text-base focus:border-primary focus:outline-none focus:ring-primary sm:text-sm',
            errorMessage ? 'border-red-500' : '',
            icon ? 'pl-10' : 'pl-3'
          ]"
        >
          <option value="" disabled selected>{{ placeholder || 'Select an option' }}</option>
          <option v-for="option in options" :key="option.value" :value="option.value">
            {{ option.label }}
          </option>
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
          <MaterialIcon icon="expand_more" class="h-5 w-5 text-gray-400" />
        </div>
      </div>
      <p v-if="errorMessage" class="mt-1 text-sm text-red-600">{{ errorMessage }}</p>
    </div>
  </template>

  <script setup lang="ts">
  import { useField } from 'vee-validate';
  import MaterialIcon from './MaterialIcon.vue';

  interface Option {
    value: string | number;
    label: string;
  }

  interface Props {
    name: string;
    options: Option[];
    placeholder?: string;
    label?: string;
    icon?: string;
    isRequired?: boolean;
  }

  const props = withDefaults(defineProps<Props>(), {
    isRequired: false
  });

  const { value, errorMessage } = useField(() => props.name);
  </script>
