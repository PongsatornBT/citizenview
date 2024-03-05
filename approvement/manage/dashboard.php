<?php 
$currentPage = 'dashboard';
include 'sidebar.php';
?>

<?php
    //data user
    $stmt = $conn->prepare("SELECT `user_id` FROM `approve_user`");
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $count_user = count($users);

    //watch data
    $stmt = $conn->prepare("SELECT `watch_id`,`watch_status`,`watch_time`,`watch_rating` FROM `watch_log`");
    $stmt->execute();
    $result = $stmt->get_result();
    $watchs = $result->fetch_all(MYSQLI_ASSOC);
    $count_watch = count($watchs);
    $count_status_approve = 0;
    $count_status_reject = 0;
    $count_status_wait = 0;
    $count_rating = array("0"=>0,"0.5"=>0,"1"=>0,"1.5"=>0,"2"=>0,"2.5"=>0,"3"=>0,"3.5"=>0,"4"=>0,"4.5"=>0,"5"=>0);
    foreach ($watchs as $watch) {
        if($watch['watch_status'] == 'อนุมัติ'){
            $count_status_approve++;
        }else if($watch['watch_status'] == 'ไม่อนุมัติ'){
            $count_status_reject++;
        }else if($watch['watch_status'] == 'รออนุมัติ'){
            $count_status_wait++;
        }
        $count_rating[$watch['watch_rating']]++;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="style_manage.css"> -->
    <link rel="stylesheet" href="style_dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">

    <script src="https://cdn.plot.ly/plotly-basic-latest.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js">
    </script>

    <link rel="stylesheet" type="text/css" href="pivot_table/dist/pivot.css">
    <script type="text/javascript" src="pivot_table/dist/pivot.js"></script>
    <script type="text/javascript" src="pivot_table/dist/plotly_renderers.js"></script>

</head>


<body>
    <section class="home">
        <div class="container">
            <div class="card-container">
                <div class="card">
                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                    <h3>จำนวนข้อมูลความคิดเห็น</h3>
                    <p><b><?php echo $count_watch;?></b> ข้อมูล</p>
                </div>
                <div class="card">
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                    <h3>จำนวนผู้ใช้งานระบบ</h3>
                    <p><b><?php echo $count_user;?></b> บัญชี</p>
                </div>
            </div>
            <div class="chart">
                <div class="bar-y">
                    <p style="font-size:140%;">จำนวนข้อมูลความคิดเห็นในแต่ละเดือน</p>
                    <hr>
                    <label for="startMonthYear">เดือนปีเริ่มต้น: </label>
                    <input type="month" id="startMonthYear" value="2022-06">

                    <label for="endMonthYear">เดือนปีสิ้นสุด: </label>
                    <input type="month" id="endMonthYear">

                    <canvas id="barChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="chart">
                <div class="bar-x">
                    <p style="font-size:140%;">จำนวนข้อมูลความคิดเห็นในแต่ละคะแนน</p>
                    <hr>
                    <canvas id="myChart2"></canvas>
                </div>
                &nbsp&nbsp&nbsp&nbsp
                <div class="pie">
                    <p style="font-size:140%;">จำนวนข้อมูลความคิดเห็นในแต่ละสถานะ</p>
                    <hr><canvas id="myChart"></canvas>
                </div>
            </div>
            <!-- style="display:none;" -->
            <div class="chart" id="pivot">
                <div class="pivot">
                    <p style="font-size:140%;">ตารางวิเคราะห์ข้อมูล
                        <!-- <button onclick="show_pivot()"> + </button> -->
                    </p>
                    <hr>
                    <div id="output" style="margin-top:-2.5%;"></div>
                </div>
            </div>
        </div>
    </section>
</body>
<script type="text/javascript">
$(function() {

    var derivers = $.pivotUtilities.derivers;
    var renderers = $.extend($.pivotUtilities.renderers,
        $.pivotUtilities.plotly_renderers);
    $.getJSON("pivot_table/data/data_test.json", function(mps) {
        $("#output").pivotUI(mps, {
            renderers: renderers,
            cols: ["จังหวัด"],
            rows: ["สถานะ"],
            rendererName: "Table",
            rowOrder: "value_a_to_z",
            colOrder: "value_a_to_z",
        });
    });
});
</script>
<script>
function show_pivot() {
    var x = document.getElementById("output");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
<?php include 'script_chart.php';?>

</html>