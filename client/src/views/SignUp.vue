<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-mobile is-centered">
                    <div class="column is-three-quarters-mobile is-two-thirds-tablet is-one-third-desktop">
                        <div class="box shadow-box">
                            <p class="subtitle">
                                Already have an account?
                                <RouterLink class="link link-signup" to="/auth/sign-in">
                                    Sign in
                                </RouterLink>
                            </p>

                            <form
                                class="form"
                                @submit.prevent
                                novalidate="true"
                            >
                                <BFormGroup
                                    label="First Name"
                                    label-for="input-name"
                                >
                                    <BFormInput
                                        id="input-name"
                                        v-model="user.name"
                                        name="first_name"
                                        autofocus
                                    ></BFormInput>
                                </BFormGroup>

                                <BFormGroup
                                    label="Last Name"
                                    label-for="input-lastName"
                                >
                                    <BFormInput
                                        id="input-lastName"
                                        v-model="user.lastName"
                                        name="last_name"
                                    ></BFormInput>
                                </BFormGroup>

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
                                    label="Phone"
                                    label-for="input-phone"
                                >
                                    <BFormInput
                                        id="input-phone"
                                        v-model="user.phone"
                                        name="phone"
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

                                <BFormGroup
                                    label="Password"
                                    label-for="input-passwordConfirmation"
                                >
                                    <BFormInput
                                        id="input-passwordConfirmation"
                                        v-model="user.passwordConfirmation"
                                        type="password"
                                        name="password_confirmation"
                                    ></BFormInput>
                                </BFormGroup>

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
