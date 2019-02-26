require('./bootstrap');

window.Vue = require('vue');
window.PhoneNumber = require( 'awesome-phonenumber' );

Vue.component('add-row-component', require('./components/frontend/form/AddRowComponent').default);
Vue.component('form-component', require('./components/frontend/form/FormComponent').default);

const app = new Vue({
    el: '.app'
});
