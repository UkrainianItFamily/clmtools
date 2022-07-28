<template>
    <div class="container-md">
        <EditProfileForm v-if="this.hasAuthenticatedUser" />
    </div>
</template>

<script>
import { mapGetters }  from "vuex";
import EditProfileForm from "@/components/profile/EditProfileForm";

export default {
    name: "ProfilePage",

    components:{
        EditProfileForm,
    },

    created() {
    },

    computed: {
        ...mapGetters('auth', ['hasAuthenticatedUser']),
    },

};
</script>
