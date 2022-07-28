import * as actions from './types/actions';
import * as mutations from './types/mutations';
import statusService from '@/services/status-service/StatusService';
import ApiRequestService from '@/services/request-service/ApiRequestService';
import requestService from "@/services/request-service/ApiRequestService";
import {UPDATE_PROFILE_IMAGE} from './types/actions';

export default {
    [actions.USER_REGISTER]: async (
        { commit },
        { name,
        lastName,
        email,
        phone,
        password,
        passwordConfirmation }
    ) => {

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

    [actions.USER_LOGIN]: async (
        { commit },
        { email,
        password }
    ) => {
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

    [actions.VERIFY_EMAIL]: async (
        { commit },
        { url }
    ) => {
        try {
            await requestService.post('/email/verify/' + url);

            return Promise.resolve();
        } catch (error) {

            return Promise.reject(error);
        }
    },

    [actions.RESEND_VERIFY_EMAIL]: async (
        { commit },
        { id }
    ) => {
        try {
            await requestService.post('/email/resend/' + id);

            return Promise.resolve();
        } catch (error) {

            return Promise.reject(error);
        }
    },

    [actions.FORGOT_PASSWORD]: async (
        { commit },
        { email }
    ) => {
        try {
            await requestService.post('/auth/forgot-password', {
                email
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);
        }
    },

    [actions.RESET_PASSWORD]: async (
        { commit },
        { token,
        email,
        password,
        passwordConfirmation }
    ) => {
        try {
            await requestService.post('/auth/reset', {
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

    [actions.CHANGE_PASSWORD]: async (
        { commit },
        { oldPassword,
        newPassword,
        newPasswordConfirmation }
    ) => {
        try {
            await requestService.post('/auth/change-password', {
                old_password: oldPassword,
                new_password: newPassword,
                new_password_confirmation: newPasswordConfirmation,
            });

            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);

        }
    },

    [actions.USER_LOGOUT]: async(
        { commit }
    ) => {
        try {
            await requestService.post('/logout');
            commit(mutations.USER_LOGOUT);
            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    [actions.GET_AUTHENTICATED_USER]: async (
        { commit }
    ) => {
        try {
            const user = await requestService.get('/auth/me');
            commit(mutations.SET_AUTHENTICATED_USER, user);

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    [actions.UPDATE_PROFILE]: async (
        { commit },
        { name,
        lastName,
        dateBirth,
        city,
        university,
        graduationYear }
    ) => {
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

    [actions.UPDATE_PROFILE_IMAGE]: async (
        { commit },
        image
    ) => {
        try {
            const formData = new FormData();
            formData.append('image', image, image.name);
            const data = await requestService.post('/auth/me/image', formData);
            commit(mutations.SET_AUTHENTICATED_USER, data,);

            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    }

};
