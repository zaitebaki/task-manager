import 'bootstrap/dist/css/bootstrap.css'
window.Vue = require('vue');

Vue.component(
    'login-component',
    require('./components/login-component/_LoginComponent.vue')
      .default
  );

  Vue.component(
    'main-component',
    require('./components/main-component/_MainComponent.vue')
      .default
  );

  Vue.component(
    'edit-component',
    require('./components/edit-component/_EditComponent.vue')
      .default
  );

const app = new Vue({
    el: '#app',
  });