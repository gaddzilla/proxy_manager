<template>
  <main class="page">
    <AppHeader :loading="loading" @refresh="loadProxies" />

    <p v-if="error" class="alert">{{ error }}</p>

    <section class="grid">
      <ProxyForm />
      <ProxyList />
    </section>
  </main>
</template>

<script setup>
import { storeToRefs } from 'pinia'
import { onMounted, provide } from 'vue'
import AppHeader from '../components/AppHeader.vue'
import ProxyForm from '../components/ProxyForm.vue'
import ProxyList from '../components/ProxyList.vue'
import { useProxyForm } from '../composables/useProxyForm'
import { useProxyStore } from '../stores/proxyStore'

const proxyStore = useProxyStore()
const {
  error,
  loading
} = storeToRefs(proxyStore)
const { loadProxies } = proxyStore

const proxyForm = useProxyForm()
provide('proxyForm', proxyForm)

onMounted(loadProxies)
</script>
