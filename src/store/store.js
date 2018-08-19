import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';

import actions from './actions';
import mutations from './mutations';
import getters from './getters';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        end: false,
        start: false
    },
    getters,
    mutations,
    actions,
    modules: {
        user
    }
});