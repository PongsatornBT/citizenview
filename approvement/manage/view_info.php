<?php
    if (isset($_GET['watch_id'])) {
        $watch_id = $_GET['watch_id'];
    }
    $currentPage = 'manage_data';
    include 'sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดความคิดเห็น</title>
    <link rel="stylesheet" href="style_manage.css">
    <link rel="stylesheet" href="style_form.css">

    <!-- MAP -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script src="https://kit.fontawesome.com/dcc6734f31.js" crossorigin="anonymous"></script>

</head>

<body>
    <section class="home">
        <div class="container">
            <span class="title">รายละเอียดความคิดเห็น</span>
            <br><br>
            <hr>
            <br>
            <?php if(isset($_SESSION['error'])){
                    echo '<script>swal({
                            title: "อนุมัติข้อมูลไม่สำเร็จ",
                            text: "ไม่พบข้อมูลข้อมูล",
                            icon: "warning",
                            dangerMode: true,
                            });</script>';
                    unset($_SESSION['error']);
            } ?>
            <div class="custom-container">
                <!-- <form action="manage_data_db.php" method="post"> -->
                <div class="form-grid">
                    <?php 
                            $stmt = $conn->prepare("SELECT * FROM `watch_log` WHERE `watch_id` = '$watch_id'");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $watchs = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($watchs as $watch) {
                        ?>
                    <!-- First Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputEventName">ชื่อสถานที่หรือกิจกรรม</label>
                            <input type="text" class="form-control" value="<?php echo $watch['watch_title'];?>"
                                readonly>
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="form-row">
                        <div class="form-group" style="margin-top:-100px;">
                            <label for="inputMessage">ความคิดเห็น</label>
                            <textarea class="form-control" readonly><?php echo $watch['watch_message'];?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                        </div>
                    </div>

                    <!-- Third Row -->
                    <div class="form-row">
                        <div class="form-group" style="margin-top:-50px;">
                            <label for="inputName">ชื่อ</label>
                            <input type="text" class="form-control" value="<?php echo $watch['watch_name'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                    </div>

                    <!-- Map Container -->
                    <div class="form-group map">
                        <label for="inputLocation">ที่ตั้ง</label>
                        <div id="mapcontainer">
                            <div id="map"></div>
                        </div>
                    </div>

                    <!-- Fourth Row -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail">อีเมล</label>
                            <input type="text" class="form-control" value="<?php echo $watch['watch_email'];?>"
                                readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <div class="form-row">
                                <div class="col">
                                    <label for="inputLat">ละติจูด</label>
                                    <input type="text" class="form-control" value="<?php echo $watch['watch_lat'];?>"
                                        readonly>
                                </div>
                                <div class="col">
                                    <label for="inputLon">ลองจิจูด</label>
                                    <input type="text" class="form-control" value="<?php echo $watch['watch_lon'];?>"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

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
                            <img id="currentImage" class="frame"
                                src="../../uploads/picture/<?php echo $imgs[0]['file_image_name']?>"
                                alt="../../uploads/picture/<?php echo $imgs[0]['file_image_name']?>">

                            <?php if ($numImages > 1) { ?>
                            <div class="image-buttons">
                                <button id="prevButton">
                                    < </button>
                                        <button id="nextButton">></button>
                            </div>
                            <?php } ?>
                            <a href="../../uploads/picture/<?php echo $imgs[1]['file_image_name']?>" target="_blank"
                                id="currentLink">
                                <i class="fa-solid fa-expand"></i>
                            </a>
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
                        <!-- <div class="video-container"> -->
                        <video controls class="frame-video">
                            <source src="../../uploads/video/<?php echo $video['file_video_name']?>">
                        </video>
                        <!-- </div> -->
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>

                <form action="manage_data_db.php" method="post">
                    <input type="hidden" name="watch_id" value="<?php echo $watch['watch_id']; ?>">
                    <!-- Buttons -->
                    <div class="form-buttons">
                        <button type="submit" name="confirm" class="btn btn-approve">อนุมัติ</button>
                        <button type="submit" name="reject" class="btn btn-not-approve">ไม่อนุมัติ</button>
                        <a href="manage_data.php" class="cancel-link">ยกเลิก</a>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </section>

</body>
<script>
// Add active to tab-button
// Get all tab buttons
var tabButtons = document.querySelectorAll(".tab-button");

// Add a click event listener to each tab button
tabButtons.forEach(function(tabButton) {
    tabButton.addEventListener("click", function() {
        // Remove the "active" class from all tab buttons
        tabButtons.forEach(function(btn) {
            btn.classList.remove("active");
        });

        // Add the "active" class to the clicked tab button
        this.classList.add("active");

        // Your existing code to switch tabs goes here
        var tabName = this.getAttribute("data-tab");
        var tabContents = document.querySelectorAll(".tab");

        for (var i = 0; i < tabContents.length; i++) {
            tabContents[i].style.display = "none";
        }

        document.getElementById(tabName).style.display = "block";
    });
});

// Open tabs
$(document).ready(function() {
    var currentImageIndex = 0;
    var $currentImage = $('#currentImage');
    var $currentLink = $('#currentLink');
    var $images = <?php echo json_encode($imgs); ?>;
    var numImages = $images.length;

    // Function to display the current image
    function displayCurrentImage() {
        var imageUrl = '../../uploads/picture/' + $images[currentImageIndex]['file_image_name'];
        $currentImage.attr('src', imageUrl);
        $currentLink.attr('href', imageUrl);
    }

    // Function to show the next image
    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % numImages;
        displayCurrentImage();
    }

    // Function to show the previous image
    function showPreviousImage() {
        currentImageIndex = (currentImageIndex - 1 + numImages) % numImages;
        displayCurrentImage();
    }

    // Display the initial image
    displayCurrentImage();

    // Handle next and previous button clicks
    $('#nextButton').click(showNextImage);
    $('#prevButton').click(showPreviousImage);
});

// Tab image and video
function openTab(tabId) {
    // Hide all tabs
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Show the selected tab
    const selectedTab = document.getElementById(tabId);
    selectedTab.classList.add('active');


    // Hide all images in the videoTab
    if (tabId === 'videoTab') {
        const videoTabImages = document.querySelectorAll('#videoTab img');
        videoTabImages.forEach(img => img.style.display = 'none');
    } else {
        // Show all images in the imageTab
        const imageTabImages = document.querySelectorAll('#imageTab img');
        imageTabImages.forEach(img => img.style.display = 'block');
    }
}
</script>
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

</html>