<template>
    <div>
        <BNavbar type="dark" variant="dark">
            <BNavbarBrand :to="{ path: '/' }">CMLTool</BNavbarBrand>

            <BNavbarNav class="ml-auto" align="right" v-if="isLoggedIn">
                <BNavItem :to="{ name: 'profile'}"><img src="/img/person.png" alt=""></BNavItem>
                <BNavItem><img src="/img/bell_icon.png"></BNavItem>
                <BNavItem @click="onSignOut"><img src="/img/door_closed.png"></BNavItem>
            </BNavbarNav>

            <BNavbarNav class="ml-auto" align="right" v-else>
                <BNavItem :to="{ name: 'auth.signUp' }">Реєстрація</BNavItem>
                <BNavItem :to="{ name: 'auth.signIn' }">Вхід</BNavItem>
            </BNavbarNav>
        </BNavbar>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import {GET_AUTHENTICATED_USER, USER_LOGOUT} from '../../store/modules/auth/types/actions';

export default {
    name: "Navbar",
    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser',
            fullName: 'getFullName',
            isLoggedIn: 'isLoggedIn'
        }),
    },

    async created() {
        if(this.isLoggedIn) {
            await this.GET_AUTHENTICATED_USER();
        }
    },

    methods: {
        ...mapActions('auth', [
            'GET_AUTHENTICATED_USER',
            'USER_LOGOUT'
        ]),
        async onSignOut() {
            await this.USER_LOGOUT();

            this.$router.push({ name: 'auth.signIn' }).catch(() => {});
        },
    }
};
</script>
