<template>
    <section class="mt-4">
        <div class="container-sm">
            <div class="box shadow-box">
                <h3 class="text-center mb-4">Forgot password?</h3>
                <h4 class="text-center text-info mb-4">We will e-mailed your password reset link!</h4>
                <form
                    class="form"
                    @submit.prevent
                    novalidate="true"
                >
                    <BFormGroup>
                        <BFormInput
                            id="input-email"
                            v-model="user.password"
                            name="password"
                            type="password"
                            placeholder="New password"
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-email"
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
