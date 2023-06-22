<?php
    session_start();
    include_once "php/connection.php";

    if(!isset($_SESSION['user_id'])){
       // header("location: ../index.html");
    }

    $course_id = $_SESSION['course_id'];

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
    <h1>Welcome Admin ! </h1>
    <p><?php echo $resultcourse['stream'];?></p>
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
    </div>





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
            data : {s:"off",course:"<?php echo $course_id;?>",cond:0},
            success : function(data){
                issuePass.innerHTML = data;
            }
        });

        var issuedPass = document.getElementById("issued-pass");
        $.ajax({
            url : "php/fetchstudents.php",
            type : "POST",
            data : {s:"off",course:"<?php echo $course_id;?>",cond:1},
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
            data : {s:issueSearch.value,course:"<?php echo $course_id;?>",cond:0},
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
            data : {s:issuedSearch.value,course:"<?php echo $course_id;?>",cond:1},
            success : function(data){
                issuedPass.innerHTML = data;
            }
        });
        });
});
</script>

</body>
</html>
