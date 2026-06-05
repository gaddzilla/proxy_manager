import { computed, ref } from 'vue'
import * as proxyApi from '../api/proxies'
import { useProxyStore } from '../stores/proxyStore'

const DEFAULT_PORT = 8080

export function useProxyForm() {
  const proxyStore = useProxyStore()

  const host = ref('')
  const port = ref(DEFAULT_PORT)
  const username = ref('')
  const password = ref('')
  const editingId = ref(null)
  const saving = ref(false)

  const isEditing = computed(() => editingId.value !== null)

  function buildPayload() {
    return {
      host: host.value.trim(),
      port: Number(port.value),
      username: username.value.trim() || null,
      password: password.value || null,
    }
  }

  async function submitProxy() {
    saving.value = true
    proxyStore.error = ''

    try {
      const payload = buildPayload()

      if (isEditing.value) {
        await proxyApi.updateProxy(editingId.value, payload)
      } else {
        await proxyApi.createProxy(payload)
      }

      resetForm()
      await proxyStore.loadProxies()
    } catch (err) {
      proxyStore.error = err.message
    } finally {
      saving.value = false
    }
  }

  function editProxy(proxy) {
    editingId.value = proxy.id
    host.value = proxy.host
    port.value = proxy.port
    username.value = proxy.username || ''
    password.value = proxy.password || ''
  }

  function resetForm() {
    editingId.value = null
    host.value = ''
    port.value = DEFAULT_PORT
    username.value = ''
    password.value = ''
  }

  return {
    host,
    port,
    username,
    password,
    saving,
    isEditing,
    submitProxy,
    editProxy,
    resetForm,
  }
}
