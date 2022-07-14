<template>
    <div v-show="status" class="modal bg-dark bg-opacity-40" tabindex="-1" role="dialog">
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
import { SHOW_REGISTER_MODAL } from '/src/store/modules/auth/types/mutations.js';

export default {
    name: "RegistrationModal",

    computed: {
        ...mapGetters('auth', {
            status: 'getRegistrationModalStatus',
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
                    alert("Email resended");
                })
                .catch((error) => {console.log(error);} );
        },
        Close() {
            this.$store.commit(`auth/${SHOW_REGISTER_MODAL}`);
        }
    },

    created() {
        if (this.status) {
            this.Close();
        }
    }
};
</script>

<style>
    .modal {
        display: block;
    }
</style>
