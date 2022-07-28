<template>
    <section class="mt-4">
            <div class="d-flex justify-content-center">
                <div class="box shadow-box w-50">
                    <h3 class="text-center mb-4">Авторизація</h3>
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
                                placeholder="E-mail"
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

                        <BRow>
                            <BCol>
                                <p class="ml-4">
                                    <RouterLink class="link link-signup" :to="{name: 'auth.signUp'}">
                                        Реєстрація
                                    </RouterLink>
                                </p>
                            </BCol>
                            <BCol>
                                <p class="mr-4 text-right">
                                    <RouterLink class="link link-signup" :to="{name: 'auth.forgotPassword'}">
                                        Забули пароль?
                                    </RouterLink>
                                </p>
                            </BCol>
                        </BRow>

                        <BButton
                            block
                            @click="onSubmit"
                        >
                            Увійти
                        </BButton>

                    </form>
                </div>
            </div>
        <RegistrationModal ref="modal" />
    </section>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import RegistrationModal from '@/components/auth/RegistrationModal.vue';

export default {
    name: "SignInPage",

    components:{
        RegistrationModal
    },

    data: () => ({
        user: {
            email: '',
            password: ''
        }
    }),

    computed: {
        ...mapGetters('auth', [
            'hasAuthenticatedUser',
        ]),
    },

    methods: {
        ...mapActions('auth', [
            'USER_LOGIN',
        ]),
        showModal() {
            this.$refs.modal.showModal();
        },
        onSubmit() {
            this.USER_LOGIN(this.user)
                .then(() => {
                    if (this.hasAuthenticatedUser) {
                        alert("Ви увійшли до системи");
                        this.$router.push({ path: '/' }).catch(() => {});
                    } else {
                        this.showModal();
                    }
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        alert(Object.values(error.response.data.errors).join('\r\n'));
                    }
                } );
        },
    },

};
</script>
