import * as mutations from './types/mutations';

export default {
    [mutations.SET_CHAT]: (state, chat) => {
        state.chat = chat.chat;
    },
};
