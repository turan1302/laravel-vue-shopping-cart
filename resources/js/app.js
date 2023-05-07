/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import AppComponent from './components/AppComponent.vue';

app.component('app-component', AppComponent);

/** LAYOUT KISIMLARINI DAHİL EDELİM **/

// NAVBAR
import NavbarComponent from './components/layouts/NavbarComponent.vue';
app.component('navbar-component', NavbarComponent);

// HEADER
import HeaderComponent from './components/layouts/HeaderComponent.vue';
app.component('header-component', HeaderComponent);

// FOOTER
import FooterComponent from './components/layouts/FooterComponent.vue';
app.component('footer-component', FooterComponent);

/************************* ****************/

/** ROUTER KISMI **/
import router from "./router";
import mixin from "./mixins/common"

/** SWEET ALERT KISMI **/  // GLOBAL OLARAK HER YERDE KULLANABİLMEMİZ İÇİN
import Swal from 'sweetalert2'
window.Swal = Swal;

/** TOAST KISMI **/
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast;

import toastNotification from "./helper/ToastNotification";
window.ToastNotification = toastNotification;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

/** EVENT BUS ISLEMI ICIN KULLANCAZ **/
import mitt from 'mitt';
const emitter = mitt();
app.config.globalProperties.emitter = emitter;

app
    .use(router)
    .mixin(mixin)
    .mount('#app');
