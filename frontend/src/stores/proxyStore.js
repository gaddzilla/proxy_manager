import { defineStore } from 'pinia'
import * as proxyApi from '../api/proxies'

export const useProxyStore = defineStore('proxy', {
  state: () => ({
    proxies: [],
    loading: false,
    checkingId: null,
    error: '',
    search: '',
  }),

  actions: {
    async loadProxies() {
      this.loading = true
      this.error = ''

      try {
        this.proxies = await proxyApi.fetchProxies(this.search)
      } catch (err) {
        this.error = err.message
      } finally {
        this.loading = false
      }
    },

    async removeProxy(proxy) {
      if (!confirm(`Удалить прокси ${proxy.host}:${proxy.port}?`)) {
        return
      }

      try {
        await proxyApi.deleteProxy(proxy.id)
        await this.loadProxies()
      } catch (err) {
        this.error = err.message
      }
    },

    async checkProxyStatus(proxy) {
      this.checkingId = proxy.id
      this.error = ''

      try {
        const updated = await proxyApi.checkProxy(proxy.id)
        this.proxies = this.proxies.map((item) => (item.id === updated.id ? updated : item))
      } catch (err) {
        this.error = err.message
      } finally {
        this.checkingId = null
      }
    },

    updateSearch(value) {
      this.search = value
      this.loadProxies()
    },
  },
})
