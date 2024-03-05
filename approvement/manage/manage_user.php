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
    <title>จัดการผู้ใช้</title>
    <link rel="stylesheet" href="style_manage.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>


<body>
    <section class="home">
        <?php if(isset($_SESSION['add_user'])) { ?>
        <?php 
                    echo '<script>swal({
                            title: "เพิ่มผู้ใช้สำเร็จ",
                            text: "กรุณาตรวจสอบข้อมูล",
                            icon: "success",
                            });</script>';
                    unset($_SESSION['add_user']);
                ?>
        <?php } ?>
        <?php if(isset($_SESSION['edit_user'])) { ?>
        <?php 
                    echo '<script>swal({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            text: "กรุณาตรวจสอบข้อมูล",
                            icon: "success",
                            });</script>';
                    unset($_SESSION['edit_user']);
                ?>
        <?php } ?>
        <div class="container">
            <span class="title">ข้อมูลผู้ใช้
                <span class="add-user">
                    <a href="add_user.php">
                        <i class="bx bxs-plus-square"></i>
                        เพิ่มผู้ใช้
                    </a>
                </span></span>
            <br> <br>
            <hr>
            <br>
            <div class="table">
                <table id="table">
                    <thead>
                        <th>ลำดับ</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>อีเมล</th>
                        <th>หน่วยงาน</th>
                        <th>การจัดการ</th>
                    </thead>
                    <tbody>
                        <?php 
                        $id = $_SESSION['id'];
                        $stmt = $conn->prepare("SELECT `user_id`,`user_name`,`user_email`,`user_agency` FROM `approve_user` WHERE user_add_id = '$id'");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $users = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($users as $user) {
                        ?>
                        <?php if($user['user_id'] != $_SESSION['id']) { ?>
                        <tr>
                            <td width='5%'><?php echo $i++; ?></td>
                            <td width='30%'><?php echo $user['user_name']; ?></td>
                            <td width='35%'><?php echo $user['user_email']; ?></td>
                            <td width='20%'><?php echo $user['user_agency']; ?></td>
                            <td width='10%' class="delete">
                                <a href="#" onclick="deleteUser(<?php echo $user['user_id']; ?>)">
                                    <i class="fa fa-trash" style="padding-top:3px;"></i>&nbspลบ
                                </a>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
let table = new DataTable('#table');
</script>
<script>
function deleteUser(userId) {
    Swal.fire({
        title: "ยืนยันการลบผู้ใช้งาน?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#808080",
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "delete_user.php",
                data: {
                    userId: userId
                },
                success: function(response) {
                    if (response === "success") {
                        Swal.fire(
                            "ลบข้อมูล",
                            "ลบข้อมูลผู้ใช้งานสำเร็จ",
                            "success"
                        ).then(() => {
                            // Reload the page or update the UI as needed
                            location.reload(); // Reload the page to reflect the changes
                        });
                    } else {
                        Swal.fire("ลบข้อมูลผู้ใช้ไม่สำเร็จ", "Error deleting user.", "error");
                    }
                }
            });
        }
    });
}
</script>

</html>