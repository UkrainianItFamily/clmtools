<template>
    <main role="main" class="container">
        <div class="starter-template">
            <h2 v-text="title">Bootstrap starter template</h2>
            <p class="lead"></p>
            <iframe v-if="link" width="560" height="315"
                    :src="link"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
        </div>
    </main>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';

    export default {
        name: "DetailLection",

        data: function() {
            return {
                title: null,
                link: null
            };
        },

        computed: {
            ...mapGetters('lections', [
                'getLection',
            ]),
        },

        methods: {
            ...mapActions('lections', [
                'GET_LECTION',
            ]),

            loadURL (video_url) {
                const youtubeEmbedTemplate = 'https://www.youtube.com/embed/';
                const url = video_url.split(/(vi\/|v%3D|v=|\/v\/|youtu\.be\/|\/embed\/)/);
                const YId = undefined !== url[2] ? url[2].split(/[^0-9a-z_/\\-]/i)[0] : url[0];
                if (YId === url[0]) {
                    return this.getLection.lection.link;
                }

                return youtubeEmbedTemplate.concat(YId);
            }
        },
        mounted() {
            this.GET_LECTION({ lection_id: this.$router.history.current.params.lection_id })
                .then(() => {
                    this.title = this.getLection.lection.title;
                    this.link = this.loadURL(this.getLection.lection.link);
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
    .modal {
        display: block;
    }
</style>
