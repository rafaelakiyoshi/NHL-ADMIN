import Vue from 'vue'
import Router from 'vue-router'

// Containers
import DefaultContainer from '@/containers/DefaultContainer'

// Views
import Dashboard from '@/views/Dashboard'

import Teams from '@/views/Teams'
import Games from '@/views/Games'
import TeamDetail from '@/views/TeamDetail'
import GameDetail from '@/views/GameDetail'

// Views - Pages
import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'
import Login from '@/views/pages/Login'
import Register from '@/views/pages/Register'

Vue.use(Router)

export default new Router({
  mode: 'hash', // Demo is living in GitHub.io, so required!
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: DefaultContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'teams',
          name: 'Teams',
          component: Teams
        },
        {
          path: 'games',
          name: 'Games',
          component: Games,
          props: true
        },
        {
          path: 'teamdetail',
          name: 'Teamdetail',
          component: TeamDetail,
          props: true
        },
        {
          path: 'gamedetail',
          name: 'Gamedetail',
          component: GameDetail,
          props: true
        }
      ]},
    {
      path: '/pages',
      redirect: '/pages/404',
      name: 'Pages',
      component: {
        render (c) { return c('router-view') }
      },
      children: [
        {
          path: '404',
          name: 'Page404',
          component: Page404
        },
        {
          path: '500',
          name: 'Page500',
          component: Page500
        },
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        }
      ]
    }
  ]
})
