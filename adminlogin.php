<?php
include('login_admin.php'); // Includes Login Script
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title> Admin Login  </title>
    </head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <body background="assets/img/forcustomer.png">
                 <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color:white; width:100%; font-size:20px;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php" style="font-size:28px;">
                   BIKE POINT </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            
                        <div class="collapse navbar-collapse navbar-right navbar-main-collapse" ">
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
									<a href="adminlogin.php">Admin</a>
								</li>
                                <li>
                                    <a href="faq/index.php"> FAQ </a>
                                </li>
                            </ul>
                        </div>
                       
                        <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

        <div class="container">
            <div class="jumbotron">
                <h1>Welcome to <span style="color:#158CBA; font-family:Droid Serif">Bike Point </span> </span>
                </h1>
                
                <p>Kindly <span style="color:#158CBA; ">LOGIN </span> to continue.</p>
            </div>
        </div>

        <div class="container" style="margin-top: -2%; margin-bottom: 2%;">
            <div class="col-md-5 col-md-offset-4">
                <label style="margin-left: 5px;color: red;"><span> <?php echo $error;  ?> </span></label>
                <div class="panel panel-primary">
                    <div class="panel-heading"> Login </div>
                    <div class="panel-body">

                        <form action="" method="POST">

                            <div class="row">
                                <div class="form-group col-xs-12">
                                   <!-- <label for="customer_username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
								   -->
                                    <div class="input-group">
                                        <input class="form-control" id="customer_username" type="text" name="customer_username" placeholder="Username*" required="" autofocus="">
                                        <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <!--<label for="customer_password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
									-->
                                    <div class="input-group">
                                        <input class="form-control" id="customer_password" type="password" name="customer_password" placeholder="Password*" required="">
                                        <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
                                        </span>

                                    </div>
                                </div>
                            </div>
							
                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <button class="btn btn-primary" name="submit" type="submit" value=" Login ">Submit</button>

                                </div>

                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer class="site-footer" >
        <div class="container" >
            <hr>
            <div class="row" >
                <div class="col-sm-6" style="background-color:#EFEFEF ;width:100%; border-top-right-radius:12px; border-top-left-radius:12px; text-align:center; ">
                    <h5>© 2019 Bike Point</h5>
                </div>
            </div>
        </div>
    </footer>

    </html>