import axios from 'axios'

export const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
})

apiClient.interceptors.response.use(
  (response) => (response.status === 204 ? null : response.data),
  (error) => {
    const data = error.response?.data
    const message = data?.message || Object.values(data?.errors || {}).flat().join(' ')

    return Promise.reject(new Error(message || error.message || 'Request failed'))
  },
)
