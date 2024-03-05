<?php
    include '../server.php';
    mysqli_set_charset($conn,"utf8");
    $count_data = "SELECT COUNT(watch_id) FROM `watch_log`";
    $result = mysqli_query($conn, $count_data);
    $resultfetch = mysqli_fetch_all($result);
    $count_data = $resultfetch[0][0];

    $count_data_pic = "SELECT COUNT(watch_id) FROM `watch_file_image`";
    $result2 = mysqli_query($conn, $count_data_pic);
    $resultfetch2 = mysqli_fetch_all($result2);
    $count_image = $resultfetch2[0][0];

    $count_data_video = "SELECT COUNT(watch_id) FROM `watch_file_video`";
    $result3 = mysqli_query($conn, $count_data_video);
    $resultfetch3 = mysqli_fetch_all($result3);
    $count_video = $resultfetch3[0][0];

    $count_data_provinces = "SELECT COUNT(id) FROM `provinces`";
    $result4 = mysqli_query($conn, $count_data_provinces);
    $resultfetch4 = mysqli_fetch_all($result4);
    $count_province = $resultfetch4[0][0];
    
    $quot = '"';
    $update = "UPDATE `watch_log` SET watch_message = REPLACE(REPLACE(REPLACE(watch_message, '$quot', ''), '\r', ' '), '\n', ' ')
        WHERE watch_message LIKE '%$quot%' OR
        watch_message LIKE '%\r%' OR
        watch_message LIKE '%\n%';";
    $result_update = mysqli_query($conn, $update);
    $data = "SELECT * FROM `watch_log`";
    $result_data = mysqli_query($conn, $data);
    $fetch = mysqli_fetch_all($result_data);

    $pic = "SELECT * FROM `watch_file_image`";
    $result_pic = mysqli_query($conn, $pic);
    $fetch_pic = mysqli_fetch_all($result_pic);

    $video = "SELECT * FROM `watch_file_video`";
    $result_video = mysqli_query($conn, $video);
    $fetch_video = mysqli_fetch_all($result_video);

    $provinces = "SELECT name_th FROM `provinces`";
    $result_provinces = mysqli_query($conn, $provinces);
    $fetch_provinces = mysqli_fetch_all($result_provinces);
    
    $update = "UPDATE `watch_log` SET watch_province = REPLACE(REPLACE(REPLACE(watch_message, '$quot', ''), '\r', ' '), '\n', ' ')
        WHERE watch_message LIKE '%$quot%' OR
        watch_message LIKE '%\r%' OR
        watch_message LIKE '%\n%';";
    $result_update = mysqli_query($conn, $update);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <form action="update_db.php" method="post">
        <?php for ($i = $count_data-500; $i < $count_data; $i++) {
        if ($fetch[$i][5] != '' && $fetch[$i][6] != '') { ?>
        <input type="hidden" name="watch_ids[]" value="<?php echo $fetch[$i][0]; ?>">
        <input type="text" name="provinces[]" id="provinceField_<?php echo $i; ?>" placeholder="Province">
        <?php }} ?>
        <button type="submit" name="update_all">บันทึกทั้งหมด</button>
    </form>


    <script>
    // Place your JavaScript code here

    let provinceFeatures;

    fetch('province.geojson')
        .then(response => response.json())
        .then(data => {
            provinceFeatures = data.features;
        });

    function pointInPolygon(point, vs) {
        let inside = false;
        for (let i = 0, j = vs.length - 1; i < vs.length; j = i++) {
            const xi = vs[i][0],
                yi = vs[i][1];
            const xj = vs[j][0],
                yj = vs[j][1];
            const intersect = ((yi > point[1]) !== (yj > point[1])) &&
                (point[0] < (xj - xi) * (point[1] - yi) / (yj - yi) + xi);
            if (intersect) inside = !inside;
        }
        return inside;
    }

    function getProvince(lon, lat) {
        const point = [lon, lat];
        for (const feature of provinceFeatures) {
            if (pointInPolygon(point, feature.geometry.coordinates[0])) {
                return feature.properties.pv_tn;
            }
        }
        return "Unknown";
    }

    // Add an event listener to dynamically populate the province field
    <?php for ($i = $count_data-500; $i < $count_data; $i++) {
            if ($fetch[$i][5] != '' && $fetch[$i][6]) { ?>
    const provinceField_<?php echo $i; ?> = document.getElementById("provinceField_<?php echo $i; ?>");
    provinceField_<?php echo $i; ?>.addEventListener("focus", () => {
        const lat = <?php echo $fetch[$i][5]; ?>;
        const lon = <?php echo $fetch[$i][6]; ?>;
        provinceField_<?php echo $i; ?>.value = getProvince(lon, lat);
    });
    <?php }} ?>
    </script>
</body>

</html>