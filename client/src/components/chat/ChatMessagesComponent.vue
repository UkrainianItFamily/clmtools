<template>
    <div class="message-area" v-if="messagesExist">
        <MessageComponent
            v-for="message in getChat"
            :key="message.id"
            :message="message"
        ></MessageComponent>

    </div>
    <p v-else>Повідомлень немає.</p>
</template>

<script>
import MessageComponent from '@/components/chat/MessageComponent.vue';
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'ChatMessagesComponent',
    components:{
        MessageComponent
    },
    data: () => ({
        messagesExist: false,
    }),
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
            .then(() => {
                if(this.getChat.length){
                    this.messagesExist = true;
                }
            })
            .catch((error) => {
                if (error.response.data.errors) {
                    alert(Object.values(error.response.data.errors).join('\r\n'));
                }
            } );

    },

};
</script>
