<template>
    <Link
      :href="href"
      class="flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200"
      :class="{
        'bg-green-700 text-white': active,
        'text-gray-100 hover:bg-green-800': !active
      }"
    >
      <span class="mr-3">
        <slot name="icon" />
      </span>
      <slot />
    </Link>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3'

  defineProps({
    href: {
      type: String,
      required: true
    },
    active: {
      type: Boolean,
      default: false
    }
  })
  </script>
