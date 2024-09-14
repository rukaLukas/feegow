import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import EmpregadosView from '../views/EmpregadosView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        breadcrumb: [
          { title: 'Página inicial' }
        ]
      }
    },
    {
      path: '/empregados',
      name: 'empregados',
      component: EmpregadosView,
      meta: {
        breadcrumb: [
          { title: 'Empregados' }
        ]
      }
    }
  ]
})

export default router
