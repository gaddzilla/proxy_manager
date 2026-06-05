<template>
  <form class="card form" @submit.prevent="submitProxy">
    <h2>{{ isEditing ? 'Редактировать прокси' : 'Добавить прокси' }}</h2>

    <label>
      Хост
      <input
        v-model="host"
        required
        placeholder="proxy.example.com"
      />
    </label>

    <label>
      Порт
      <input v-model="port" required type="number" min="1" max="65535" />
    </label>

    <label>
      Логин
      <input v-model="username" autocomplete="username" placeholder="Необязательно" />
    </label>

    <label>
      Пароль
      <input
        v-model="password"
        autocomplete="current-password"
        placeholder="Необязательно"
        type="password"
      />
    </label>

    <div class="actions">
      <button type="submit" :disabled="saving">
        {{ saving ? 'Сохраняем...' : isEditing ? 'Сохранить' : 'Добавить' }}
      </button>
      <button v-if="isEditing" class="secondary" type="button" @click="resetForm">
        Отмена
      </button>
    </div>
  </form>
</template>

<script setup>
import { inject } from 'vue'

const {
  host,
  port,
  username,
  password,
  saving,
  isEditing,
  submitProxy,
  resetForm
} = inject('proxyForm')
</script>
