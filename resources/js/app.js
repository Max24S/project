

require('./bootstrap');

window.Vue = require('vue');

 // let VueResource = require('vue-resource');
 // Vue.use(VueResource);
// let VeeValidate = require('vee-validate');
// Vue.use(VeeValidate);
import Vue from 'vue';
import VeeValidate from 'vee-validate';
import { Validator } from 'vee-validate';
import ru from 'vee-validate/dist/locale/ru';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VeeValidate, {
    locale: 'ru',
    dictionary: {
        ru: {
            attributes:{
                surname:" ",
                name:" ",
                patronymic:" ",
                email:' ',
                birthday:' ',
                address:" ",
                role:" ",
                grade:" ",
                sex:" ",
                number:" "
            }
        }
    }
});
Validator.localize('ru', ru);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-user', require('./components/forms/сreate/CreateUser.vue').default);
Vue.component('create-timetable', require('./components/forms/сreate/CreateTimetable.vue').default);

const app = new Vue({
    el: '#app',
});
