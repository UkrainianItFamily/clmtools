<template>
    <section class="mt-4">
            <div class="container">
                <div class="box shadow-box">
                    <h3 class="text-center mb-4">Authorization</h3>
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

                        <BFormGroup>
                            <BFormInput
                                id="input-password"
                                v-model="user.password"
                                type="password"
                                name="password"
                                placeholder="Password"
                            ></BFormInput>
                        </BFormGroup>

                        <BRow>
                            <BCol>
                                <p class="ml-4">
                                    <RouterLink class="link link-signup" :to="{name: 'auth.signUp'}">
                                        Registration
                                    </RouterLink>
                                </p>
                            </BCol>
                            <BCol>
                                <p class="mr-4 text-right">
                                    <RouterLink class="link link-signup" :to="{name: 'auth.forgotPassword'}">
                                        Forgot password?
                                    </RouterLink>
                                </p>
                            </BCol>
                        </BRow>

                        <BButton
                            block
                            @click="onSubmit"
                        >
                            Sign in
                        </BButton>

                    </form>
                </div>
            </div>
    </section>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "SignInPage",

    data: () => ({
        user: {
            email: '',
            password: ''
        }
    }),


    methods: {
        ...mapActions('auth', [
            'signIn',
        ]),

        onSubmit() {
            this.signIn(this.user)
                .then(() => {
                    alert("Login");

                    this.$router.push({ path: '/' }).catch(() => {});
                })
                .catch((error) => {console.log(error);} );
        },
    },

};
</script>
