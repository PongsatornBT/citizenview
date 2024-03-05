<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Reverse Geocoding</title>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlPvIGpOeZxEjbdZOvDngpMzRCcxQ-dY0&callback=initMap">
    </script>
    <script type="text/javascript">
    var geocoder;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
    }
    //Get the latitude and the longitude;
    function successFunction(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        codeLatLng(lat, lng)
    }

    function errorFunction() {
        alert("Geocoder failed");
    }

    function initialize() {
        geocoder = new google.maps.Geocoder();



    }

    function codeLatLng(lat, lng) {

        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({
            'latLng': latlng
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                console.log(results)
                if (results[1]) {
                    //formatted address
                    //alert(results[0].formatted_address+"---->"+lat)
                    window.location.assign('formpage11.php?lat1=' + lat + '&long1=' + lng + '&address=' +
                        results[0].formatted_address);



                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }
    </script>
</head>

<body onload="initialize()">

</body>

</html>