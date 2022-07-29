<template>
    <div>
        <div class="card-img mt-5">
            <div class="d-table mx-auto position-relative">
                <div class="h2 position-absolute d-flex" style="right: 0" @click="ShowUploadImageModal">
                    <BIcon icon="pencil-fill" class="rounded-circle bg-dark p-2" variant="light"></BIcon>
                </div>
                <BImg :src="editUser.avatar" alt="" center></BImg>
            </div>
        </div>

        <form
            class="form needs-validation"
            :class="{ 'was-validated': validated}"
            @submit.prevent="onSaveClick"
            novalidate="true"
        >

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
                <BAlert show variant="danger" v-if="errors.name">{{Object.values(errors.name).join('\r\n')}}</BAlert>
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
                <BAlert show variant="danger" v-if="errors.last_name">{{Object.values(errors.last_name).join('\r\n')}}</BAlert>
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
                            <BFormSelectOption v-for="day in days" :key="day" :value="day">{{ day }}</BFormSelectOption>
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
                            <BFormSelectOption v-for="year in years"
                                               :key="year"
                                               :value="year">{{ year }}
                            </BFormSelectOption>
                        </BFormSelect>
                    </BCol>
                </BRow>
                <BAlert show variant="danger" v-if="errors.date_birth">{{Object.values(errors.date_birth).join('\r\n')}}</BAlert>
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
                    <BFormSelectOption v-for="year in years" :key="year" :value="year">{{ year }}</BFormSelectOption>
                </BFormSelect>
                <BAlert show variant="danger" v-if="errors.graduation_year">{{Object.values(errors.graduation_year).join('\r\n')}}</BAlert>
            </div>

            <BAlert show variant="success" v-if="validated">Дані збережено!</BAlert>

            <div class="mt-3 mb-5">
                <BButton block @click="ShowChangePasswordModal">Змінити пароль</BButton>
                <BButton block :disabled="disableSaveBtn" type="submit">Зберегти</BButton>
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
                    <BIcon icon="cloud-arrow-up"></BIcon>
                    <b>{{ image ? image.name : 'Виберіти фото (jpeg, png, 5MB)' }}</b>
                </p>
                <input
                    type="file"
                    @input="pickFile"
                    class="d-none"
                    ref="fileInput"
                    accept=".jpg, .png, .jpeg"
                >
                <BAlert show variant="success" v-if="successUploadImage">Ваше фото зміненно!</BAlert>
                <BAlert show variant="danger" v-if="imageErrors.message">{{imageErrors.message}}</BAlert>
            </div>
            <div class="mt-3">
                <BRow>
                    <BCol>
                        <BButton variant="secondary" block @click="uploadAvatar">Зберегти</BButton>
                    </BCol>
                    <BCol>
                        <BButton variant="outline-warning" block @click="hideModal">Відмінити</BButton>
                    </BCol>
                </BRow>
            </div>
        </BModal>

        <BModal ref="change-password-modal" hide-footer block title="Змінити пароль">
            <div class="form-control-file">

                <BAlert show variant="success" v-if="successChangePassword">Ваш пароль успішно зміненно!</BAlert>
                <BAlert show variant="danger" v-if="passErrors.message">{{passErrors.message}}</BAlert>

                <BFormGroup>
                    <BFormInput
                        id="input-password"
                        v-model="ChangePass.oldPassword"
                        name="old_password"
                        type="password"
                        placeholder="Старий пароль"
                        required
                    ></BFormInput>
                </BFormGroup>

                <BFormGroup>
                    <BFormInput
                        id="input-password"
                        v-model="ChangePass.newPassword"
                        name="new_password"
                        type="password"
                        placeholder="Новий пароль"
                        required
                    ></BFormInput>
                </BFormGroup>

                <BFormGroup>
                    <BFormInput
                        id="input-passwordConfirmation"
                        v-model="ChangePass.newPasswordConfirmation"
                        name="new_password_confirmation"
                        type="password"
                        placeholder="Підтвердження нового пароля"
                        required
                    ></BFormInput>
                </BFormGroup>
            </div>
            <div class="mt-3">
                <BButton variant="secondary" block @click="onChangePassword">Зберегти</BButton>
            </div>
        </BModal>

    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
import {emptyUser} from '@/services/Normalizer';
import moment from 'moment';
import methods from '@/components/methods/methods';
import {CHANGE_PASSWORD} from '../../store/modules/auth/types/actions';

export default {
    name: 'EditProfileForm',

    mixins: [methods],

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser',
        }),
        ...mapGetters('handbook', {
            cities: 'getCities',
            universities: 'getUniversities',
        }),
        days()
        {
            let currentYear = typeof (this.BirthYear) === 'string' ? this.BirthYear : new Date().getFullYear(),
                currentMonth = typeof (this.BirthMonth) === 'string' ? this.BirthMonth : new Date().getMonth();

            return this.getDaysInMonthArray(currentYear, currentMonth);
        },
        months()
        {
            let months_obj = [];
            moment.locale(process.env.VUE_APP_LOCALE);
            moment.months().forEach((element, index) =>
                months_obj.push({text: element, value: ('0' + (index + 1)).slice(-2)}),
            );
            return months_obj;
        },
        dateBirth()
        {
            return this.BirthYear && this.BirthMonth && this.BirthDay ?
                this.BirthYear + '-' + this.BirthMonth + '-' + this.BirthDay :
                null;
        },
        years()
        {
            let currentYear = new Date().getFullYear(), array = [];
            for (let i = currentYear; i > (currentYear - 110); i--)
            {
                array.push(i);
            }
            return array;
        },
        disableSaveBtn(){
            return JSON.stringify(this.user) === JSON.stringify(this.editUser) &&
                this.BirthDay === this.pad(new Date(this.user.dateBirth).getDate()) &&
                this.BirthMonth === this.pad(new Date(this.user.dateBirth).getMonth() + 1) &&
                this.BirthYear === new Date(this.user.dateBirth).getFullYear();
        }
    },

    data: () => ({
        editUser: {
            ...emptyUser(),
        },
        BirthDay: null,
        BirthMonth: null,
        BirthYear: null,
        validated: false,
        errors: {},
        ChangePass: {
            oldPassword: '',
            newPassword: '',
            newPasswordConfirmation: '',
        },
        successChangePassword: false,
        passErrors: {},
        image: null,
        preview: null,
        successUploadImage: false,
        imageErrors: {},
    }),

    created()
    {
        this.editUser = {
            ...this.user,
        };
        this.BirthDay = this.pad(new Date(this.user.dateBirth).getDate());
        this.BirthMonth = this.pad(new Date(this.user.dateBirth).getMonth() + 1);
        this.BirthYear = new Date(this.user.dateBirth).getFullYear();
    },

    mounted()
    {
        this.getCitiesList();
        this.getUniversitiesList();
    },

    methods: {
        ...mapActions('auth', ['UPDATE_PROFILE', 'UPDATE_PROFILE_IMAGE', 'CHANGE_PASSWORD']),

        ...mapActions('handbook', ['GET_CITIES', 'GET_UNIVERSITIES']),

        getCitiesList()
        {
            this.GET_CITIES().then(() => {}).catch((error) =>
            {
                if (error.response.data.errors)
                {
                    alert(Object.values(error.response.data.errors).join('\r\n'));
                }
            });
        },
        getUniversitiesList()
        {
            this.GET_UNIVERSITIES().then(() => {}).catch((error) =>
            {
                if (error.response.data.errors)
                {
                    alert(Object.values(error.response.data.errors).join('\r\n'));
                }
            });
        },

        async onChangePassword()
        {
            await this.CHANGE_PASSWORD(this.ChangePass)
            .then(() =>
            {
                this.passErrors = {};
                this.successChangePassword = true;
                setTimeout(() => {
                    this.$refs['change-password-modal'].hide();
                    this.successChangePassword = false;
                    this.ChangePass = {};
                },2000);

            }).catch((error) =>
            {
                this.passErrors = error.response.data.error;
                if (error.response.data.errors)
                {
                    this.passErrors = error.response.data.errors;
                }
            });
        },

        async onSaveClick()
        {
            this.editUser.dateBirth = this.dateBirth;
            await this.UPDATE_PROFILE(this.editUser).then(() =>
            {
                this.validated = true;
                this.errors = {};
            }).catch((error) =>
            {
                this.validated = false;
                this.errors = error.response.data.errors;
            });
        },

        ShowUploadImageModal()
        {
            this.$refs['upload-image-modal'].show();
        },

        ShowChangePasswordModal()
        {
            this.$refs['change-password-modal'].show();
        },

        hideModal()
        {
            this.$refs['upload-image-modal'].hide();
        },

        selectImage()
        {
            this.$refs['fileInput'].click();
        },

        pickFile()
        {
            let input = this.$refs.fileInput;
            let file = input.files;
            if (file && file[0])
            {
                let reader = new FileReader;
                reader.onload = e =>
                {
                    this.preview = e.target.result;
                    this.image = file[0];
                };
                reader.readAsDataURL(file[0]);
                this.$emit('fileInput', file[0]);
            }
        },

        async uploadAvatar()
        {
            await this.UPDATE_PROFILE_IMAGE(this.image).then(() =>
            {
                this.imageErrors = {};
                this.successUploadImage = true;
                this.image = null;
                this.preview = null;
                setTimeout(() => {
                    this.hideModal();
                    this.successUploadImage = false;
                },2000);
            }).catch((error) =>
            {
                this.image = null;
                this.preview = null;
                this.imageErrors = error.response.data;
            });
        },

    },
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
