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
    <title>เพิ่มผู้ใช้งาน</title>
    <link rel="stylesheet" href="style_manage.css">
    <link rel="stylesheet" href="style_form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
.position-relative {
    position: relative;
}

.icon-eye {
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
            <span class="title">เพิ่มผู้ใช้</span>
            <br><br>
            <div class="custom-container">
                <form action="manage_user_db.php" method="post">
                    <?php if(isset($_SESSION['add_error'])) : ?>
                    <?php 
                    echo '<script>swal({
                            title: "เพิ่มผู้ใช้ไม่สำเร็จ",
                            text: "ระบุรหัสผ่านและยืนยันรหัสผ่านไม่ถูกต้อง",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['error']);
                    ?>
                    <?php elseif(isset($_SESSION['exists'])) : ?>
                    <?php 
                    unset($_SESSION['add_error']);
                    echo '<script>swal({
                            title: "เพิ่มผู้ใช้ไม่สำเร็จ",
                            text: "ชื่อผู้ใช้งานหรืออีเมลถูกใช้แล้ว",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['exists']);
                    ?>
                    <?php endif ?>
                    <!-- First Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputFirstname">ชื่อ</label>
                            <input type="text" class="form-control" name="firstname" placeholder="ชื่อ"
                                pattern="[a-zA-Zก-๏]+" title="ชื่อต้องมีเฉพาะตัวอักษรเท่านั้น" required>
                        </div>
                        <div class="form-group">
                            <label for="inputLastname">นามสกุล</label>
                            <input type="text" class="form-control" name="lastname" placeholder="นามสกุล"
                                pattern="[a-zA-Zก-๏]+" title="นามสกุลต้องมีเฉพาะตัวอักษรเท่านั้น" required>
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputUsername">ชื่อผู้ใช้งาน</label>
                            <input type="text" class="form-control" name="username" pattern="[a-zA-Z].{3,30}"
                                title="ชื่อผู้ใช้งานต้องเป็นภาษาอังกฤษ" placeholder="ชื่อผู้ใช้งาน" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="inputPassword">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                                title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                                id="togglePassword1" required>
                            <i class="far fa-eye toggle-password icon-eye"
                                onclick="show_password('togglePassword1', this)"></i>
                        </div>
                    </div>

                    <!-- Third Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputEmail">อีเมล</label>
                            <input type="email" class="form-control" name="email"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="อีเมลต้องอยู่ในรูปแบบของอีเมล"
                                placeholder="อีเมล" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="inputConfirm">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" name="c_password" placeholder="ยืนยันรหัสผ่าน"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                                title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                                id="togglePassword2" required>
                            <i class="far fa-eye toggle-password icon-eye"
                                onclick="show_password('togglePassword2', this)"></i>
                        </div>
                    </div>

                    <!-- Fourth Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputTel">เบอร์โทรติดต่อ</label>
                            <input type="text" class="form-control" name="tel" pattern="[0-9]{9,10}"
                                title="เบอร์โทรต้องอยู่ในรูปแบบตัวเลข" placeholder="เบอร์โทรติดต่อ" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAgency">หน่วยงาน</label>
                            <input type="text" class="form-control" name="agency" placeholder="หน่วยงาน"
                                title="ชื่อหน่วยงาน" required>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-buttons">
                        <button type="submit" name="add_user" class="btn btn-confirm">บันทึก</button>
                        <a href="manage_user.php" class="cancel-link">ยกเลิก</a>
                    </div>
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