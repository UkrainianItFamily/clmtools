<template>
    <div class="modal bg-dark bg-opacity-40" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Підтвердження електронної пошти</h5>
                </div>
                <div class="modal-body">
                    <p v-text="message"></p>
                </div>
                <div class="modal-footer">
                    <button
                        v-show="expired"
                        type="button"
                        class="btn btn-secondary"
                        @click="reSend"
                    >Надіслати лист ще раз</button>
                    <RouterLink class="link link-signup" to="/auth/sign-in">
                        <button
                            type="button"
                            class="btn btn-secondary"
                        >
                        Перейти до авторизації</button>
                    </RouterLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    import {RESEND_VERIFY_EMAIL, VERIFY_EMAIL} from '../store/modules/auth/types/actions';

    export default {
        name: "VerifyEmail",

        data: () => ({
            message: 'Перевіряємо...',
            expired: false,
            url: null,
            registered_user_id: null
        }),

        methods: {
            ...mapActions('auth', [
                'VERIFY_EMAIL',
                'RESEND_VERIFY_EMAIL',
            ]),
            reSend() {
                this.RESEND_VERIFY_EMAIL({ id: this.registered_user_id })
                    .then(() => {
                        alert("Лист з верифікацією надіслан повторно");
                    })
                    .catch((error) => {
                        if (error.response.data.errors) {
                            alert(Object.values(error.response.data.errors).join('\r\n'));
                        }
                    } );
            },
        },
        mounted() {
            this.registered_user_id = this.$router.history.current.params.user_id;
            let params = new URLSearchParams(this.$router.history.current.query);
            this.url = this.registered_user_id + '?' + params.toString();

            this.VERIFY_EMAIL({ url: this.url })
                .then(() => {
                    this.message = "Дякуємо за підтвердження електронної адреси.";
                })
                .catch((error) => {
                    console.log(error);
                    this.expired = error.response.data.error.code === 401;
                    this.message = error.response.data.error.message;
                } );
        },
    };
</script>

<style>
    .modal {
        display: block;
    }
</style>
