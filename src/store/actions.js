import * as types from './types';

export default {
    [types.ACTION_QUIZ_STATE_CHANGE]: ( {commit}, payload ) => {
        commit(types.MUTATION_QUIZ_STATE_CHANGE, payload);
    }
};