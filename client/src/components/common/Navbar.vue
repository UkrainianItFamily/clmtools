<template>
    <nav
        v-if="user.id"
        class="navbar"
        role="navigation"
        aria-label="main navigation"
    >

        <div id="header-navbar" class="navbar-menu">

            <div class="navbar-end">
                <b-dropdown
                    position="is-bottom-left"
                    aria-role="menu"
                    class="profile"
                >
                    <a class="navbar-link" slot="trigger" role="button">
                        <figure class="image is-32x32 is-square">
                            <img
                                v-if="user.avatar"
                                class="profile-image is-rounded"
                                :src="user.avatar"
                            >
                            <DefaultAvatar v-else class="image is-32x32" :user="user" />
                        </figure>
                        <span class="profile-name">{{ this.fullName }}</span>
                    </a>

                    <b-dropdown-item has-link aria-role="menuitem">
                        <router-link :to="{ name: 'profile' }" class="page-link">
                            <b-icon pack="fa" icon="cog" />
                            <span>Settings</span>
                        </router-link>
                    </b-dropdown-item>

                </b-dropdown>
            </div>
        </div>
    </nav>
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
