import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'SportClub',
    component: () => import('@/views/ListTables')
  },
  {
    path: '/sportsmans/:filter_field?:filter_value?',
    name: 'Sportsmans',
    props: (route) => {
      return {
        filter_field: route.params.filter_field,
        filter_value: route.params.filter_value,
      }
    },
    component: () => import('@/views/SportsmansPage')
  },
  {
    path: '/typeofsport/:filter_field?:filter_value?',
    name: 'TypeOfSport',
    props: (route) => {
      return {
        filter_field: route.params.filter_field,
        filter_value: route.params.filter_value,
      }
    },
    component: () => import('@/views/TypeOfSportPage'),
  },
  {
    path: '/sportsmans-edit/:id?',
    name: 'SportsmansEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/SportsmansEdit'),
  },
  {
    path: '/typeofsport-edit/:id?',
    name: 'TypeOfSportEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/TypeOfSportEdit'),
  },
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: () => import('@/views/SportsmansPage'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
