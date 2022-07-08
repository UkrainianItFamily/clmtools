<template>
  <div id="app">
      <Navbar />
    <BContainer class="content">
      <RouterView />
    </BContainer>
  </div>
</template>

<style lang="scss">
@import 'scss/bootstrap.scss';
@import 'scss/common.scss';
</style>
<script>
import { mapGetters, mapMutations } from 'vuex';
import Navbar from '@/components/common/Navbar.vue';
import { USER_LOGOUT } from './store/modules/auth/types/mutations';
import { EventEmitter, TOKEN_EXPIRED_EVENT } from './services/EventEmitter';

export default {
    name: 'App',

    components:{
        Navbar
    },

    computed: {
        ...mapGetters('auth', [
            'isLoggedIn',
        ]),
    },

    created() {
        // EventEmitter.$on(TOKEN_EXPIRED_EVENT, () => {
        //     this.logout();
        //     this.$router.push({ name: 'auth.signIn' }).catch(() => {});
        // });
    },

    methods: {
        ...mapMutations('auth', {
            logout: USER_LOGOUT
        }),
    },
};
</script>
