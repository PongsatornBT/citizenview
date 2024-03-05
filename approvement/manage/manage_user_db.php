<?php
    session_start();
    include '../../server.php';

    //add user data
    $errors_add = array();
    if(isset($_POST['add_user'])){
        $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $name = $fname . ' '. $lname;
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm = mysqli_real_escape_string($conn, $_POST['c_password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $agency = mysqli_real_escape_string($conn, $_POST['agency']);
        $id = $_SESSION['id'];
        if($password != $confirm){
            array_push($errors_add, "Password not match");
        }
        $user_check_query = "SELECT * FROM approve_user WHERE user_username = '$username' OR user_email = '$email' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){
            if($result['user_username'] === $username || $result['user_email'] === $email){
                array_push($errors_add, "Username or email already exists");
                $_SESSION['exists'] = "Username or email already exists";
                header("location: add_user.php");
            }
        }

        if(count($errors_add) == 0){
            $password = md5($password);

            $sql = "INSERT INTO approve_user(user_username, user_password, user_name, user_email, user_tel, user_agency, user_add_id)
            VALUES ('$username','$password','$name','$email','$tel','$agency', '$id')";
            mysqli_query($conn, $sql);
            
            $_SESSION['add_user'] = "เพิ่มสำเร็จ";
            header('location: manage_user.php');
        }else if($password != $confirm){
            array_push($errors_add, "password and confirm password doesn't match");
            $_SESSION['add_error'] = "password and confirm password doesn't match";
            header("location: add_user.php");
        }
    }
        
    //edit user data
    $errors_edit = array();
    if(isset($_POST['edit_user'])){
        $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $name = $fname . ' '. $lname;
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $agency = mysqli_real_escape_string($conn, $_POST['agency']);

        $user_check_query2 = "SELECT * FROM approve_user WHERE user_email = '$email'";
        $query2 = mysqli_query($conn, $user_check_query2);
        $result_edit = mysqli_fetch_assoc($query2);
        // if($result_edit){
        //     if($result_edit['user_email'] === $email){
        //         array_push($errors_edit, "Username or email already exists");
        //         $_SESSION['exists_edit'] = "Username or email already exists";
        //         header("location: edit_user.php");
        //     }
        // }

        $user = $_SESSION['username_approve'];
        $user_check_query2 = "SELECT * FROM approve_user WHERE user_username = '$user'";
        $query2 = mysqli_query($conn, $user_check_query2);
        $result_edit = mysqli_fetch_assoc($query2);
        
        if($result_edit){
            if($result_edit['user_password'] !== md5($password)){
                array_push($errors_edit, "wrong");
                $_SESSION['password_wrong'] = "wrong";
                header("location: edit_user.php");
            }
        }
        
        if(count($errors_edit) == 0){
            
            $sql2 = "UPDATE approve_user
            SET `user_username`='$username',`user_name`='$name',`user_email`='$email'
            ,`user_tel`='$tel',`user_agency`='$agency' WHERE user_username = '$username'";
            mysqli_query($conn, $sql2);
            
            $_SESSION['edit_user'] = "แก้ไขสำเร็จ";
            $_SESSION['name'] = $name;
            header('location: manage_user.php');
        }
    }

    //change password
    $errors_change = array();
    if(isset($_POST['change_password'])){
        $password_old = mysqli_real_escape_string($conn, $_POST['password_old']);
        $password_new1 = mysqli_real_escape_string($conn, $_POST['password_new1']);
        $password_new2 = mysqli_real_escape_string($conn, $_POST['password_new2']);

        $user = $_SESSION['username_approve'];
        $user_check_query3 = "SELECT * FROM approve_user WHERE user_username = '$user'";
        $query3 = mysqli_query($conn, $user_check_query3);
        $result_change = mysqli_fetch_assoc($query3);
        
        if($result_change){
            if($result_change['user_password'] == md5($password_old)){
                if($password_new1 == $password_new2){
                    $password = md5($password_new1);
                }else{
                    array_push($errors_change, "wrong");
                    $_SESSION['password_new_wrong'] = "wrong";
                    header("location: change_password.php");   
                }
            }else{
                array_push($errors_change, "wrong");
                $_SESSION['password_change_wrong'] = "wrong";
                header("location: change_password.php");   
            }
        }
        if(count($errors_change) == 0){
            if($password){
                $sql = "UPDATE approve_user
                SET `user_password`='$password' WHERE user_username = '$user'";
                mysqli_query($conn, $sql);
                
                $_SESSION['change_password_success'] = "แก้ไขสำเร็จ";
                header('location: edit_user.php');
            }
        }
    }
?>