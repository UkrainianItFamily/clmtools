<template>
    <div class="row-fluid">
        <ul class="thumbnails">
            <li class="span4" v-for="lection in this.getLections">
                <div class="thumbnail">
                    <img data-src="holder.js/150x150" alt="150x150" src="{{ lection.image }}" style="width: 150px; height: 150px;">
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
            ...mapActions('auth', [
                'getLections',
            ]),
        },
        mounted() {
            this.getLections({ user_id: this.getAuthenticatedUser.id })
                .then(() => {
                    alert("Лист з верифікацією надіслан повторно");
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        alert(Object.values(error.response.data.errors).join('\r\n'));
                    }
                } );
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
