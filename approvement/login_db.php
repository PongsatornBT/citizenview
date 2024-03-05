<?php
    session_start();
    include '../server.php';


    if(isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }
        if(count($errors) == 0){
            $password = md5($password); 
            $query = "SELECT * FROM approve_user WHERE user_username = '$username' AND user_password = '$password'";
            $result = mysqli_query($conn, $query);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $_SESSION['email'] = $row['user_email'];
                    $_SESSION['name'] = $row['user_name'];
                    $_SESSION['username_approve'] = $row['user_username'];
                    $_SESSION['id'] = $row['user_id'];
                }
            }
            if(mysqli_num_rows($result) == 1){
                header("location: manage/manage_data.php");
            }else{
                // array_push($errors, "Wrong username or password please try again.");
                $_SESSION['error'] = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
                header("location: loginpage_approve.php");
            }
        }
    }
?>