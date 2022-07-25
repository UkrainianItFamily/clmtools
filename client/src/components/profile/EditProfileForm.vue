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

            <div class="mt-3 mb-5">
                <BButton block>Змінити пароль</BButton>
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
        dateBirth(){
            return this.BirthYear && this.BirthMonth && this.BirthDay ?
                this.BirthYear + '-' + this.BirthMonth + '-' + this.BirthDay :
                null;
        },
        years() {
            let currentYear = new Date().getFullYear(), array = [];
            for (let i = currentYear; i >= (currentYear - 100); i--) {
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
        preview: null,
        errors: {}
    }),

    created() {
        this.editUser = {
            ...this.user
        };
        console.log(this);
        console.log(this.editUser);
        console.log(this.user);
    },

    methods:{
        ...mapActions('auth', ['updateProfile']),

        onSaveClick(){
            this.editUser.dateBirth = this.dateBirth;
            console.log(this.editUser);
            this.updateProfile(this.editUser)
                .then(() => {
                    this.validated = true;
                    this.errors = {};
                    console.log(this.errors);
                })
                .catch((error) => {
                    this.validated = false;
                    this.errors = error.response.data.error;

                    if(error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                    console.log(error);
                } );
        },

        ShowUploadImageModal(){
            this.$refs['upload-image-modal'].show();
        },

        hideModal(){
            this.$refs['upload-image-modal'].hide();
        },

        selectImage() {
            console.log(this);
            this.$refs['fileInput'].click();
        },

        onFileChange(e){
            let file = e.target.files[0];

            if(file) {
                this.image = file;
                this.image.path = URL.createObjectURL(file);
            }
            console.log(this);
        },

        pickFile() {
            let input = this.$refs.fileInput;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader;
                reader.onload = e => {
                    this.image = e.target.result;
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
