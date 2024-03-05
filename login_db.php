<?php
    session_start();
    include 'server.php';

    $errors = array();

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
            $query = "SELECT * FROM watch_user WHERE user_username = '$username' AND user_password = '$password'";
            $result = mysqli_query($conn, $query);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $_SESSION['email'] = $row['user_email'];
                    $_SESSION['name'] = $row['user_firstname'];
                    $_SESSION['id'] = $row['user_id'];
                }
            }
            if(mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                // $_SESSION['success'] = "Your are now log in";
                // header("location: formpage11.php");
                header("location: index.php");
            }else{
                array_push($errors, "Wrong username or password please try again.");
                $_SESSION['error'] = "Wrong username or password try again!";
                header("location: loginpage.php");
            }
        }
    }else if(isset($_POST['login_guest'])){
        $username = "guest";
        $password = "guest";
        $query = "SELECT * FROM watch_user WHERE user_username = '$username' AND user_password = '$password'";
        $result = mysqli_query($conn, $query);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION['email'] = $row['user_email'];
                $_SESSION['name'] = $row['user_firstname'];
                    $_SESSION['id'] = $row['user_id'];
            }
        }
        if(mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            // $_SESSION['success'] = "Your are now log in";
            // header("location: formpage11.php");
            header("location: index.php");
        }
    }
?>