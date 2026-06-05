<template>
  <section class="hero">
    <div>
      <p class="eyebrow">Proxy Manager</p>
    </div>
    <button
        class="secondary"
        type="button"
        :disabled="loading"
        @click="$emit('refresh')"
    >
      {{ loading ? 'Обновляем...' : 'Обновить список' }}
    </button>
  </section>
</template>

<script setup>
defineProps({
  loading: {
    type: Boolean,
    default: false,
  },
})

defineEmits(['refresh'])
</script>

