import * as mutations from './types/mutations';
import Storage from '@/services/Storage';
import { emptyUser, userMapper } from '@/services/Normalizer';

export default {
    [mutations.USER_LOGIN]: (state, { accessToken, tokenType }) => {
        Storage.setToken(accessToken,tokenType);

        state.token = accessToken;
        state.isLoggedIn = true;
    },

    [mutations.USER_LOGOUT]: state => {
        Storage.removeToken();

        state.token = '';
        state.isLoggedIn = false;
        state.user = emptyUser();
    },

    [mutations.SET_AUTHENTICATED_USER]: (state, user) => {
        state.isLoggedIn = true;
        state.user = userMapper(user);
    },
};