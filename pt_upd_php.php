<?php
session_start();

$address = $_POST['address'];

require 'connection.php';

$sql = "UPDATE login SET Address='$address' WHERE UserID=".$_SESSION['userID'];
$result = mysqli_query($conn,$sql);
if($result)
{
    // echo '<script>alert("SOS Generated Sucessfully")</script>';
    header("Location:map.php");
}
else
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}