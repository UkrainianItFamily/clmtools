<template>
  <div class="col-lg-3">
    <ul class="nav nav-link-secondary flex-column">
      <li class="nav-item flex">
        <RouterLink class="nav-link text-dark" :to="'lections'">Лекція</RouterLink>
        <RouterLink class="nav-link text-dark" :to="'tasks'">Завдання</RouterLink>
        <RouterLink class="nav-link text-dark" :to="'more-info'">Чат з викладачем</RouterLink>
      </li>
    </ul>
  </div>
</template>

<style>
    .flex {
        display: flex;
    }
</style>
