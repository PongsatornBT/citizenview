<!DOCTYPE html>
<html>
<head>
<!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://www.navanurak.in.th/AssTempageIndex/css/font-awesome.min.css" type="text/css" media="screen">
<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 0px solid #ddd;
}

th, td {
  text-align: left;
  padding-top:20px;
  padding-bottom:20px;
  padding-right:20px; 
}

tr:nth-child(even){background-color: #f2f2f2}

#gray_border {
  border: 1px solid gray;
  padding: 10px;
  border-radius: 25px;
}

</style>
</head>
<body>
<?php

$json = 'syn_obj2.json';
$contents = file_get_contents($json); 
$arr = json_decode($contents,true); 

#echo "$contents";
$results = array_filter($arr['synnonym'], function($synnonym) {
  $obj = $_GET['title'];
    if($synnonym['first_name'] == $obj)
    {
  	return $synnonym['first_name'];
    }
  else if($synnonym['second_name'] == $obj)
    {
  	return $synnonym['second_name'];
    }
  else if($synnonym['third_name'] == $obj)
    {
     return $synnonym['third_name'];
    }
  else if($synnonym['fourth_name'] == $obj)
    {
     return $synnonym['fourth_name'];
    }
  else if($synnonym['fifth_name'] == $obj)
    {
     return $synnonym['fifth_name'];
    }
   else if($synnonym['sixth_name'] == $obj)
    {
     return $synnonym['sixth_name'];
    }
   else if($synnonym['seventh_name'] == $obj)
    {
     return $synnonym['seventh_name'];
    }
  else if($synnonym['eighth_name'] == $obj)
    {
     return $synnonym['eighth_name'];
    }
  else if($synnonym['ninth_name'] == $obj)
    {
     return $synnonym['ninth_name'];
    }
  else if($synnonym['tenth_name'] == $obj)
    {
     return $synnonym['tenth_name'];
    }
  
});

#var_dump($results);

#print_r(array_keys($results));

$mykey = array_keys($results);

#echo "$mykey[0]";
$mykey = $mykey[0];

#var_dump($results[$mykey]);

#echo $results[$mykey][first_name];

$obj = $results[$mykey][first_name];
$obj2 = $results[$mykey][second_name];
$obj3 = $results[$mykey][third_name];
$obj4 = $results[$mykey][fourth_name];
$obj5 = $results[$mykey][fifth_name];
$obj6 = $results[$mykey][sixth_name];
$obj7 = $results[$mykey][seventh_name];
$obj7 = $results[$mykey][seventh_name];
$obj8 = $results[$mykey][eighth_name];
$obj9 = $results[$mykey][ninth_name];
$obj10 = $results[$mykey][tenth_name];


$json2 = 'https://www.navanurak.in.th/museum_api/itemmuseums.php';
$contents2 = file_get_contents($json2); 
$data = json_decode($contents2,true); 

#### get Museum Site###
$json3 = 'https://www.navanurak.in.th/museum_api/main_museums.php';
$contents3 = file_get_contents($json3); 
$data3 = json_decode($contents3,true); 

foreach ($data3 as $key3 => $value3) {
$my_museum_code = $data3[$key3]['museum_code'];
#echo "$data3[$key3]['museum_code']<br>";
#echo "$my_museum_code <br>";
}
#var_dump($result3);
### End of get Museum Site ###



foreach ($data as $key => $value) {
    #echo $data[$key]['museum_name'];
    
    $myobj = $data[$key]['obj_title'];
    $museum_code = $data[$key]['ownermuseum_code'];
    $pic_path = $data[$key]['pic_path'];
    $obj_refcode = $data[$key]['obj_refcode'];
    $obj_path = $data[$key]['obj_path'];
    $obj_physicals = $data[$key]['obj_physicals'];
    #echo "<b>$museum_code - $myobj ::</b> $obj = $obj2 = $obj3 = $obj4ช= $obj5 $obj6 <br>";
    
    foreach ($data3 as $key3 => $value3) {
	$my_museum_code = $data3[$key3]['museum_code'];
	if($my_museum_code == $museum_code)
	  {
	#echo "$my_museum_code : $my_museum_name <br>";
	$my_museum_name = $data3[$key3]['museum_name'];
	  } 
	}


 echo "<div style='overflow-x:auto;'>";   
 echo " <table id ='gray_border'>";
    
    if ("$myobj" == "$obj") 
    { 
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border'><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td> <a href='$obj_path'>ชื่อ:  $obj </a><br> ที่มา : $my_museum_name <br> $obj_physicals</td> ";
    	echo " </tr>  ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }
    else if ("$myobj" == "$obj2")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj2 </a> <br>ที่มา : $my_museum_name  <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }
    else if ("$myobj" == "$obj3")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td> <a href='$obj_path'>ชื่อ:  $obj3  </a><br>ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr>"; 
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }
    else if ("$myobj" == "$obj4")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border'  ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td> <a href='$obj_path'>ชื่อ:  $obj4  </a><br>ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr>"; 
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }
    else if ("$myobj" == "$obj5")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj5 </a><br> ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }
    else if ("$myobj" == "$obj6")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj6 </a><br> ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }
    else if ("$myobj" == "$obj7")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj7 </a><br> ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }  
    else if ("$myobj" == "$obj8")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj8 </a><br> ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }  
    else if ("$myobj" == "$obj9")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj9 </a><br> ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    } 
    else if ("$myobj" == "$obj10")
    {
    	if($obj_refcode != $obj_refcode2)
    	{
    	echo " <tr>  ";
    	echo "<td width='150' valign='top' id='gray_border' ><a href='$obj_path'><img src ='$pic_path' width ='150'> </a></td><td><a href='$obj_path'> ชื่อ:  $obj10 </a><br> ที่มา : $my_museum_name <br> $obj_physicals </td> ";
    	echo " </tr> ";
    	}
    	$obj_refcode2 = $obj_refcode;
    	$alert =1;
    }   
}

if ($alert != 1)
{
 echo "ไม่มีข้อมูลที่เกี่ยวข้อง";
}

echo "</div>";
?>
</body>