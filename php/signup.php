<?php 
    session_start();
    include_once "connection.php";
    error_reporting(0);

   
    $user= mysqli_real_escape_String($conn, $_POST['user']);
    $name= mysqli_real_escape_String($conn, $_POST['name']);
    $email= mysqli_real_escape_String($conn, $_POST['email']);
    $phone= mysqli_real_escape_String($conn, $_POST['phone']);
    $psw= mysqli_real_escape_String($conn, $_POST['password']);

    $collagestatus = 1;
    
    if($user == 'Student'){
        $teacherstatus = 0;
    }
    else{
        $teacherstatus = 1;
    }

    if(!empty($user) && !empty($name) && !empty($email) && !empty($phone) && !empty($psw)){
        $sql_usercheck = "SELECT * FROM `tbl_user` WHERE `user_email` = '{$email}' OR `user_phone` = '{$phone}' ";
        $resultcheck = mysqli_query($conn,$sql_usercheck);
        if (mysqli_num_rows($resultcheck) == 0) {
            $sql = "INSERT INTO `tbl_user`(`user_type`, `user_name`, `user_email`, `user_phone`, `user_psw`, `tj21`,`collage_status`, `teach_status`) VALUES ('{$user}','{$name}','{$email}','{$phone}','{$psw}','1','{$collagestatus}','{$teacherstatus}')";
            if(mysqli_query($conn, $sql))
            {
                $sql_userid = "SELECT * FROM `tbl_user` WHERE `user_type` = '{$user}' AND `user_name` = '{$name}' AND  `user_email` = '{$email}' AND `user_phone` = '{$phone}' AND `user_psw` = '{$psw}' AND `collage_status` = '{$collagestatus}' AND `teach_status` = '{$teacherstatus}'";
                $result = mysqli_query($conn,$sql_userid);
                $row = mysqli_fetch_assoc($result);

                $user_id = $row['user_id'];
                $_SESSION["user_id"] = $user_id; 
                        echo "success";
                    
            }
            else{
                echo "Try Again !";
            }
        }
        else{
            echo "User Already Exist !";
        }
    }
    else{
        echo "All Fields Are Required !";
    }
?>