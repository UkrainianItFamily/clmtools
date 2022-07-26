<template>
    <div>
        <div class="card-img mt-5">
            <div class="d-table mx-auto position-relative">
                <div class="h2 position-absolute d-flex" style="right: 0" @click="ShowUploadImageModal">
                    <BIcon icon="pencil-fill" class="rounded-circle bg-dark p-2" variant="light"></BIcon>
                </div>
                <BImg :src="avatar" alt="" center></BImg>
            </div>
        </div>

        <form
            class="form needs-validation"
            :class="{ 'was-validated': validated}"
            @submit.prevent="onSaveClick"
            novalidate="true"
        >
            <BAlert show variant="success" v-if="validated">Дані збережено!</BAlert>
<!--            <BAlert show variant="danger" v-if="errors.message">{{ errors.message }}</BAlert>-->

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
                            v-model="BirthDay"
                            name="date_birth"
                        >
                            <BFormSelectOption v-for="day in days" :key="day" :value="day">{{day}}</BFormSelectOption>
                        </BFormSelect>
                    </BCol>
                    <BCol cols="4">
                        <BFormSelect
                            id="input-dateBirth"
                            v-model="BirthMonth"
                            :options="months"
                            name="date_birth"
                        ></BFormSelect>
                    </BCol>
                    <BCol cols="4">
                        <BFormSelect
                            id="input-dateBirth"
                            v-model="BirthYear"
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
                    value-field="id"
                    text-field="name"
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
                    value-field="id"
                    text-field="name"
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

            <div class="mt-3 mb-5">
                <BButton block @click="ShowChangePasswordModal">Змінити пароль</BButton>
                <BButton block type="submit">Зберегти</BButton>
            </div>
        </form>

        <BModal ref="upload-image-modal" hide-footer block>
            <div class="d-block text-center">
                <h3>Редагування фото</h3>
            </div>
            <div class="form-control-file">
                <div
                    class="imagePreviewWrapper"
                    :style="{ 'background-image': `url(${preview})` }"
                    @click="selectImage"
                    >
                </div>
                <p class="mt-2 text-center" @click="selectImage">
                    <BIcon icon="cloud-arrow-up"></BIcon> <b>{{ image ? image.name : 'Виберіти фото (jpeg, png, 5MB)' }}</b>
                </p>
                <input
                    type="file"
                    @input="pickFile"
                    class="d-none"
                    ref="fileInput"
                    accept=".jpg, .png, .jpeg"
                >
            </div>
            <div class="mt-3">
                <BRow>
                    <BCol>
                        <BButton variant="secondary" block @click="hideModal">Зберегти</BButton>
                    </BCol>
                    <BCol>
                        <BButton variant="outline-warning" block @click="hideModal">Відмінити</BButton>
                    </BCol>
                </BRow>
            </div>
        </BModal>

        <BModal ref="change-password-modal" hide-footer block title="Змінити пароль">
            <div class="form-control-file">
                <BFormGroup>
                    <BFormInput
                        id="input-password"
                        v-model="ChangePass.password"
                        name="password"
                        type="password"
                        placeholder="Новий пароль"
                        required
                    ></BFormInput>
                </BFormGroup>

                <BFormGroup>
                    <BFormInput
                        id="input-passwordConfirmation"
                        v-model="ChangePass.passwordConfirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Підтвердіть пароль"
                        required
                    ></BFormInput>
                </BFormGroup>
            </div>
            <div class="mt-3">
                <BRow>
                    <BCol>
                        <BButton variant="secondary" block @click="hideModal">Зберегти</BButton>
                    </BCol>
                    <BCol>
                        <BButton variant="outline-warning" block @click="hideModal">Відмінити</BButton>
                    </BCol>
                </BRow>
            </div>
        </BModal>

    </div>
</template>

<script>
import { mapGetters,mapActions } from "vuex";
import { emptyUser } from '@/services/Normalizer';
import moment from 'moment';

export default {
    name: "EditProfileForm",

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
        ...mapGetters('handbook', {
            cities: 'getCities',
            universities: 'getUniversities'
        }),
        avatar(){
            return this.user.avatar ? this.user.avatar : '/img/empty_avatar.jpg';
        },
        days() {
            let day_arr = [];
            for (let i = 1; i <= 28; i++) {
                (i < 10) ? day_arr.push('0'+i) : day_arr.push(i.toString());
            }
            if (this.BirthMonth === '02') {
                if(this.BirthYear % 4 === 0) {
                    day_arr.push(29);
                }
            } else if (this.BirthMonth === '04' || this.BirthMonth === '06'
                || this.BirthMonth === '09' || this.BirthMonth === '11') {
                day_arr.push(29);
                day_arr.push(30);
            } else {
                day_arr.push(29);
                day_arr.push(30);
                day_arr.push(31);
            }
            return day_arr;
        },
        months(){
            let months_obj = [];
            moment.locale(process.env.VUE_APP_LOCALE);
            moment.months().forEach((element, index) =>
                months_obj.push({text:element,value: ('0'+(index+1)).slice(-2)})
            );
            return months_obj;
        },
        dateBirth(){
            return this.BirthYear && this.BirthMonth && this.BirthDay ?
                this.BirthYear + '-' + this.BirthMonth + '-' + this.BirthDay :
                null;
        },
        years() {
            let currentYear = new Date().getFullYear(), array = [];
            for (let i = currentYear; i > (currentYear - 110); i--) {
                array.push(i);
            }
            return array;
        },
    },

    data: () => ({
        editUser: {
            ...emptyUser()
        },
        BirthDay(){
            return this.user.dateBirth ? new Date(this.user.dateBirth).getDay() : null;
        },
        BirthMonth(){
            return this.user.dateBirth ? new Date(this.user.dateBirth).getMonth() : null;
        },
        BirthYear(){
            return this.user.dateBirth ? new Date(this.user.dateBirth).getFullYear() : null;
        },
        ChangePass: {
            password: '',
            passwordConfirmation: '',
        },
        image: null,
        preview: null,
        validated: false,
        errors: {}
    }),

    created() {
        this.editUser = {
            ...this.user
        };
    },

    mounted() {
        this.getCitiesList();
        this.getUniversitiesList();
    },

    methods:{
        ...mapActions('auth', ['updateProfile']),

        ...mapActions('handbook', ['GET_CITIES','GET_UNIVERSITIES']),

        getCitiesList(){
            this.GET_CITIES().then(() => {}).catch((error) => {
                    if (error.response.data.errors) {
                        alert(Object.values(error.response.data.errors).join('\r\n'));
                    }
                });
        },
        getUniversitiesList(){
            this.GET_UNIVERSITIES().then(() => {}).catch((error) => {
                    if (error.response.data.errors) {
                        alert(Object.values(error.response.data.errors).join('\r\n'));
                    }
                });
        },

        async onSaveClick(){
            this.editUser.dateBirth = this.dateBirth;
            try {
                await this.updateProfile(this.editUser)
                    .then(() => {
                        this.validated = true;
                        this.errors = {};
                    })
                    .catch((error) => {
                        this.validated = false;
                        this.errors = error.response.data.error;
                        if (error.response.data.errors) {
                            this.errors = error.response.data.errors;
                        }
                    });
            } catch (error) {
                console.log(error);
            }
        },

        ShowUploadImageModal(){
            this.$refs['upload-image-modal'].show();
        },

        ShowChangePasswordModal(){
            this.$refs['change-password-modal'].show();
        },

        hideModal(){
            this.$refs['upload-image-modal'].hide();
            this.$refs['change-password-modal'].hide();
        },

        selectImage() {
            this.$refs['fileInput'].click();
        },

        pickFile() {
            let input = this.$refs.fileInput;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader;
                reader.onload = e => {
                    this.preview = e.target.result;
                    this.image = file[0];
                };
                reader.readAsDataURL(file[0]);
                this.$emit('click', file[0]);
            }
        }
    }
};
</script>

<style scoped>
.imagePreviewWrapper {
    width: 250px;
    height: 250px;
    display: block;
    cursor: pointer;
    margin: 0 auto 30px;
    background-size: cover;
    background-position: center center;
}
</style>
