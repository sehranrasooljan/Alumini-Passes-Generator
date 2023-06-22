<?php 
    session_start();
    include_once "connection.php";
    error_reporting(0);

    $username = mysqli_real_escape_String($conn, $_POST['username']);
    $password = mysqli_real_escape_String($conn, $_POST['psw']);
    $word = "@";

    if(!empty($username) && !empty($password)){
        if(strpos($username, $word) == true){
            $sql = mysqli_query($conn,"SELECT * from tbl_user WHERE user_email = '{$username}' AND user_type = 'Teacher'");
        }
        else
        {
            $sql = mysqli_query($conn,"SELECT * from tbl_user WHERE user_phone = '{$username}' AND user_type = 'Teacher'"); 
        }
        if(mysqli_num_rows($sql) > 0)
        {
            $result = mysqli_fetch_assoc($sql);
            if($password == $result['user_psw'])
            {
                $_SESSION['user_id'] = $result['user_id'];
                echo "success";
            }
            else
            {
                echo "Incorrect Password";
            }
        }
        else 
        {
            echo "Email/Mobile Number Not Registered !";
        }
    }
    else{
        echo "All Fields Are Required !";
    }
?>