<template>
    <div class="row-fluid card example-1 square scrollbar-grey bordered-grey">
        <LecturertLectionMenu v-if="lecturer" />
        <h3>Лекції</h3>
        <RouterLink class="nav-link text-dark" :to="'add.lection'" v-if="lecturer">
            <button class="btn btn-info float-right">
                Створити лекцію
            </button>
        </RouterLink>
        <ul class="thumbnails card-body">
            <li class="span4" v-for="lection in getLections" v-bind:key="lection.id" @click="onLectionClick(lection)">
                <div class="thumbnail">
                    <img data-src="holder.js/150x150" alt="150x150" :src="lection.image" style="width: 150px; height: 150px;">
                    <div class="caption">
                        <RouterLink class="nav-link text-dark" :to="{ name: 'edit.lection', params: { lection_id: lection.id }}" v-if="lecturer">
                            <button class="btn btn-info float-right">
                                Редагувати
                            </button>
                        </RouterLink>
                        <h3>{{ lection.title }}</h3>
                        <p v-if="lecturer">Курс: {{ lection.course }}</p>
                        <p>Створено: {{ lection.created_at }}</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import LecturertLectionMenu from '@/components/common/LecturertLectionMenu.vue';

    export default {
        name: "Lections",

        components: {
            LecturertLectionMenu
        },

        data: function() {
            return {
                lecturer: false,
            };
        },

        computed: {
            ...mapGetters('auth', [
                'getAuthenticatedUser',
            ]),
            ...mapGetters('lections', [
                'getLections',
            ]),
        },

        methods: {
            ...mapActions('lections', [
                'GET_LECTIONS',
            ]),

            getUserLections(){
                this.GET_LECTIONS({ user_id: this.getAuthenticatedUser.id })
                    .then(() => {})
                    .catch((error) => {
                        if (error.response.data.errors) {
                            alert(Object.values(error.response.data.errors).join('\r\n'));
                        }
                    } );
            },

            onLectionClick(lection){
                if(!this.lecturer){
                    this.$router.push({ name: 'detail.lection', params: { lection_id: lection.id } }).catch(() => {});
                }
            }
        },

        mounted() {
            if(this.getAuthenticatedUser.id){
                this.getUserLections();
            }
            this.lecturer = this.getAuthenticatedUser.lecturer;
        },
    };
</script>

<style>
    .span4, .thumbnail {
        display: flex;
    }
    ul.thumbnails {
        display: inline;
    }

</style>
