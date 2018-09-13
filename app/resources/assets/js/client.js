
/**
 * This is the page where Vue will be used the most. Once mounted, we
 * want to immediately start listening for broadcasted events. If any
 * are found, we'll add them to the "messages" array so they get displayed
 * on the frontend.
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
        window.Echo.channel('global')
            .listen('MessageEvent', (e) => {
                let message = e.data;

                if (message.userId == window.userId) {
                    // This is a message intended for this user. Let's display it!
                    this.messages.unshift(e.data.message);
                }
            });
    },

    methods: {
    }
});
