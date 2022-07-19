<template>
  <div class="col-lg-3">
    <h4 class="mt-5 font-weight-bold text-center">Меню</h4>
    <ul class="nav nav-link-secondary flex-column">
      <li class="nav-item">
        <RouterLink class="nav-link text-dark" :to="'tasks'">Завдання</RouterLink>
        <RouterLink class="nav-link text-dark" :to="'more-info'">База додаткової інформації</RouterLink>
      </li>
    </ul>
  </div>
</template>

<script>
</script>
<style lang="scss" scoped>
    .router-link-active {
        font-weight: 700;
    }
</style>
