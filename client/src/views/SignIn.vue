<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-mobile is-centered">
                    <div class="column is-three-quarters-mobile is-two-thirds-tablet is-one-third-desktop">
                        <div class="box shadow-box">
                            <p class="subtitle">
                                Don't have an account?
                                <RouterLink class="link link-signup" to="/auth/sign-up">
                                    Sign up
                                </RouterLink>
                            </p>

                            <form
                                class="form"
                                @submit.prevent
                                novalidate="true"
                            >
                                <BFormGroup
                                    label="Email"
                                    label-for="input-email"
                                >
                                    <BFormInput
                                        id="input-email"
                                        v-model="user.email"
                                        name="email"
                                    ></BFormInput>
                                </BFormGroup>

                                <BFormGroup
                                    label="Password"
                                    label-for="input-password"
                                >
                                    <BFormInput
                                        id="input-password"
                                        v-model="user.password"
                                        type="password"
                                        name="password"
                                    ></BFormInput>
                                </BFormGroup>

                                <div class="login-footer has-text-centered">
                                    <button
                                        type="button"
                                        class="button is-primary is-rounded"
                                        @click="onSubmit"
                                    >
                                        Sign in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

