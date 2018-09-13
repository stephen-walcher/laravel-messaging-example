
/**
 * This page didn't require much JavaScript work. It's mainly handled by
 * the Laravel end. We're really just instantiating the Vue backbone that
 * we've established and initializing the Datepicker plugin.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

const app = new Vue({
    el: '#app',

    data() {
        return {
            messages: []
        }
    },

    mounted() {
        $('#datepicker').datepicker();
    },

    methods: {
    }
});
