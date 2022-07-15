<template>
    <div v-show="show_modal" class="modal bg-dark bg-opacity-40" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Підтвердіть електронну пошту</h5>
                    <button type="button" class="close" data-dismiss="modal" @click="Close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Будь ласка, підтвердіть свою адресу електронної пошти. Для цього перейдіть за посиланням з листа, що вам було надіслано на пошту.</p>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        @click="reSend"
                    >Надіслати лист ще раз</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: "RegistrationModal",

    data: () => ({
        show_modal: false,
    }),

    computed: {
        ...mapGetters('auth', {
            registered_user_id: 'getRegistrationUserId'
        }),
    },

    methods: {
        ...mapActions('auth', [
            'reSendEmail',
        ]),

        reSend() {
            this.reSendEmail({ id: this.registered_user_id })
                .then(() => {
                    alert("Лист з верифікацією надіслан повторно");
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        alert(Object.values(error.response.data.errors).join('\r\n'));
                    }
                } );
        },
        showModal() {
            this.show_modal = true;
        },
        Close() {
            this.show_modal = false;
        }
    },
};
</script>

<style>
    .modal {
        display: block;
    }
</style>
