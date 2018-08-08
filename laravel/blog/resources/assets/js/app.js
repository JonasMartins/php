
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';
Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
  state:{
    items:{
      test:"worked"
    }
  },
  mutations:{
    setItems(state,obj){
      state.items = obj;
    }
  }
});


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('top', require('./components/Top.vue'));
Vue.component('top', require('./components/Top.vue'));
Vue.component('box', require('./components/Box.vue'));
Vue.component('page', require('./components/Page.vue'));
Vue.component('panel', require('./components/Panel.vue'));
Vue.component('table-list', require('./components/TableList.vue'));
Vue.component('form-input', require('./components/FormInput.vue'));
Vue.component('breadcrumb', require('./components/Breadcrumb.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('modal-link', require('./components/modal/ModalLink.vue'));

const app = new Vue({
    el: '#app',
    store
});
