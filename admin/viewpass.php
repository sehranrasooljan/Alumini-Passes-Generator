<?php
    session_start();
    include_once "php/connection.php";

    $user_id = $_GET['id'];

    $sql = mysqli_query($conn,"SELECT * from tbl_user WHERE `user_id` = '{$user_id}'");
    if(mysqli_num_rows($sql) > 0)
    {
        $result = mysqli_fetch_assoc($sql);
    }

    $teach_id = $result['teach_id'];
    $sql_teach = mysqli_query($conn,"SELECT * from tbl_user WHERE `user_id` = '{$teach_id}'");
    if(mysqli_num_rows($sql_teach) > 0)
    {
        $result_teach = mysqli_fetch_assoc($sql_teach);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['user_name'];?> - Koshish Alumni Pass 2022</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/user.css">
    <style>

       .pass{
        margin:20px 10px;
        width:420px;
        background:White;
        color:black;
        padding:20px 0px;
        border-radius:12px;
       }

       .pass .top .left img{
        width:55px;
        height:50px;
       }

       .pass .top{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:0 15px;
       }

       .pass .top h2{
        font-size:20px;
       }


       .pass .head h1{
        background:red;
        color:white;
        margin:10px 0;
        text-align:center;
        font-weight:500;
       }

       .passtype{
        display:flex;
        padding:5px 15px 15px 15px;
        justify-content:space-between;
        align-items:center;
        border-bottom:2px dashed black;
       }

       .passlogo{
        background:purple;
        color:white;
        padding:4px 8px;
        border-radius:6px;
       }

       .passlogo h3{
        font-weight:500;
       }

       .passno p{
        font-weight:700;
        font-size:24px;
        color:red;
       }

       .pass .student,
       .pass .teacher{
        padding:15px;
       }

       

       
       .pass .student img{
        width:150px;
        height:150px;
        display:block;
        margin:20px auto;
        border-radius:50%;
        /* object-fit: cover; */
       }

       .std-text{
        font-weight:500;
        font-size:14px;
        margin:8px 0;
       }

       .std-text span{
        margin:0 8px;
        word-wrap:wrap;
       }

       .std-text-name{  
        color:Red;
       }

       .date h4{
        background:Red;
        text-align:center;
        padding:5px;
        color:White;
       }

       .pass .teacher{
        border-bottom:2px dashed black;
       }

       .qr{
        padding:25px;
       }

       .qr img{
        width:180px;
        height:180px;
        display:block;
        margin:0 auto;
       }

       .qr p{
        text-align:center;
        margin:10px;
       }

      


       .floatingprint{
        position:fixed;
        bottom: 20px;
        right:20px;
       }

       .floatingprint button{
        background:orange;
        padding:10px;
        color:black;
        font-size:14px;
        border:none;
        border-radius:12px;
        cursor:pointer;
       }

       .floatingprint button:nth-child(1){
        background:green;
  
        color:white;

       }


       /* @media (min-width:801px) {
            .pass{
                max-width:900px;
                width:70%;

                display:grid;
                grid-template-areas:
                
                "top top"
                "head head"
                "passtype passtype"
                "student teacher"
                "date date"
                "qr qr";
            }

            .top{
                grid-area:top;
            }

            .head{
                grid-area:head;
            }

            .passtype{
                grid-area:passtype;
            }

            .student{
                grid-area:student;
                display:grid;
                grid-template-areas:
                "heading heading"
                "std-img std-details";
            }

            .student h3{
                grid-area:heading;
            }

            

            .student .std-detils{
                margin:20px 0;
                
            }

            .pass .teacher{
                grid-area:teacher;
                border:none;
            }

            .date{
                grid-area:date;
            }

            .qr{
                grid-area:qr;
            }


       } */


</style>


        <!-- fontawesome -->
        <script src="https://kit.fontawesome.com/ceef2fc685.js" crossorigin="anonymous"></script>
</head>
<body id='bg'>

<div class="floatingprint">
    <?php
    if( $result['pass_status'] == 0){
        echo '<a href="issue.php?user='.$user_id.'"><button>Issue Pass</button></a>';
    }
    ?>
    
    <button onclick="print()"><i class="fa-solid fa-download"></i> Download Pass</button>
</div>

        <div class="pass">
            <div class="top">
                <div class="left">
                    <img src="./pctelogo.png" alt="">
                </div>
                <div class="right">
                <h2>PCTE Group of Institutes</h2>
                </div>
            </div>
            <div class="head">
                    <h1 >Festaweek-2022</h1>
            </div>
            <div class="passtype">
                <div class="passlogo">
                    <h3>Alumni Pass</h3>
                </div>
                <div class="passno">
                    <p>AL <?php 
                    
                    if($user_id > 9){
                        echo $user_id;
                    }else{
                        echo "0".$user_id;
                    }
                    ?></p>
                </div>
            </div>
            

            <div class="student">
                <h3>STUDENT DETAILS</h3>
                <div class="std-img">
                    <img src="../userimg/<?php echo $user_id.'.jpg';?>" alt="">
                </div>
                <div class="std-detils">
                    <p class="std-text std-text-name"><i class="fa-solid fa-user"></i> <span><?php echo $result['user_name'];?></span>
                    </p>
                    <p class="std-text"><i class="fa-solid fa-envelope"></i> 
                    <span><?php echo $result['user_email'];?></span>
                </p>
                    <p class="std-text"><i class="fa-solid fa-phone"></i><span><?php echo $result['user_phone'];?></span></p>
                    <p class="std-text"><i class="fa-solid fa-book"></i> <span>
                    <?php 
                    

                    $courseid = $result['user_course'];
                            
                    $sqlcourse = mysqli_query($conn,"SELECT * FROM `tbl_course` WHERE `id` = '{$courseid}'");
if(mysqli_num_rows($sqlcourse) > 0)
{
$resultcourse = mysqli_fetch_assoc($sqlcourse);

echo substr($resultcourse['stream'],0,40);

if(strlen($resultcourse['stream'])>40){
    echo "...";
}
}
                    
                    
                    ?>
                    </span></p>
                    <p class="std-text"><i class="fa-solid fa-calendar-days"></i> <span>
                    <?php echo $result['user_batch']."-".$result['user_section'];?>
                    </span></p>
                </div>

            </div>

            <div class="date">
               <h4>Valid For 21 OCT 2022</h4> 
            </div>

            <?php 
            if($result['pass_status'] == 1){
                echo '<div class="teacher">
                <h3>REF. TEACHER DETAILS</h3>
                <div class="teach-detils">
                <p class="std-text "><i class="fa-solid fa-user"></i> <span>'.$result_teach['user_name'].'</span>
                        </p>
                        <p class="std-text"><i class="fa-solid fa-envelope"></i> 
                        <span>'.$result_teach['user_email'].'</span>
                    </p>
                        <p class="std-text"><i class="fa-solid fa-phone"></i><span>'.$result_teach['user_phone'].'</span></p>
                        <p class="std-text"><i class="fa-solid fa-book"></i> <span>'.substr($resultcourse['stream'],0,40).'</span></p>
            
                    </div>
                </div>';

                echo '
                <div class="qr">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://'.$_SERVER['HTTP_HOST'].'/viewpass.php?id='.$user_id.'" alt="">
                <p>Scan to Verify</p>

                
            </div>';

              //echo $_SERVER['HTTP_HOST'];
            }

            ?>

        
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
