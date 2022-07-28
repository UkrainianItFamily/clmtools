import * as mutations from './types/mutations';

export default {
  [mutations.SET_CITIES]: (state, cities) => {
    state.cities = cities.cities;
  },

  [mutations.SET_CITY]: (state, city) => {
    state.city = city;
  },

  [mutations.SET_UNIVERSITIES]: (state, universities) => {
    state.universities = universities.universities;
  },

  [mutations.SET_UNIVERSITY]: (state, university) => {
    state.university = university;
  },

};
