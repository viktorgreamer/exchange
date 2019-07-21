var map;
var markers = [];
var infoWindows = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 50.45466, lng: 30.5238},
        zoom: 8
    });
}

function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
}

function addMarker(rate, map) {

    var infoWindow = new google.maps.InfoWindow({
        content: rate.point.name
    });

    infoWindows.push(infoWindow);

    var  marker = new google.maps.Marker({
        position: {lat: parseFloat(rate.point.latitude), lng: parseFloat(rate.point.longitude)},
        icon: '/img/marker-red.png',
        label: rate.sell.toString(),
        map: map
    });

    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });

    markers.push(marker);

}


initMap();


var app = new Vue({
    el: '#app',
    data: {
        pair_id: null,
        type: 'buy',
        city_id: null,
        region_id: null,
        cities: null,
        pairs: null,
        regions: null,
        rates: null,

    },

    methods: {
        getRates() {
            axios.get('/rates', {
                params: {
                    city_id: this.city_id,
                    region_id: this.region_id,
                    type: this.type,
                    pair_id: this.pair_id
                }
            })
                .then(function (response) {
                    if (response.status) {
                        app.rates = response.data;
                        if (app.rates) {

                            for (let i = 0; i < markers.length; i++) {
                                markers[i].setMap(null);
                            }

                            for (let i = 0; i < app.rates.length; i++) {
                                addMarker(app.rates[i], map);
                            }
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {

                });
        },

        getCities() {
            axios.get('/api/cities', {})
                .then(function (response) {

                    app.cities = response.data;
                    if (app.cities) {
                        app.city_id = parseInt(app.cities[0].id);
                        app.getRegions();
                    }

                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {

                });
        },
        getRegions() {
            axios.get('/api/regions', {
                params: {
                    city_id: this.city_id,
                }
            })
                .then(function (response) {

                    app.regions = response.data;

                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {

                });
        },
        getPairs() {
            axios.get('/api/pairs', {})
                .then(function (response) {

                    app.pairs = response.data;

                    if (app.pairs) {
                        app.pair_id = parseInt(app.pairs[0].id);
                    }


                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {

                });
        },
    },

    mounted() {
        this.getRates();
        this.getPairs();
        this.getCities();
    }

})
