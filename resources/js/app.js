

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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

Vue.component("v-select", vSelect);

import Toaster from 'v-toaster'

import 'v-toaster/dist/v-toaster.css'

// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VeeValidate, {
    fieldsBagName: 'veeFields',
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
                number:" ",
                day:" ",
                grade_id:" ",
                classroom_id:" ",
                semester:" "
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
Vue.component('create-classroom', require('./components/forms/сreate/CreateClassroom.vue').default);
Vue.component('create-grade', require('./components/forms/сreate/CreateGrade.vue').default);
Vue.component('create-subject', require('./components/forms/сreate/CreateSubject.vue').default);
Vue.component('index-timetable', require('./components/forms/index/IndexTimetable').default);
Vue.component('index-user', require('./components/forms/index/IndexUser').default);
Vue.component('edit-user', require('./components/forms/edit/EditUser').default);
Vue.component('edit-timetable', require('./components/forms/edit/EditTimetable').default);

const app = new Vue({
    el: '#app',
});
