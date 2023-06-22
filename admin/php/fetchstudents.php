<?php
 include_once "connection.php";

 $output = "";

 $course_id = $_POST['course'];

 $cond = $_POST['cond'];

 $s = $_POST['s'];



//  echo $course_id;
if(($cond == 0 && $s == "off") || ($cond == 0 && $s == "")){
    $sql = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE `user_course` = '{$course_id}' AND `user_type` = 'Student' AND `pass_status` = '0'");
}else if(($cond == 1 && $s == "off") || ($cond == 1 && $s == "")){
    $sql = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE `user_course` = '{$course_id}' AND `user_type` = 'Student' AND `pass_status` = '1'");
}else if($cond == 0 && $s != "off"){
    $sql = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE `user_course` = '{$course_id}' AND `user_type` = 'Student' AND `pass_status` = '0' AND `user_name` like '%$s%'");
}else if($cond == 1 && $s != "off"){
    $sql = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE `user_course` = '{$course_id}' AND `user_type` = 'Student' AND `pass_status` = '1' AND `user_name` like '%$s%'");
}

 
 if(mysqli_num_rows($sql) > 0)
    {
        while($result = mysqli_fetch_assoc($sql))
        {
            $output .= '<div class="std">
            <p>'.$result['user_name'].' - '.$result['user_batch'].'</p>';

            if($cond == 0){
                $output .= ' <a href="viewpass.php?id='.$result['user_id'].'"><button>Issue</button></a>';
            }else{
                $output .= ' <a href="viewpass.php?id='.$result['user_id'].'" target="_blank"><button
                style="background:green;
                color:white;"
                
                >View</button></a>';
            }


            $output .= '
        </div>' ;
        }
    }else{
        $output = '<div class="std">
        <p style="color:red;">No Record Found !</p>
    </div>';
    }

    echo $output; 
?>