<template>
  <div>
    <h1>Services test</h1>
    <div>
      <StatusTableComponent />
    </div>
  </div>
</template>

<script>
import StatusTableComponent from '@/components/status/StatusTableComponent.vue';

export default {
  name: 'Status',
  components: {
    StatusTableComponent
  }
};
</script>
