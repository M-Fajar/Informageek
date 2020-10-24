import Vue from 'vue';
import VueRouter from 'vue-router';

import Welcome from './pages/Welcome';
import Login from './pages/Login';
import Register from './pages/Register';
import Forgot from './pages/Forgot';
import Beranda from './pages/Beranda';
import Profile from './pages/Profile';
import Post from './pages/Post';
import Search from './pages/Search';
import Message from './pages/Message';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  'routes': [
    {
      name: 'welcome',
      path: '/',
      component: Welcome,
      meta: { layout: 'default' }
    },
    {
      name: 'login',
      path: '/login',
      component: Login,
      meta: { layout: 'default' }
    },
    {
      name: 'register',
      path: '/register',
      component: Register,
      meta: { layout: 'default' }
    },
    {
      name: 'forgot',
      path: '/forgot',
      component: Forgot,
      meta: { layout: 'default' }
    },
    {
      name: 'beranda',
      path: '/beranda',
      component: Beranda,
      meta: { layout: "home" }
    },
    {
      name: 'post',
      path: '/post',
      component: Post,
      meta: { layout: "home" }
    },
    {
      name: 'search',
      path: '/search',
      component: Search,
      meta: { layout: "home" }
    },
    {
      name: 'profile',
      path: '/profile',
      component: Profile,
      meta: { layout: "home" }
    },
    {
      name: 'message',
      path: '/message',
      component: Message,
      meta: { layout: "messaging" }
    }
  ]
});

export default router;