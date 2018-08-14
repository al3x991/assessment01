<?php
session_start();
 include('../user_login.php');
?>
    
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Sahara | Sales Web App</title>
<script src="js/d3.v3.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
     <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
  <link rel="stylesheet" href="css/linearicons.css">
     <link rel="stylesheet" type="text/css" href="css/loader.css">
<link href="https://unpkg.com/ionicons@4.2.6/dist/css/ionicons.min.css" rel="stylesheet">
</head>
<body style="overflow-x:hidden;">

<div class="spacer"></div>
 <?php include('user_login_form.php'); ?>
        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">
                    <!-- Logo -->
                    <a class="nav-brand" href="../index.php"><img src="../img/core-img/logo.png"  style="width: 140px;" alt="">&nbsp;&nbsp;<span>Assessment</span></a>
                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav">
                            <li style="text-align: center;padding-right: 80px;"><a href="../index.php" class="active2" >Back to Sales form</a></li>
                        <?php
            include('user_online.php');
                        ?>
                        </div>
                    </div>
                </nav>  <!-- Nav End -->
            </div>
        </div>
            <!-- Top Header Area -->
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
           <div class="contact-info">
                <a href="#"><span>Phone:</span> 09069525059</a>
                <a href="#"><span>Email:</span> ostrategic@gmail.com</a>
            </div>
            <!-- Follow -->
            <div class="follow-us">
                <span>Follow </span>
                <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
<section>
<div class="row">
<div class="col-md-2">
    <div class="side_nav">
        <p><li><a href="dashboard.php" class="active2">Dashboard</a></li></p>
        <p><li><a href="vending_report.php">Vending Report</a></li></p>
    </div>
</div>
<div class="col-md-10">
<div class="section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <h4 style="font-size: 28px;padding-bottom: 20px;">Dashboard</h4>
                        <p></p>
                    <div class="page-content">
                        
                       
        <div class="row">
       
        <div class="col-md-12">
            <?php 
            //get total ev for current day
            $evoftheday = "SELECT SUM(energy_vended) AS total_ev FROM sales WHERE dt >= CURDATE() ";

              //use for MySQLi-OOP
              $evd = $pdo->query($evoftheday);
              while($row = $evd->fetch()){

               $evfortheday = $row['total_ev'];
               }
               //get total amount for current day
               $amountoftheday = "SELECT SUM(amount) AS total_amount FROM sales WHERE dt >= CURDATE() ";

              
              $avd = $pdo->query($amountoftheday);
              while($row = $avd->fetch()){

               $amountfortheday = $row['total_amount'];
               }
               
               echo "<div class='col-md-6'><div class='evday'><h1>EV For The Day</h1>
               <span><i class='fa fa-bolt' style='color:rgba(0,0,0,0.6);'></i>&nbsp;&nbsp;".number_format($evfortheday)." Kwh</span></div></div>";
               echo "<div class='col-md-6'><div class='evday'><h1>Amount For The Day</h1>
               <span><i class='fa fa-money' style='color:rgba(0,0,0,0.6);'></i>&nbsp;&nbsp;N".number_format($amountfortheday)."</span></div></div>";
               ?>
        </div>
         <div class="col-md-12">
            <?php include('simple-chart.php') ?>
        </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                    <h1>Last 5 Energy Vended</h1>
<table id="myTable" class=" table table-striped">
    <thead>
    <tr class="">
        <th>Username</th>
        <th>EV</th>
        <th>Price</th>
        <th>Amount</th>
        <th>EB</th>
        <th>OTD</th>
    </tr>
    </thead>
    <tbody>
    <?php

 $conn = new mysqli('localhost', 'root', '', 'sahara_assessment');
    if($conn->connect_error){
       die("Connection failed: " . $conn->connect_error);
    }
                            $sql = "SELECT * FROM sales ORDER BY dt DESC LIMIT 5 ";

                            //use for MySQLi-OOP
                            $query = $conn->query($sql);
                            while($row = $query->fetch_assoc()){

    echo '<tr class="package-row">
        <td>'.$row['user_name'].'</td>
        <td>'.$row['energy_vended'].'</td>
        <td>'.$row['price'].'</td>
        <td name="revenue" class="amnt" id="revenue">'.$row['amount'].'</td>
        <td name="value" id="value">'.$row['ebBefore'].'</td>
        <td id="inPackage" name="inPackage">'.$row['dt'].'</td>
    </tr>';
}

    ?>
   
    </tbody>

</table>
</div>
</div>
</div>
        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </section>
        <!-- start copyright -->
        <footer id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>
                        Copyright &copy; 2018 Sahara Assessment Solution By Alex Omoruyi</p>
                    </div>
                </div>
            </div>
        </footer>
    
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->

   
    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->

   <script  src="../js/index.js"></script>
 
    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
 
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../datatable/jquery.dataTables.min.js"></script>
<script src="../datatable/dataTable.bootstrap.min.js"></script>
</body>

</html>
