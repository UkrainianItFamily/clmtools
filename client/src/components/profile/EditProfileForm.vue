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

            <div role="group" class="mt-3">
                <label for="input-name"><b>Ім'я</b></label>
                <BFormInput
                    id="input-name"
                    v-model="editUser.name"
                    :value="editUser.name"
                    name="name"
                    required
                    trim
                ></BFormInput>
            </div>

            <div role="group" class="mt-3">
                <label for="input-lastName"><b>Прізвище</b></label>
                <BFormInput
                    id="input-lastName"
                    v-model="editUser.lastName"
                    :value="editUser.lastName"
                    name="last_name"
                    required
                    trim
                ></BFormInput>
            </div>

            <label for="input-dateBirth" class="mt-3"><b>Дата народження</b></label>
            <BFormGroup>
                <BRow class="justify-content-md-center">
                    <BCol cols="4">
                        <BFormSelect
                            id="input-dateBirth"
                            v-model="editUser.dateBirth"
                            :value="editUser.dateBirth"
                            name="date_birth"
                        >
                            <BFormSelectOption v-for="day in days" :key="day" :value="day">{{day}}</BFormSelectOption>
                        </BFormSelect>
                    </BCol>
                    <BCol cols="4">
                        <BFormSelect
                            id="input-dateBirth"
                            v-model="editUser.dateBirth"
                            :options="months"
                            :value="editUser.dateBirth"
                            name="date_birth"
                        ></BFormSelect>
                    </BCol>
                    <BCol cols="4">
                        <BFormSelect
                            id="input-dateBirth"
                            v-model="editUser.dateBirth"
                            :value="editUser.dateBirth"
                            name="date_birth"
                        >
                            <BFormSelectOption v-for="year in years" :key="year" :value="year">{{year}}</BFormSelectOption>
                        </BFormSelect>
                    </BCol>
                </BRow>
            </BFormGroup>

            <div role="group" class="mt-3">
                <label for="input-phone"><b>Номер телефону</b></label>
                <BFormInput
                    id="input-phone"
                    v-model="editUser.phone"
                    :value="editUser.phone"
                    name="phone"
                    readonly
                ></BFormInput>
            </div>

            <div role="group" class="mt-3">
                <label for="input-phone"><b>Електронна пошта</b></label>
                <BFormInput
                    id="input-phone"
                    v-model="editUser.email"
                    :value="editUser.email"
                    name="email"
                    readonly
                ></BFormInput>
            </div>

            <div role="group" class="mt-3">
                <label for="input-city"><b>Місто</b></label>
                <BFormSelect
                    id="input-city"
                    v-model="editUser.city"
                    :options="cities"
                    :value="editUser.city"
                    name="city"
                ></BFormSelect>
            </div>

            <div role="group" class="mt-3">
                <label for="input-university"><b>Університет</b></label>
                <BFormSelect
                    id="input-university"
                    v-model="editUser.university"
                    :options="universities"
                    :value="editUser.university"
                    name="university"
                ></BFormSelect>
            </div>

            <div role="group" class="mt-3">
                <label for="input-graduationYear"><b>Рік випуску</b></label>
                <BFormSelect
                    id="input-graduationYear"
                    v-model="editUser.graduationYear"
                    :value="editUser.graduationYear"
                    name="graduation_year"
                >
                    <BFormSelectOption v-for="year in years" :key="year" :value="year">{{year}}</BFormSelectOption>
                </BFormSelect>
            </div>

            <div class="mt-3">
                <BButton block>Змінити пароль</BButton>
                <BButton block type="submit">Зберегти</BButton>
            </div>
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
        days() {
            var array = [];
            for (var i = 1; i <= 31; i++) {
                array.push(i);
            }
            return array;
        },
        years() {
            var currentYear = new Date().getFullYear(), array = [];
            for (var i = currentYear; i >= (currentYear - 100); i--) {
                array.push(i);
            }
            return array;
        },
    },

    data: () => ({
        editUser: {
            ...emptyUser()
        },
        months: [
            { text: 'Січень', value: '01' },
            { text: 'Лютий', value: '02' },
            { text: 'Березень', value: '03'},
            { text: 'Квітень', value: '04'},
            { text: 'Травень', value: '05'},
            { text: 'Червень', value: '06'},
            { text: 'Липень', value: '07'},
            { text: 'Серпень', value: '08'},
            { text: 'Вересень', value: '09'},
            { text: 'Жовтень', value: '10'},
            { text: 'Листопад', value: '11'},
            { text: 'Грудень', value: '12'},
        ],
        cities: [
            { text: 'Львів', value: 'Львів' },
            { text: 'Київ', value: 'Київ' },
            { text: 'Миколаїв', value: 'Миколаїв'},
            { text: 'Харків', value: 'Харків'},
            { text: 'Одеса', value: 'Одеса'},
            { text: 'Донецьк', value: 'Донецьк'},
            { text: 'Херсон', value: 'Херсон'},
        ],
        universities: [
            { text: 'Київський національний університет культури і мистецтв', value: 'Київський національний університет культури і мистецтв' },
            { text: 'КПІ ім. Ігоря Сікорського', value: 'КПІ ім. Ігоря Сікорського' },
            { text: 'Азовський морський інститут Одеської національної морської академії', value: 'Азовський морський інститут Одеської національної морської академії'},
            { text: 'Вінницький державний педагогічний університет ім. М. Коцюбинського', value: 'Вінницький державний педагогічний університет ім. М. Коцюбинського'},
            { text: 'Глухівський національний педагогічний університет ім. Довженка', value: 'Глухівський національний педагогічний університет ім. Довженка'},
        ],
        image: null,
        validated: false,
        errors: {}
    }),

    created() {
        this.editUser = {
            ...this.user
        };
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
