<?php
$currentPage = 'manage_data';
include 'sidebar.php';

// find last space before 100 char
function truncateWatch($watch) {
    if (strlen($watch) > 200) {
        $lastSpace = strrpos(substr($watch, 0, 200), ' ');
        if ($lastSpace !== false) {
            return substr($watch, 0, $lastSpace) . '...';
        } else {
            return substr($watch, 0, 200) . '...';
        }
    } else {
        return $watch;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูล</title>
    <link rel="stylesheet" href="style_manage.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
    // After 3 seconds, remove the "display: none" property from the container
    setTimeout(function() {
        document.querySelector('.container').style.display = 'block';
    }, 500);
    </script>
</head>

<body>
    <section class="home">
        <div class="container" style="display:none;">
            <span class="title">ข้อมูลความคิดเห็น</span>
            </a>
            <br> <br>
            <hr>
            <br>
            <?php if(isset($_SESSION['confirm'])) { ?>
            <?php 
                    echo '<script>swal({
                            title: "อนุมัติข้อมูลสำเร็จ",
                            text: "กรุณาตรวจสอบข้อมูล",
                            icon: "success",
                            });</script>';
                    unset($_SESSION['confirm']);
                ?>
            <?php }else if(isset($_SESSION['reject'])){
                    echo '<script>swal({
                            title: "ไม่อนุมัติข้อมูลสำเร็จ",
                            text: "กรุณาตรวจสอบข้อมูล",
                            icon: "success",
                            });</script>';
                    unset($_SESSION['reject']);
            } ?>
            <div class="table">
                <table id="table">
                    <thead>
                        <th>ลำดับ</th>
                        <th>ชื่อสถานที่หรือกิจกรรม</th>
                        <th>ความคิดเห็น</th>
                        <th>เรทติง</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </thead>
                    <tbody>
                        <?php 
                        $stmt = $conn->prepare("SELECT `watch_id`,`watch_title`,`watch_message`,`watch_rating`,`watch_status` FROM `watch_log`");
                        // $stmt = $conn->prepare("SELECT * FROM `watch_log`");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $watchs = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($watchs as $watch) {
                        if($watch['watch_title'] != ''){
                        ?>
                        <tr>
                            <td width='5%'><?php echo $i++; ?></td>
                            <td style="overflow: hidden;" width='20%'>
                                <?php //echo truncateWatch($watch['watch_title']);
                                echo $watch['watch_title']; ?>
                            </td>
                            <td style="overflow: hidden;" width='40%'>
                                <?php echo truncateWatch($watch['watch_message']);
                                ?>
                            </td>
                            <td width='15%'>
                                <img src="img/<?php echo $watch['watch_rating'];?>star.png" width='120px' height='20px'>
                                <span style="visibility:hidden;"><?php echo $watch['watch_rating'];?></span>
                            </td>
                            <td width='10%'>
                                <span class="status 
                                <?php 
                                if($watch['watch_status'] == 'อนุมัติ'){echo 'yes';}
                                else if($watch['watch_status'] == 'ไม่อนุมัติ'){echo 'no';}
                                else{echo 'none';}
                                ?>">
                                    <?php echo $watch['watch_status']; ?></span>
                            </td>
                            <td class="view_info" width='10%'>
                                <a href="view_info.php?watch_id=<?php echo $watch['watch_id']; ?>">
                                    <i class="fa fa-file-text-o" aria-hidden="true"
                                        style="padding-top:5px;"></i>&nbsp;ดูข้อมูล
                                </a>
                            </td>
                        </tr>
                        <?php
                        } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</body>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
let table = new DataTable('#table');
</script>

</html>