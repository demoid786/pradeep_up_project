<html>

  <head>
    <title> customer Signup | Bike Point </title>
  </head>
  <?php session_start(); ?>
  <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

  <body>
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
                    <li>
                        <a href="#">History</a>
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

<?php

require 'connection.php';
$conn = Connect();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    
    switch($imagetype) {
        case 'assets/img/cars/bmp': return '.bmp';
        case 'assets/img/cars/gif': return '.gif';
        case 'assets/img/cars/jpeg': return '.jpg';
        case 'assets/img/cars/png': return '.png';
        default: return false;
    }
}

$bike_name = $conn->real_escape_string($_POST['bike_name']);
$bike_nameplate = $conn->real_escape_string($_POST['bike_nameplate']);
$price = $conn->real_escape_string($_POST['price']);
$price_per_day = $conn->real_escape_string($_POST['price_per_day']);
$bike_availability = "yes";

if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name1=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename1=$_FILES["uploadedimage"]["name"];
    $target_path1 = "assets/img/cars/".$imagename1;
}

if (!empty($_FILES["uploadedrcbook"]["name"])) {
    $file_name=$_FILES["uploadedrcbook"]["name"];
    $temp_name2=$_FILES["uploadedrcbook"]["tmp_name"];
    $imgtype=$_FILES["uploadedrcbook"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename2=$_FILES["uploadedrcbook"]["name"];
    $target_path2 = "assets/img/rc_book/".$imagename2;
}

if (!empty($_FILES["uploadeddl"]["name"])) {
    $file_name=$_FILES["uploadeddl"]["name"];
    $temp_name3=$_FILES["uploadeddl"]["tmp_name"];
    $imgtype=$_FILES["uploadeddl"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename3=$_FILES["uploadeddl"]["name"];
    $target_path3 = "assets/img/dls/".$imagename3;
}

if (!empty($_FILES["uploadedinsur"]["name"])) {
    $file_name=$_FILES["uploadedinsur"]["name"];
    $temp_name4=$_FILES["uploadedinsur"]["tmp_name"];
    $imgtype=$_FILES["uploadedinsur"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename4=$_FILES["uploadedinsur"]["name"];
    $target_path4 = "assets/img/insure/".$imagename4;
}

    if(move_uploaded_file($temp_name1, $target_path1)
		&& move_uploaded_file($temp_name2, $target_path2)
		&& move_uploaded_file($temp_name3, $target_path3)
		&& move_uploaded_file($temp_name4, $target_path4)
	) {
        $query = "INSERT into bikes(bike_name,bike_nameplate,bike_img,bikerc,bikedl,bikeinsure,price,price_per_day,bike_availability) VALUES('" . $bike_name . "','" . $bike_nameplate . "','".$target_path1."','".$target_path2."','".$target_path3."','".$target_path4."','". $price . "','" . $price_per_day . "','" . $bike_availability ."')";
        $success = $conn->query($query);
    } 

// Taking bike_id from bikes

$query1 = "SELECT bike_id from bikes where bike_nameplate = '$bike_nameplate'";

$result = mysqli_query($conn, $query1);
$rs = mysqli_fetch_array($result, MYSQLI_BOTH);
$bike_id = $rs['bike_id'];
 

$query2 = "INSERT into clientbikes(bike_id,client_username) values('" . $bike_id ."','" . $_SESSION['login_client'] . "')";
$success2 = $conn->query($query2);

if (!$success){ ?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        Bike with the same vehicle number already exists!
        <?php echo $conn->error; ?>
        <br><br>
        <a href="entercar.php" class="btn btn-default"> Go Back </a>
</div>
<?php	
}
else {
	echo '<script language="javascript">';
	echo 'alert("Bike Data Entered Successfully <br>Thank You.")';
	echo '</script>';
    header("location: entercar.php"); //Redirecting 
}

$conn->close();

?>

    </body>
    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>©2019 Bike Point</h5>
                </div>
            </div>
        </div>
    </footer>
</html>