<template>
    <div>
        <BNav pills v-if="user.id">
            <BNavItemDropdown
                id="my-nav-dropdown"
                toggle-class="nav-link-custom"
                right
            >
                <BDropdownItem>Profile</BDropdownItem>
                <BDropdownItem>Exit</BDropdownItem>
            </BNavItemDropdown>
        </BNav>
        <BNav pills>
            <BNavItem active>
                <RouterLink :to="{ name: 'auth.signUp' }" class="page-link">
                    <span>Sign up</span>
                </RouterLink>
            </BNavItem>
            <BNavItem>
                <RouterLink :to="{ name: 'auth.signIn' }" class="page-link">
                    <span>Sign in</span>
                </RouterLink>
            </BNavItem>
        </BNav>
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

};
</script>
