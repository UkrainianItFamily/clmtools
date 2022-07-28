import * as actions from './types/actions';
import * as mutations from './types/mutations';
import ApiRequestService from '@/services/request-service/ApiRequestService';

export default {
    [actions.GET_MESSAGES]: async (
        { commit },
        { user_id, lecture_id }
    ) => {
        try {
            const data = await ApiRequestService.get('/chat', {
                user_id: user_id,
                lecture_id: lecture_id
            });

            commit(mutations.SET_MESSAGES, {
                messages: data.data
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },
};
