<html>
<?php include 'header.php';?>

<body>

<div id="map" style="height: 100%; width: 100%" ></div>

<script>

var travel_mode = "DRIVING";
var mindist=100000000;
var map;
var origin = "" ;

    $(function () {
        var origin, destination, map;

        // add input listeners
        google.maps.event.addDomListener(window, 'load', function (listener) {
            initMap();
            var origin = getCookie("drSrAddress");
                var destination =  getCookie("drdestaddress");
                var travel_mode = 'DRIVING';
                var directionsDisplay = new google.maps.DirectionsRenderer({'draggable': false});
                var directionsService = new google.maps.DirectionsService();
                displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
        });

        // init or load map
        function initMap() {

            var myLatLng = {
                lat: 22.5593128,
                lng: 72.9184815
            };
            map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: myLatLng,});
        };


        function getCookie(name) 
        {
            var cookieArr = document.cookie.split(";");
            for(var i = 0; i < cookieArr.length; i++) {
                var cookiePair = cookieArr[i].split("=");
                if(name == cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        };

        function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: travel_mode,
                avoidTolls: true
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                } else {
                    directionsDisplay.setMap(null);
                    directionsDisplay.setDirections(null);
                    alert('Could not display directions due to: ' + status);
                }
            });
        }

    });


 

</script>

  

</body>

</html>
