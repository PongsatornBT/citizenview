<?php
    session_start();

    include 'server.php';
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

    $errors = array();

    if(isset($_POST['reg_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $month = mysqli_real_escape_string($conn, $_POST['month']);
        $day = mysqli_real_escape_string($conn, $_POST['day']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $birthday = sprintf("%02d-%02d-%04d", $month, $day, $year);
        $income = mysqli_real_escape_string($conn, $_POST['income']);

        $provinces = mysqli_real_escape_string($conn, $_POST['provinces']);
        $amphures = mysqli_real_escape_string($conn, $_POST['amphures']);
        $districts = mysqli_real_escape_string($conn, $_POST['districts']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zip_code']);
        
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        // if(empty($username)){
        //     array_push($errors, "Username is required");
        // }
        // if(empty($email)){
        //     array_push($errors, "Email is required");
        // }
        // if(empty($password1)){
        //     array_push($errors, "password is required");
        // }
        if($password1 != $password2){
            array_push($errors, "Password not match");
        }
        $user_check_query = "SELECT * FROM watch_user WHERE user_username = '$username' OR user_email = '$email' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){
            if($result['user_username'] === $username || $result['user_email'] === $email){
                array_push($errors, "Username or email already exists");
                $_SESSION['exists'] = "Username or email already exists";
                header("location: registerpage.php");
            }
            // if($result['user_email'] === $email){
            //     array_push($errors, "Email already exists");
            //     $_SESSION['error_email'] = "Email already exists";
            //     header("location: registerpage.php");
            // }
        }

        else if(count($errors) == 0){
            $password = md5($password1);

            $sql = "INSERT INTO watch_user (user_username, user_password, user_firstname, user_lastname, user_email, user_gender, user_birthday, user_income,provinces_id,amphures_id,districts_id,user_zipcode, user_address)
            VALUES ('$username','$password','$firstname','$lastname','$email','$gender','$birthday','$income','$provinces', '$amphures','$districts','$zipcode','$address')";
            mysqli_query($conn, $sql);
            
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You now sign up";
            header('location: loginpage.php');
        }else if($password1 != $password2){
            array_push($errors, "password and confirm password doesn't match");
            $_SESSION['error'] = "password and confirm password doesn't match";
            header("location: registerpage.php");
        }else{
        
        }
    }
?>