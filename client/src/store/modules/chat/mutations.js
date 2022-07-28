import * as mutations from './types/mutations';

export default {
    [mutations.SET_MESSAGES]: (state, chat) => {
        state.messages = chat.messages;
    },
    [mutations.SET_MESSAGE]: (state, chat) => {
        state.message = chat.message;
    },
    [mutations.SET_CHAT]: (state, chat) => {
        state.chat = chat.chat;
    },
};
