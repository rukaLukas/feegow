import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import EmpregadosView from '../views/EmpregadosView.vue'
import EmpregadoCreateView from '../views/EmpregadoCreateView.vue'

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
      },
      // children: [
      //   {
      //     path: 'create', label: 'Cadastrar', name: 'empregados-create', component: EmpregadoCreateView,
      //     meta: {
      //       breadcrumb: [
      //         { text: 'Empregados', href: '/empregados' },
      //         { title: 'Cadastrar Empregado' }
      //       ]
      //     }
      //   },
      // ]     
    },
    {
      path: '/empregados/create',
      name: 'empregados-create',
      component: EmpregadoCreateView,
      meta: {
        breadcrumb: [
          { text: 'Empregados', href: '/empregados' },
          { title: 'Cadastrar Empregado' }
        ]
      },      
    }
  ]
})

export default router
