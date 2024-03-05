<?php
    include '../server.php';
    mysqli_set_charset($conn,"utf8");
    
    $quot = '"';
    $update = "UPDATE `watch_log` SET watch_message = REPLACE(REPLACE(REPLACE(watch_message, '$quot', ''), '\r', ' '), '\n', ' ')
        WHERE watch_message LIKE '%$quot%' OR
        watch_message LIKE '%\r%' OR
        watch_message LIKE '%\n%';";
    $result_update = mysqli_query($conn, $update);
    $data = "SELECT * FROM `watch_log` WHERE watch_status = 'อนุมัติ'";
    $result_data = mysqli_query($conn, $data);
    $fetch = mysqli_fetch_all($result_data);
    $count_data = count($fetch);

    $pic = "SELECT * FROM `watch_file_image`";
    $result_pic = mysqli_query($conn, $pic);
    $fetch_pic = mysqli_fetch_all($result_pic);
    $count_image = count($fetch_pic);

    $video = "SELECT * FROM `watch_file_video`";
    $result_video = mysqli_query($conn, $video);
    $fetch_video = mysqli_fetch_all($result_video);
    $count_video = count($fetch_video);

    $provinces = "SELECT name_th FROM `provinces`";
    $result_provinces = mysqli_query($conn, $provinces);
    $fetch_provinces = mysqli_fetch_all($result_provinces);
    $count_province = count($fetch_provinces)
?>