<template>
    <!-- Text/Email/Password Input -->
    <div class="mb-4 flex flex-col" v-if="type !== 'checkbox'">
      <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }}<span v-if="isRequired" class="text-red-600">*</span>
      </label>
      <div :class="[
        'relative rounded-md shadow-sm',
        errorMessage ? 'border-red-500' : 'border-gray-300 focus:border-primary focus:ring-primary'
      ]">
        <div v-if="icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <MaterialIcon :icon="icon" class="h-5 w-5 text-gray-400" />
        </div>
        <input
          :id="name"
          :type="localType"
          v-model="value"
          :placeholder="placeholder"
          :autocomplete="autocomplete"
          :class="[
            'block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm',
            icon ? 'pl-10' : 'pl-3',
            'py-2'
          ]"
        />
        <button
          v-if="type === 'password'"
          type="button"
          class="absolute inset-y-0 right-0 pr-3 flex items-center"
          @click="togglePassword"
        >
          <MaterialIcon :icon="passwordVisible ? 'visibility_off' : 'visibility'" class="h-5 w-5 text-gray-400 hover:text-gray-500" />
        </button>
      </div>
      <p v-if="errorMessage" class="mt-1 text-sm text-red-600">{{ errorMessage }}</p>
    </div>

    <!-- Checkbox Input -->
    <div class="mb-4 flex items-start" v-else>
      <div class="flex items-center h-5">
        <input
          :id="name"
          type="checkbox"
          v-model="value"
          :class="[
            'focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded',
            errorMessage ? 'border-red-500' : ''
          ]"
        />
      </div>
      <div class="ml-3 text-sm">
        <label :for="name" class="font-medium text-gray-700">
          {{ label }}<span v-if="isRequired" class="text-red-600">*</span>
        </label>
        <p v-if="errorMessage" class="mt-1 text-red-600">{{ errorMessage }}</p>
      </div>
    </div>
  </template>

  <script setup lang="ts">
  import { useField } from 'vee-validate';
  import MaterialIcon from './MaterialIcon.vue';
  import { computed, ref } from 'vue';

  interface Props {
    name: string;
    type?: 'text' | 'email' | 'password' | 'checkbox';
    placeholder?: string;
    label?: string;
    icon?: string;
    isRequired?: boolean;
    autocomplete?: string;
  }

  const props = withDefaults(defineProps<Props>(), {
    type: 'text',
    isRequired: false
  });

  const passwordVisible = ref(false);
  const localType = computed(() => passwordVisible.value ? 'text' : props.type);

  const togglePassword = () => {
    passwordVisible.value = !passwordVisible.value;
  };

  const { value, errorMessage } = useField(() => props.name, undefined, {
    type: props.type === 'checkbox' ? 'boolean' : 'string'
  });
  </script>
