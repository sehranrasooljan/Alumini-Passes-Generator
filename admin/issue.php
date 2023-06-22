<?php
    session_start();
    include_once "php/connection.php";

    if(!isset($_SESSION['user_id'])){
       // header("location: ../index.html");
    }

    $course_id = $_SESSION['course_id'];

    $user_id = $_GET['user'];

    // echo $course_id;
    $sqlcourse = mysqli_query($conn,"SELECT * FROM `tbl_course` WHERE `id` = '{$course_id}'");
    if(mysqli_num_rows($sqlcourse) > 0)
    {
        $resultcourse = mysqli_fetch_assoc($sqlcourse);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $resultcourse['stream'];?> - Koshish 2022</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/user.css">


    <style>
.radio-dates div{
    margin:12px 0; 

}

.details table td{
    padding:6px 10px 6px 6px;
}

.details table tr td:nth-child(1){
    color:yellow;
}



table,tr,td{
    border:1px solid white;
    border-collapse:collapse;
}

.uploadimg{
    margin:30px 15px;
}

.uploadimg p{
    color:yellow;
}

.uploadimg .img img{
    display:block;
    margin:20px auto;
    border-radius:50%;
}

.uploadimg .btn{
    background-color: #3DB166;
    color: rgb(255, 255, 255);
    cursor: pointer;
    border-radius: 4px;
    font-size: 14px;
    padding:4px;
}

.issue-pass{
    padding:20px 15px;
}

.issue-pass .head{
    border-bottom:2px solid white;
    padding:5px 0;
    margin:0 0 10px 0;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.issue-pass .head input{
    padding:4px;
    outline:none;
    background:black;
    color:white;
    border:none;
    width:150px;
}

::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: lightgrey;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: lightgrey;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: lightgrey;
}

.issue-pass .std-list{
    max-height:220px;
    overflow-y:auto;
}

.issue-pass .std-list .std{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:15px;
}

.issue-pass .std-list .std button{
    padding:2px 12px;
    background:yellow;
    border:none;
    border-radius:4px;
    cursor:pointer;
}

.issue-pass .std-list .std-already-issue button{
    background:green;
    color:white;
}

.wrapper h1{
    text-align:center;
    margin:10px;
}

.wrapper p{
    text-align:center;
    margin:10px;
}

</style>


        <!-- fontawesome -->
        <script src="https://kit.fontawesome.com/ceef2fc685.js" crossorigin="anonymous"></script>
</head>
<body id='bg'>
    <!--Loading Screen-->
    <div id="loader">
        <img src='img/loader.gif'>
    </div>


    <div class="wrapper" style='display:none;'>
    <div class="collage">
                <section class="form login">
                    <form action="" method="POST" class="form">
                       
                            <p>Enter Teacher Details</p>
                            <div class="errortext"></div>
                        <div class="getdata">
                            <div class="getinput">
                                <input type="text" name="teachname" placeholder="Enter Teacher Name" required>
                            </div>
                            <div class="getinput">
                            <input type="text" name="teachemail" placeholder="Enter Teacher Email" required>
                            </div>
                            <div class="getinput">
                                <input type="text" name="teachphone" placeholder="Enter Teacher Phone" required>
                            </div>
                            <div class="getinput">
                                <input type="text" name="teachpsw" placeholder="Create Your Password" required>
                            </div>
                            <div class="submitbtn button">
                                <center><input type="submit" name="submit" value="Submit"></center>
                            </div>
                           
                            </div>
                        </form>
                </section>
            </div>
    </div>
    
    <script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>

    <?php 
        if(isset($_POST['submit'])){
           
            $teachname = $_POST['teachname'];
            $teachemail = $_POST['teachemail'];
            $teachphone = $_POST['teachphone'];
            $teachpsw = $_POST['teachpsw'];

            if(!empty($teachname) && !empty($teachemail) && !empty($teachphone) && !empty($teachpsw)){
                $sql = "INSERT INTO `tbl_user`(`user_type`, `user_name`, `user_email`, `user_phone`, `user_psw`, `user_course`, `collage_status`, `teach_status`) VALUES ('Teacher','{$teachname}','{$teachemail}','{$teachphone}','{$teachpsw}','{$course_id}','1','1')";
                if(mysqli_query($conn, $sql))
                {
                //     echo "<script>
                //     alert('not able to add!');
                //  </script>";

                $sql_teach = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE `user_name` = '{$teachname}' AND  `user_email` = '{$teachemail}'  AND  `user_phone` = '{$teachphone}' AND `user_psw` = '{$teachpsw}'");
                $result_teach = mysqli_fetch_assoc($sql_teach);

                $teach_id = $result_teach['user_id'];

                if(mysqli_query($conn,"UPDATE `tbl_user` SET `teach_id`='{$teach_id}',`pass_status`='1' WHERE  `user_id`='{$user_id}'"))
                {
                    $sql_user = mysqli_query($conn,"SELECT * from tbl_user WHERE `user_id` = '{$user_id}'");
                    $result_user = mysqli_fetch_assoc($sql_user);
                echo '<script>
                    emailjs.init("CjcSmJ4jrBz8hVfTr");

                    emailjs.send("service_7lnqlol","template_u8wis66",{
                    name: "'.$result_user['user_name'].'",
                    pass_id: "'.$result_user['user_id'].'",
                    link: "http://'.$_SERVER['HTTP_HOST'].'/viewpass.php?id='.$result_user['user_id'].'",
                    from_name: "Koshish 2022 - Alumni Passes (PCTE Group of Institutes)",
                    to: "'.$result_user['user_email'].'",
                    }).then(() => {
                              alert("Mail Sent !");
                              window.location.replace("user.php");
                         }, (err) => {
                               alert("Mail Not Sent !");
                               window.location.replace("user.php");
                    });

                    // console.log(tj);

                    
                </script>';

    
                }else{
                    echo "<script>
                    alert('Not able to Issue Pass !');
    </script>";
                }

            }else{
                echo "<script>
                alert('Not able to Register !');
</script>";
            }
        }else{
                echo "<script>
                alert('All Fields are Required !');
</script>";
            }
        }
    ?>








        
    </section>
    </div>

    <script src="javascript/jquery.js"></script>



    <script>
        $(document).ready(function(){
            var myVar;
            myVar = setTimeout(showPage, 1600);

            function showPage()
            {
                $('#loader').hide();
                $('.wrapper').show();
                if(window.innerWidth >= 600 ){
                    $('#bg').css("background-image", "url('img/bg.jpg')");
                }
                else{
                    $('#bg').css("background-color", "black"); 
                }
            }
        });
    </script>
    <script>
        var countDownDate = new Date("Feb 12, 2022 00:00:00").getTime();
        var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timer").innerHTML = "Time Left : " + days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "";
        }
        }, 1000);
</script>

</body>
</html>
