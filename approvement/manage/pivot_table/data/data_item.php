<?php

$json = 'syn_obj.json';
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


$json2 = 'https://www.navanurak.in.th/muse_api/index.php/api/v1/manuscript';
//$json2 = 'merge_json.php';
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
    $category_name = $data[$key]['category_name'];
    $obj_keyword = $data[$key]['obj_keyword'];
    $obj_physicals = $data[$key]['obj_physicals'];
    $obj_physicals = trim(preg_replace('/\s+/', ' ', $obj_physicals));
    $obj_physicals = str_replace('“', ' ', $obj_physicals);
    $obj_physicals = str_replace('”', ' ', $obj_physicals);
    $obj_physicals = str_replace('"', ' ', $obj_physicals);
    $obj_latitude = $data[$key]['latitude'];
    $obj_longitude = $data[$key]['longitude'];
   # echo "<b>$museum_code - $myobj ::</b> $obj = $obj2 = $obj3 = $obj4 $obj5 <br>";
    
    foreach ($data3 as $key3 => $value3) {
	$my_museum_code = $data3[$key3]['museum_code'];
	if($my_museum_code == $museum_code)
	  {
	#echo "$my_museum_code : $my_museum_name <br>";
	$my_museum_name = $data3[$key3]['museum_name'];
	   $my_museum_province = $data3[$key3]['province'];
	   $my_museum_lat = $data3[$key3]['latitude'];
	   $my_museum_lon = $data3[$key3]['longitude'];
	   $my_museum_province = trim($my_museum_province);
	  } 
	}
	
/*test */	
	
	if ("$myobj" == "$obj") 
	{
	 $myobj = $obj;
	 $check = 1;
	}
	else if ("$myobj" == "$obj2")
	{
	$myobj = $obj2;
	$check = 1;
	}
	else if ("$myobj" == "$obj3")
	{
	$myobj = $obj3;
	$check = 1;
	}
	else if ("$myobj" == "$obj4")
	{
	$myobj = $obj4;
	$check = 1;
	}
	else if ("$myobj" == "$obj5")
	{
	$myobj = $obj5;
	$check = 1;
	}
	
	
		if(($obj_refcode != $obj_refcode2) and ($check == 1))
    	{
    	$my_json = "
    	{
   			 \"type_name\": \"วัตถุ\",
    		  \"title\": \"$myobj\",
    		 \"outline\": \"$obj_physicals\",
    		  \"rating\": 9.3,
              \"pic_path\": \"$pic_path\",
    		  \"obj_path\": \"$obj_path\",
          	\"source_name\": \"$my_museum_name\",
    		\"province\": \"$my_museum_province\",
    	   	\"category\": \"$category_name\",
    		\"year\": null,
    		\"runtime\": null,
    		\"keywords\": \"$obj_keyword\",
    		\"id\": \"$obj_refcode\"   
    		}, 
    	".$my_json;

    	}
    	
    	$obj_refcode2 = $obj_refcode;
    	$alert =1; 
    	$check=0; 
   
}

if ($alert != 1)
{
 /*echo "ไม่มีข้อมูลที่เกี่ยวข้อง";*/
}

$json3 = $my_json;
/*echo "</div>";*/
//$my_json = substr($my_json, 0, -8);
//echo "[ $my_json] ";

?>