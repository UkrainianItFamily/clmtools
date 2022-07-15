<template>
    <section class="mt-4">
        <div class="d-flex justify-content-center">
            <div class="box shadow-box w-50">
                <h3 class="text-center">Реєстрація</h3>
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
                            placeholder="Пароль"
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-passwordConfirmation"
                            v-model="user.passwordConfirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Підтвердіть пароль"
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-name"
                            v-model="user.name"
                            name="first_name"
                            placeholder="Ім'я"
                            autofocus
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-lastName"
                            v-model="user.lastName"
                            name="last_name"
                            placeholder="Прізвище"
                        ></BFormInput>
                    </BFormGroup>

                    <BFormGroup>
                        <BFormInput
                            id="input-phone"
                            v-model="user.phone"
                            name="phone"
                            placeholder="Телефон"
                        ></BFormInput>
                    </BFormGroup>

                    <p class="text-right">
                        <RouterLink class="link link-signup" to="/auth/sign-in">
                            Вже є аккаунт? Увійти.
                        </RouterLink>
                    </p>

                        <BButton
                            block
                            @click="onSubmit"
                        >
                            Зареєструватися
                        </BButton>
                </form>
</div>
        </div>
        <RegistrationModal ref="modal" />
    </section>
</template>

<script>
import { mapActions } from 'vuex';
import RegistrationModal from '@/components/auth/RegistrationModal.vue';

export default {
    name: 'SignUpPage',

    components:{
        RegistrationModal
    },

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
        showModal() {
            this.$refs.modal.showModal();
        },
        onSubmit() {
            this.signUp(this.user)
                .then(() => {
                    this.showModal();
                })
                .catch((error) => {console.log(error);} );
        },
    },
};
</script>
