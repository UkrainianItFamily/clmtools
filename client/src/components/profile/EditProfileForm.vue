<template>
    <div>
        <div>
            <img v-if="user.avatar" :src="user.avatar" class="rounded mx-auto d-block" alt="">
        </div>

        <form
            class="form needs-validation"
            :class="{ 'was-validated': validated}"
            @submit.prevent="onSaveClick"
            novalidate="true"
        >
            <BAlert show variant="success" v-if="validated">Дані збережено!</BAlert>
            <BAlert show variant="danger" v-if="errors.message">{{ errors.message }}</BAlert>

            <div role="group">
                <label for="input-name"><b>Ім'я</b></label>
                <BFormInput
                    id="input-name"
                    v-model="editUser.name"
                    :value="editUser.name"
                    name="first_name"
                    aria-describedby="input-name-feedback"
                    required
                    trim
                ></BFormInput>

<!--                <BFormInvalidFeedback id="input-name-feedback">-->
<!--                    {{ Object.values(errors.name).join('\r\n') }}-->
<!--                </BFormInvalidFeedback>-->
            </div>

            <div role="group">
                <label for="input-lastName"><b>Прізвище</b></label>
                <BFormInput
                    id="input-lastName"
                    v-model="editUser.lastName"
                    :value="editUser.lastName"
                    name="last_name"
                    aria-describedby="input-lastName-feedback"
                    required
                    trim
                ></BFormInput>

<!--                <BFormInvalidFeedback id="input-lastName-feedback">-->
<!--                    {{ Object.values(errors.lastName).join('\r\n') }}-->
<!--                </BFormInvalidFeedback>-->
            </div>

            <BButton
                block
            >
                Змінити пароль
            </BButton>

            <BButton
                block
                type="submit"
            >
                Зберегти
            </BButton>

        </form>
    </div>
</template>

<script>
import { mapGetters,mapActions } from "vuex";
import { emptyUser } from '@/services/Normalizer';

export default {
    name: "EditProfileForm",

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
        // nameState() {
        //     return this.errors.hasOwnProperty('name');
        // },
        // lastNameState() {
        //     return this.errors.hasOwnProperty('lastName');
        // },
    },

    data: () => ({
        editUser: {
            ...emptyUser()
        },
        image: null,
        validated: false,
        errors: {}
    }),

    created() {
        this.editUser = {
            ...this.user
        };
        console.log(this);
    },

    methods:{
        ...mapActions('auth', ['updateProfile']),

        onSaveClick(){
            this.updateProfile(this.editUser)
                .then(() => {
                    this.validated = true;
                    this.errors = {};
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
