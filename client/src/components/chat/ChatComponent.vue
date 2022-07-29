<template>
    <main role="main" class="container">
        <StudentLectionMenu />
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Чат з викладачем</div>
                <div class="card-body" v-if="chatExist">
                    <ChatMessagesComponent></ChatMessagesComponent>
                    <ChatFormComponent></ChatFormComponent>
                </div>
                <div class="card-body" v-else>
                    <button>Почати листування</button>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import ChatMessagesComponent from '@/components/chat/ChatMessagesComponent.vue';
import ChatFormComponent from '@/components/chat/ChatFormComponent.vue';
import StudentLectionMenu from '@/components/common/StudentLectionMenu.vue';
import { mapActions, mapGetters } from "vuex";

export default {
    name: 'ChatComponent',
    components:{
        ChatMessagesComponent,
        ChatFormComponent,
        StudentLectionMenu
    },
    data: () => ({
        chatExist: false,
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
                console.log(this.getChat.id);
                if(this.getChat.id){
                    this.chatExist = true;
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
