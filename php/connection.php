<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_koshishpasses";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
    // echo "Connected";
}
else 
{
    echo "Unable to Connnect ".mysqli_connect_error();
}
?>