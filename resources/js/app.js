import { options } from "laravel-mix";
import Vue from 'vue'
import App from './App.vue'
import VueGeolocation from 'vue-browser-geolocation'


Vue.config.productionTip = false
Vue.use(VueGeolocation)

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDNVt4dCI9BwDl0F7hitw-ab_aKQ8xBtxg'
    }

})

const app = new Vue({
    el: '#app',
    data(){

        return {
            etablissements: [],
            infoWindowOptions: {
                pixelOffset:{
                    width: 0,
                    height: -35
                }
            },
            infoWindowPosition(){
                return{
                    lat: parseFloat(this.activeEtablissement.latitude),
                    lng: parseFloat(this.activeEtablissement.longitude),};
            },

            activeEtablissement: {},
            infoWindowOpened: false
        }

    }
});

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="input-group mb-3"><input placeholder="Enter Price" type="text" name="mytext[]" class="form-control"><div class="input-group-append"><button class="btn btn-outline-danger remove_field" type="button">Supprimer</button></div></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    })
});
