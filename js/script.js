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

    var map, infoWindow;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

});