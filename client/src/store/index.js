import Vue from 'vue';
import Vuex from 'vuex';
import StatusService from './modules/status-service';
import auth from './modules/auth';
import lections from './modules/lections';
import chat from './modules/chat';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    StatusService,
      auth,
      lections,
      chat
  }
});
