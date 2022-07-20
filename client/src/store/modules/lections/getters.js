import * as types from './types/getters';

export default {
  [types.GET_LECTIONS]: state => state.lections,
  [types.GET_LECTION]: state => state.lection
};
