webpackJsonp([2],{

/***/ 4:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function(__webpack_provided_window_dot_jQuery, __webpack_provided_window_dot_$) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_laravel_echo__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_laravel_echo___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_laravel_echo__);

window._ = __webpack_require__(5);

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    __webpack_provided_window_dot_$ = __webpack_provided_window_dot_jQuery = __webpack_require__(1);
} catch (e) {
    console.error("Cannot load jquery...", e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(6);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */



window.Pusher = __webpack_require__(9);

window.Echo = new __WEBPACK_IMPORTED_MODULE_0_laravel_echo___default.a({
    namespace: 'App\\Events',
    broadcaster: 'socket.io',
    key: 'ed95d43e0a93517e3536a531b4323240',
    host: window.location.hostname + ':6001'
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1), __webpack_require__(1)))

/***/ }),

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(42);


/***/ }),

/***/ 42:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);

/**
 * This is the page where Vue will be used the most. Once mounted, we
 * want to immediately start listening for broadcasted events. If any
 * are found, we'll add them to the "messages" array so they get displayed
 * on the frontend.
 */

__webpack_require__(4);

window.Vue = __webpack_require__(3);



var app = new __WEBPACK_IMPORTED_MODULE_0_vue___default.a({
    el: '#app',

    data: function data() {
        return {
            messages: []
        };
    },
    mounted: function mounted() {
        var _this = this;

        window.Echo.channel('global').listen('MessageEvent', function (e) {
            var message = e.data;

            if (message.userId == window.userId) {
                // This is a message intended for this user. Let's display it!
                _this.messages.unshift(e.data.message);
            }
        });
    },


    methods: {}
});

/***/ })

},[41]);