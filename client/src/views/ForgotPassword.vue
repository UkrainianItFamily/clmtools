<template>
    <section class="mt-4">
        <div class="d-flex justify-content-center">
            <div class="box shadow-box w-50">
                <h3 class="text-center mb-4">Забули пароль?</h3>
                <p class="text-center h5 mb-4">Вам на пошту буде відправлене повідомлення з посиланням для зміни паролю</p>
                <BAlert show variant="success" v-if="validated">Ми надіслали ваше посилання для зміни пароля електронною поштою!</BAlert>
                <form
                    class="form needs-validation"
                    @submit="onSubmit"
                    :class="{ 'was-validated': validated}"
                    novalidate="true"
                >
                    <BFormGroup>
                        <BFormInput
                            id="input-email"
                            v-model="user.email"
                            name="email"
                            placeholder="E-mail"
                            required
                        ></BFormInput>
                    </BFormGroup>
                    <BAlert show variant="danger" v-if="errors.email">{{ Object.values(errors.email).join('\r\n') }}</BAlert>

                    <p class="text-right">
                        <RouterLink class="link link-signup" :to="{name: 'auth.signIn'}">
                            Повернутись до авторизації
                        </RouterLink>
                    </p>

                    <BButton
                        block
                        type="submit"
                    >
                        Надіслати лист
                    </BButton>

                </form>
            </div>
        </div>
    </section>
</template>

<script>
import {mapActions} from 'vuex';
import {FORGOT_PASSWORD} from '../store/modules/auth/types/actions';
export default {
    name: "ForgotPasswordPage",

    data: () => ({
        user: {
            email: ''
        },
        validated: false,
        errors: {}
    }),

    methods: {
        ...mapActions('auth', [
            'FORGOT_PASSWORD'
        ]),

        onSubmit(e) {
            e.preventDefault();
            this.FORGOT_PASSWORD(this.user)
                .then(() => {
                    this.validated = true;
                    this.errors = {};
                })
                .catch((error) => {
                    this.validated = false;
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>
