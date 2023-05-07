import {createRouter, createWebHistory} from 'vue-router';

let front_prefix = '/';

/********!!!!!!! FRONT KISMI !!!!!!!********/
import front_component from '../components/AppComponent.vue';


/** FRONT HOME **/
import front_home from '../components/myComponents/HomeComponent.vue';

/** FRONT SEPET **/
import front_sepet from '../components/myComponents/SepetComponent.vue';


const routes = [
    /** FRONT KISMLARI **/
    {
        path : front_prefix,
        component : front_component,
        children : [
            /** ANASAYFA KSIMI **/
            {path : front_prefix ,component : front_home, name : 'front_home'},

            /** SEPET SAYFASI KISMI **/
            {path : front_prefix+"sepet" ,component : front_sepet, name : 'front_sepet'},
        ],
    },
];

export default new createRouter({
    history : createWebHistory(),
    routes
})
