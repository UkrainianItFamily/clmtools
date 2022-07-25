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
    mounted() {
        console.log('Component mounted.');
    }
};
</script>

<style>
.message-area {
    height: 400px;
    max-height: 400px;
    overflow-y: scroll;
    padding: 15px;
    border-bottom: 1px solid #eee;
}
</style>
