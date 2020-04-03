

require('./bootstrap');

window.Vue = require('vue');

 let VueResource = require('vue-resource');
 Vue.use(VueResource)

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-user', require('./components/forms/сreate/CreateUser.vue').default);
Vue.component('create-timetable', require('./components/forms/сreate/CreateTimetable.vue').default);

const app = new Vue({
    el: '#app',
});
