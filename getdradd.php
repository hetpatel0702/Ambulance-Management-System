<?php
session_start();
include "connection.php";

$return_arr = array();


$sql = "SELECT * FROM route WHERE ptID=".$_SESSION['userID'];
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) == 0)
    {
        $query = "SELECT * FROM login WHERE DorP='Driver' AND ForNF=0";
        $result1 = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($result1)){
        $id = $row['UserID'];
        $addr = $row['Address'];
        $return_arr[] = array("addr" => $addr);
        }                    
   }
    else
    {
        $row = mysqli_fetch_assoc($result);

        $result2 = mysqli_query($conn,"SELECT * FROM login WHERE UserID=".$row['drID']);

        $row2 = mysqli_fetch_assoc($result2);

        $addr = $row2['Address'];
        $return_arr[] = array("addr" => $addr);

    }

// Encoding array in JSON format
echo json_encode($return_arr);
?>