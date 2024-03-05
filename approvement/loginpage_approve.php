<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>

<body>
    <div class="container-login">
        <div class="login-box">
            <div class="user-logo"><i class="fas fa-user-alt"></i></div>
            <div class="title-login">
                Welcome to Citizen Approvement<br>
            </div>
            <form action="login_db.php" method="post">
                <?php if(isset($_SESSION['error'])) :  ?>
                <?php 
                    echo '<script>swal({
                            title: "เข้าสู่ระบบไม่สำเร็จ",
                            text: "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['error']);
                    ?>
                <?php endif ?>
                <div class="input-group">
                    <label for="username">ชื่อผู้ใช้งาน</label><br>
                    <input type="text" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">รหัสผ่าน</label><br>
                    <input type="password" name="password" id="togglePassword" required>
                    <i class="far fa-eye" onclick="show_password(this)"></i>
                </div>
                <div class="input-group">
                    <button type="submit" name="login_user" class="login">เข้าสู่ระบบ</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
let show_password = function(icon) {
    icon.classList.toggle("fa-eye-slash");
    var pass = document.getElementById("togglePassword");

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</html>