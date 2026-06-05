import { createRouter, createWebHistory } from 'vue-router'
import ProxiesPage from '../pages/ProxiesPage.vue'

const routes = [
  {
    path: '/',
    name: 'proxies',
    component: ProxiesPage,
  },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})
