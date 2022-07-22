import * as mutations from './types/mutations';

export default {
  [mutations.SET_LECTIONS]: (state, lections) => {
    state.lections = lections.lections;
  },

  [mutations.SET_LECTION]: (state, lection) => {
    state.lection = lection;
  }
};
