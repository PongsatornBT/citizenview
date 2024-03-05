<?php
include 'server.php';
    // Function to get province by latitude and longitude
    function getProvinceByLatLon($latitude, $longitude, $geoJsonData) {
        // Loop through each feature
        foreach ($geoJsonData['features'] as $feature) {
            // Extract the coordinates of the polygon
            $coordinates = $feature['geometry']['coordinates'][0];

            // Check if the point is inside the polygon
            if (isPointInPolygon($latitude, $longitude, $coordinates)) {
                // Return the province name
                return $feature['properties']['pv_tn'];
            }
        }

        // If no matching province is found, return null
        return 'Unknown';
    }

    // Function to check if a point is inside a polygon
    function isPointInPolygon($latitude, $longitude, $polygon) {
        $isInside = false;
        $verticesCount = count($polygon);
        $j = $verticesCount - 1;

        for ($i = 0; $i < $verticesCount; $i++) {
            if (
                (($polygon[$i][1] > $latitude) != ($polygon[$j][1] > $latitude)) &&
                ($longitude < ($polygon[$j][0] - $polygon[$i][0]) * ($latitude - $polygon[$i][1]) / ($polygon[$j][1] - $polygon[$i][1]) + $polygon[$i][0])
            ) {
                $isInside = !$isInside;
            }
            $j = $i;
        }

        return $isInside;
    }

    // $stmt = $conn->prepare("SELECT `watch_id`,`watch_lat`,`watch_lon` FROM `watch_log` WHERE `watch_province` = '1' ORDER BY `watch_id` DESC limit 100");
    $stmt = $conn->prepare("SELECT `watch_id`,`watch_lat`,`watch_lon` FROM `watch_log` WHERE `watch_province` = 'null'");
    $stmt->execute();
    $result = $stmt->get_result();
    $watchs = $result->fetch_all(MYSQLI_ASSOC);
    $geoJsonData = json_decode(file_get_contents('province.geojson'), true);
    foreach ($watchs as $watch) {
        $lon = $watch['watch_lon'];
        $lat = $watch['watch_lat'];
        $watch_id = $watch['watch_id'];
        $province = getProvinceByLatLon($lat, $lon, $geoJsonData);
        $sql = "UPDATE watch_log SET watch_province = '$province' WHERE watch_id='$watch_id'";

        if ($conn->query($sql) === TRUE) {
            echo $watch_id." : successfully<br>";
        }
    }