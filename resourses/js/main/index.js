import 'bootstrap/dist/css/bootstrap.css'
window.Vue = require('vue');

Vue.component(
    'login-component',
    require('./components/login-component/_LoginComponent.vue')
      .default
  );

const app = new Vue({
    el: '#app',
  });