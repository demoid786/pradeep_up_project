<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Book Bike </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 


      <!-- Navigation -->
     <!-- Navigation -->
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   BIKE POINT </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Bike</a></li>
              <li> <a href="enterdriver.php"> Add Driver</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garage <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
            </ul>
            </li>
          </ul>
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
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <h2 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Rent your bike from here </h2><br>

        <?php
        $bike_id = $_GET["id"];
        $sql1 = "SELECT * FROM bikes WHERE bike_id = '$bike_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $bike_name = $row1["bike_name"];
                $bike_nameplate = $row1["bike_nameplate"];
				$price = $row1["price"];
                $price_per_day = $row1["price_per_day"];
            }
        }

        ?>

          <!-- <div class="form-group"> -->
              <h5> Vehicle:&nbsp;  <?php echo($bike_name);?></h5>
         <!-- </div> -->
         
          <!-- <div class="form-group"> -->
            <h5> Vehicle Number:&nbsp; <?php echo($bike_nameplate);?></h5>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d") ?>
          <label><h5>Start Date:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp;
          <label><h5>End Date:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        <!-- </div>      -->
        
        <h5> Click to know the fare:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar" > Fare &nbsp;
            
                
        
        <div ng-switch="myVar"> 
        
                    <div ng-switch-when="ac">
                    
                <h5>Fare: <?php echo("₹" . $price . "/km and ₹" . $price_per_day . "/day");?><h5>    
                
                     </div>
                     
        </div>

         <h5> Choose charge type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="km"> per km(s) &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="days"> per day(s)

            <br><br>
                <!-- <form class="form-group"> -->
                Choose a Driver: &nbsp;
                <select name="access_id_from_dropdown" ng-model="myVar1">
                        <?php
                        $sql2 = "SELECT * FROM bike_accessories d WHERE d.access_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientbikes cc WHERE cc.bike_id = '$bike_id')";
                        $result2 = mysqli_query($conn, $sql2);

                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                $driver_id = $row2["access_id"];
                                $driver_name = $row2["access_name"];
                                $driver_gender = $row2["access_for_mf"];
                                $driver_phone = $row2["access_price"];
                    ?>
  

                    <option value="<?php echo($driver_id); ?>"><?php echo($driver_name); ?>
                   

                    <?php }} 
                    else{
                        ?>
                    Sorry! No Driver are currently available, try again later...
                        <?php
                    }
                    ?>
                </select>
                <!-- </form> -->
                <div ng-switch="myVar1">
                

                <?php
                        $sql3 = "SELECT * FROM bike_accessories d WHERE d.access_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientbikes cc WHERE cc.bike_id = '$bike_id')";
                        $result3 = mysqli_query($conn, $sql3);

                        if(mysqli_num_rows($result3) > 0){
                            while($row3 = mysqli_fetch_assoc($result3)){
                                $access_id= $row3["access_id"];
                                $access_name = $row3["access_name"];
                                $access_for_mf = $row3["access_for_mf"];
                                $access_price = $row3["access_price"];

                ?>

                <div ng-switch-when="<?php echo($access_id); ?>">
                    <h5>Driver Name:&nbsp; <?php echo($access_name); ?></h5>
                    <p>Gender:&nbsp; <?php echo($access_for_mf); ?> </p>
                    <p>Contact:&nbsp; <?php echo($access_price); ?> </p>
                </div>
                <?php }} ?>
                </div>
                <input type="hidden" name="hidden_carid" value="<?php echo $bike_id; ?>">
                
         
           <input type="submit"name="submit" value="Book Now" class="btn btn-success pull-right">     
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Kindly Note:</strong> You will be charged <span class="text-danger">₹100/-</span> for each day after the due date.</h6>
        </div>
    </div>

</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© 2019 Bike Point</h5>
                </div>
            </div>
        </div>
    </footer>
</html>