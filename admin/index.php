<?php 
    session_start();
    include_once "./php/connection.php";
    // error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Koshish Alumni Passes - 2022</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<style>
.loader {
  border: 5px solid black;
  border-radius: 50%;
  border-top: 5px solid  #3DB166;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.getinput select
{
    background-color:rgba(255,255,255,0.07);
        height:40px;
        width:100%;
        font-size:14px;
        padding:3px;
        color:white;
        border: 1px solid grey;
        border-radius: 4px;
        border-left:none;
        border-top:none;
        border-right:none;

        outline:none;
        cursor:pointer;
}


.getinput select option
{
    background-color:rgba(255,255,255,0.07);
    font-size:14px;
    padding:3px;
    color:black;
}
</style>
<body id='bg'>
    <!--Loading Screen-->
    <div id="loader">
        <img src='img/loader.gif'>
    </div>


    <div class="wrapper" style='display:none;'>
    <section class="form login">
        <form action="" method="POST" class="form">
            <header>Issue Alumni Passes</header>
            <div class="errortext"></div>
            <div class="getdata">
                <div class="getinput">
                    <select name="courses" id="">
                        <option value="">Select Course</option>
                        <?php
                            $sqlcourse = mysqli_query($conn,"SELECT * FROM `tbl_course`");
                            if(mysqli_num_rows($sqlcourse) > 0)
                            {
                                while($resultcourse = mysqli_fetch_assoc($sqlcourse)){
                                    echo ' <option value="'.$resultcourse["id"].'">'.$resultcourse["stream"].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="getinput">
                      <input type="password" name="psw" id='psw' placeholder="Password" required>
                      <p style='font-size:9px;'>&nbsp;</p>&nbsp;
                      <input type="checkbox" onclick="showpsw()">&nbsp;<span style='color:grey;'>Show Password</span>
                </div>
                <div class="submitbtn button">
                    <center><input type="submit" name="login" value="Log In"></center>
                </div>

                <center><div class='loaderarea' style='margin-bottom:60px;display:none;'><div class="loader"></div></div></center>


                <div class="forgotpsw">
                    <a href='#'>Forget Password ?</a>
                </div>
            
            </div>
        </form>
        </section>
    </div>

    <?php
    if(isset($_POST['login'])){
        $courses = $_POST['courses'];
        $psw = $_POST['psw'];

        if(!empty($psw) && !empty($psw)){
            $sql = mysqli_query($conn,"SELECT * FROM `tbl_course` WHERE `id` = '{$courses}' && `pin` = '{$psw}'"); 
            if(mysqli_num_rows($sql) > 0)
            {
                $result = mysqli_fetch_assoc($sql);
                if($psw == $result['pin'])
                {
                    $_SESSION['course_id'] = $result['id'];
                    echo "<script>alert('Login Succesfull !');</script>";
                    echo "<script>window.location.replace('user.php');</script>";
                }
            
            }else
            {
                echo "<script>alert('Incorrect Password !');</script>";
                // echo "<script>window.location.replace('index.php');</script>";
            }
        }
    }
    ?>

    <script src="javascript/showpassword.js"></script>
    <!-- <script src="javascript/login.js"></script> -->
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
                    $('#bg').css("background-image", "url(img/0.jpg)"); 

                    var images = Array("img/0.jpg",
                                "img/2.jpg",
                                "img/3.jpg",
                                "img/4.jpg",
                                "img/5.jpg");
                    var currimg = 0;
                    function loadimg(){
                    $('#bg').animate({ opacity: 1 }, 600,function(){          
                            $('#bg').animate({ opacity: 1}, 600,function(){
                                currimg++;
                                if(currimg > images.length-1){
                                    currimg=0;
                                }
                                var newimage = images[currimg];             
                                $('#bg').css("background-image", "url("+newimage+")"); 
                                $('#bg').animate({ opacity: 1 },600,function(){
                                    setTimeout(loadimg,5000);
                                });
                            });
                        });
                    }
                    setTimeout(loadimg,5000);
                }
                else{
                    $('#bg').css("background-color", "black");
                }
            }
        }); 
    </script>
</body>
</html>