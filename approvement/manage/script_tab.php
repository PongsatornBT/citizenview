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
    var $images = <?php echo json_encode($imgs); ?>;
    var numImages = $images.length;

    // Function to display the current image
    function displayCurrentImage() {
        var imageUrl = '../../uploads/picture/' + $images[currentImageIndex]['file_image_name'];
        $currentImage.attr('src', imageUrl);
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