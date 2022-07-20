<template>
    <div>
        <BNavbar type="dark" variant="dark">
            <BNavbarBrand :to="{ path: '/' }">CMLTool</BNavbarBrand>

            <BNavbarNav class="ml-auto" align="right" v-if="isLoggedIn">
                <BNavItemDropdown
                    id="my-nav-dropdown"
                    toggle-class="nav-link-custom"
                    text="User"
                >
                    <BDropdownItem>Profile</BDropdownItem>
                    <BDropdownItem :to="{ name: 'auth.logout'}">Exit</BDropdownItem>
                </BNavItemDropdown>
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

};
</script>
