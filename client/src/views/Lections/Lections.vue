<template>
    <div class="row-fluid card example-1 square scrollbar-grey bordered-grey">
        <h3>Лекції</h3>
        <ul class="thumbnails card-body">
            <li class="span4" v-for="lection in getLections" v-bind:key="lection.id" @click="onLectionClick(lection)">
                <div class="thumbnail">
                    <img data-src="holder.js/150x150" alt="150x150" :src="lection.image" style="width: 150px; height: 150px;">
                    <div class="caption">
                        <h3>{{ lection.title }}</h3>
                        <p>Створено: {{ lection.created_at }}</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';

    export default {
        name: "Lections",

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
                this.$router.push({ name: 'detail.lection', params: { lection_id: lection.id } }).catch(() => {});
            }
        },

        mounted() {
            if(this.getAuthenticatedUser.id){
                this.getUserLections();
            }
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
