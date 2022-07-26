<template>
    <div class="message-area">
        <MessageComponent></MessageComponent>
    </div>
</template>

<script>
import MessageComponent from '@/components/chat/MessageComponent.vue';

export default {
    name: 'ChatMessagesComponent',
    components:{
        MessageComponent
    },
};
</script>
