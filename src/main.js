import Vue from 'vue';
import App from './App.vue';
import moment from 'moment';
import {ClientTable, Event} from 'vue-tables-2';
Vue.use(ClientTable);
Vue.prototype.$moment = moment;

export const eventBus = new Vue();

new Vue({
  el: '#app',
  render: h => h(App)
})
