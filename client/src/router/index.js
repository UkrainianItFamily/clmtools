import Vue from 'vue';
import VueRouter from 'vue-router';
import Storage from '@/services/Storage';

import Index from '@/views/Index';
import Tasks from '@/views/Tasks';
import MoreInfo from '@/views/MoreInfo';

import Status from '@/views/Status';

import SignUp from '@/views/SignUp';
import SignIn from '@/views/SignIn';
import ForgotPassword from "@/views/ForgotPassword";
import VerifyEmail from '@/views/VerifyEmail';
import ResetPassword from "@/views/ResetPassword";
import Profile from "@/views/Profile";
import Lections from '@/views/Lections/Lections';
import DetailLection from '@/views/Lections/DetailLection';


Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index,
        meta: { requiresAuth: true },
    },
    {
        path: '/tasks',
        name: 'Tasks',
        component: Tasks,
        meta: { requiresAuth: true },
    },
    {
        path: '/more-info',
        name: 'MoreInfo',
        component: MoreInfo,
        meta: { requiresAuth: true },
    },
    {
        path: '/status',
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
    {
        path: '/auth/forgot-password',
        name: 'auth.forgotPassword',
        component: ForgotPassword,
        meta: { handleAuth: true },
    },
    {
        path: '/verify-email/:user_id',
        name: 'verify.email',
        component: VerifyEmail,
        meta: { handleAuth: true },
    },
    {
        path: '/auth/reset-password/:token/:email',
        name: 'auth.resetPassword',
        component: ResetPassword,
        meta: { handleAuth: true },
    },
    {
        path: '/personal/profile',
        name: 'profile',
        component: Profile,
        meta: { requiresAuth: true },
    },
    {
        path: '/lections',
        name: 'lections',
        component: Lections,
    },
    {
        path: '/lections/:lection_id',
        name: 'detail.lection',
        component: DetailLection,
    },
    {
        path: '/add-lection',
        name: 'add.lection',
        component: Lections,
    },
    {
        path: '/edit-lection/:lection_id',
        name: 'edit.lection',
        component: DetailLection,
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
