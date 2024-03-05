<?php
    session_start();
    include '../../server.php';

    // function getProvinceName($lon, $lat) {
    //     $latitude = $lat;
    //     $longitude = $lon;

    //     // Using OpenStreetMap Nominatim for reverse geocoding
    //     $nominatimUrl =
    //         "https://nominatim.openstreetmap.org/reverse?format=json&lat={$latitude}&lon={$longitude}&addressdetails=1";

    //     // Set User-Agent header
    //     $context = stream_context_create(['http' => ['header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36']]);
        
    //     // Make HTTP request and decode JSON response
    //     $response = file_get_contents($nominatimUrl, false, $context);
    //     $data = json_decode($response, true);

    //     if ($data && isset($data['address'])) {
    //         $address = $data['address'];
    //         // $provinceName = $address['state'] ?? $address['county'] ?? $address['region'] ?? 'Not Available';
    //         $provinceName = str_replace('จังหวัด', '', $address['state'] ?? $address['county'] ?? $address['region'] ?? 'Not Available');
    //         return $provinceName;
    //     } else {
    //         return 'Unknown';
    //     }
    // }

        if(isset($_POST['confirm']) || isset($_POST['reject'])){
            if(isset($_POST['confirm'])){
                $status = "อนุมัติ";
            }else if(isset($_POST['reject'])){
                $status = "ไม่อนุมัติ";
            }
            $errors = array();
            $watch_id = mysqli_real_escape_string($conn, $_POST['watch_id']);

            $data_check_query = "SELECT * FROM watch_log WHERE watch_id = '$watch_id'";
            $query = mysqli_query($conn, $data_check_query);
            $result = mysqli_fetch_assoc($query);
            // $lon = $result['watch_lon'];
            // $lat = $result['watch_lat'];
            // $province = getProvinceName($lon,$lat);
            if($result){
                if($result['watch_id'] !== $watch_id){
                    array_push($errors, "not found id");
                    $_SESSION['error'] = "not found id";
                    header("location: view_info.php?watch_id=$watch_id");
                }
            }
            if(count($errors) == 0){
                $sql = "UPDATE watch_log
                SET `watch_status`='$status' WHERE watch_id = '$watch_id'";
                // $sql = "UPDATE watch_log SET `watch_status`='$status',`watch_province`='$province' WHERE watch_id = '$watch_id'";
                mysqli_query($conn, $sql);
                if(isset($_POST['confirm'])){
                    $_SESSION['confirm'] = "อนุมัติสำเร็จ";
                }else if(isset($_POST['reject'])){
                    $_SESSION['reject'] = "ไม่อนุมัติสำเร็จ";
                }
                header('location: manage_data.php');
            }
        }
    // if(isset($_POST['confirm'])){
    //     $errors_confirm = array();
    //     $watch_id = mysqli_real_escape_string($conn, $_POST['watch_id']);
    //     $status = "อนุมัติ";

    //     $data_check_query = "SELECT * FROM watch_log WHERE watch_id = '$watch_id'";
    //     $query = mysqli_query($conn, $data_check_query);
    //     $result = mysqli_fetch_assoc($query);

    //     if($result){
    //         if($result['watch_id'] !== $watch_id){
    //             array_push($errors_confirm, "not found id");
    //             $_SESSION['error_confirm'] = "not found id";
    //             header("location: view_info.php?watch_id=$watch_id");
    //         }
    //     }
    //     if(count($errors_confirm) == 0){
    //         $sql = "UPDATE watch_log
    //         SET `watch_status`='$status' WHERE watch_id = '$watch_id'";
    //         mysqli_query($conn, $sql);
            
    //         $_SESSION['confirm'] = "อนุมัติสำเร็จ";
    //         header('location: manage_data.php');
    //     }
    // }
    
    // if(isset($_POST['reject'])){
    //     $errors_reject = array();
    //     $watch_id = mysqli_real_escape_string($conn, $_POST['watch_id']);
    //     $status = "ไม่อนุมัติ";

    //     $data_check_query = "SELECT * FROM watch_log WHERE watch_id = '$watch_id'";
    //     $query = mysqli_query($conn, $data_check_query);
    //     $result = mysqli_fetch_assoc($query);

    //     if($result){
    //         if($result['watch_id'] !== $watch_id){
    //             array_push($errors_reject, "not found id");
    //             $_SESSION['error_reject'] = "not found id";
    //             header("location: view_info.php?watch_id=$watch_id");
    //         }
    //     }
    //     if(count($errors_confirm) == 0){
    //         $sql = "UPDATE watch_log
    //         SET `watch_status`='$status' WHERE watch_id = '$watch_id'";
    //         mysqli_query($conn, $sql);
            
    //         $_SESSION['reject'] = "ไม่อนุมัติสำเร็จ";
    //         header('location: manage_data.php');
    //     }
    // }
    
?>