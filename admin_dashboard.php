<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Point</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black; font-size:20px;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php" style="font-size:28px;">
                   BIKE POINT </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_admin'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_admin']; ?></a>
                    </li>
					<li>
                        <a href="dash_det.php">DashBoard</a>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Client</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
					   <a href="adminlogin.php">admin</a>
                    </li>
                    <li>
                        <a href="faq/index.php"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="bgimg-1">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: white">BIKE POINT</h1>
                            <p class="intro-text">
                                Online Bike rental & buying service
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Currently Available VEHICLE</h3>
<br>
        <section class="menu-content">
            <?php   
            $sql1 = "SELECT * FROM bikes WHERE bike_availability='yes'";
            $result1 = mysqli_query($conn,$sql1);

            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $bike_id = $row1["bike_id"];
                    $bike_name = $row1["bike_name"];
                    //$ac_price = $row1["ac_price"];
                    //$ac_price_per_day = $row1["ac_price_per_day"];
                    $fare = $row1["price"];
                    $price_per_day = $row1["price_per_day"];
                    $bike_img = $row1["bike_img"];
               
                    ?>
            <a href="booking.php?id=<?php echo($bike_id) ?>">
            <div class="sub-menu">
            

            <img class="card-img-top" src="<?php echo $bike_img; ?>" alt="Bike image">
            <h5> <?php echo $bike_name; ?> </h5>
            <h6> Fare: <?php echo ("₹" . $fare . "/km & ₹" . $price_per_day . "/day"); ?></h6>
            

            
            </div> 
            </a>
            <?php }}
            else {
                ?>
<h1> No bikes available :( </h1>
                <?php
            }
            ?>                                   
        </section>
                    
    </div>

    <div class="bgimg-2">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
        </div>
    </div>

    <div style="position:relative;">
        <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;">
            <p><a onClick="alert('Write now their is no deal.')" >Click here</a> for the latest deals on your bookings</p>
			
        </div>
    </div>
    <!-- Container (Contact Section) -->
    <div class="w3-content w3-container w3-padding-64" id="contact">
        <h3 class="w3-center">WHERE WE WORK</h3>
        <p class="w3-center"><em>We love your feedback!</em></p>

        <div class="w3-row w3-padding-32 w3-section">
            <div class="w3-col m4 w3-container">
                <!-- Add Google Maps -->
                
				<div id="googleMap" class="w3-round-large w3-greyscale" style="width:100%;height:400px;">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3884.8509691696495!2d77.53406111482413!3d13.171794990724722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae21be4ad63a55%3A0x1008adb771c3d236!2sPresidency%20University!5e0!3m2!1sen!2sin!4v1575780797327!5m2!1sen!2sin" width="300" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				</div>
            </div>
            <div class="w3-col m8 w3-panel">
                <div class="w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>  Presidency University, India<br><br>
                    <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: +91 TESTING<br><br>
                    <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: bikepoint@gmail.com<br>
                </div>
                <p>New Here? Drop Your Details and Leave it on us, We'll Revert</p>
                <form action="action_page.php" method="POST">
                    <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                        <div class="w3-half">
                            <input class="w3-input w3-border" type="text" placeholder="Name*" required name="name">
                        </div>
                        <div class="w3-half">
                            <input class="w3-input w3-border" type="email" placeholder="Email*" required name="e_mail">
                        </div>
                    </div>
                    <input class="w3-input w3-border" type="text" placeholder="Message*" required name="message"><br>
					<input class="w3-input w3-border" type="text" placeholder="Your number for contact"  name="number" pattern="\d*" maxlength="10">
                    <button class="w3-button w3-black w3-right w3-section" type="submit" maxlength="10">
					
                <i class="fa fa-paper-plane"></i> SEND MESSAGE
              </button>
                </form>
            </div>
        </div>
    </div>
    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>©2019 Bike Point</h5>
                </div>
                <div class="col-sm-6 social-icons">
                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        function myMap() {
            myCenter = new google.maps.LatLng(23.259933, 77.412613);
            var mapOptions = {
                center: myCenter,
                zoom: 12,
                scrollwheel: true,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

            var marker = new google.maps.Marker({
                position: myCenter,
            });
            marker.setMap(map);
        }
    </script>
    <script>
        function sendGaEvent(category, action, label) {
            ga('send', {
                hitType: 'event',
                eventCategory: category,
                eventAction: action,
                eventLabel: label
            });
        };
    </script>
    
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>