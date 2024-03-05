<?php
    session_start();
    if(!isset($_SESSION['username_approve'])){
        $_SESSION['msg'] = "You must login first";
        header('location: loginpage.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username_approve']);
        header('location: loginpage_approve.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>approve</title>
</head>

<body>
</body>

</html>