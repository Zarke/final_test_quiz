import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: { name: '', userPoints: 0, time: '', date: ''},
        end: false
    },
    getters: {
        returnUser: state => {
            return state.user;
        },
        returnEnd: state => {
            return state.end;
        }
    },
    mutations: {
        quizEnd(state, payload) {
            state.end = payload;
        },
        updateUser(state, payload) {
            state.user[payload.key] = payload.value;
        }
    }
});