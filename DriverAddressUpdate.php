<?php 
include 'header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $address = $_POST['address'];

    require 'connection.php';  

    $sql = "UPDATE login SET Address='$address' WHERE UserID=".$_SESSION['userID'];
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        // session_unset();
        // session_destroy();
        header("Location:Driver_status.php?Address Updated!");
    }
    else    
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<?php 

require 'connection.php';
$sql = "SELECT * FROM login WHERE UserID=".$_SESSION['userID'];
$result = mysqli_query($conn,$sql);

if($result)
    {
        $rows = mysqli_fetch_assoc($result); 
              
    }
    else
    {
        echo 'error';
    }

?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script>
    function initialize() {
    var input = document.getElementById('searchTextField');
    new google.maps.places.Autocomplete(input);
}

    google.maps.event.addDomListener(window, 'load', initialize);

//     function setCookie(){
//         document.cookie = "address="+document.getElementById("searchTextField").value;
//         // document.write(document.cookie);
//     }

</script>
<body>
<section class="team-area section-padding40 section-bg1">
<main class="login-body">
    <form class="form-default" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        
        <div class="login-form" style="padding-top:50px;">
        <h2>Details</h2>

            <div class="form-input">
                <label for="name">Full name</label>
                <input  type="text" name="Name" placeholder="Full name" value="<?php if(isset($rows['UserName'])) echo $rows['UserName']; ?>" readonly>
            </div>

            <div class="form-input">
                <label for="name">Address</label>
                <div >
                <input type="text" id="searchTextField" name="address" style="background-color:transperent;" value="" >
                
                </div>
            </div>
            <div class="form-input" style="">
                <input type="submit" id="SOS" name="submit" value="Update Address" style="background-color:rgb(146,39,36);">
            </div>
            <!-- Forget Password -->
            <!-- <a href="login.php" class="registration">login</a> -->
        </div>
    </form>
</main>
</section>

</body>
</html>

