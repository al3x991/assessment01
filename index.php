<?php
session_start();//start user session
//include some dependables
include("db/db.php");
 include('user_login.php');
?>
    <?php
//if buy now is clicked
if (isset($_POST['purchase_energy'])){

   $idnoo = "";
//post vending form details
$user = $_SESSION['user_name'];
$ev = $_POST['ev'];
$tev = $_POST['tev'];
$price = $_POST['price'];
$amount = $_POST['amount'];
$eb = $_POST['eb'];
//update EB with EV
$eba = $eb + $ev;
//insert energy purchased details to database
$purchase = $conn->prepare("INSERT INTO sales (user_name, energy_vended, ebBefore, ebAfter, price, amount, dt) VALUES (:uname,:ev, :ebb, :eba, :price, :amnt, NOW())");

 $purchase->bindParam(":uname", $user, PDO::PARAM_STR);
 $purchase->bindParam(":ev", $ev, PDO::PARAM_INT);
  $purchase->bindParam(":ebb", $eb, PDO::PARAM_INT);
 $purchase->bindParam(":eba", $eba, PDO::PARAM_INT);
  $purchase->bindParam(":price", $price, PDO::PARAM_INT);
 $purchase->bindParam(":amnt", $amount, PDO::PARAM_INT);

$purchase->execute();

//show alert of how much was bought
echo "<script>alert('".$ev." Kwh Puchased!');</script>";
    
echo "<script>window.open('index.php','_self')</script>";

}
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
  
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/linearicons.css">
     <link rel="stylesheet" type="text/css" href="css/loader.css">
<link href="https://unpkg.com/ionicons@4.2.6/dist/css/ionicons.min.css" rel="stylesheet">
                 <script type="text/javascript">
    //calculates the amount and energy balance 
    function calculateTotal() {
        //get current values from our form
        var price = document.addem.price.value;
        var tev = document.addem.tev.value;
        var ev = document.addem.ev.value;
        //calculate amount
        amount = eval(price * ev);
        //calculate energy balance
        eb = tev - ev;
        //round up amount to two decimal place
        totalR = Math.ceil(amount * 100)/100;
        //auto update the total as ev changes
        document.getElementById('update').value = totalR;
        //auto update the energy balance as ev changes
        document.getElementById('update2').value = eb;
    }

</script>

</head>
<body>

<div class="spacer"></div>
<!-- ##### include the login form ##### -->
 <?php include('user_login_form.php'); ?>
   
 
        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="index.html"><img src="img/core-img/logo.png"  style="width: 140px;" alt="">&nbsp;&nbsp;<span>Assessment</span></a>
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

                        <?php
//include view shown for when user is logged in or out
include('user_online.php');
                        ?>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
            <!-- Top Header Area -->
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <!-- My Contact Info -->
            <div class="contact-info">
                <a href="#"><span>Phone:</span> 09069525059</a>
                <a href="#"><span>Email:</span> ostrategic@gmail.com</a>
            </div>
            <!-- Follow-->
            <div class="follow-us">
                <span>Follow </span>
                <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
   
   <?php





   ?>
    
   
<section>
<!-- ##### Main page view ##### -->
<div class="regular-page-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content" style="text-align: center;">
                        <h4 >Energy Sales Capture 
                        <p>Your online energy vendor</p></h4>
                        <!--  Energy Sales Capture Form  -->
                        <form name="addem"  method="POST" action="" id="csvForm" >

                     <p>Enter Vending details or load from file&nbsp;&nbsp;<input id="upload" type="file"></p><br>
                            <!-- Run the javascript function everytime the user updates the value of textbox using event listener onkeyup -->
                            <!-- ##### CSV FORMAT USED
                                 ID     VALUE
                                 price     00000
                                 tev      00000
                                 ev   00000 
                                 ################## -->
                              <span>Energy (Kwh):</span><input type="text" class="form-control" name="ev" id="ev" onkeyup="calculateTotal()" required/><br>
                            <!--TEV set to 10,000Kwh by default-->
                            <span>TEV: </span>&nbsp;<input type="text" class="form-control" name="tev" id="tev" value="10000" readonly><br>
                            <!--editable price field-->
                            <span>Price (per Kwh):</span>&nbsp;<input type="text" class="form-control" name="price" id="price" value="23.10"/>
                            <br>
                            <p>Total to pay:&nbsp;&nbsp;N<input type="text" name="amount" id="update" style="border: none;" readonly></p><br>
                            <p>Energy Balance:&nbsp;&nbsp;<input type="text" name="eb" value="" id="update2" style="border: none;" readonly></p><br>
                            <?php
                           //if user is not logged in, display buy button that triggers login form
                           if (!isset($_SESSION['user_name'])){

                            echo '<div class="main-nav"><input type="button" id="cd-signin" class="btn clever-btn" value="Buy Now"></div>';
                           }
                           else{
                            //if user is logged in, allow purchase.
                            echo '<input type="submit" name="purchase_energy" class="btn clever-btn" value="Buy Now">';
                           }

                            ?>
                        </form>
                        
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
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
   <script  src="js/index.js"></script>
    <script src="js/sweetalert.js"></script>

    <?php 

if (isset($_SESSION['purchased'])){
  
  echo '<script>
  swal("Success", "you have successfully purchased" '.$_SESSION['success1'].' Kwh, "success");</script>';
  unset($_SESSION['purchased']);
}else{

  echo " ";
}
?>

</body>

</html>

    <script type="text/javascript" src="js/csv_upload.js"></script>
