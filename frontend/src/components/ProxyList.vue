<template>
  <section class="card list">
    <div class="toolbar">
      <h2>Список прокси</h2>
      <input
        :value="search"
        class="search"
        placeholder="Поиск по хосту или логину"
        @input="updateSearch($event.target.value)"
      />
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Прокси</th>
            <th>Статус</th>
            <th>Последняя проверка</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!loading && proxies.length === 0">
            <td colspan="4" class="empty">Прокси пока не добавлены</td>
          </tr>
          <ProxyTableRow
            v-for="proxy in proxies"
            :key="proxy.id"
            :proxy="proxy"
            :checking="checkingId === proxy.id"
            @check="checkProxyStatus"
            @edit="editProxy"
            @delete="removeProxy"
          />
        </tbody>
      </table>
    </div>
  </section>
</template>

<script setup>
import { storeToRefs } from 'pinia'
import { inject } from 'vue'
import { useProxyStore } from '../stores/proxyStore'
import ProxyTableRow from './ProxyTableRow.vue'

const proxyStore = useProxyStore()
const { editProxy } = inject('proxyForm')

const {
  proxies,
  loading,
  checkingId,
  search
} = storeToRefs(proxyStore)

const {
  removeProxy,
  checkProxyStatus,
  updateSearch
} = proxyStore
</script>
