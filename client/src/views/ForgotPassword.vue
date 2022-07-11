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
                            v-model="user.email"
                            name="email"
                            placeholder="Email"
                        ></BFormInput>
                    </BFormGroup>

                    <p class="text-right">
                        <RouterLink class="link link-signup" :to="{name: 'auth.signIn'}">
                            back to authorization
                        </RouterLink>
                    </p>

                    <BButton
                        block
                        @click="onSubmit"
                    >
                        Send
                    </BButton>

                </form>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "ForgotPasswordPage",

    data: () => ({
        user: {
            email: ''
        }
    }),

    methods:{
        ...mapActions('auth',[
            'forgotPassword'
        ]),

        onSubmit(){
            this.forgotPassword(this.user)
                .then(() => {
                    alert("Successful send!");
                })
                .catch((error) => {console.log(error);} );
        }
    }
};
</script>
