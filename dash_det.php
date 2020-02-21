<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">    
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
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
 <div class="container">
      <div class="jumbotron">
	  
	  <?php 

	$login_customer = $_SESSION['login_admin']; 

    $sql1 = "select count(*) as nov from bikes;;";
    $result1 = $conn->query($sql1);
	$row = mysqli_fetch_assoc($result1)
	?>
	
		<p> Number of vehicles : </p>
        <h1><?php echo $row['nov']; ?></h1>
        
      </div>
    </div>
<?php 

	$login_customer = $_SESSION['login_admin']; 

    $sql1 = "select b.bike_name,c.client_username,b.bike_nameplate,b.bikerc,b.bikedl,b.bikeinsure from clientbikes c,bikes b where c.bike_id=b.bike_id;";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>

    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
<table class="table table-striped" style="background-color:white;">
  <thead class="thead-dark">
<tr>
<th width="30%">Vehicle</th>
<th width="20%">Owner</th>
<th width="20%">Name Plate</th>
<th width="20%">RC Book</th>
<th width="10%">Driving License</th>
<th width="10%">Insurance</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["bike_name"]; ?></td>
<td><?php echo $row["client_username"] ?></td>
<td><?php echo $row["bike_nameplate"]; ?></td>
<td><a href="<?php echo $row["bikerc"];?>" target = "_blank"> View </a></td>
<td><a href="<?php echo $row["bikedl"];?>" target = "_blank"> View </a></td>
<td><a href="<?php echo $row["bikeinsure"];?>" target = "_blank"> View </a></td>
</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } 
            ?>

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