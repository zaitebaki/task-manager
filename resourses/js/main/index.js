console.log("Hello from js");

window.Vue = require('vue');

Vue.component(
    'login-component',
    require('./components/login-component/_LoginComponent.vue')
      .default
  );

const app = new Vue({
    el: '#app',
  });