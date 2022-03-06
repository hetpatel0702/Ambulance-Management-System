<!doctype html>
<html class="no-js" lang="zxx">
<?php 
include 'header.php';
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
  var input = document.getElementById('address');
  new google.maps.places.Autocomplete(input);
}

google.maps.event.addDomListener(window, 'load', initialize);

    function setaddress(){
        document.cookie = "address="+document.getElementById('address').value;
    }
</script>


<body onload="getCurrentPosition()">
<?php include 'head.php';?>
<section class="team-area section-padding40 section-bg1">
<main class="login-body">
    <form class="form-default" action="details_php.php" method="POST">
        
        <div class="login-form" style="padding-top:50px;">
            <h2>Details</h2>

            <div class="form-input">
                <label for="name">Full name</label>
                <input  type="text" name="Name" placeholder="Full name" value="<?php if(isset($rows['UserName'])) echo $rows['UserName']; ?>">
            </div>
            <div class="form-input">
                <label for="name">Address</label>
                <div ><input type="text" id="address" name="address" onfocusout="setaddress()"/></div>
            </div>
            
            <div class="form-input" style="">
                <input type="submit" name="submit" value="Generate SOS">
            </div>
            
            <!-- Forget Password -->
            <!-- <a href="login.php" class="registration">login</a> -->
        </div>
    </form>
</main>
</section>
<?php
include 'footer.php';
?>
</body>
</html>