import Vue from 'vue';
import VueRouter from 'vue-router';

import Welcome from './pages/Welcome';
import Login from './pages/Login';
import Register from './pages/Register';
import Forgot from './pages/Forgot';
import Beranda from './pages/Beranda';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  'routes': [
    {
      name: 'welcome',
      path: '/',
      component: Welcome,
      meta: {layout: 'default'}
    },
    {
      name: 'login',
      path: '/login',
      component: Login,
      meta: {layout: 'default'}
    },
    {
      name: 'register',
      path: '/register',
      component: Register,
      meta: {layout: 'default'}
    },
    {
      name: 'forgot',
      path: '/forgot',
      component: Forgot,
      meta: {layout: 'default'}
    },
    {
      name: 'beranda',
      path: '/beranda',
      component: Beranda,
      meta: {layout: "home"}
    }
  ]
});

export default router;