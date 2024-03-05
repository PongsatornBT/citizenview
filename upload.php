<?php
    include 'server.php';
    session_start();
    
    function getProvinceName($lon, $lat) {
        $latitude = $lat;
        $longitude = $lon;

        // Using OpenStreetMap Nominatim for reverse geocoding
        $nominatimUrl =
            "https://nominatim.openstreetmap.org/reverse?format=json&lat={$latitude}&lon={$longitude}&addressdetails=1";

        // Set User-Agent header
        $context = stream_context_create(['http' => ['header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36']]);
        
        // Make HTTP request and decode JSON response
        $response = file_get_contents($nominatimUrl, false, $context);
        $data = json_decode($response, true);

        if ($data && isset($data['address'])) {
            $address = $data['address'];
            // $provinceName = $address['state'] ?? $address['county'] ?? $address['region'] ?? 'Not Available';
            $provinceName = str_replace('จังหวัด', '', $address['state'] ?? $address['county'] ?? $address['region'] ?? 'Not Available');
            return $provinceName;
        } else {
            return 'Unknown';
        }
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
    <!-- <script src="form.js"></script> -->


</head>

<body>
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
                <h2>Citizen View</h2>
                <?php
                    // $handle = fopen('province.geojson', 'r');
                    // $provinceFeatures = [];

                    // if ($handle) {
                    //     $geojson = json_decode(fread($handle, filesize('province.geojson')), true);
                    //     if ($geojson !== null && isset($geojson['features'])) {
                    //         $provinceFeatures = $geojson['features'];
                    //     }
                    //     fclose($handle);
                    // }

                    date_default_timezone_set('Asia/Bangkok');
                    $date=date("Y-m-d h:i:sa");

                    //get watch_id
                    $watch_id = "SELECT max(watch_id) as watch_id FROM watch_log";
                    $result2 = mysqli_query($conn, $watch_id);
                    $resultCheck2 = mysqli_num_rows($result2);
                    if($resultCheck2 > 0){
                        while($row = mysqli_fetch_assoc($result2)){
                            $watch_id = $row['watch_id'] + 1;
                            //เอาค่า watch_id ล่าสุด ลองรัน push ก่อนแล้วมัน error
                        }
                    }
                    $countWrongFileType = 0;
                    //upload video
                    $uploaddirvideo = 'uploads/video/';
                    $uploadfileVideo = $uploaddirvideo . basename($_FILES['videoToUpload']['name']);
                    $mime_types_video = ["video/mp4","video/mp3","video/quicktime"]; //quicktime == mov file type
                    if(in_array($_FILES["videoToUpload"]["type"], $mime_types_video)){
                        $video = basename($_FILES['videoToUpload']['name']);
                        $i = 1;
                        $file_video = pathinfo($uploadfileVideo);
                        // echo $file_video['extension'];
                        // echo $file_video['filename'];
                        while(file_exists($uploadfileVideo)){
                            $uploadfileVideo = $uploaddirvideo.$file_video['filename'].' ('.$i.')' . '.' . $file_video['extension'];
                            $video = $file_video['filename'].' ('.$i++.')' . '.' . $file_video['extension'];
                            // print_r($_FILES['videoToUpload']);
                        }
                        if (move_uploaded_file($_FILES['videoToUpload']['tmp_name'], $uploadfileVideo)) {
                            if($video != NULL){
                            $video_watch = "INSERT INTO watch_file_video (file_video_name,watch_id) VALUES ('$video','$watch_id')";
                                if ($conn->query($video_watch) === TRUE) {
                                }
                            }
                        }
                    }else{
                        $video = basename($_FILES['videoToUpload']['name']);
                        if($video != NULL){
                            $countWrongFileType++;
                            $_SESSION['file_v'] = "Wrong file type";
                            header("location: index.php");
                        }
                    }

                    // upload picture
                    $uploaddir = 'uploads/picture/';
                        // $allowedExtensions = ['heic'];
                        $fileCount = count($_FILES['fileToUpload']['name']);
                        $mime_types = ["image/png","image/jpg","image/jpeg"];
                        for($i=0;$i<$fileCount;$i++){
                            if(in_array($_FILES["fileToUpload"]["type"][$i], $mime_types)){
                                $uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name'][$i]);
                                $pic = basename($_FILES['fileToUpload']['name'][$i]);
                                $j = 1;
                                $file_pic = pathinfo($uploadfile);
                                while(file_exists($uploadfile)){
                                    $uploadfile = $uploaddir.$file_pic['filename'].' ('.$j.')' . '.' . $file_pic['extension'];
                                    $pic = $file_pic['filename'].' ('.$j++.')' . '.' . $file_pic['extension'];
                                }
                                
                                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], $uploadfile)) {
                                    if($pic != NULL){
                                        $watch = "INSERT INTO watch_file_image (file_image_name,watch_id) VALUES ('$pic','$watch_id')";
                                        if ($conn->query($watch) === TRUE) {
                                        }
                                    }
                                }
                            }else{
                                $pic = basename($_FILES['fileToUpload']['name'][$i]);
                                if($pic != NULL){
                                    $countWrongFileType++;
                                    $_SESSION['file_p'] = "Wrong file type";
                                    header("location: index.php");
                                }
                            }
                        }
                        
                        echo '<pre>';
                        if($countWrongFileType == 0){
                            echo "ขอบคุณสำหรับข้อมูล <br>";
                            echo $date;
                            include 'push.php';
                            echo " <br> <br> <a href='php_location2.php'> กลับหน้าหลัก</a>";
                        }else{
                            echo "ขอบคุณสำหรับข้อมูล <br>";
                            echo $date;
                            include 'push.php';
                            echo " <br> <br> <a href='php_location2.php'> กลับหน้าหลัก</a>";
                        }
                        print "</pre>";
                    ?>
            </div>
        </div>
    </div>
</body>


</html>