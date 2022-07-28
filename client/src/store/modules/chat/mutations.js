import * as mutations from './types/mutations';

export default {
    [mutations.SET_MESSAGES]: (state, chat) => {
        state.messages = chat.messages;
    },
};
