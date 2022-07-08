<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-mobile is-centered">
                    <div class="column is-three-quarters-mobile is-two-thirds-tablet is-one-third-desktop">
                        <div class="box shadow-box">
                            <p class="subtitle">
                                Already have an account?
                                <router-link class="link link-signup" to="/auth/sign-in">
                                    Sign in
                                </router-link>
                            </p>

                            <form
                                class="form"
                                @submit.prevent
                                novalidate="true"
                            >
                                <b-form-group
                                    label="First Name"
                                    label-for="input-name"
                                >
                                    <b-form-input
                                        id="input-name"
                                        v-model="user.name"
                                        name="first_name"
                                        autofocus
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group
                                    label="Last Name"
                                    label-for="input-lastName"
                                >
                                    <b-form-input
                                        id="input-lastName"
                                        v-model="user.lastName"
                                        name="last_name"
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group
                                    label="Email"
                                    label-for="input-email"
                                >
                                    <b-form-input
                                        id="input-email"
                                        v-model="user.email"
                                        name="email"
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group
                                    label="Phone"
                                    label-for="input-phone"
                                >
                                    <b-form-input
                                        id="input-phone"
                                        v-model="user.phone"
                                        name="phone"
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group
                                    label="Password"
                                    label-for="input-password"
                                >
                                    <b-form-input
                                        id="input-password"
                                        v-model="user.password"
                                        type="password"
                                        name="password"
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group
                                    label="Password"
                                    label-for="input-passwordConfirmation"
                                >
                                    <b-form-input
                                        id="input-passwordConfirmation"
                                        v-model="user.passwordConfirmation"
                                        type="password"
                                        name="password_confirmation"
                                    ></b-form-input>
                                </b-form-group>

                                <div class="login-footer has-text-centered">
                                    <button
                                        type="button"
                                        class="button is-primary is-rounded"
                                        @click="onSubmit"
                                    >
                                        Sign up
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
    name: 'SignUpPage',

    data: () => ({
        user: {
            name: '',
            lastName: '',
            email: '',
            phone: '',
            password: '',
            passwordConfirmation: ''
        }
    }),

    methods: {
        ...mapActions('auth', [
            'signUp',
        ]),

        onSubmit() {
            this.signUp(this.user)
                .then(() => {
                    alert("Register");

                    this.$router.push({ path: '/' }).catch(() => {});
                })
                .catch((error) => {console.log(error);} );
        },
    },
};

</script>

<style scoped>
</style>
