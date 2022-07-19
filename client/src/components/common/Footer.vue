<template>
    <div>
        <footer class="footer">
            <div class="container">
                <div class="row">

                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled text-small">
                            <li v-bind:key="link.title" v-for="link in linksLeft">
                                <RouterLink class="text-muted" :to="{ name: link.route }">{{ link.title }}</RouterLink>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled text-small">
                            <li v-bind:key="link.title" v-for="link in linksRight">
                                <RouterLink class="text-muted" :to="{ name: link.route }">{{ link.title }}</RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
<script>
export default {
    name: "Footer",
    data() {
        return {
            linksLeft: [
                {
                    title: "Новини",
                    route: "Tasks"
                },
                {
                    title: "Новини2",
                    route: "MoreInfo"
                },
            ],
            linksRight: [
                {
                    title: "Новини3",
                    route: "Tasks"
                },
                {
                    title: "Новини4",
                    route: "MoreInfo"
                },
            ]
        };
    }
};
</script>

<style lang="scss" scoped>
    html {
        position: relative;
        min-height: 100%;
    }
    body {
        margin-bottom: 60px; /* Margin bottom by footer height */
    }
    ul {
        margin-top: 1rem;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        background-color: #f5f5f5;
    }
    container {
        width: auto;
        padding: 0 15px;
    }
</style>
