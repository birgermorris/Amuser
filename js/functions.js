var x = document.getElementById("error");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    $("#lat").val(position.coords.latitude);
    $("#lng").val(position.coords.longitude);
}

getLocation();