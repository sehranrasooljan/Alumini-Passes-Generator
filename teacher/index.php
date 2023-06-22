<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Koshish Alumni Passes - 2022</title>
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
</style>
<body id='bg'>
    <!--Loading Screen-->
    <div id="loader">
        <img src='img/loader.gif'>
    </div>


    <div class="wrapper" style='display:none;'>
    <section class="form login">
        <form action="" class="form">
            <header>Issue Alumni Passes</header>
            <div class="errortext"></div>
            <div class="getdata">
                <div class="getinput">
                     <input type="text" name="username" placeholder="Email or Mobile Number" required>
                </div>
                <div class="getinput">
                      <input type="password" name="psw" id='psw' placeholder="Password" required>
                      <p style='font-size:9px;'>&nbsp;</p>&nbsp;
                      <input type="checkbox" onclick="showpsw()">&nbsp;<span style='color:grey;'>Show Password</span>
                </div>
                <div class="submitbtn button">
                    <center><input type="submit" value="Log In"></center>
                </div>

                <center><div class='loaderarea' style='margin-bottom:60px;display:none;'><div class="loader"></div></div></center>


                <div class="forgotpsw">
                    <a href='#'>Forget Password ?</a>
                </div>
                
                <div class="newuser">
                    <p>Don't have an account ? <a href='signup.php'>Sign Up</a></p>
                </div>
            </div>
        </form>
        </section>
    </div>

    <script src="javascript/showpassword.js"></script>
    <script src="javascript/login.js"></script>
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