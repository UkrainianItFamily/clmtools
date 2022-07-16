<template>
    <section class="mt-4">
        <div class="d-flex justify-content-center">
            <div class="box shadow-box w-50">
                <h3 class="text-center mb-4">Recover password</h3>
                <form
                    class="form"
                    @submit.prevent
                    novalidate="true"
                >
                    <BFormGroup>
                        <BFormInput
                            id="input-password"
                            v-model="user.password"
                            name="password"
                            type="password"
                            placeholder="New password"
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-passwordConfirmation"
                            v-model="user.passwordConfirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Confirm password"
                        ></BFormInput>
                    </BFormGroup>

                    <BButton
                        block
                        @click="onSubmit"
                    >
                        Change password
                    </BButton>

                </form>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "ResetPasswordPage",

    data: () => ({
        user: {
            password: '',
            password_confirmation: ''
        },
    }),

    methods:{
        ...mapActions('auth',[
            'resetPassword'
        ]),

        onSubmit(){
            this.resetPassword(this.user)
                .then(() => {
                    alert("Password success changed!");

                    this.$router.push({ name: 'auth.signIn' }).catch(() => {});
                })
                .catch((error) => {console.log(error);} );
        }
    }
};
</script>
