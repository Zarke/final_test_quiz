import * as types from '../types';

const state = {
    user: { name: '', userPoints: 0, date: '', time: ''}
};

const getters = {
    [types.RETURN_USER]: state => {
        return state.user;
    },
    [types.RETURN_POINTS]: state => {
        return state.user.userPoints;
    }
};

const mutations = {
    [types.MUTATION_UPDATE_USER]: (state, payload) => {
        state.user[payload.key] = payload.value;
    },
    [types.MUTATION_USER_RESET]: (state, payload) => {
        if(payload) {
            state.user.name = '';
            state.user.userPoints = 0;
            state.user.date = '';
            state.user.time = '';
        }
    },
    [types.MUTATION_UPDATE_POINTS]:(state, payload) => {
        if(payload.reset) {
            state.user.userPoints = 0;
        } else {
            state.user.userPoints += payload.value;
        }
        
    }
};

const actions = {
    [types.ACTION_UPDATE_USER]: ( {commit}, payload ) => {
        commit(types.MUTATION_UPDATE_USER, payload);
    },
    [types.ACTION_USER_RESET]: ( {commit}, payload ) => {
        commit(types.MUTATION_USER_RESET, payload);
    },
    [types.ACTION_UPDATE_POINTS]: ( {commit}, payload ) => {
        commit(types.MUTATION_UPDATE_POINTS, payload);
    }
};

export default {
    state,
    mutations,
    actions,
    getters
}