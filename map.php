<html>
<?php include 'header.php';?>
<body>
<!-- <li class="button-header margin-left "><a href="delete_php.php" class="btn">Done</a></li> -->
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
            minDistance();
            
        });

        // init or load map
        function initMap() {

            var myLatLng = {
                lat: 22.5593128,
                lng: 72.9184815
            };
            map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: myLatLng,});
        };

        function minDistance(){
            var srcAddress = getCookie("address");
            var desAddress = getdesAddress();
            origin=srcAddress;
            for(var i=0; i<desAddress.length;i++){
                calculateDistance(srcAddress,desAddress[i]);
            }

            setTimeout(() => { 
                
                var origin = getCookie("address");
                var destination =  getCookie("destaddress");
                var travel_mode = 'DRIVING';
                var directionsDisplay = new google.maps.DirectionsRenderer({'draggable': false});
                var directionsService = new google.maps.DirectionsService();
                displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
                
            }, 3000);
            

            setTimeout(() => { 
               sendAjaxRequest() ;
            }, 5000);
            
        };

        function getdesAddress(){
            var dest=[];
            $.ajax({
                url: 'getdradd.php',
                type: 'get',
                async: false,
                dataType: 'JSON',
                success: function(response){
                    var len = response.length;
                    for(var i=0; i<len; i++){
                        
                        dest.push(response[i].addr);
                        
                    }
                }
            });
            return dest;
        }
        
        function calculateDistance(origin, destination) {
            var DistanceMatrixService = new google.maps.DistanceMatrixService();
            DistanceMatrixService.getDistanceMatrix(
                {
                    origins: [origin],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode['DRIVING'],
                    //unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                    unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                    avoidHighways: false,
                    avoidTolls: false
                }, save_results);
            
        };

        // save distance results
        function save_results(response, status) {
            if (status != google.maps.DistanceMatrixStatus.OK) {
                $('#result').html(err);
            } else {
                var origin = response.originAddresses[0];
                var destination = response.destinationAddresses[0];
                // alert(destination);
                if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                    $('#result').html("Sorry , not available to use this travel mode between " + origin + " and " + destination);
                } else {
                    var distance = response.rows[0].elements[0].distance;
                    var distance_in_kilo = distance.value / 1000; // the kilo meter
//                    dist.push(distance_in_kilo);
                    if(mindist>distance_in_kilo){
                        mindist=distance_in_kilo;
                        setaddress(destination);
                    }
                 }
            }
        };

        function setaddress(destadd){
        document.cookie = "destaddress="+destadd;
        };

        function sendAjaxRequest() {
            var patientAdd = getCookie('address');
            var driverAdd = getCookie('destaddress');
            var res = '';
            $.ajax({
                url: 'DriverAssignedToPatient.php',
                type: 'POST',
                async: false,
                
                data: {
                    patientAdd:patientAdd,
                    driverAdd:driverAdd
                },
                success: function (response) {
                    // document.write(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                    // alert('error');
                }
            });
            
        };


        function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    var cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
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

    // get current Position
    function getCurrentPosition() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setCurrentPosition);
        } else {
            alert("Geolocation is not supported by this browser.")
        }
    };

    // get formatted address based on current position and set it to input
    function setCurrentPosition(pos) {
        var geocoder = new google.maps.Geocoder();
        var latlng = {lat: parseFloat(pos.coords.latitude), lng: parseFloat(pos.coords.longitude)};
        geocoder.geocode({ 'location' :latlng  }, function (responses) {
            console.log(responses);
            if (responses && responses.length > 0) {
                $("#origin").val(responses[1].formatted_address);
                $("#from_places").val(responses[1].formatted_address);
            } else {
                alert("Cannot determine address at this location.")
            }
        });
    };


</script>

  

</body>

</html>
