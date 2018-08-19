import * as types from './types';

export default {
    [types.RETURN_START]: state => {
        return state.start;
    },
    [types.RETURN_END]: state => {
        return state.end;
    }
};
