<?php
    session_start();
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You must login first";
        header('location: loginpage.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: loginpage.php');
    }
?>
<!DOCTYPE html>
<html>
<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(redirectToPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function redirectToPosition(position) {
    //window.location.href ='formpage10.php?lat1='+position.coords.latitude+'&long1='+position.coords.longitude;
    //window.location = 'formpage10.php?lat1='+position.coords.latitude+'&long1='+position.coords.longitude;
    //location.assign('formpage10.php?lat1='+position.coords.latitude+'&long1='+position.coords.longitude);

    window.location.assign('formpage11.php?lat1=' + position.coords.latitude + '&long1=' + position.coords.longitude);
}
</script>

<body onload="getLocation()">
    <!--onload="getLocation()" use it for on load page-->

    <!--<button onclick="getLocation()">Try It</button>-->


    <?php

echo $lat1=(isset($_GET['lat']))?$_GET['lat']:'';
echo $long1=(isset($_GET['long']))?$_GET['long']:'';

//do whatever you want

?>
</body>

</html>