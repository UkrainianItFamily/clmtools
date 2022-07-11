<template>
    <div>
        <b-nav pills v-if="user.id">
            <b-nav-item-dropdown
                id="my-nav-dropdown"
                text="{{ this.fullName }}"
                toggle-class="nav-link-custom"
                right
            >
                <b-dropdown-item>Profile</b-dropdown-item>
                <b-dropdown-item>Exit</b-dropdown-item>
            </b-nav-item-dropdown>
        </b-nav>
        <b-nav pills>
            <b-nav-item active>
                <router-link :to="{ name: 'auth.signUp' }" class="page-link">
                    <span>Sign up</span>
                </router-link>
            </b-nav-item>
        </b-nav>
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
        }),
    },

}
</script>
