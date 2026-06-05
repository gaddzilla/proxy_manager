import { apiClient } from './client'

export function fetchProxies(search = '') {
  return apiClient.get('/proxies', {
    params: search ? { search } : undefined,
  })
}

export function createProxy(payload) {
  return apiClient.post('/proxies', payload)
}

export function updateProxy(id, payload) {
  return apiClient.put(`/proxies/${id}`, payload)
}

export function deleteProxy(id) {
  return apiClient.delete(`/proxies/${id}`)
}

export function checkProxy(id) {
  return apiClient.post(`/proxies/${id}/check`)
}
