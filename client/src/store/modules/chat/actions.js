import * as actions from './types/actions';
import * as mutations from './types/mutations';
import ApiRequestService from '@/services/request-service/ApiRequestService';

export default {
    [actions.GET_MESSAGES]: async (
        { commit },
        { user_id, lecture_id }
    ) => {
        try {
            const data = await ApiRequestService.get('/messages', {
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

    [actions.POST_MESSAGE]: async (
        { commit },
        { lecture_id, body }
    ) => {
        try {
            await ApiRequestService.post('/message', {
                lecture_id: lecture_id,
                body: body
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);

        }
    },

    [actions.GET_CHAT]: async (
        { commit },
        { user_id, lecture_id }
    ) => {
        try {
            const data = await ApiRequestService.get('/chat', {
                user_id: user_id,
                lecture_id: lecture_id
            });

            commit(mutations.SET_CHAT, {
                chat: data.data
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    [actions.POST_CHAT]: async (
        { commit },
        { lecture_id }
    ) => {
        try {
            await ApiRequestService.post('/chat', {
                lecture_id: lecture_id
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);

        }
    },
};
