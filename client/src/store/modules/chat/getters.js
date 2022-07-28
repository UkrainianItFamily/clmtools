import * as types from './types/getters';

export default {
    [types.GET_MESSAGES]: state => state.messages,
    [types.POST_MESSAGE]: state => state.message,
};
