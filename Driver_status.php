<!DOCTYPE html>
<html class="no-js" lang="zxx">
<?php
include 'header.php'; 
// session_start();

                    require 'connection.php';
                    $sql = "SELECT * FROM route WHERE drID=".$_SESSION['userID'];
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) == 0)
                    {
                        
                    }
                    else
                    {
                        $row = mysqli_fetch_assoc($result);

                        $result2 = mysqli_query($conn,"SELECT * FROM login WHERE UserID=".$row['ptID']);
                        
                        $result3 = mysqli_query($conn,"SELECT * FROM login WHERE UserID=".$_SESSION['userID']);
                        
                        $row3 = mysqli_fetch_assoc($result3);
                        $row2 = mysqli_fetch_assoc($result2);

                        
                        setcookie('drSrAddress',$row3['Address']);
                        setCookie('drdestaddress',$row2['Address']);

                    }
?>
<body>
<?php include 'head.php';?>
<section class="team-area section-padding40 section-bg1">
<main class="login-body">
    <form class="form-default" action="driverMap.php" method="POST">
        
        <div class="login-form" style="padding-top:50px;">
        <h2>Driver Status</h2>
            <div style="padding-bottom:5%;padding-left:9%;">
            <?php
                    if(mysqli_num_rows($result) == 0)
                    {
                        echo '<h1 style="color:white;"> Currently You are free! </h1>';
                        
                    }
                    else
                    {
                        echo '<h1 style="color:white;">Patient Name: '.$row2['UserName'].'</h1><br>';
                        echo '<h1 style="color:white;">Patient Address: '.$row2['Address'].'</h1>';
                    }
               
                ?>
            </div>
            <div class="form-input">
                <input type="submit" id="SOS" name="submit" value="Get the Route" style="background-color:#F067FF">
            </div>
            <a href="DriverAddressUpdate.php" class="registration">Update Address</a>
            <!-- Forget Password -->
            <!-- <a href="login.php" class="registration">login</a> -->
        </div>
    </form>
</main>
</section>

</body>


<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="./assets/js/gijgo.min.js"></script>

<!-- Video bg -->
<script src="./assets/js/jquery.vide.js"></script>

<!-- Nice-select, sticky -->
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>
<!-- Progress -->
<script src="./assets/js/jquery.barfiller.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>
<script src="./assets/js/jquery.countdown.min.js"></script>
<script src="./assets/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>


</html>