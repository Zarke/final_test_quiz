import * as types from './types';

export default {
        [types.MUTATION_QUIZ_STATE_CHANGE]: (state, payload) => {
        state.start = payload.start;
        state.end = payload.end;
    }
};