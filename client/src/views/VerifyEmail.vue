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
                'verifyEmail',
                'reSendEmail',
            ]),
            reSend() {
                this.reSendEmail({ id: this.registered_user_id })
                    .then(() => {
                        alert("Лист з верифікацією надіслан повторно");
                    })
                    .catch((error) => {console.log(error);} );
            },
        },
        mounted() {
            this.url = decodeURIComponent(document.location.href).split(process.env.VUE_APP_API_URL)[1];
            this.registered_user_id = this.url.split('?')[0].split('verify/')[1];
            this.verifyEmail({ url: this.url })
                .then(() => {
                    this.message = "Дякуємо за підтвердження електронної адреси.";
                })
                .catch((error) => {
                    console.log(error);
                    if (error.toString().indexOf('Expired') > -1) {
                        this.expired = true;
                        this.message = "Термін дії URL-адреси підтвердження закінчився.";
                    } else {
                        this.expired = false;
                        this.message = "Ваша електронна адреса вже була підтверджена.";
                    }
                } );
        },
    };
</script>

<style>
    .modal {
        display: block;
    }
</style>
