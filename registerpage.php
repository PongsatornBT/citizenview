<?php
    session_start();
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "cultural_watch";

    // // Create connection
    // $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    include 'server.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <?php
        $sql_provinces = "SELECT * FROM provinces";
        $query = mysqli_query($conn, $sql_provinces);
    ?>
    <div class="container-login">
        <div class="login-box"></div>
        <div class="register-box2">
            <div class="register-title">
                Register
            </div>

            <form action="register_db.php" method="post">
                <?php if(isset($_SESSION['error'])) : ?>
                <?php 
                    echo '<script>swal({
                            title: "สมัครสมาชิกไม่สำเร็จ",
                            text: "ระบุ password และ confirm password ไม่ถูกต้อง",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['error']);
                    ?>
                <?php elseif(isset($_SESSION['exists'])) : ?>
                <?php 
                    unset($_SESSION['error']);
                    echo '<script>swal({
                            title: "สมัครสมาชิกไม่สำเร็จ",
                            text: "ชื่อผู้ใช้งานหรืออีเมลถูกใช้แล้ว",
                            icon: "warning",
                            dangerMode: true,
                        })</script>';
                    unset($_SESSION['exists']);
                    ?>
                <?php endif ?>
                <div class="input-group-r">
                    <input type="text" name="username" title="ชื่อผู้ใช้งานต้องเป็นภาษาอังกฤษ" pattern="[a-zA-Z].{3,30}"
                        required placeholder="ชื่อผู้ใช้งาน">
                    <!-- <label for="username">ชื่อผู้ใช้งาน</label> -->
                    <input type="text" name="firstname" pattern="[a-zA-Zก-๏]+" title="ชื่อต้องมีเฉพาะตัวอักษรเท่านั้น"
                        required placeholder="ชื่อ">
                    <!-- <label for="firstname" style="left:360px;">ชื่อ</label> -->

                </div>
                <div class="input-group-r">
                    <input type="password" name="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                        title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                        required placeholder="รหัสผ่าน">
                    <!-- <label for="password">รหัสผ่าน</label> -->
                    <input type="text" name="lastname" pattern="[a-zA-Zก-๏]+" title="นามสกุลต้องมีเฉพาะตัวอักษรเท่านั้น"
                        required placeholder="นามสกุล">
                    <!-- <label for="lastname">นามสกุล</label> -->

                </div>
                <div class="input-group-r">
                    <input type="password" name="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"
                        title="รหัสผ่านต้องมีอย่างน้อย 8 ตัว มีอักษรตัวเล็กตัวใหญ่ ตัวเลขและอักขระอย่างละ 1 ตัว"
                        required placeholder="ยืนยันรหัสผ่าน">
                    <!-- <label for="password2">ยืนยันรหัสผ่าน</label> -->
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        title="อีเมลไม่ถูกฟอแมท" required placeholder="อีเมล">
                    <!-- <label for="email">อีเมล</label> -->
                </div>
                <div class="input-group-r">
                    <select class="dropdown gender" name="gender" required>
                        <option value="" selected disabled>เพศ</option>
                        <option value="ชาย">ชาย</option>
                        <option value="หญิง">หญิง</option>
                        <option value="ไม่ระบุ">ไม่ระบุ</option>
                    </select>
                    <select class="dropdown income" name="income" required>
                        <option value="" selected disabled>รายได้ต่อเดือน</option>
                        <option value="ไม่มีรายได้">ไม่มีรายได้</option>
                        <option value="ต่ำกว่า 15,000 บาท">ต่ำกว่า 15,000 บาท</option>
                        <option value="15,000 – 30,000 บาท">15,000 – 30,000 บาท</option>
                        <option value="30,001 – 45,000 บาท">30,001 – 45,000 บาท</option>
                        <option value="45,001 – 60,000 บาท">45,001 – 60,000 บาท</option>
                        <option value="60,001 – 75,000 บาท">60,001 – 75,000 บาท</option>
                        <option value="75,001 – 100,000 บาท">75,001 – 100,000 บาท</option>
                        <option value="มากกว่า 100,000 บาท">มากกว่า 100,000 บาท</option>
                    </select>
                    <!-- <label for="income">รายได้</label> -->
                </div>
                <div class="input-group-r">
                    <!-- <label for="birthday">วันเกิด</label> -->
                    <select class="dropdown year" name="year" required>
                        <option value="">ปี</option>
                        <?php
                    $currentYear = date("Y", strtotime("+8 HOURS"));
                    for ($year = 1950; $currentYear >= $year; $currentYear--) {
                        echo "<option value='".$currentYear."'>".$currentYear."</option>";
                    }
                ?>
                    </select>
                    <select class="dropdown month" name="month" onchange="updateDays()" required>
                        <option value="">เดือน</option>
                        <?php
                    $monthNames = array(
                    1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน',
                    5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม',
                    9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
                    );
                    foreach ($monthNames as $month => $monthName) {
                        echo "<option value='".$month."'>".$monthName."</option>";
                    }
                ?>
                    </select>
                    <select class="dropdown day" name="day" id="daySelect" required>
                        <option value="">วัน</option>
                    </select>
                </div>
                <div class="input-group-r">
                    <!-- <label for="provinces">จังหวัด:</label> -->
                    <select class="dropdown" style="margin-left:50px;width:34%;" name="provinces" id="provinces">
                        <option value="" selected disabled>กรุณาเลือกจังหวัด</option>
                        <?php foreach ($query as $value) { ?>
                        <option value="<?=$value['id']?>"><?=$value['name_th']?></option>
                        <?php } ?>
                    </select>
                    <!-- <label for="amphures">อำเภอ:</label> -->
                    <select class="dropdown" style="margin-left:50px;width:34%;" name="amphures" id="amphures">
                        <option value="" selected disabled>กรุณาเลือกอำเภอ</option>
                    </select>
                    <!-- <label for="districts">ตำบล:</label> -->
                    <!-- <label for="zip_code">รหัสไปรษณีย์:</label> -->

                </div>
                <div class="input-group-r">
                    <select class="dropdown" style="margin-left:50px;width:34%;" name="districts" id="districts">
                        <option value="" selected disabled>กรุณาเลือกตำบล</option>
                    </select>
                    <input type="text" style="margin-left:50px;width:30%;" name="zip_code" id="zip_code"
                        placeholder="รหัสไปรษณีย์" readonly>
                </div>
                <div class="input-group-r">
                    <!-- <label for="address">ที่อยู่</label> -->
                    <input type="text" name="address" placeholder="ที่อยู่" style="width:75%;height:80px;">
                </div>
                <div class="input-group-r">
                    <button type="submit" name="reg_user" class="register">สมัครสมาชิก</button>
                </div>
                <p style="margin-left: 27%;margin-top:10px;">เป็นสมาชิกอยู่แล้ว? <a href="loginpage.php"
                        style="color:green; ">เข้าสู่ระบบ</a>
                </p>

            </form>
        </div>


    </div>
    </div>
</body>

</html>

<script>
function updateDays() {
    var monthSelect = document.getElementsByName("month")[0];
    var daySelect = document.getElementById("daySelect");

    var month = monthSelect.value;
    var daysInMonth = 31;

    if (month === "4" || month === "6" || month === "9" || month === "11") {
        daysInMonth = 30;
    } else if (month === "2") {
        var year = document.getElementsByName("year")[0].value;
        daysInMonth = (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0)) ? 29 : 28;
    }

    // Clear existing options
    while (daySelect.options.length > 0) {
        daySelect.remove(0);
    }

    // Add new options
    for (var day = 1; day <= daysInMonth; day++) {
        var option = document.createElement("option");
        option.value = day;
        option.text = day;
        daySelect.add(option);
    }
}
</script>
<?php include('script_address.php');?>