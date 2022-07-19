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

            commit(mutations.ADD_REGISTER_USER, {
                id: data.data.user.id,
            });

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    async signIn({ commit }, { email, password }) {
        try {
            const data = await requestService.post('/login', {
                email,
                password,
            });

            if (data.data.user.email_verified_at === '') {
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

    async verifyEmail({ commit }, { url }) {
        try {
            await requestService.post('/email/verify/' + url);
            
            return Promise.resolve();
        } catch (error) {

            return Promise.reject(error);
        }
    },

    async reSendEmail({ commit }, { id }) {
        try {
            const data = await requestService.post('/email/resend/' + id.id);

            return Promise.resolve();
        } catch (error) {

            return Promise.reject(error);
        }
    },
    
    async forgotPassword({ commit }, { email }) {
        try {
            await requestService.post('/auth/forgot-password', {
                email
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);
        }
    },

    async resetPassword({ commit }, {
        password,
        passwordConfirmation
    }) {
        try {
            const data = await requestService.post('/auth/reset', {
                email: this.$route.params.email,
                password,
                password_confirmation: passwordConfirmation,
                token: this.$route.params.token
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);

        }
    },
};
