<?php
    session_start();
    include_once "php/connection.php";

    if(!isset($_SESSION['user_id'])){
       // header("location: ../index.html");
    }

    $user_id = $_SESSION['user_id'];

    $sql = mysqli_query($conn,"SELECT * from tbl_user WHERE `user_id` = '{$user_id}'");
    if(mysqli_num_rows($sql) > 0)
    {
        $result = mysqli_fetch_assoc($sql);
    }

    // $sqlother = mysqli_query($conn,"SELECT * from tbl_teacher WHERE `user_id` = '{$user_id}'");
    // if(mysqli_num_rows($sqlother) > 0)
    // {
    //     $resultother = mysqli_fetch_assoc($sqlother);
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koshish 2022</title>
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
    <section class="form login">
            <header>Koshish - 2022</header>
            <div class="welcome" style="
            display:flex;
            justify-content:space-between;
            alin-items:center;
            padding:20px;
            ">
                <p>Welcome <?php echo $result['user_name'];?> !</p>
                <div class="logout">
            <center><button style='width:80px;
            background-color:#192F59;
            border:1px solid #192F59;
            color:#fff;
            cursor:pointer;
            border-radius: 4px;
            font-size:16px;
            padding-top:4px;
            padding-bottom:4px;' onMouseOver="this.style.backgroundColor='#3DB166'" onMouseOut="this.style.backgroundColor='#192F59'" onclick="window.location.replace('php/logout.php')">Log Out</button></center>
            </div>
            </div>

            

            <?php

            if($result['teach_status'] == 0) //teach status here is actually for filling batch and course of student
            {
                echo '
                    <div class="teacher">
                        <section class="form login">
                            <form action=""  class="form">
                                
                                    <p>Please Enter Below Details</p>
                                   
                                <div class="getdata">
                                    <div class="getinput">
                             
                                        <select name="course" required>
                                            <option value="">Select Course</option>';


                                            $sqlcourse = mysqli_query($conn,"SELECT * FROM `tbl_course`");
    if(mysqli_num_rows($sqlcourse) > 0)
    {
        while($resultcourse = mysqli_fetch_assoc($sqlcourse)){
            echo ' <option value="'.$resultcourse["id"].'">'.$resultcourse["stream"].'</option>';
        }
    }
                                            
                                            echo '
                                        </select>
                                    </div>
                                    <div class="getinput">
                               
                                    <select name="batch" required hidden>
                                            <option value="">Select Batch</option>';

                                            $batchYear = 2021;

                                            while($batchYear >= 1999){
                                                echo '<option value="'.$batchYear.'">'.$batchYear.'</option>';
                                                $batchYear--;
                                            }

                                    
                                            echo '
                                        </select>
                                    </div>
                                    <div class="getinput">
                                    <select name="section" required hidden>
                                    <option value="">Select Section</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>';

                        

                            
                                    echo '
                                </select>
                                    </div>
                                    <div class="errortext"></div>
                                    <div class="submitbtn button">
                                        <center><input type="submit" value="Submit"></center>
                                    </div>
                                    <center><div class="loaderarea" style="margin-bottom:60px;display:none;"><div class="loader"></div></div></center>

                                    </div>
                                </form>
                        </section>
                    </div>';
            }

            else if($result['collage_status'] == 0 && $result['teach_status'] == 1){
                echo '<div class="collage">
                <section class="form login">
                    <form action="" class="form">
                       
                            <p>Select Dates For Passes <i class="fa-solid fa-ticket"></i></p>
                            <div class="errortext"></div>
                        <div class="getdata">
                            <div class="getinput radio-dates">
                            <div style="display:none;">
                            <input type="checkbox" name="nineteenoct"  value="1" id="nineteenoct"><label for="nineteenoct">&nbsp;&nbsp;19 Oct 2022</label>
                            </div>

                            <div style="display:none;">
                            <input type="checkbox" value="1" name="twentyoct" id="twentyoct"><label for="twentyoct">&nbsp;&nbsp;20 Oct 2022</label>
                            </div>

                            <div>
                            <input type="checkbox"  value="1" name="twentyoneoct" style="background-color:red;" id="twentyoneoct"><label for="twentyoneoct">&nbsp;&nbsp;21 Oct 2022</label>
                            </div>
                                
                                
                               
                            </div>
                          
                            <div class="submitbtn button">
                                <center><input type="submit" value="Submit"></center>
                            </div>
                            <center><div class="loaderarea" style="margin-bottom:60px;display:none;"><div class="loader"></div></div></center>
                            </div>
                        </form>
                </section>
            </div>';

            }
            else if($result['collage_status'] == 1 && $result['teach_status'] == 1){
                echo '
                <div class="details">
                    <table border=0 width="100%">
                        <tr>
                        <td style="border-bottom:1px solid white;color:black;background:yellow;font-weight:700;" colspan="2">'.$result['user_type'].' DETAILS</td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td >'.substr($result['user_email'],0,26).'</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td >'.$result['user_phone'].'</td>
                        </tr>
                        <tr>
                            <td>Course</td>
                            <td >';
                            
                            $courseid = $result['user_course'];
                            
                            $sqlcourse = mysqli_query($conn,"SELECT * FROM `tbl_course` WHERE `id` = '{$courseid}'");
    if(mysqli_num_rows($sqlcourse) > 0)
    {
        $resultcourse = mysqli_fetch_assoc($sqlcourse);
        
        echo substr($resultcourse['stream'],0,26);

        if(strlen($resultcourse['stream'])>26){
            echo "...";
        }
    }
                            
                            
                            
                            echo '</td>
                        </tr>
                      
                     
    
                    </table>
                </div>';

                

                echo '
                <div class="issue-pass">   
                    <div class="head">
                        <h3>ISSUE PASS</h3>
                        <div class="search">
                         <input type="search" id="search-issue" placeholder="Search Student !"> <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="std-list" id="issue-pass">
                        
                        
                    </div>

                </div>
                
                ';

                echo '
                <div class="issue-pass">   
                    <div class="head">
                        <h3>ALREADY ISSUED</h3>
                        <div class="search" id="issue-pass">
                         <input type="search" id="search-issued" placeholder="Search Student !"> <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="std-list std-already-issue" id="issued-pass">
                    
                    </div>

                </div>
                
                ';




            }
            ?>

<?php
//img upload
if(isset($_POST['uploadprofile']))
{
    // echo "<script>alert('clicked');</script>";
    //uploa dprohgile img
    $filename = $user_id;
    $filename .= ".jpg";
    $profileimg = $_FILES["profileimg"]["tmp_name"];
    $folderprofile = "./userimg/".$filename;
    
    $file_size_profile = $_FILES["profileimg"]['size'];
    if (($file_size_profile  > 250000)){      
        echo '<script type="text/javascript">alert("File size too large. File must be less than 200KB.");</script>'; 
    }else{
    move_uploaded_file($profileimg,$folderprofile);
      $sql_profiepicupload = "UPDATE `tbl_user` SET `img`='1' WHERE `user_id` = {$user_id}";
    if(mysqli_query($conn,$sql_profiepicupload)){
      echo '<script>
      alert("Profile Pic Uploaded !");
      window.location.replace("user.php");</script>'; 
    }
    }
}

?>

            <script>
                 var loadFilep = function (event,picid) {
      var out = ["outputprofile"];
      var output = document.getElementById(out[picid]);
      if(event.target.files[0].size < 250000){
      output.src = URL.createObjectURL(event.target.files[0]);
      output.style.height = "150px";
      output.style.width = "150px";
        output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
      };
      }else{ 
        alert("File size too large. File must be less than 200KB.");
        output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
      };
      }
    };

            </script>


        
    </section>
    </div>

    <script src="javascript/jquery.js"></script>

    <?php

if($result['teach_status'] == 0)
{
   echo '<script src="javascript/teacher.js"></script>';
}
else if($result['collage_status'] == 0 && $result['teach_status'] == 1){
    echo '<script src="javascript/collage.js"></script>';
}
?>

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


<script>
$(document).ready(function(){
    var issuePass = document.getElementById("issue-pass");
        $.ajax({
            url : "php/fetchstudents.php",
            type : "POST",
            data : {s:"off",course:"<?php echo $courseid;?>",cond:0},
            success : function(data){
                issuePass.innerHTML = data;
            }
        });

        var issuedPass = document.getElementById("issued-pass");
        $.ajax({
            url : "php/fetchstudents.php",
            type : "POST",
            data : {s:"off",course:"<?php echo $courseid;?>",cond:1},
            success : function(data){
                issuedPass.innerHTML = data;
            }
        });

        var issueSearch =  document.getElementById("search-issue");
        var issuedSearch =  document.getElementById("search-issued");

        issueSearch.addEventListener("keyup",()=>{
            $.ajax({
            url : "php/fetchstudents.php",
            type : "POST",
            data : {s:issueSearch.value,course:"<?php echo $courseid;?>",cond:0},
            success : function(data){
                issuePass.innerHTML = data;
            }
        });
        });

        issuedSearch.addEventListener("keyup",()=>{
            // alert("SDfdf");
            $.ajax({
            url : "php/fetchstudents.php",
            type : "POST",
            data : {s:issuedSearch.value,course:"<?php echo $courseid;?>",cond:1},
            success : function(data){
                issuedPass.innerHTML = data;
            }
        });
        });
});
</script>
</body>
</html>
