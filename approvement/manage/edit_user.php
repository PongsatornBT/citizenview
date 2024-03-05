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
    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
    <link rel="stylesheet" href="style_manage.css">
    <link rel="stylesheet" href="style_form.css">
</head>

<style>
.position-relative {
    position: relative;
}

.icon-edit {
    position: absolute;
    top: 65%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #707070;
    font-size: 20px;
}

.icon-edit:hover {
    color: #333333;
}
</style>

<body>
    <section class="home">
        <div class="container">
            <span class="title">แก้ไขข้อมูล</span>
            <br><br>
            <hr>
            <div class="custom-container">
                <form action="manage_user_db.php" method="post">
                    <?php if(isset($_SESSION['password_wrong'])) { ?>
                    <?php 
                        echo '<script>swal({
                                title: "แก้ไขข้อมูลไม่สำเร็จ",
                                text: "ระบุรหัสผ่านให้ถูกต้อง",
                                icon: "warning",
                                dangerMode: true,
                            })</script>';
                        unset($_SESSION['password_wrong']);
                    ?>
                    <?php } ?>
                    <?php if(isset($_SESSION['exists_edit'])) { ?>
                    <?php 
                        echo '<script>swal({
                                title: "แก้ไขข้อมูลไม่สำเร็จ",
                                text: "อีเมลถูกใช้งานแล้ว",
                                icon: "warning",
                                dangerMode: true,
                            })</script>';
                        unset($_SESSION['exists_edit']);
                    ?>
                    <?php } ?>
                    <?php if(isset($_SESSION['change_password_success'])) { ?>
                    <?php 
                        echo '<script>swal({
                                title: "แก้ไขสำเร็จ",
                                text: "แก้ไขรหัสผ่าน",
                                icon: "success",
                                });</script>';
                        unset($_SESSION['change_password_success']);
                    ?>
                    <?php } ?>
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
                        <div class="form-group">
                            <label for="inputFirstname">ชื่อ</label>
                            <input type="text" class="form-control" name="firstname" placeholder="ชื่อ"
                                pattern="[a-zA-Zก-๏]+" title="ชื่อต้องมีเฉพาะตัวอักษรเท่านั้น"
                                value="<?php echo substr($user['user_name'],0,(strpos($user['user_name'],' '))); ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="inputLastname">นามสกุล</label>
                            <input type="text" class="form-control" name="lastname" placeholder="นามสกุล"
                                pattern="[a-zA-Zก-๏]+" title="นามสกุลต้องมีเฉพาะตัวอักษรเท่านั้น"
                                value="<?php echo substr($user['user_name'],strpos($user['user_name'],' ')+1); ?>"
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputUsername">ชื่อผู้ใช้งาน</label>
                            <input type="text" class="form-control" name="username" pattern="[a-zA-Z].{3,30}"
                                title="ชื่อผู้ใช้งานต้องเป็นภาษาอังกฤษ" placeholder="ชื่อผู้ใช้งาน"
                                value="<?php echo $user['user_username']; ?>" readonly>
                        </div>
                        <div class="form-group position-relative">
                            <label for="inputPassword">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                                title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                                required>
                            <a href="change_password.php">
                                <i class="bx bxs-edit icon-edit"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputEmail">อีเมล</label>
                            <input type="email" class="form-control" name="email"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="อีเมลต้องอยู่ในรูปแบบของอีเมล"
                                placeholder="อีเมล" value="<?php echo $user['user_email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAgency">หน่วยงาน</label>
                            <input type="text" class="form-control" name="agency" placeholder="หน่วยงาน"
                                title="ชื่อหน่วยงาน" value="<?php echo $user['user_agency']; ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputTel">เบอร์โทรติดต่อ</label>
                            <input type="text" class="form-control" name="tel" pattern="[0-9]{9,10}"
                                title="เบอร์โทรต้องอยู่ในรูปแบบตัวเลข" placeholder="เบอร์โทรติดต่อ"
                                value="<?php echo $user['user_tel']; ?>" required>
                        </div>
                        <div class="form-group">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-buttons">
                        <button type="submit" name="edit_user" class="btn btn-confirm">บันทึก</button>
                        <a href="manage_user.php" class="cancel-link">ยกเลิก</a>
                    </div>
                    <?php } ?>
                </form>
            </div>

        </div>
    </section>

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