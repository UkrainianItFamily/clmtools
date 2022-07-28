<template>
    <div>
        <form class="form">
            <textarea
                id="body"
                cols="25"
                rows="5"
                class="form-input"
                @keydown="typing"
                v-model="body"
            >
            </textarea>
            <span class="notice">
                Натисніть Enter, щоб надіслати повідомлення
            </span>
        </form>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Event from '../../store/modules/chat/event.js';

export default {
    name: 'ChatFormComponent',
    data() {
        return {
            body: null
        };
    },
    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
    },
    methods: {
        typing(e) {
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        },
        sendMessage() {
            if(!this.body || this.body.trim() === '') {
                return;
            }
            let messageObj = this.buildMessage();
            Event.$emit('added_message', messageObj);
            this.body = null;
        },
        buildMessage() {
            return {
                id: Date.now(),
                body: this.body,
                self_message: true,
                user: this.user
            };
        }
    }
};
</script>
