var geocoder;
var map;
var map2;

function initialize() {

    //Checks to see if geolocation supported.  If so, gets current position and runs function geolocationSuccess.    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationFailure);
    } else {
        alert("Your browser does not support geolocation.");
    }

    //Uses coordinates for users position to create home map on left.
    function geolocationSuccess(position) {

        var location = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        var myOptions = {
            zoom: 11,
            center: location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("mapHome"), myOptions);
        //Optional info window on home map.
        var infowindow = new google.maps.InfoWindow();
            infowindow.setContent("You are here!");
            infowindow.setPosition(location);
            infowindow.open(map);
    }

    //If geolocation fails after the test determines that it is supported in the browser, then it failed for one of the following reasons.  Creates alert.
    function geolocationFailure(positionError) {
        if (positionError.code == 1) {
            alert("You have decided not to share your location.");
        } else if (positionError.code == 2) {
            alert("The positioning service cannot be reached at this time.");
        } else if (positionError.code == 3) {
            alert("The attempt timed out before it could get the location data.");
        } else {
            alert("An unknown error has occurred.");
        }
    }

//Use geocoder from Google maps API to encode new address entered into text box.
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var sAddress = document.getElementById("enterDestination").value;
    geocoder.geocode( { 'address': sAddress}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        map2.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map2,
            position: results[0].geometry.location
        });
    } else {
        alert("Geocode failed for the following reason: " + status);
    }
});
}