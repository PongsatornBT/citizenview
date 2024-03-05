<?php
    include 'server.php';
	$message = $_POST['message'] ?? '';
	$name = $_POST['name'] ?? '';
	$email = $_POST['email'] ?? '';
	$lat = $_POST['lat'] ?? '';
	$lon = $_POST['lon'] ?? '';
	$rating = $_POST['rating'] ?? '';
	$title = $_POST['title'] ?? '';
	$location = $_POST['location'] ?? '';
	// $province = getProvince($lon, $lat, $provinceFeatures);
	$province = getProvinceName($lon,$lat);
	// $province = "Unknown";

	date_default_timezone_set('Asia/Bangkok');
	$date=date("Y-m-d h:i:sa");

	if($rating == '')
	{
	$rating = 0;
	}

	if($location == '')
	{
	$location = " ";
	}
	else
	{
	}

	mysqli_set_charset($conn,"utf8");
	$id = "SELECT user_id FROM watch_user WHERE user_email = '$email'";
	$result = mysqli_query($conn, $id);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while($row = mysqli_fetch_assoc($result)){
			$user_id = $row['user_id'];
		}
	}else{
		$user_id = 0;
	}

	$sql = "INSERT INTO watch_log (watch_title,watch_name, watch_email, watch_message, watch_lat, watch_lon, watch_time,watch_rating,watch_location,watch_province,user_id,watch_status)
	VALUES ('$title','$name', '$email', '$message','$lat','$lon','$date','$rating','$location','$province','$user_id','รออนุมัติ')";

	if ($conn->query($sql) === TRUE) {
	#echo "New record created successfully";
	}
	$conn->close();

?>

<!--
<?php

	
    include 'server.php';
	
	date_default_timezone_set('Asia/Bangkok');	

	// $link = mysqli_connect($host,$username,$password2,$dbname);
	$link = mysqli_connect($servername,$username,$password,$dbname);

		if (!$link) {
		    echo "Error: Unable to connect to MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}

	mysqli_query($link, "SET NAMES utf8");
	mysqli_commit($link);

?>
-->