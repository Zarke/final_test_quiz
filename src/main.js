import Vue from 'vue';
import App from './App.vue';
import moment from 'moment';
import VueResource from 'vue-resource';
import {ClientTable, Event} from 'vue-tables-2';

Vue.use(VueResource);
Vue.use(ClientTable);
Vue.http.options.root = 'https://vuejs-http-d7108.firebaseio.com/';

Vue.prototype.$moment = moment;

export const eventBus = new Vue();

new Vue({
  el: '#app',
  render: h => h(App)
})
