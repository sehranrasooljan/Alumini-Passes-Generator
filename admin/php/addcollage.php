<?php 
    session_start();
    include_once "connection.php";
    error_reporting(0);

    $user_id = $_SESSION['user_id'];

    $tjone= mysqli_real_escape_String($conn, $_POST['nineteenoct']);
    $tjtwo= mysqli_real_escape_String($conn, $_POST['twentyoct']);
    $tjthree= mysqli_real_escape_String($conn, $_POST['twentyoneoct']);

    $collagestatus = 1;

            $sqlupdatestatus = "UPDATE `tbl_user` SET `tj19`='{$tjone}',`tj20`='{$tjtwo}',`tj21`='{$tjtwo}',`collage_status`='{$collagestatus}' WHERE `user_id` = {$user_id}";
            if(mysqli_query($conn, $sqlupdatestatus)){    
                echo "success";
            }
            else{
                echo "Try Again !";
            }
?>