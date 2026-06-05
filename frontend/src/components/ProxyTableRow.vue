<template>
  <tr>
    <td>
      <strong>{{ proxy.host }}:{{ proxy.port }}</strong>
      <span v-if="proxy.username" class="muted">Логин: {{ proxy.username }}</span>
      <span v-if="proxy.last_error" class="error-text">{{ proxy.last_error }}</span>
    </td>
    <td>
      <span class="status" :class="proxy.status">{{ proxy.status }}</span>
    </td>
    <td>{{ formatDate(proxy.checked_at) }}</td>
    <td class="actions-cell">
      <div class="row-actions">
        <button
            class="secondary btn-sm"
            type="button"
            :disabled="checking"
            @click="$emit('check', proxy)"
        >
          {{ checking ? '...' : 'Проверить' }}
        </button>
        <button
            class="secondary btn-sm"
            type="button"
            @click="$emit('edit', proxy)"
        >
          Изменить
        </button>
        <button
            class="danger btn-sm"
            type="button"
            @click="$emit('delete', proxy)"
        >
          Удалить
        </button>
      </div>
    </td>
  </tr>
</template>

<script setup>
import { formatDate } from '../utils/formatDate'

defineProps({
  proxy: {
    type: Object,
    required: true,
  },
  checking: {
    type: Boolean,
    default: false,
  },
})

defineEmits([
  'check',
  'edit',
  'delete'
])
</script>