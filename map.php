<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Places Searchbox</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    h1 {
      text-align: center;
    }
    a {
      color: gray;
      text-decoration: none;
      font-weight: bold;
    }
    </style>
  </head>
  <body>
    <a href="home.php"> &#8592 Home </a>
    <h1>
      <img src="logo.png" alt="KMKitchen" width=350 height=100>
    </h1>
    <div id="map"></div>
     <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
        var c = {lat: -34.397, lng: 150.644}
        map = new google.maps.Map(document.getElementById('map'), {
          center: c,
          zoom: 15
        });
        
        infoWindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: {lat: 42.381235, lng: -71.125735},
          radius: 500,
          type: ['store']
        }, callback);
      


        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
    

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

      }


      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infowindow.setPosition(pos);
        infowindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }


      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }

    </script>

  <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB44jhGJTeC3QMlC9MqJIN8s4RJNXDBFAg&libraries=places&callback=initMap"
         async defer></script>


  </body>
</html>
<!--<html>
  <head>
    <title>Local food</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="script.js"></script>
  </head>
  <body onload="initialize()">
    <script>
      var map;
      var infowindow;

      function initMap() {
        var pyrmont = {lat: -33.867, lng: 151.195};

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: 500,
          keyword: 'grocery'
          // type: ['grocery_or_supermarket']
        }, callback);
      }

      

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script> -->
  
<!--     <script>
//       var map;
// var infoWindow;
// var service;

// function initMap() {
//   map = new google.maps.Map(document.getElementById('map'), {
//     center: {lat: -33.867, lng: 151.206},
//     zoom: 15,
//     styles: [{
//       stylers: [{ visibility: 'simplified' }]
//     }, {
//       elementType: 'labels',
//       stylers: [{ visibility: 'off' }]
//     }]
//   });

//   infoWindow = new google.maps.InfoWindow();
//   service = new google.maps.places.PlacesService(map);

//   // The idle event is a debounced event, so we can query & listen without
//   // throwing too many requests at the server.
//   map.addListener('idle', performSearch);
// }

// function performSearch() {
//   var request = {
//     bounds: map.getBounds(),
//     keyword: 'best view'
//   };
//   service.radarSearch(request, callback);
// }

// function callback(results, status) {
//   if (status !== google.maps.places.PlacesServiceStatus.OK) {
//     console.error(status);
//     return;
//   }
//   for (var i = 0, result; result = results[i]; i++) {
//     addMarker(result);
//   }
// }

// function addMarker(place) {
//   var marker = new google.maps.Marker({
//     map: map,
//     position: place.geometry.location,
//     icon: {
//       url: 'http://maps.gstatic.com/mapfiles/circle.png',
//       anchor: new google.maps.Point(10, 10),
//       scaledSize: new google.maps.Size(10, 17)
//     }
//   });

//   google.maps.event.addListener(marker, 'click', function() {
//     service.getDetails(place, function(result, status) {
//       if (status !== google.maps.places.PlacesServiceStatus.OK) {
//         console.error(status);
//         return;
//       }
//       infoWindow.setContent(result.name);
//       infoWindow.open(map, marker);
//     });
//   });
// }
//     </script> -->
<!--<body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDz4uD00sinbXRHH9mNHqEGcrm_b1NIIxs&libraries=places&callback=initMap" async defer></script>
  </body>
</html>-->
<!-- infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
              location: pyrmont,
              radius: 500,
              keyword: 'grocery'
              // type: ['grocery_or_supermarket']
              }, callback);
            
        function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);  -->