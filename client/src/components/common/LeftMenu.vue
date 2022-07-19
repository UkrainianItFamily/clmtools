<template>
  <div class="col-lg-3">
    <h4 class="mt-5 font-weight-bold text-center">Меню</h4>
    <ul class="nav nav-link-secondary flex-column">
      <li class="nav-item" v-bind:key="link.title" v-for="link in links">
        <RouterLink class="nav-link text-dark" :to="{ name: link.route }">{{ link.title }}</RouterLink>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        links: [
          {
            title: "Завдання",
            route: "Tasks"
          },
          {
            title: "База додаткової інформації",
            route: "MoreInfo"
          },
        ]
      };
    }
  };
</script>
<style lang="scss" scoped>
    .router-link-active {
        font-weight: 700;
    }
</style>
