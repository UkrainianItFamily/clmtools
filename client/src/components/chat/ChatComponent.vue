<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Чат з викладачем</div>
            <div class="card-body">
                <ChatMessagesComponent></ChatMessagesComponent>
                <ChatFormComponent></ChatFormComponent>
            </div>
        </div>
    </div>
</template>

<script>
import ChatMessagesComponent from '@/components/chat/ChatMessagesComponent.vue';
import ChatFormComponent from '@/components/chat/ChatFormComponent.vue';

export default {
    name: 'ChatComponent',
    components:{
        ChatMessagesComponent,
        ChatFormComponent
    },
};
</script>
