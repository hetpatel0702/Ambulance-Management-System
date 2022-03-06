<?php

if(isset($_POST['submit']))
{
  require 'connection.php';

  $mail = $_POST['email'];
  $password = $_POST['password'];

  if(empty($mail) || empty($password)){
    header("Location:login.php?error=emptyfields");
    exit();
  }
  else
  {
    $sql = "SELECT * FROM login WHERE Username = ? OR Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
      header("Location:login.php?error=sqlerror");
      exit();
    }
    else {

        mysqli_stmt_bind_param($stmt,"ss",$mail,$mail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($rows = mysqli_fetch_assoc($result))
        {
            $passCheck = password_verify($password,$rows['Password']);
            if($password != $rows['Password'])
            {
              header("Location:login.php?error=wrongpass");
              exit();
            }
            else if($password == $rows['Password'])
            {
              session_start();
              $_SESSION['userName'] = $rows['UserName'];
              $_SESSION['userID'] = $rows['UserID'];
              $_SESSION['user'] = $rows['DorP'];
              
              if($rows['DorP'] == 'Patient')
                header("Location:details.php?login=success&username=".$rows['UserName']);
              else if($rows['DorP'] == 'Driver')
                header("Location:Driver_status.php?login=success&username=".$rows['UserName']);
                exit();
            }

        }
        else {
          header("Location:login.php?error=nouser");
          exit();
        }
    }
  }



}
else
{
  header("Location:login.php");
  exit();
}



