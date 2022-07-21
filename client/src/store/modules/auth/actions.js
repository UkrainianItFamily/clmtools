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

            if (data.data.user.email_verified_at === null) {
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
            await requestService.post('/email/resend/' + id);

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
        token,
        email,
        password,
        passwordConfirmation
    }) {
        try {
            const data = await requestService.post('/auth/reset', {
                token: token,
                email: email,
                password: password,
                password_confirmation: passwordConfirmation,
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);

        }
    },

    async signOut({ commit }) {
        try {
            await requestService.post('/logout');
            commit(mutations.USER_LOGOUT);
            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    async fetchAuthenticatedUser({ commit }) {
        try {
            const user = await requestService.get('/auth/me');
            commit(mutations.SET_AUTHENTICATED_USER, user);

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    async updateProfile({ commit }, {
        name,
        lastName,
        dateBirth,
        city,
        university,
        graduationYear
    }) {
        try {
            const data = await requestService.put('/auth/me', {
                name: name,
                last_name: lastName,
                date_birth: dateBirth,
                city: city,
                university: university,
                graduation_year: graduationYear
            });

            commit(mutations.SET_AUTHENTICATED_USER, data,);

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

};
