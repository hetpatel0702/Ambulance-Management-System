<?php
    session_start();

    $address = $_POST['address'];
    
    require 'connection.php';

    if($_SESSION['user']=='Patient'){
        
        $user='ptID';
        $query="SELECT * FROM route WHERE ".$user." = " . $_SESSION['userID'];
        $result = mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        $finalID=$row['drID'];
        $loc='details.php';
    }
        
    else{
        $user='drID';
        $finalID=$_SESSION['userID'];
        $loc='Driver_status.php';
    }
       

    $sql = "DELETE FROM route WHERE ".$user." = " . $_SESSION['userID'];

    if (mysqli_query($conn, $sql))
    {
        $sql1 = "UPDATE login SET ForNF=0 WHERE UserID=$finaldID";
        mysqli_query($conn,$sql1);
       header("Location:".$loc);
    } else {
      echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);

?>
