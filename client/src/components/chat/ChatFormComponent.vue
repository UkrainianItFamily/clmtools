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
            <button type="button" @click="sendMessage">Отправить</button>
            <span class="notice">
                Натисніть Enter, щоб надіслати повідомлення
            </span>
        </form>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
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
        ...mapActions('chat', [
            'POST_MESSAGE',
        ]),
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

            this.POST_MESSAGE({
                lecture_id: this.$route.params.lection_id,
                body: this.body.trim()
            })
                .then(() => {})
                .catch((error) => {
                    if (error.response.data.errors) {
                        alert(Object.values(error.response.data.errors).join('\r\n'));
                    }
                } );

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
