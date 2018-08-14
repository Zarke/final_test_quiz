import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: { name: '', userPoints: 0, date: '', time: ''},
        end: false,
        start: false
    },
    getters: {
        returnUser: state => {
            return state.user;
        },
        returnStart: state => {
            return state.start;
        },
        returnEnd: state => {
            return state.end;
        }
    },
    mutations: {
        quizStateChange(state, payload) {
                state.start = payload.start;
                state.end = payload.end;
        },
        updateUser(state, payload) {
            state.user[payload.key] = payload.value;
        }
    }
});