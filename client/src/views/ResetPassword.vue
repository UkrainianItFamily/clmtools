<template>
    <section class="mt-4">
        <div class="d-flex justify-content-center">
            <div class="box shadow-box w-50">
                <h3 class="text-center mb-4">Відновлення пароля</h3>

                <form
                    class="form needs-validation"
                    :class="{ 'was-validated': validated}"
                    @submit.prevent="onSubmit"
                    novalidate="true"
                >
                    <BAlert show variant="success" v-if="validated">Пароль успішно змінено!</BAlert>
                    <BAlert show variant="danger" v-if="errors.message">{{ errors.message }}</BAlert>

                    <BFormGroup>
                        <BFormInput
                            id="input-password"
                            v-model="user.password"
                            name="password"
                            type="password"
                            placeholder="Новий пароль"
                            required
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-passwordConfirmation"
                            v-model="user.passwordConfirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Підтвердіть пароль"
                            required
                        ></BFormInput>
                    </BFormGroup>

                    <BAlert show variant="danger" v-if="errors.password">{{ Object.values(errors.password).join('\r\n') }}</BAlert>

                    <BButton
                        block
                        type="submit"
                    >
                        Змінити пароль
                    </BButton>

                </form>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from 'vuex';
import {RESET_PASSWORD} from '../store/modules/auth/types/actions';

export default {
    name: "ResetPasswordPage",

    data: () => ({
        user: {
            password: '',
            passwordConfirmation: ''
        },
        validated: false,
        errors: {}
    }),

    methods:{
        ...mapActions('auth',[
            'RESET_PASSWORD'
        ]),

        onSubmit(){
            this.RESET_PASSWORD({
                'token' : this.$route.params.token,
                'email' : this.$route.params.email,
                'password' : this.user.password,
                'passwordConfirmation' : this.user.passwordConfirmation
            })
                .then(() => {
                    this.validated = true;
                    this.errors = {};

                    setTimeout(() => {
                        this.$router.push({ name: 'auth.signIn' }).catch(() => {});
                    },2000);
                })
                .catch((error) => {
                    this.validated = false;
                    this.errors = error.response.data.error;

                    if(error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                } );
        }
    }
};
</script>
