import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import EmpregadosView from '../views/Empregados/EmpregadosView.vue'
import EmpregadoCreateView from '../views/Empregados/EmpregadoCreateView.vue'

import VacinasView from '../views/Vacinas/VacinasView.vue'
import VacinaCreateView from '../views/Vacinas/New.vue'
import VacinaEditView from '../views/Vacinas/Edit.vue'

import VacinacaoView from '../views/Vacinacao/VacinacaoView.vue'
import VacinacaoCreateView from '../views/Vacinacao/VacinacaoCreateView.vue'

import RelatorioView from '../views/RelatorioView.vue'

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
    },

    // Vacinas
    {
      path: '/vacinas',
      name: 'vacinas',
      component: VacinasView,
      meta: {
        breadcrumb: [
          { title: 'Vacinas' }
        ]
      },
    },
    {
      path: '/vacinas/create',
      name: 'vacinas-create',
      component: VacinaCreateView,
      meta: {
        breadcrumb: [
          { text: 'Vacinas', href: '/vacinas' },
          { title: 'Cadastrar Vacina' }
        ]
      },      
    },
    {
      path: '/vacinas/edit/:id', 
      name: 'vacinas-edit', 
      component: VacinaEditView,
      meta: {
        breadcrumb: [
          { text: 'Vacinas', href: '/vacinas' },
          { title: 'Editar Vacina' }
        ]
      },
    },

     // Vacinacao
     {
      path: '/vacinacao',
      name: 'vacinacao',
      component: VacinacaoView,
      meta: {
        breadcrumb: [
          { title: 'Vacinação' }
        ]
      },
    },
    {
      path: '/vacinacao/create',
      name: 'vacinacao-create',
      component: VacinacaoCreateView,
      meta: {
        breadcrumb: [
          { text: 'Vacinação', href: '/vacinacao' },
          { title: 'Cadastrar Vacinação' }
        ]
      },      
    },

    // Report
    {
      path: '/relatorios',
      name: 'relatorios',
      component: RelatorioView,
      meta: {
        breadcrumb: [
          { title: 'Relatórios' }
        ]
      },
    },
  ]
})

export default router
