<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-mobile is-centered">
                    <div class="column is-three-quarters-mobile is-two-thirds-tablet is-one-third-desktop">
                        <div class="box shadow-box">
                            <p class="subtitle">
                                Don't have an account?
                                <router-link class="link link-signup" to="/auth/sign-up">
                                    Sign up
                                </router-link>
                            </p>

                            <form
                                class="form"
                                @submit.prevent
                                novalidate="true"
                            >
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

};
</script>

