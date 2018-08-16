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
        },
        returnPoints: state => {
            return state.user.userPoints;
        }
    },
    mutations: {
        quizStateChange(state, payload) {
            state.start = payload.start;
            state.end = payload.end;
        },
        updateUser(state, payload) {
            state.user[payload.key] = payload.value;
        },
        userInfoReset(state, payload){
            if(payload) {
                state.user.name = '';
                state.user.userPoints = 0;
                state.user.date = '';
                state.user.time = '';
            }
        },
        updatePoints(state, payload) {
            if(payload.reset) {
                state.user.userPoints = 0;
            } else {
                state.user.userPoints += payload.value;
            }
            
        }
    }
});