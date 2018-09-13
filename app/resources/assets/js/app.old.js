/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDuPu-7Fug1nN-GO9_IBnLq1Gli5P1C324'
    }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('location-entry', require('./components/locationEntry.component.vue'));
Vue.component('location-list', require('./components/locationList.component.vue'));
Vue.component('location-map', require('./components/locationMap.component.vue'));

const app = new Vue({
    el: '#app',
    data: {
        latitude: 38.926737,
        longitude: -94.716811,
        currentLocation: {},
        locations: []
    },
    mounted: function() {
        // Get the browsers location
        navigator.geolocation.getCurrentPosition((position) => {
            this.latitude = position.coords.latitude.toFixed(6);
            this.longitude = position.coords.longitude.toFixed(6);

            // Call for locations based on the browser latitude/longitude values returned
            this.getLocations();
        });
    },
    methods: {
        // Make a call to the API to get all locations based on the provided latitude/longitude values
        getLocations: function() {
            $.ajax({
                method: "GET",
                url: `/api/locations/${this.latitude}/${this.longitude}`,
                dataTyle: "json"
            }).then((response) => {
                // Set some default values in the returned locations array
                this.locations = _.map(response, (location) => {
                    location.isSelected = false;
                    location.animation = null;

                    // Position object used in the google map component
                    location.latLng = {
                        lat: parseFloat(location.latitude),
                        lng: parseFloat(location.longitude)
                    };

                    return location;
                });

                // Select the first location of those returned
                this.selectLocation(this.locations[0]);

            }).fail(function(error) {
                console.error(error);
            });

        },
        selectLocation: function(location) {
            // Reset the selected flag and animation for all locations
            _.forEach(this.locations, (loc) => {
                loc.isSelected = false;
                loc.animation = null;
            });

            // Find the location that's been selected out of all stored locations
            let l = _.find(this.locations, (loc) => {
                return loc.id === location.id;
            });

            // Set that location as the selected location and animate its marker
            l.isSelected = true;
            l.animation = google.maps.Animation.BOUNCE;
        }
    }
});
