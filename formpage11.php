<?php

  $lat = $_REQUEST['lat1'];
  $lng = $_REQUEST['long1'];
  $address = $_REQUEST['address'];
  
?>

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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citizen View</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="form.css">
    <script src="form.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlPvIGpOeZxEjbdZOvDngpMzRCcxQ-dY0"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>





    <script>
    function initialize() {
        //getLocation();

        var latlng = new google.maps.LatLng(<?php echo "$lat,$lng";?>);

        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 13
        });
        var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            draggable: true,
            anchorPoint: new google.maps.Point(0, -29)
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var geocoder = new google.maps.Geocoder();
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            bindDataToForm(place.formatted_address, place.geometry.location.lat(), place.geometry.location
                .lng());
            infowindow.setContent(place.formatted_address);
            infowindow.open(map, marker);

        });


        // this function will work on marker move event into map 
        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        bindDataToForm(results[0].formatted_address, marker.getPosition().lat(), marker
                            .getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });
    }
    </script>


    <script type="text/javascript">
    function bindDataToForm(address, lat, lng) {
        document.getElementById('location').value = address;
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>




    <style>
    .input-controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #searchInput {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 100%;
    }

    #searchInput:focus {
        border-color: #4d90fe;
    }
    </style>



    <style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset,
    label {
        margin: 0;
        padding: 0;
    }

    body {
        margin: 20px;
    }

    h1 {
        font-size: 1.5em;
        margin: 10px;
    }

    /****** Style Star Rating Widget *****/

    .rating {
        border: none;
        float: left;
    }

    .rating>input {
        display: none;
    }

    .rating>label:before {
        margin: 5px;
        font-size: 2.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    .rating>.half:before {
        content: "\f089";
        position: absolute;
    }

    .rating>label {
        color: #ddd;
        float: right;
    }


    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating>input:checked~label,
    /* show gold star when clicked */
    .rating:not(:checked)>label:hover,
    /* hover current star */
    .rating:not(:checked)>label:hover~label {
        color: #FFD700;
    }

    /* hover previous stars in list */

    .rating>input:checked+label:hover,
    /* hover current star when changing rating */
    .rating>input:checked~label:hover,
    .rating>label:hover~input:checked~label,
    /* lighten current selection */
    .rating>input:checked~label:hover~label {
        color: #FFED85;
    }
    </style>





</head>

<body>
    <!--<body>-->
    <!-- left -->
    <div class="box" style="margin: -6% 0 0 6.5%; opacity: 0.1;"> </div>
    <div class="box" style="margin: 7.5% 0 0 -7%; opacity: 0.25;"> </div>
    <div class="box" style="margin: 21% 0 0 6.5%; opacity: 0.15;"> </div>
    <div class="box" style="margin: 34.5% 0 0 -7%; opacity: 0.1;"> </div>
    <div class="box" style="margin: 48% 0 0 6.5%; opacity: 0.2;"> </div>
    <!-- right -->
    <div class="box" style="margin: -6% 0 0 95%; opacity: 0.1;"> </div>
    <div class="box" style="margin: 7.5% 0 0 82%; opacity: 0.25;"> </div>
    <div class="box" style="margin: 21% 0 0 95%; opacity: 0.15;"> </div>
    <div class="box" style="margin: 34.5% 0 0 82%; opacity: 0.1;"> </div>
    <div class="box" style="margin: 48% 0 0 95%; opacity: 0.2;"> </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 " id="form_container">
                <h1>Citizen View : บอกกล่าวเล่าความรู้สึกของคุณ </h1>
                <!--<form method="post"  action="upload.php" method="post" enctype="multipart/form-data">-->
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <?php if(isset($_SESSION['file_v']) && isset($_SESSION['file_p'])) : ?>
                    <?php 
                    echo '<script>swal({
                            title: "อัปโหลดไม่สำเร็จ",
                            text: "กรุณาอัปโหลดไฟล์ชนิด png jpg jpeg mp4 mp3 หรือ mov เท่านั้น",
                            icon: "warning",
                            dangerMode: true,
                            });</script>';
                    unset($_SESSION['file_v']);
                    unset($_SESSION['file_p']);
                    ?>
                    <?php elseif(isset($_SESSION['file_v'])) : ?>
                    <?php 
                    echo '<script>swal({
                            title: "อัปโหลดวิดีโอไม่สำเร็จ",
                            text: "กรุณาอัปโหลดไฟล์วิดีโอชนิด mp4 mp3 หรือ mov เท่านั้น",
                            icon: "warning",
                            dangerMode: true,
                            });</script>';
                    unset($_SESSION['file_v']);
                    unset($_SESSION['file_p']);
                    ?>
                    <?php elseif(isset($_SESSION['file_p'])) : ?>
                    <?php 
                    echo '<script>swal({
                            title: "อัปโหลดรูปภาพไม่สำเร็จ",
                            text: "กรุณาอัปโหลดไฟล์รูปภาพชนิด png jpg หรือ jpeg เท่านั้น",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['file_v']);
                    unset($_SESSION['file_p']);
                    ?>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <!--<label for="name"> ที่นี่ คือ </label> -->
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="สถานที่ หรือกิจกรรม นี้คืออะไร" required>
                        </div>
                    </div>

                    <!-- star rating -->

                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <fieldset class="rating" required>
                                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5"
                                    title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half"
                                    for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4"
                                    title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half"
                                    for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3"
                                    title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half"
                                    for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2"
                                    title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half"
                                    for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1"
                                    title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half"
                                    for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset>
                        </div>
                    </div>
                    <!-- -->
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <textarea class="form-control" type="textarea" id="message" name="message" maxlength="6000"
                                rows="7" value='$message' placeholder="เรื่องราวที่อยากบอก" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php if(isset($_SESSION['name'])) : ?>
                            <label for="name"> ชื่อ:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อผู้ใช้งาน"
                                value="<?php echo $_SESSION['name']; ?>"
                                <?php if($_SESSION['username']!="guest"){echo "readonly";}?>>
                            <?php endif ?>
                        </div>
                        <div class="col-sm-6 form-group">
                            <?php if(isset($_SESSION['email'])) : ?>
                            <label for="email"> Email (ถ้ามี):</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล"
                                value="<?php echo $_SESSION['email']; ?>"
                                <?php if($_SESSION['username']!="guest"){echo "readonly";}?>>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label for="name2"> พิกัด</label>
                            <!--<input type="text" class="form-control" id="out_input1" name="lat" value='' required>
                                <input type="text" class="form-control" id="out_input2" name="lon" value ='' required>-->
                            <p id="demo"></p>

                            <script type="text/javascript"
                                src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDlPvIGpOeZxEjbdZOvDngpMzRCcxQ-dY0&libraries=places&language=en-AU">
                            </script>

                            <input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">
                            <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                            <div class="form_area">
                                <input style="width:30%;" type="text" name="location" id="location"
                                    value="<?php echo $address; ?>">
                                <input style="width:30%;" type="text" name="lat" id="lat" value="<?php echo $lat; ?>">
                                <input style="width:30%;" type="text" name="lon" id="lng" value="<?php echo $lng; ?>">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="name"> Upload รูปภาพ:</label>
                            <br />
                            <div>
                                <input style="width:90%;" type="file" name="fileToUpload[]" id="fileToUpload" multiple>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="name"> Upload วิดีโอ:</label>
                            <br />
                            <div>
                                <input style="width:90%;" type="file" name="videoToUpload" id="videoToUpload">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-sm-6 form-group"> -->
                        <button type="submit" class="btn-add">ส่งข้อมูล
                            &rarr;</button>
                        <!-- </div> -->

                    </div>
                    <?php if(isset($_SESSION['username'])) : ?>
                    <!-- <p><a href="formpage11.php?logout='1'" style="color:red;">Logout</a></p> -->
                    <a class="logout" href="formpage11.php?logout='1'"">ออกจากระบบ</a>
                    <?php endif ?>
                </form>
                <br>
                <div id=" success_message" style="width:100%; height:100%; display:none; ">
                        <h3>Posted your message successfully!</h3>
            </div>
            <div id="error_message" style="width:100%; height:100%; display:none; ">
                <h3>Error</h3> Sorry there was an error sending your form.
            </div>
        </div>
    </div>
    </div>
</body>


</html>