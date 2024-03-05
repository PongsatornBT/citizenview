<?php
    $currentPage = 'manage_user';
    include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่าน</title>
    <link rel="stylesheet" href="style_manage.css">
    <link rel="stylesheet" href="style_form.css">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<style>
.position-relative {
    position: relative;
}

.icon-change {
    position: absolute;
    top: 65%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: rgb(185, 185, 185);
    font-size: 20px;
}
</style>

<body>
    <section class="home">
        <div class="container">
            <span class="title">เปลี่ยนรหัสผ่าน</span>
            <br><br>
            <hr>
            <div class="custom-container">
                <form action="manage_user_db.php" method="post">
                    <?php if(isset($_SESSION['password_new_wrong'])) {
                        echo '<script>swal({
                                title: "แก้ไขข้อมูลไม่สำเร็จ",
                                text: "รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ถูกต้อง",
                                icon: "warning",
                                dangerMode: true,
                            })</script>';
                        unset($_SESSION['password_new_wrong']); 
                    }else if(isset($_SESSION['password_change_wrong'])){
                        echo '<script>swal({
                                title: "แก้ไขข้อมูลไม่สำเร็จ",
                                text: "ระบุรหัสผ่านให้ถูกต้อง",
                                icon: "warning",
                                dangerMode: true,
                            })</script>';
                        unset($_SESSION['password_change_wrong']);
                    }
                    ?>
                    <?php 
                        $username = $_SESSION['username_approve'];
                        $stmt = $conn->prepare("SELECT * FROM `approve_user` WHERE `user_username` = '$username'");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $users = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($users as $user) {
                    ?>
                    <div class="form-row">
                        <div class="form-group position-relative">
                            <label for="inputPasswordOld">รหัสผ่านเดิม</label>
                            <input type="password" class="form-control" name="password_old" placeholder="รหัสผ่านเดิม"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                                title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                                required id="togglePassword1">
                            <i class="far fa-eye toggle-password icon-change"
                                onclick="show_password('togglePassword1', this)"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group position-relative">
                            <label for="inputPasswordNew1">รหัสผ่านใหม่</label>
                            <input type="password" class="form-control" name="password_new1" placeholder="รหัสผ่านใหม่"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                                title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                                required id="togglePassword2">
                            <i class="far fa-eye toggle-password icon-change"
                                onclick="show_password('togglePassword2', this)"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group position-relative">
                            <label for="inputPasswordNew2">ยืนยันรหัสผ่านใหม่</label>
                            <input type="password" class="form-control" name="password_new2"
                                placeholder="ยืนยันรหัสผ่านใหม่" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                                title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                                required id="togglePassword3">
                            <i class="far fa-eye toggle-password icon-change"
                                onclick="show_password('togglePassword3', this)"></i>
                        </div>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" name="change_password" class="btn btn-confirm">บันทึก</button>
                        <a href="edit_user.php" class="cancel-link">ยกเลิก</a>
                    </div>
                    <?php } ?>
                </form>
            </div>

        </div>
    </section>

</body>
<script>
function show_password(inputId, icon) {
    icon.classList.toggle("fa-eye-slash");
    var pass = document.getElementById(inputId);

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</html>