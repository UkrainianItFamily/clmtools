import Vue from 'vue';
import Vuex from 'vuex';
import StatusService from './modules/status-service';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    StatusService,
  }
});
