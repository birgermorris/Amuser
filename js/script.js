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

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        e.preventDefault();
    }
});
/*
function showPosition(position) {
    $("#myloc").innerHTML = "longitude " +
        position.coords.longitude + "<br> Latitude: " +
        postion.coords.latitude + "<br>";
}
*/