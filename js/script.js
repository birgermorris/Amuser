$(document).ready(function() {
    $(".addReaction").click(function(e) {
        e.preventDefault(); // submit tegenhouden
        // message ophalen uit het textvak
        $element = $(this);
        var id = $(this).data("id");
        var valueReaction = $element.prev().val();
        console.log(id + " " + valueReaction);
        if (valueReaction == "") {} else {
            $.ajax({
                    method: "POST",
                    url: "./ajax/addReaction.php",
                    data: { reaction: valueReaction, dataid: id }
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        console.log("test")
                        var nieuweReactie = "<p>" + response.user_name + ": " + response.text + "</p>";
                        $(".reactions[data-id=" + response.dataid + "]").append(nieuweReactie);
                        $element.prev().val("");
                        //$(".reactions[data-id=" + response.dataid + "] noComments").text('');
                    } else {
                        console.log(response.dataid);
                    }
                });
        }
    });

});

function success(position) {
    var s = document.querySelector('#status');

    if (s.className == 'success') {
        // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back    
        return;
    }

    s.innerHTML = "found you!";
    s.className = 'success';

    var mapcanvas = document.createElement('div');
    mapcanvas.id = 'mapcanvas';
    mapcanvas.style.height = '400px';
    mapcanvas.style.width = '560px';

    document.querySelector('article').appendChild(mapcanvas);

    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeControl: false,
        navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: "You are here!"
    });
}

function error(msg) {
    var s = document.querySelector('#status');
    s.innerHTML = typeof msg == 'string' ? msg : "failed";
    s.className = 'fail';

    // console.log(arguments);
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error);
} else {
    error('not supported');
}

$("#load").click(function() {
    Loadmore();
});

function Loadmore() {
    $ajax({
        type: 'post',
        url: '',
        data: {
            getresult: val
        },
        success: function(response) {
            var content = '';
            content.innerHTML = content.innerHTML + response;

            //increase value with 20
        }
    })
}

(function() {
    var App = {
        errorFunction: function() {

        },

        initialize: function() {
            App.getLocation();
        },

        getLocation: function() {
            navigator.geolocation.getCurrentPosition(App.foundPosition);
        },

        foundPosition: function(cords) {
            var lat = cords.coords.latitude;
            var lng = cords.coords.longitude;
            App.codeLatLng(lat, lng);
        },

        codeLatLng: function(lat, lng) {

            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'latLng': latlng }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log((results))
                    if (results[1]) {
                        //formatted address
                        //find country name
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var b = 0; b < results[0].address_components[i].types.length; b++) {

                                //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                if (results[0].address_components[i].types[b] == "locality") {
                                    //this is the object you are looking for
                                    city = results[0].address_components[i];
                                    break;
                                }
                            }
                        }
                        //city data
                        document.getElementById('cords').value = city.long_name;

                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        }
    }
    App.initialize();
}());