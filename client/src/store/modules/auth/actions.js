import * as actions from './types/actions';
import * as mutations from './types/mutations';
import statusService from '@/services/status-service/StatusService';
import ApiRequestService from '@/services/request-service/ApiRequestService';
import requestService from "@/services/request-service/ApiRequestService";

export default {
    async signUp({ commit }, {
        name,
        lastName,
        email,
        phone,
        password,
        passwordConfirmation
    }) {

        try {
            const data = await requestService.post('/auth/register', {
                name: name,
                last_name: lastName,
                email: email,
                phone: phone,
                password: password,
                password_confirmation: passwordConfirmation
            });

            commit(mutations.USER_LOGIN, {
                accessToken: data.access_token,
                tokenType: data.token_type
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    async signIn({ commit }, { email, password }) {

        try {
            const data = await requestService.post('/v1/login', {
                email,
                password,
            });

            if (data.data.user.email_verified_at === '') {
                commit(mutations.SHOW_REGISTER_MODAL);

                commit(mutations.ADD_REGISTER_USER, {
                    id: data.data.user.id,
                });
            } else {
                commit(mutations.USER_LOGIN, {
                    accessToken: data.data.access_token,
                    tokenType: data.data.token_type
                });

                commit(mutations.SET_AUTHENTICATED_USER,
                    data.data.user,
                );
            }

            return Promise.resolve();
        } catch (error) {

            return Promise.reject(error);
        }
    },

};
