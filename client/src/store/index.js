import Vue from 'vue';
import Vuex from 'vuex';
import StatusService from './modules/status-service';
import auth from './modules/auth';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    StatusService,
      auth
  }
});
