window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('select2');
    require('jquery-mask-plugin');
    $.fn.select2.defaults.set('theme', 'bootstrap4');
    $.fn.select2.defaults.set('language', {
        errorLoading: function () {
            return "Os resultados não puderam ser carregados."
        },
        inputTooLong: function (e) {
            var n = e.input.length - e.maximum, r = "Apague " + n + " caracter"; return 1 != n && (r += "es"), r
        },
        inputTooShort: function (e) {
            return "Digite " + (e.minimum - e.input.length) + " ou mais caracteres"
        },
        loadingMore: function () {
            return "Carregando mais resultados…"
        },
        maximumSelected: function (e) {
            var n = "Você só pode selecionar " + e.maximum + " ite"; return1 == e.maximum ? n += "m" : n += "ns", n
        },
        noResults: function () {
            return "Nenhum resultado encontrado"
        },
        searching: function () {
            return "Buscando…"
        },
        removeAllItems: function () {
            return "Remover todos os itens"
        }
    });



} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
