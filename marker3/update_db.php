<?php
include '../server.php';

if (isset($_POST['update_all'])) {
    $watch_ids = $_POST['watch_ids'];
    $provinces = $_POST['provinces'];

    // Loop through the data and update the database
    for ($i = 0; $i < count($watch_ids); $i++) {
        $watch_id = mysqli_real_escape_string($conn, $watch_ids[$i]);
        $province = mysqli_real_escape_string($conn, $provinces[$i]);

        // Update the database
        $sql = "UPDATE `watch_log` SET watch_province = '$province'
                WHERE watch_id = '$watch_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated for watch_id $watch_id<br>";
        } else {
            echo "Error updating record for watch_id $watch_id: " . mysqli_error($conn) . "<br>";
        }
    }
}
?>