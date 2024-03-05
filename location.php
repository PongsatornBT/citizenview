<html>
  <head>
    <title>Event Click LatLng</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
            <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cultural Watch</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>
  </head>
 
  
  <style>
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 30%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

  </style>
  <body onload="getLocation()">

  

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlPvIGpOeZxEjbdZOvDngpMzRCcxQ-dY0&callback=initMap&v=weekly&channel=2"
      async
    ></script> 
    
        <div class="container">
        
            <div class="row">
                <div class="col-md-6 " id="form_container">
                    <h2>Cultural Watch</h2> 
                    <p> ส่งข้อความด้านล่าง สำหรับแจ้งข้อมูล </p>
                    <!--<form method="post"  action="upload.php" method="post" enctype="multipart/form-data">-->
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="message"> ข้อความ:</label>
                                <textarea class="form-control" type="textarea" id="message" name="message" maxlength="6000" rows="7" value='$message'></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name"> ชื่อ:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email"> Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6 form-group" id="map"></div>
                            <div class="col-sm-6 form-group">
                                <label for="name2"> พิกัด</label>
                                <!--<input type="text" class="form-control" id="out_input1" name="lat" value='' required>
                                <input type="text" class="form-control" id="out_input2" name="lon" value ='' required>
                                -->
                               
                                <input type="text" class="form-control" id="out_input3" name="latlon" value ='' required>
                                <p id="demo"></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="name">  Upload รูปภาพ:</label>
                                <br/>
                                <div>
                                    <!--<button type="button" class="btn btn-default" >Browse</button>-->
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button type="submit"  class="btn btn-lg btn-default pull-right" >Send &rarr;</button>
                            </div>
                        </div>
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Posted your message successfully!</h3> </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                </div>
            </div>
        </div>
    </body>
    
<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
    
function showPosition(position) {
    x.innerHTML="Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
    var loc1  = position.coords.latitude;
    var loc2 = position.coords.longitude;
    document.getElementById("out_input1").value =  loc1 ;
    document.getElementById("out_input2").value =  loc2 ;
    document.getElementById("out_input3").value =  loc2 ;
}


function initMap() {
  const myLatlng = { lat: 13.8894084, lng: 100.5035457 };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 30,
    center: myLatlng,
  });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);
    document.getElementById("out_input3").value =  mapsMouseEvent.latLng;

  });
}
 
  
</script>
</html>