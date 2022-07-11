import Vue from 'vue';
import VueRouter from 'vue-router';
import Storage from '@/services/Storage';

import Status from '@/views/Status';

import SignUp from '@/views/SignUp';
import SignIn from '@/views/SignIn';

Vue.use(VueRouter);

const routes = [
      {
        path: '/',
        name: 'Status',
        component: Status
      },
    {
        path: '/auth/sign-up',
        name: 'auth.signUp',
        component: SignUp,
        meta: { handleAuth: true },
    },
    {
        path: '/auth/sign-in',
        name: 'auth.signIn',
        component: SignIn,
        meta: { handleAuth: true },
    },

];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

// check auth routes
router.beforeEach(
    (to, from, next) => {
        const isAuthenticatedRoute = to.matched.some(record => record.meta.requiresAuth);
        const isAuthSectionRoute = to.matched.some(record => record.meta.handleAuth);

        if (isAuthenticatedRoute && !Storage.hasToken()) {
            next({ name: 'auth.signIn' });
            return;
        }

        if (isAuthSectionRoute && Storage.hasToken()) {
            next({ path: '/' });
            return;
        }

        next({ path: to });
    },
);

export default router;
