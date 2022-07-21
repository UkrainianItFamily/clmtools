<template>
    <h1 class="mt-5 font-weight-bold text-primary">Ви успішно авторизувалися в системі!</h1>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'IndexPage',
    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser',
            fullName: 'getFullName',
            isLoggedIn: 'isLoggedIn'
        }),
    },
};
</script>
