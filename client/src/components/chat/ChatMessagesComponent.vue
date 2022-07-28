<template>
    <div class="message-area">
        <MessageComponent
            v-for="message in getChat"
            :key="message.id"
            :message="message"
        ></MessageComponent>
    </div>
</template>

<script>
import MessageComponent from '@/components/chat/MessageComponent.vue';
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'ChatMessagesComponent',
    components:{
        MessageComponent
    },
    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
        ...mapGetters('chat', [
           'getChat',
        ]),
    },
    methods: {
        ...mapActions('chat', [
            'GET_CHAT',
        ]),
    },
    mounted() {
        this.GET_CHAT({
            user_id: this.user.id,
            lecture_id: this.$route.params.lection_id
        })
            .then(() => {})
            .catch((error) => {
                if (error.response.data.errors) {
                    alert(Object.values(error.response.data.errors).join('\r\n'));
                }
            } );
    },

};
</script>
