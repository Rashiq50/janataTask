require('./bootstrap');

window.Vue = require('vue');
Vue.component('maincomponent', require('./components/maincomponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
import VueFilterDateFormat from 'vue-filter-date-format';
Vue.use(VueFilterDateFormat);

const app = new Vue({
    el: '#app',
}).$mount('#app');

