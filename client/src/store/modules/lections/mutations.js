import * as mutations from './types/mutations';

export default {
  [mutations.SET_LECTIONS]: (state, lections) => {
      state.lections = lections;
    // const i = state.map.findIndex(
    //   lection => lections.id === lection
    // );
    //
    // state.byId = {
    //   ...state.byId,
    //   [lections.id]: {
    //     ...(state.byId[lections.id] || {}),
    //     ...lections.data
    //   }
    // };
    //
    // if (i === -1) {
    //   state.map = state.map.concat(lections);
    // } else {
    //   state.map = [
    //     ...state.map.slice(0, i),
    //     lections.id,
    //     ...state.map.slice(i + 1, state.map.length)
    //   ];
    // }
  },

  [mutations.SET_LECTION]: (state, lection) => {
    state.lection = lection;
    // if (!state.byId[lection]) {
    //   return;
    // }
    //
    // state.byId = {
    //   ...state.byId,
    //   [lection]: {
    //     ...state.byId[lection],
    //     status: null
    //   }
    // };
  }
};
