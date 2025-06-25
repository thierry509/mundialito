<template>
    <header
      class="relative"
      :class="height"
      :style="{ background: `linear-gradient(to right, var(--${gradientFrom}), var(--${gradientTo}))` }"
    >
      <div
        class="absolute inset-0 bg-cover bg-center"
        :style="{
          backgroundImage: `url('${backgroundImage}')`,
          opacity: `0.${opacity}`
        }"
      ></div>
      <div class="absolute inset-0 bg-black opacity-30"></div>
      <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center" :class="textColor">
          <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ title }}</h1>
          <p v-if="subtitle" class="text-xl">{{ subtitle }}</p>
        </div>
      </div>
    </header>
  </template>

  <script setup lang="ts">
  interface Props {
    title: string
    subtitle?: string
    gradientFrom?: string
    gradientTo?: string
    opacity?: string
    height?: string
    textColor?: string
    backgroundImage?: string
  }

  const props = withDefaults(defineProps<Props>(), {
    gradientFrom: 'from-primary',
    gradientTo: 'to-accent',
    opacity: '1',
    height: 'py-20',
    textColor: 'text-white',
    backgroundImage: 'https://img.freepik.com/photos-gratuite/concept-faire-du-sport_23-2151937746.jpg?ga=GA1.1.90895242.1736884756&semt=ais_hybrid&w=740'
  })
  </script>

  <style scoped>

  </style>
