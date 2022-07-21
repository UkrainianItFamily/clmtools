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
                <BNavItem :to="{ name: 'auth.signUp' }">Sign up</BNavItem>
                <BNavItem :to="{ name: 'auth.signIn' }">Sign in</BNavItem>
            </BNavbarNav>
        </BNavbar>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

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
        await this.fetchAuthenticatedUser();
    },

    methods: {
        ...mapActions('auth', [
            'fetchAuthenticatedUser',
            'signOut'
        ]),
        async onSignOut() {
            await this.signOut();

            this.$router.push({ name: 'auth.signIn' }).catch(() => {});
        },
    }
};
</script>
