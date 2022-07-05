<template>
  <div>
    <BTable :fields="fields" :items="items"> </BTable>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import * as statusGetters from '@/store/modules/status-service/types/getters';
import * as statusActions from '@/store/modules/status-service/types/actions';

export default {
  name: 'StatusTableComponent',
  data() {
    return {
      fields: ['name', 'statusText', 'status']
    };
  },
  computed: {
    ...mapGetters('StatusService', {
      serviceById: statusGetters.GET_STATUS_BY_ID,
      services: statusGetters.GET_STATUS_MAP
    }),
    items() {
      return this.services.map(serviceId => this.serviceById[serviceId]);
    }
  },
  methods: {
    ...mapActions('StatusService', {
      getStatusByName: statusActions.GET_SERVICE_STATUS_BY_NAME
    }),

  },
  mounted() {
    try {
      this.getStatusByName('app');
      this.getStatusByName('server');
      this.getStatusByName('cache');
      this.getStatusByName('database');
      this.getStatusByName('storage');
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
