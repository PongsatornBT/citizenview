<?php
    session_start();
    if(!isset($_SESSION['username_approve'])){
        $_SESSION['msg'] = "You must login first";
        header('location: ../loginpage_approve.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username_approve']);
        header('location: ../loginpage_approve.php');
    }
    include '../../server.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style_sidebar.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="sidebar close">
        <header>
            <span class="image">
                <img src="logo.png">
            </span>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link <?php echo $currentPage === 'manage_data' ? 'active' : ''; ?>">
                        <a href="manage_data.php">
                            <i class="bx bxs-data nav_icon icon"></i>
                            <span class="text nav-text">จัดการข้อมูล</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $currentPage === 'manage_user' ? 'active' : ''; ?>">
                        <a href="manage_user.php">
                            <i class=" bx bxs-user-rectangle icon"></i>
                            <span class="text nav-text">จัดการผู้ใช้</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $currentPage === 'dashboard' ? 'active' : ''; ?>">
                        <a href="dashboard.php">
                            <i class="fa fa-bar-chart icon"></i>
                            <span class="text nav-text">สถิติ</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../../marker3/marker.php">
                            <i class="fa fa-globe icon"></i>
                            <span class="text nav-text">แผนที่</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content" id="manage-user">
                <hr>
                <ul class="nav">
                    <?php if(isset($_SESSION['name'])) : ?>
                    <!-- <li class="nav-link <?php //echo $currentPage === 'account' ? 'active' : ''; ?>"> -->
                    <li class="nav-link">
                        <a href="#" class="" id="userDropdown">
                            <i class='fa fa-user-o icon'></i>
                            <span class="text nav-text"><?php echo $_SESSION['name']; ?></span>
                        </a>
                        <div class="dropdown-content" id="userDropdownContent">
                            <a href="edit_user.php" class="text-menu">
                                <i class="bx bxs-edit icon"></i>&nbspแก้ไขข้อมูล
                            </a>
                            <a href="<?php echo $currentPage; ?>.php?logout='1'" class="
                                 text-menu"><i class="bx bx-log-out icon"></i>&nbspออกจากระบบ</a>
                        </div>
                        </l>
                        <?php endif ?>
                </ul>
            </div>
        </div>


    </nav>

</body>

<script>
// Open and Close sidebar
const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    // Store the sidebar state in local storage
    localStorage.setItem('sidebarState', sidebar.classList.contains('close') ? 'closed' : 'open');
});

// Check the state of the sidebar in local storage
document.addEventListener('DOMContentLoaded', function() {
    const storedState = localStorage.getItem('sidebarState');
    if (storedState === 'closed') {
        sidebar.classList.add('close');
    } else {
        sidebar.classList.remove("close");
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//add class active when click menu
$(document).ready(function() {
    var menuLinks = $(".menu-links .nav-link");
    menuLinks.click(function() {
        menuLinks.removeClass("active");
        $(this).addClass("active");
    });
});

//dropdown menu in profile
document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggle = document.getElementById("userDropdown");
    var dropdownContent = document.getElementById("userDropdownContent");

    dropdownToggle.addEventListener("click", function() {
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
});
</script>

</html>