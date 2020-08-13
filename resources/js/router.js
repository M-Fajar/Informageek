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
      component: Welcome
    },
    {
      name: 'login',
      path: '/login',
      component: Login
    },
    {
      name: 'register',
      path: '/register',
      component: Register
    },
    {
      name: 'forgot',
      path: '/forgot',
      component: Forgot
    },
    {
      name: 'beranda',
      path: '/beranda',
      meta: {layout: "home"},
      component: Beranda
    }
  ]
});

export default router;