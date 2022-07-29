import * as types from './types/getters';

export default {
    [types.GET_MESSAGES]: state => state.messages,
    [types.POST_MESSAGE]: state => state.message,
    [types.GET_CHAT]: state => state.chat,
    [types.POST_CHAT]: state => state.chat,
};
