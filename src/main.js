import Vue from 'vue';
import App from './App.vue';
import moment from 'moment';
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import {ClientTable, Event} from 'vue-tables-2';
import { store } from './store/store';

Vue.use(VueResource);
Vue.use(ClientTable);
Vue.use(VueRouter);
Vue.http.options.root = 'https://vuejs-http-d7108.firebaseio.com/';

Vue.prototype.$moment = moment;

export const eventBus = new Vue();

new Vue({
  el: '#app',
  store,
  render: h => h(App)
})
