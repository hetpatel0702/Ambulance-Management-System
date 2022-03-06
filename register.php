<!doctype html>
<html class="no-js" lang="zxx">
<?php include 'header.php';?>
<body>
<?php include 'head.php';?>
<!-- Register -->

<main class="login-body" data-vide-bg="assets/img/login-bg.mp4">
    <!-- Login Admin -->
    <form class="form-default" action="register_php.php" method="POST">
        
        <div class="login-form">
            <!-- logo-login -->
            <div class="logo-login" >
                <a href="index.php"><img src="assets/img/logo/loder.png" alt=""></a>
            </div>
            <h2>Registration Here</h2>

            <div class="form-input">
                <label for="name">Full name</label>
                <input  type="text" name="Name" placeholder="Full name" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}  ?>">
            </div>
            <div class="form-input">
                <label for="name">Email Address</label>
                <input type="email" name="email" placeholder="Email Address" value="<?php if(isset($_GET['mail'])){echo $_GET['mail'];}  ?>">
            </div>
            <div class="form-input">
                <label for="name">Password</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-input">
                <label for="name">Confirm Password</label>
                <input type="password" name="password-repeat" placeholder="Confirm Password">
            </div>
            <div class="form-input">
                <input type="radio" name="radio" value="Patient" style="width: 20px;height:20px;">
                <label for="name">Patient</label>
                <div></div>
                <input type="radio" name="radio" value="Driver" style="width: 20px;height:20px;">
                <label for="name">Driver</label>
            </div>
            <div class="form-input" style="">
                <input type="submit" name="submit" value="Registration">
            </div>
            
            <!-- Forget Password -->
            <a href="login.php" class="registration">login</a>
        </div>
    </form>
    <!-- /end login form -->
</main>


    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Video bg -->
    <script src="./assets/js/jquery.vide.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
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
    
    </body>
</html>