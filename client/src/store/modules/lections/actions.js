import * as actions from './types/actions';
import * as mutations from './types/mutations';
import ApiRequestService from '@/services/request-service/ApiRequestService';

export default {
  [actions.GET_LECTIONS]: async (
    { commit },
    { user_id }
  ) => {
      try {
          const data = await ApiRequestService.post('/user-lectures/' + user_id);

          commit(mutations.SET_LECTIONS, {
              lections: data.data,
          });

          return Promise.resolve();
      } catch (error) {
          return Promise.reject(error);
      }
  }

    [actions.GET_LECTION]: async (
        { commit },
        { lection_id }
    ) => {
        try {
            const data = await ApiRequestService.post('/lecture/' + lection_id);

            commit(mutations.SET_LECTION, {
                lection: data.data,
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    }
};
