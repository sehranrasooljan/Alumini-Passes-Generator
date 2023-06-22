<?php 
//just updating course , section , batch of student donto not go with file name
    session_start();
    include_once "connection.php";
    error_reporting(0);

    $user_id = $_SESSION['user_id'];

    $course= mysqli_real_escape_String($conn, $_POST['course']);
    $batch= mysqli_real_escape_String($conn, $_POST['batch']);
    $section= mysqli_real_escape_String($conn, $_POST['section']);

    $teacherstatus = 1;

    if(!empty($course) && !empty($batch) && !empty($section)){ 
            $sqlupdatestatus = "UPDATE `tbl_user` SET `user_course`='{$course}',`user_batch`='{$batch}',`user_section`='{$section}',`teach_status`='1' WHERE `user_id` = {$user_id}";
            if(mysqli_query($conn, $sqlupdatestatus)){    
                echo "success";
            }
            else{
                echo "Try Again !";
            }
    }
    else{
        echo "All Fields Are Required !";
    }
?>