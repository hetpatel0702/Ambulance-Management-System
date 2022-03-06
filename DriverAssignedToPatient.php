<?php
session_start();

    if (isset($_REQUEST["patientAdd"])
        && isset($_REQUEST["driverAdd"])
    ) {

        require 'connection.php';

        $patientAddress = $_REQUEST["patientAdd"];
        $driverAddress = $_REQUEST["driverAdd"];
        
        // $sql = "SELECT * FROM login WHERE Address=$patientAddress";
        // $result = mysqli_query($conn, $sql);
        $pID = $_SESSION['userID'];

        $sql2 = "SELECT * FROM login WHERE DorP='Driver'";
        $result2 =  mysqli_query($conn, $sql2);
        
        
        $similarity = 0;
        $finaldID = 0;
        while($row = mysqli_fetch_assoc($result2))
        {
            $match = similar_text($driverAddress,$row['Address']);
            if($similarity < $match)
            {
                $similarity = $match;
                $finaldID = $row['UserID'];
            }
        }

        $sql3 = "INSERT INTO route (ptID,drID) VALUES ($pID,$finaldID)";
        $result3 = mysqli_query($conn,$sql3);
        
        $sql4 = "UPDATE login SET ForNF=1 WHERE UserID=$finaldID";
        $result4 = mysqli_query($conn,$sql4);
        

        // header('Content-Type: application/json');
        
            echo json_encode(array("ptID" => $finaldID));
        

    }else{
        echo json_encode("missing input");

    }

/*
 * End of common.php
 */