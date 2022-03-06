<?php

if(isset($_POST['submit']))
{
   require 'connection.php';

   $username = $_POST['Name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $password_repeat = $_POST['password-repeat'];
   $radio = $_POST['radio'];

   if(empty($username) || empty($email) || empty($password) || empty($radio)){
     header("Location:register.php?error=emptyfields&username=".$username."&mail=".$email."&radio=".$radio);
     exit();
   }
   else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
     header("Location:register.php?error=invalidEmailandUsername");
     exit();
   }
   else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     header("Location:register.php?error=invalidEmail&username=".$username);
     exit();
   }
   else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
     header("Location:register.php?error=invalidUsername&mail=".$email);
     exit();
   }
   else if($password !== $password_repeat){
     header("Location:register.php?error=passwordsNotMatch&username=".$username."&mail=".$email);
     exit();
   }
   else
   {
        $sql = "SELECT Username FROM login WHERE Username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location:register.php?error=SQLerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0)
            {
                header("Location:register.php?error=UsernameTaken&mail=".$email);
                exit();
            }
            else
            {

                $sql = "INSERT INTO login (UserName,Email,Password,DorP) VALUES (?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    header("Location:register.php?error=SQLerror");
                    exit();
                }
                else
                {
                    //$hashed_pass = password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"ssss",$username,$email,$password,$radio);
                    mysqli_stmt_execute($stmt);
                    header("Location:login.php?Signup=success");
                  
                }
            }
        }
   }

   $img_name = mysqli_insert_id($conn);

   mysqli_stmt_close($stmt);
   mysqli_close($conn);

   if(is_uploaded_file($_FILES['file']['tmp_name']))
    {

      if( strstr($_FILES['file']['name'],".exe"))
	        die("It must not be .exe file");

//if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))  && ($_FILES["file"]["size"] < 2000000)) 
	
    if($_FILES["file"]["type"] == "image/jpeg" )
    {
    
        if (file_exists("images/profile_photos/" . $img_name . ".jpg"))
        {
            echo '<script>alert("File Already Exists")</script>';
        }
        else
        {
        //move_uploaded_file 
	          copy($_FILES["file"]["tmp_name"],"images/profile_photos/" . $img_name . ".jpg");
	          echo $_SERVER['HTTP_REFERER'];
	          //if($_SERVER['HTTP_REFERER'] == "http://10.10.11.94/pillowmart-master/signup.php")
                  header("Location:Sign_in.php?insert=yes&file=yes&Signup=success");
            // else
		        //       header("Location:index_admin.php"); 
	  
 //       header("Location:index.php");
        }
    }
    else 
        echo '<script>alert("Only jpg File can be uploaded")</script>';
      }
    else
        echo '<script>alert("File is not selected/uploded")</script>';
  
}
else {
  header("Location:register_page.php");
  exit();
}
?>
