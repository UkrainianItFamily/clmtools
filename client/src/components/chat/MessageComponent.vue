<template>
    <div class="message" v-bind:class="{ self: message.self_message }">
        <strong class="user">{{ message.user.name }}</strong>
        <p class="body">{{ message.body }}</p>
    </div>
</template>

<script>
export default {
    name: 'MessageComponent',
    props: {
        message: {
            default: 'NULL'
        }
    }
};
</script>
