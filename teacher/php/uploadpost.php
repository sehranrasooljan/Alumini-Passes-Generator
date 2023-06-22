<?php 
    session_start();
    include_once "connection.php";
    include_once "protect.php";
    $username = $_SESSION['username'];
    $mode = mysqli_real_escape_String($conn, $_POST['mode']);


    if(isset($_FILES['image']))
    {
        $img_name = $_FILES['image']['name']; //getting default name of image
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode); //here we get extension of user uploaded image

        $extension = ['png','jpeg','jpg'];
        if(in_array($img_ext,$extension) === true)
        {
            $new_img_name = $username.$img_name;

            if(move_uploaded_file($tmp_name,"../posts/".$new_img_name))
            {
                $sql = mysqli_query($conn, "INSERT INTO `posts`(`username`, `post`, `mode`) VALUES ('{$username}','{$new_img_name}','{$mode}')");
                if($sql)
                {
                    echo "success";
                }
                else
                {
                    echo "Try Again !";
                }
            }
            else
            {
                echo "Something Went Wrong ! Try Again";
            }
        }
        else
        {
            echo "Image must be .jpeg, .jpg or .png !"; 
        }
    }
    else 
    {
        echo "Please Select an Image File !";
    }
?>