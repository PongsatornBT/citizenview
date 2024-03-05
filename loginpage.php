<?php
    session_start();
    include 'server.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="container-login">
        <div class="login-box"></div>
        <div class="login-box2">
            <div class="title-login">
                Welcome to Citizen View<br>
            </div>
            <form action="login_db.php" method="post">
                <?php if(isset($_SESSION['success'])) : ?>
                <?php 
                    echo '<script>swal({
                            title: "สมัครสมาชิกสำเร็จ",
                            text: "กรุณาเข้าสู่ระบบเพื่อเข้าใช้งาน",
                            icon: "success",
                            });</script>';
                    unset($_SESSION['success']);
                ?>
                <?php elseif(isset($_SESSION['error'])) :  ?>
                <?php 
                    echo '<script>swal({
                            title: "เข้าสู่ระบบไม่สำเร็จ",
                            text: "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['error']);
                    unset($_SESSION['success']);
                    ?>
                <?php endif ?>
                <div class="input-group" style="margin-top:50px;">
                    <input type="text" name="username" required>
                    <label for="username">ชื่อผู้ใช้งาน</label>
                </div>
                <div class="input-group" style="margin-top:30px;">
                    <input type="password" name="password" required>
                    <label for="password">รหัสผ่าน</label>
                </div>
                <div class="input-group">
                    <button type="submit" name="login_user" class="login">เข้าสู่ระบบ</button>
                </div>
                <br><br>
                <hr width="75%" style="margin-left: 12%;">
            </form>
            <form action="login_db.php" method="post">
                <div class="input-group">
                    <button type="submit" name="login_guest" class="login-guest">
                        ไม่ระบุตัวตน
                    </button>
                </div>
                <br>
                <p>ยังไม่มีรหัสผู้ใช้งาน?<br> <a href="registerpage.php" style="color:green;">สมัครสมาชิก</a></p>
            </form>
        </div>
    </div>
</body>

</html>