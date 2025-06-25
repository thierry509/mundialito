<template>
    <i class="material-icons" translate="no">{{ icon }}</i>
  </template>
  <script>
  export default {
    props: {
      icon: { type: String, required: true }
    }
  };
  </script>
