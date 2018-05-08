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

    $("#btnLoadMore").on("click", function(e) {


    });
    /*
        $("#btnLocation").click(function myLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                e.preventDefault();
            }
        });

        function showPosition(position) {
            $("#myloc").innerHTML = "longitude " +
                position.coords.longitude + "<br> Latitude: " +
                postion.coords.latitude + "<br>";
        }
        */
    var customLabel = {
        restaurant: {
            label: 'R'
        },
        bar: {
            label: 'B'
        }
    };

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(-33.863276, 151.207977),
            zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
                var id = markerElem.getAttribute('id');
                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('address');
                var type = markerElem.getAttribute('type');
                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));

                var infowincontent = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = name
                infowincontent.appendChild(strong);
                infowincontent.appendChild(document.createElement('br'));

                var text = document.createElement('text');
                text.textContent = address
                infowincontent.appendChild(text);
                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    label: icon.label
                });
                marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });
            });
        });
    }



    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
});