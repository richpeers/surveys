/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuex from 'vuex';
Vue.use(Vuex);

import state from './store/state';
import * as getters from './store/getters';
import * as mutations from './store/mutations';
import * as actions from './store/actions';

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});

import Dropdown from './components/Dropdown.vue';
Vue.component('dropdown', Dropdown);

import Create from './components/Create.vue';

const app = new Vue({
    el: '#app',
    store,
    components: {Create},
    data: {
        navIsActive: false
    }
});
