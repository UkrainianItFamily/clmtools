import * as types from './types/getters';

export default {
  [types.GET_CITIES]: state => state.cities,
  [types.GET_CITY]: state => state.city,
  [types.GET_UNIVERSITIES]: state => state.universities,
  [types.GET_UNIVERSITY]: state => state.university
};
