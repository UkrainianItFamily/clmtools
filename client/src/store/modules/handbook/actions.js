import * as actions from './types/actions';
import * as mutations from './types/mutations';
import ApiRequestService from '@/services/request-service/ApiRequestService';

export default {
  [actions.GET_CITIES]: async ({ commit }) => {
      try {
          const data = await ApiRequestService.get('/cities/');

          commit(mutations.SET_CITIES, {
              cities: data.data
          });

          return Promise.resolve();
      } catch (error) {
          return Promise.reject(error);
      }
  },

    [actions.GET_CITY]: async (
        { commit },
        { city_id }
    ) => {
        try {
            const data = await ApiRequestService.post('/cities/' + city_id);

            commit(mutations.SET_CITY, {
                city: data.data
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    [actions.GET_UNIVERSITIES]: async ({ commit }) => {
      try {
          const data = await ApiRequestService.get('/universities/');

          commit(mutations.SET_UNIVERSITIES, {
              universities: data.data
          });

          return Promise.resolve();
      } catch (error) {
          return Promise.reject(error);
      }
  },

    [actions.GET_UNIVERSITY]: async (
        { commit },
        { university_id }
    ) => {
        try {
            const data = await ApiRequestService.post('/universities/' + university_id);

            commit(mutations.SET_UNIVERSITY, {
                university: data.data
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    }
};
