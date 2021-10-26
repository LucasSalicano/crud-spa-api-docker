import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Novo from './pages/Novo.vue';
import Editar from './pages/Editar.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/novo',
            name: 'novo',
            component: Novo
        },
        {
            path: '/editar',
            name: 'editar',
            component: Editar
        }
    ]
});

export default router;
