<script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
<?php 
    session_start();
    include_once "./php/connection.php";
    // error_reporting(0);

    $user_id = $_GET['user'];
    $teach_id = $_GET['teach'];

    if(!empty($user_id) && !empty($teach_id)){
        $sql = "UPDATE `tbl_user` SET `teach_id`='{$teach_id}',`pass_status`='1' WHERE `user_id` = '{$user_id}'";
            if(mysqli_query($conn, $sql))
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
                               alert("mail Not Sent !");
                               window.location.replace("user.php");
                    });

                    // console.log(tj);

                    
                </script>';
            }
    }
    else{
        echo '<script>
                    
                    window.location.replace("user.php");
        </script>';
    }
?>

<!-- stream_set_timeout -->