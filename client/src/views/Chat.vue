<template>
    <ChatComponent></ChatComponent>
</template>

<script>
import { mapGetters } from 'vuex';
import ChatComponent from '@/components/chat/ChatComponent.vue';

export default {
    name: 'ChatPage',
    components:{
        ChatComponent
    },
    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser',
            fullName: 'getFullName',
            isLoggedIn: 'isLoggedIn'
        }),
    },
};
</script>
