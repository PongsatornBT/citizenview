<!DOCTYPE html>
<html>
<?php
$api_url = 'https://navanurak.in.th/muse_api/index.php/api/v1/museum/';


// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);
// print_r($response_data);
// All user data exists in 'data' object
$myfile = fopen("objects3.json", "a") or die("Unable to open file!");
$first = true;
// $text = '[';
$text = '';
// $arry = array(04,01,09,02,08,10,06,03,21,27,28,20,07,30,29,31,40,43,44,47,48,41,46,49,45,54,11,26,38,52,50,53,42);
// foreach ($response_data as $row) {
  $api_url2 = 'https://navanurak.in.th/muse_api/index.php/api/v1/specimen/53';
  // print_r($api_url2.$row -> museum_code);
  $json_data2 = file_get_contents($api_url2);
  // if ($json_data2 = file_get_contents($api_url2) != false) {
    $response_data2 = json_decode($json_data2);
    foreach ($response_data2 as $row2) {
      if ($first == true) {
        $text .= '
              {' . "\n";
        $first = false;
      } else {
        $text .= '
              ,{' . "\n";
      }
      $text .= '          ' . ' "สถานที่":"' . 'ไทยเบิ้ง บ้านโคกสลุง' . '",' . "\n";
      $text .= '          ' . ' "ตำบล":"' . '160205' . '",' . "\n";
      $text .= '          ' . ' "อำเภอ":"' . '98' . '",' . "\n";
      $text .= '          ' . ' "จังหวัด":"' . 'ลพบุรี' . '",' . "\n";
      $text .= '          ' . ' "ชื่อ":"' . $row2->obj_title . '",' . "\n";
      $text .= '          ' . ' "ประเภท":"' . $row2->category_name . '"';
      $text .= '
              }';
    }
// }

// }


// foreach ($response_data as $row) {
//   $api_url2 = 'https://navanurak.in.th/muse_api/index.php/api/v1/items/' . strval($row->museum_code);
//   // print_r($api_url2.$row -> museum_code);
//   // $json_data2 = file_get_contents($api_url2);
//   if ($json_data2 = file_get_contents($api_url2) != false) {
//     $response_data2 = json_decode($json_data2);
//     foreach ($response_data2 as $row2) {
//       if ($first == true) {
//         $text .= '
//               {' . "\n";
//         $first = false;
//       } else {
//         $text .= '
//               ,{' . "\n";
//       }
//       $text .= '          ' . ' "สถานที่":"' . '$row->museum_name' . '",' . "\n";
//       $text .= '          ' . ' "ตำบล":"' . '$row->tambon' . '",' . "\n";
//       $text .= '          ' . ' "อำเภอ":"' . '$row->ampher' . '",' . "\n";
//       $text .= '          ' . ' "จังหวัด":"' . '$row->province' . '",' . "\n";
//       $text .= '          ' . ' "ชื่อ":"' . $row2->obj_title . '",' . "\n";
//       $text .= '          ' . ' "ประเภท":"' . $row2->category_name . '"';
//       $text .= '
//               }';
//     }
//   }

// }

// foreach ($response_data as $row) {
//     if($first == true){
//         $text .= '
//         {'."\n";
//         $first = false;
//     }else{
//         $text .= '
//         ,{'."\n";
//     }
//     $text .= '          '.' "ms_name":"'.$row->museum_name.'",'."\n";
//     $text .= '          '.' "tambon":"'.$row->province.'",'."\n";
//     $text .= '          '.' "ampher":"'.$row->province.'",'."\n";
//     $text .= '          '.' "province":"'.$row->province.'"'."\n";


//     $text .= '
//         }';
// }

// $text .= '    ]';
fwrite($myfile, $text . "\n");
fclose($myfile);
// var_dump($response_data );
// $user_data = $response_data->data;
// var_dump($user_data);

?>

<head>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <title>สถิติข้อมูลวัฒนธรรม</title>
  <meta charset="utf-8">
  <!-- external libs from cdnjs -->
  <script src="https://cdn.plot.ly/plotly-basic-latest.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

  <!-- PivotTable.js libs from ../dist -->
  <link rel="stylesheet" type="text/css" href="../dist/pivot.css">
  <script type="text/javascript" src="../dist/pivot.js"></script>
  <script type="text/javascript" src="../dist/plotly_renderers.js"></script>
  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }
  </style>

  <!-- optional: mobile support with jqueryui-touch-punch -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

  <!-- for examples only! script to show code to user -->
  <!-- <script type="text/javascript" src="show_code.js"></script>-->
</head>

<body>



  <script type="text/javascript">
    // This example adds Plotly chart renderers.

    $(function() {

      var derivers = $.pivotUtilities.derivers;
      var renderers = $.extend($.pivotUtilities.renderers,
        $.pivotUtilities.plotly_renderers);

      $.getJSON("objects3.json", function(mps) {
        $("#output").pivotUI(mps, {
          renderers: renderers,
          cols: [""],
          rows: ["จังหวัด"],
          rendererName: "Table",
          rowOrder: "value_a_to_z",
          colOrder: "value_z_to_a",
        });
      });
    });

  </script>


  <!-- <p><a href="index.html">&laquo; back to PivotTable.js examples</a></p>-->

  <div id="output" style="margin: 30px;"></div>

</body>

</html>