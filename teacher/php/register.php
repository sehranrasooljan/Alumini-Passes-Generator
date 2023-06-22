<?php 
    session_start();

    error_reporting(0);

    include_once "connection.php";
    include_once "protect.php";



    $username = mysqli_real_escape_String($conn, $_POST['username']);

    $event_name = mysqli_real_escape_String($conn, $_POST['event_name']);

    $p1_rollno = mysqli_real_escape_String($conn, $_POST['p1_rollno']);
    $p1_name = mysqli_real_escape_String($conn, $_POST['p1_name']);
    $p1_email = mysqli_real_escape_String($conn, $_POST['p1_email']);
    $p1_mobile = mysqli_real_escape_String($conn, $_POST['p1_mobile']);
    $p1_course = mysqli_real_escape_String($conn, $_POST['p1_course']);
    $p1_stream = mysqli_real_escape_String($conn, $_POST['p1_stream']);
    $p1_batch = mysqli_real_escape_String($conn, $_POST['p1_batch']);
    $p1_section = mysqli_real_escape_String($conn, $_POST['p1_section']);

    $p2_rollno = mysqli_real_escape_String($conn, $_POST['p2_rollno']);
    $p2_name = mysqli_real_escape_String($conn, $_POST['p2_name']);
    $p2_email = mysqli_real_escape_String($conn, $_POST['p2_email']);
    $p2_mobile = mysqli_real_escape_String($conn, $_POST['p2_mobile']);
    $p2_course = mysqli_real_escape_String($conn, $_POST['p2_course']);
    $p2_stream = mysqli_real_escape_String($conn, $_POST['p2_stream']);
    $p2_batch = mysqli_real_escape_String($conn, $_POST['p2_batch']);
    $p2_section = mysqli_real_escape_String($conn, $_POST['p2_section']);

    $p3_rollno = mysqli_real_escape_String($conn, $_POST['p3_rollno']);
    $p3_name = mysqli_real_escape_String($conn, $_POST['p3_name']);
    $p3_email = mysqli_real_escape_String($conn, $_POST['p3_email']);
    $p3_mobile = mysqli_real_escape_String($conn, $_POST['p3_mobile']);
    $p3_course = mysqli_real_escape_String($conn, $_POST['p3_course']);
    $p3_stream = mysqli_real_escape_String($conn, $_POST['p3_stream']);
    $p3_batch = mysqli_real_escape_String($conn, $_POST['p3_batch']);
    $p3_section = mysqli_real_escape_String($conn, $_POST['p3_section']);

    $p4_rollno = mysqli_real_escape_String($conn, $_POST['p4_rollno']);
    $p4_name = mysqli_real_escape_String($conn, $_POST['p4_name']);
    $p4_email = mysqli_real_escape_String($conn, $_POST['p4_email']);
    $p4_mobile = mysqli_real_escape_String($conn, $_POST['p4_mobile']);
    $p4_course = mysqli_real_escape_String($conn, $_POST['p4_course']);
    $p4_stream = mysqli_real_escape_String($conn, $_POST['p4_stream']);
    $p4_batch = mysqli_real_escape_String($conn, $_POST['p4_batch']);
    $p4_section = mysqli_real_escape_String($conn, $_POST['p4_section']);


    $checkit = mysqli_real_escape_String($conn, $_POST['checkit']);

    if(!empty($p2_rollno) && empty($p3_rollno))
    {
        
        $sql_p2_check = mysqli_query($conn,"SELECT p2_rollno from tbl_register WHERE p2_rollno = '{$p2_rollno}' AND event_name = '{$event_name}' OR p1_rollno = '{$p2_rollno}' AND event_name = '{$event_name}' OR p3_rollno = '{$p2_rollno}' AND event_name = '{$event_name}'");
        if(mysqli_num_rows($sql_p2_check) == 0)
        {
            if(!empty($event_name) && $checkit == '1' && !empty($p1_stream))
            {
                $sql = mysqli_query($conn,"INSERT INTO `tbl_register`(`userid`,`event_name`, `p1_rollno`, `p1_name`, `p1_email`, `p1_mobile`, `p1_course`, `p1_stream`, `p1_batch`, `p1_section`, `p2_rollno`, `p2_name`, `p2_email`, `p2_mobile`, `p2_course`, `p2_stream`, `p2_batch`, `p2_section`, `p3_rollno`, `p3_name`, `p3_email`, `p3_mobile`, `p3_course`, `p3_stream`, `p3_batch`, `p3_section`, `p4_rollno`, `p4_name`, `p4_email`, `p4_mobile`, `p4_course`, `p4_stream`, `p4_batch`, `p4_section`) VALUES ('{$username}','{$event_name}','{$p1_rollno}','{$p1_name}','{$p1_email}','{$p1_mobile}','{$p1_course}','{$p1_stream}','{$p1_batch}','{$p1_section}','{$p2_rollno}','{$p2_name}','{$p2_email}','{$p2_mobile}','{$p2_course}','{$p2_stream}','{$p2_batch}','{$p2_section}','{$p3_rollno}','{$p3_name}','{$p3_email}','{$p3_mobile}','{$p3_course}','{$p3_stream}','{$p3_batch}','{$p3_section}','{$p4_rollno}','{$p4_name}','{$p4_email}','{$p4_mobile}','{$p4_course}','{$p4_stream}','{$p4_batch}','{$p4_section}')");
                if($sql)
                {

                    /* Email System For Participant 2*/

                    include('../../smtp/PHPMailerAutoload.php');
                    $mail=new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host="smtp.gmail.com";
                    $mail->Port=587;
                    $mail->SMTPSecure="tls";
                    $mail->SMTPAuth=true;
                    $mail->Username="athena.pcte@gmail.com";
                    $mail->Password="athena.pcte@2021";
                    $mail->SetFrom("athena.pcte@gmail.com","Athena - 2021");
                    $mail->addAddress($p1_email);
                    $mail->IsHTML(true);
                    $mail->Subject="Successfully Registered For an Event !";
                    $mail->Body="Thanku <b>".$p1_name."</b> from ".$p1_stream." - ".$p1_batch." (".$p1_section.") AND <b>".$p2_name."</b> from ".$p2_stream." - ".$p2_batch." (".$p2_section.") For Taking Part in <b>".$event_name."</b> Event.";
                    $mail->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));
                    $mail->send();

                    $mail_p2=new PHPMailer(true);
                    $mail_p2->isSMTP();
                    $mail_p2->Host="smtp.gmail.com";
                    $mail_p2->Port=587;
                    $mail_p2->SMTPSecure="tls";
                    $mail_p2->SMTPAuth=true;
                    $mail_p2->Username="athena.pcte@gmail.com";
                    $mail_p2->Password="athena.pcte@2021";
                    $mail_p2->SetFrom("athena.pcte@gmail.com","Athena - 2021");
                    $mail_p2->addAddress($p2_email);
                    $mail_p2->IsHTML(true);
                    $mail_p2->Subject="Successfully Registered For an Event !";
                    $mail_p2->Body="Thanku <b>".$p1_name."</b> from ".$p1_stream." - ".$p1_batch." (".$p1_section.") AND <b>".$p2_name."</b> from ".$p2_stream." - ".$p2_batch." (".$p2_section.") For Taking Part in <b>".$event_name."</b> Event.";
                    $mail_p2->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));
                    $mail_p2->send();

                    /* End of Email System */

                    echo "success";
                }
            }
            else if($event_name == '')
            {
                echo "\n\nPlease Select an Event !";
            }
            else if($checkit != '1'){
                echo "\n\nPlease Confirm the Checkbox !";
            }
        }
        else
        {
            echo $p2_name." Already Registered with Another Participant !";
        }
    }

    else if(!empty($p3_rollno))
    {
        $sql_p3_check = mysqli_query($conn,"SELECT p3_rollno from tbl_register WHERE p3_rollno = '{$p3_rollno}' AND event_name = '{$event_name}' OR p1_rollno = '{$p3_rollno}' AND event_name = '{$event_name}' OR p2_rollno = '{$p3_rollno}' AND event_name = '{$event_name}'");
        if(mysqli_num_rows($sql_p3_check) == 0)
        {
            if(!empty($event_name) && $checkit == '1' && !empty($p1_stream))
            {
                $sql = mysqli_query($conn,"INSERT INTO `tbl_register`(`userid`,`event_name`, `p1_rollno`, `p1_name`, `p1_email`, `p1_mobile`, `p1_course`, `p1_stream`, `p1_batch`, `p1_section`, `p2_rollno`, `p2_name`, `p2_email`, `p2_mobile`, `p2_course`, `p2_stream`, `p2_batch`, `p2_section`, `p3_rollno`, `p3_name`, `p3_email`, `p3_mobile`, `p3_course`, `p3_stream`, `p3_batch`, `p3_section`, `p4_rollno`, `p4_name`, `p4_email`, `p4_mobile`, `p4_course`, `p4_stream`, `p4_batch`, `p4_section`) VALUES ('{$username}','{$event_name}','{$p1_rollno}','{$p1_name}','{$p1_email}','{$p1_mobile}','{$p1_course}','{$p1_stream}','{$p1_batch}','{$p1_section}','{$p2_rollno}','{$p2_name}','{$p2_email}','{$p2_mobile}','{$p2_course}','{$p2_stream}','{$p2_batch}','{$p2_section}','{$p3_rollno}','{$p3_name}','{$p3_email}','{$p3_mobile}','{$p3_course}','{$p3_stream}','{$p3_batch}','{$p3_section}','{$p4_rollno}','{$p4_name}','{$p4_email}','{$p4_mobile}','{$p4_course}','{$p4_stream}','{$p4_batch}','{$p4_section}')");
                if($sql)
                {

                    /* Email System For Participant 3*/

                    include('../../smtp/PHPMailerAutoload.php');
                    $mail=new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host="smtp.gmail.com";
                    $mail->Port=587;
                    $mail->SMTPSecure="tls";
                    $mail->SMTPAuth=true;
                    $mail->Username="athena.pcte@gmail.com";
                    $mail->Password="athena.pcte@2021";
                    $mail->SetFrom("athena.pcte@gmail.com","Athena - 2021");
                    $mail->addAddress($p1_email);
                    $mail->IsHTML(true);
                    $mail->Subject="Successfully Registered For an Event !";
                    $mail->Body="Thanku <b>".$p1_name."</b> from ".$p1_stream." - ".$p1_batch." (".$p1_section.") AND <b>".$p2_name."</b> from ".$p2_stream." - ".$p2_batch." (".$p2_section.") AND <b>".$p3_name."</b> from ".$p3_stream." - ".$p3_batch." (".$p3_section.") For Taking Part in <b>".$event_name."</b> Event.";
                    $mail->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));
                    $mail->send();

                    $mail_p2=new PHPMailer(true);
                    $mail_p2->isSMTP();
                    $mail_p2->Host="smtp.gmail.com";
                    $mail_p2->Port=587;
                    $mail_p2->SMTPSecure="tls";
                    $mail_p2->SMTPAuth=true;
                    $mail_p2->Username="athena.pcte@gmail.com";
                    $mail_p2->Password="athena.pcte@2021";
                    $mail_p2->SetFrom("athena.pcte@gmail.com","Athena - 2021");
                    $mail_p2->addAddress($p2_email);
                    $mail_p2->IsHTML(true);
                    $mail_p2->Subject="Successfully Registered For an Event !";
                    $mail_p2->Body="Thanku <b>".$p1_name."</b> from ".$p1_stream." - ".$p1_batch." (".$p1_section.") AND <b>".$p2_name."</b> from ".$p2_stream." - ".$p2_batch." (".$p2_section.") AND <b>".$p3_name."</b> from ".$p3_stream." - ".$p3_batch." (".$p3_section.") For Taking Part in <b>".$event_name."</b> Event.";
                    $mail_p2->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));
                    $mail_p2->send();

                    $mail_p3=new PHPMailer(true);
                    $mail_p3->isSMTP();
                    $mail_p3->Host="smtp.gmail.com";
                    $mail_p3->Port=587;
                    $mail_p3->SMTPSecure="tls";
                    $mail_p3->SMTPAuth=true;
                    $mail_p3->Username="athena.pcte@gmail.com";
                    $mail_p3->Password="athena.pcte@2021";
                    $mail_p3->SetFrom("athena.pcte@gmail.com","Athena - 2021");
                    $mail_p3->addAddress($p3_email);
                    $mail_p3->IsHTML(true);
                    $mail_p3->Subject="Successfully Registered For an Event !";
                    $mail_p3->Body="Thanku <b>".$p1_name."</b> from ".$p1_stream." - ".$p1_batch." (".$p1_section.") AND <b>".$p2_name."</b> from ".$p2_stream." - ".$p2_batch." (".$p2_section.") AND <b>".$p3_name."</b> from ".$p3_stream." - ".$p3_batch." (".$p3_section.") For Taking Part in <b>".$event_name."</b> Event.";
                    $mail_p3->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));
                    $mail_p3->send();

                    /* End of Email System */

                    echo "success";
                }
            }
            else if($event_name == '')
            {
                echo "\n\nPlease Select an Event !";
            }
            else if($checkit != '1'){
                echo "\n\nPlease Confirm the Checkbox !";
            }
        }
        else
        {
            echo $p3_name." Already Registered with Another Participant !";
        }
    }

    else
    {
        $sql_p1_check = mysqli_query($conn,"SELECT p1_rollno from tbl_register WHERE p1_rollno = '{$p1_rollno}' AND event_name = '{$event_name}'");
        if(mysqli_num_rows($sql_p1_check) == 0)
        {
            if(!empty($event_name) && $checkit == '1' && !empty($p1_stream))
            {
                $sql = mysqli_query($conn,"INSERT INTO `tbl_register`(`userid`,`event_name`, `p1_rollno`, `p1_name`, `p1_email`, `p1_mobile`, `p1_course`, `p1_stream`, `p1_batch`, `p1_section`, `p2_rollno`, `p2_name`, `p2_email`, `p2_mobile`, `p2_course`, `p2_stream`, `p2_batch`, `p2_section`, `p3_rollno`, `p3_name`, `p3_email`, `p3_mobile`, `p3_course`, `p3_stream`, `p3_batch`, `p3_section`, `p4_rollno`, `p4_name`, `p4_email`, `p4_mobile`, `p4_course`, `p4_stream`, `p4_batch`, `p4_section`) VALUES ('{$username}','{$event_name}','{$p1_rollno}','{$p1_name}','{$p1_email}','{$p1_mobile}','{$p1_course}','{$p1_stream}','{$p1_batch}','{$p1_section}','{$p2_rollno}','{$p2_name}','{$p2_email}','{$p2_mobile}','{$p2_course}','{$p2_stream}','{$p2_batch}','{$p2_section}','{$p3_rollno}','{$p3_name}','{$p3_email}','{$p3_mobile}','{$p3_course}','{$p3_stream}','{$p3_batch}','{$p3_section}','{$p4_rollno}','{$p4_name}','{$p4_email}','{$p4_mobile}','{$p4_course}','{$p4_stream}','{$p4_batch}','{$p4_section}')");
                if($sql)
                {

                    /* Email System For Participant 1*/

                    include('../../smtp/PHPMailerAutoload.php');
                    $mail=new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host="smtp.gmail.com";
                    $mail->Port=587;
                    $mail->SMTPSecure="tls";
                    $mail->SMTPAuth=true;
                    $mail->Username="athena.pcte@gmail.com";
                    $mail->Password="athena.pcte@2021";
                    $mail->SetFrom("athena.pcte@gmail.com","Athena - 2021");
                    $mail->addAddress($p1_email);
                    $mail->IsHTML(true);
                    $mail->Subject="Successfully Registered For an Event !";
                    $mail->Body="Thanku <b>".$p1_name."</b> from ".$p1_stream." - ".$p1_batch." (".$p1_section.") For Taking Part in <b>".$event_name."</b> Event.<br><br>";
                    $mail->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));
                    $mail->send();

                    /* End of Email System */

                    echo "success";
                }
            }
            else if($event_name == '')
            {
                echo "\n\nPlease Select an Event !";
            }
            else if($checkit != '1'){
                echo "\n\nPlease Confirm the Checkbox !";
            }
        }
        else
        {
            echo $p1_name." Already Registered For This Event !";
        }
    }
?>