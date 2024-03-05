<script>
function initMap() {
    <?php
    $stmt = $conn->prepare("SELECT * FROM `watch_log` WHERE `watch_id` = '$watch_id'");
    $stmt->execute();
    $result = $stmt->get_result();
    $watchs = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($watchs as $watch) {
        $watch_lat = $watch['watch_lat'];
        $watch_lon = $watch['watch_lon'];
    ?>
    <?php if($watch_lat != '' && $watch_lon != ''){ ?>
    var watchLat = <?php echo json_encode($watch_lat); ?>;
    var watchLon = <?php echo json_encode($watch_lon); ?>;

    var map = L.map('map').setView([watchLat, watchLon], 8);
    <?php }else{ ?>
    var map = L.map('map').setView([13.7245995, 100.6331108], 8);
    <?php } ?>
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 49,
        // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    <?php if($watch_lat != '' && $watch_lon != ''){ ?>
    L.circleMarker([watchLat, watchLon], {
        radius: 8,
        weight: 2,
        opacity: 1,
        fillOpacity: 0.7
    }).addTo(map);
    <?php } ?>
    <?php } ?>
}

initMap();
</script>



<div class="tab-buttons">
    <?php 
                        $stmt = $conn->prepare("SELECT COUNT(*) FROM `watch_file_image` WHERE `watch_id` = '$watch_id'");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $numImages = $result->fetch_row()[0];
                        
                        if ($numImages > 0) {
                    ?>
    <div class="tab-button" onclick="openTab('imageTab')" data-tab="imageTab">Image</div>
    <?php } ?>

    <?php 
                        $stmt = $conn->prepare("SELECT COUNT(*) FROM `watch_file_video` WHERE `watch_id` = '$watch_id'");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $numVideos = $result->fetch_row()[0];
                        
                        if ($numVideos > 0) {
                    ?>
    <div class="tab-button" onclick="openTab('videoTab')" data-tab="videoTab">Video</div>
    <?php } ?>
</div>
<div class="tab-content">
    <?php if ($numImages > 0) { ?>
    <div id="imageTab" class="tab">
        <?php 
                            $stmt = $conn->prepare("SELECT * FROM `watch_file_image` WHERE `watch_id` = '$watch_id'");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $imgs = $result->fetch_all(MYSQLI_ASSOC);
                            $numImages = count($imgs);
                        ?>
        <div class="image-container">
            <img id="currentImage" class="frame" style="object-fit: fill;"
                src="../../uploads/picture/<?php echo $imgs[0]['file_image_name']?>"
                alt="../../uploads/picture/<?php echo $imgs[0]['file_image_name']?>">
            <?php if ($numImages > 1) { ?>
            <div class="image-buttons">
                <button id="prevButton">
                    < </button>
                        <button id="nextButton">></button>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>


    <?php if ($numVideos > 0) { ?>
    <div id="videoTab" class="tab">
        <?php 
                            $stmt = $conn->prepare("SELECT * FROM `watch_file_video` WHERE `watch_id` = '$watch_id'");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $videos = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($videos as $video) {
                        ?>
        <video controls class="frame">
            <source src="../../uploads/video/<?php echo $video['file_video_name']?>">
        </video>
        <?php } ?>
    </div>
    <?php } ?>
</div>