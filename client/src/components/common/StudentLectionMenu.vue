<template>
  <div class="col-lg-3">
    <ul class="nav nav-link-secondary flex-column">
      <li class="nav-item flex">
        <RouterLink class="nav-link text-dark" :to="{ name: 'detail.lection', params: { lection_id: this.$route.params.lection_id }}">Лекція</RouterLink>
        <RouterLink class="nav-link text-dark" :to="'/tasks'">Завдання</RouterLink>
        <RouterLink class="nav-link text-dark" :to="{ name: 'Chat', params: { lection_id: this.$route.params.lection_id }}">Чат з викладачем</RouterLink>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
    name: 'StudentLectionMenu',
};
</script>

<style>
    .flex {
        display: flex;
    }
</style>

