<?php
session_start();
 include('../user_login.php');
?>
    <?php

if (isset($_POST['purchase_energy'])){

   $idnoo = "";

$user = $_SESSION['user_name'];
$ev = $_POST['ev'];
$tev = $_POST['tev'];
$amount = $_POST['amount'];
$eb = $_POST['eb'];

$purchase = $conn->prepare("INSERT INTO sales (user_name, energy_vended, amount, dt) VALUES (:uname,:ev, :amnt, NOW())");

 $purchase->bindParam(":uname", $user, PDO::PARAM_STR);
 $purchase->bindParam(":ev", $ev, PDO::PARAM_INT);
 $purchase->bindParam(":amnt", $amount, PDO::PARAM_INT);

$purchase->execute();

//update EB with EV
$eba = $eb + $ev;

    $recordEB = $conn->prepare("INSERT INTO eb (user_name, ebBefore, ebAfter, dt) VALUES (:uname,:ebb, :eba, NOW())");

 $recordEB->bindParam(":uname", $user, PDO::PARAM_STR);
 $recordEB->bindParam(":ebb", $eb, PDO::PARAM_INT);
 $recordEB->bindParam(":eba", $eba, PDO::PARAM_INT);


$recordEB->execute();

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
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
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

<script type="text/javascript">
function getValues() {
            var rows = document.querySelectorAll("tr.package-row");
            rows.forEach(function (currentRow) {

                var ev = Number(currentRow.querySelector('#numberUsed').value);
                var price = Number(currentRow.querySelector('#price').value);
                var tev = 10000;
                
                
                var amount = ev * price;
                var eb = tev - ev;
                currentRow.querySelector("#revenue").innerHTML = amount;
                currentRow.querySelector("#value").innerHTML = eb;

var sum = 0;
//iterate through each td based on class and add the values
    $(".ev").each(function() {

        //add only if the value is number
        if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }

    });
//$('#result').text(sum); 
document.getElementById('result').innerHTML = sum; 

            });
var tAmount = 0;
// iterate through each td based on class and add the values
$(".amnt").each(function() {

    var value = $(this).text();
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
        tAmount += parseFloat(value);
    }
});
document.getElementById('Totalamount').innerHTML = tAmount; 
        }
</script>


</head>
<body>

<div class="spacer"></div>
 <?php include('user_login_form.php'); ?>
   <!-- ##### Header Area End ##### -->
 
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
                        <!-- Nav End -->

                    </div>
                </nav>
            </div>
        </div>

            <!-- Top Header Area -->
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span>Phone:</span> 09069525059</a>
                <a href="#"><span>Email:</span> ostrategic@gmail.com</a>
            </div>
            <!-- Follow Us -->
            <div class="follow-us">
                <span>Follow </span>
                <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
  <div class="row">
<div class="col-md-2">
    <div class="side_nav">
        <p><li><a href="dashboard.php" >Dashboard</a></li></p>
        <p><li><a href="vending_report.php" class="active2">Vending Report</a></li></p>
    </div>
</div>
   
<section>
<div class="regular-page-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content">
                        <h4>All Vending Done</h4>
                        <p></p>
                       
        <div class="row">
                <div class=" ">
                <input type="text" id="search_field" class="form-control" placeholder="Search"></input>
                    <div class="table-responsive">
<table id="myTable2"  class="first table table-striped">
    <thead>
    <tr class="myHead">
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
                            $sql = "SELECT * FROM sales";

                            //use for MySQLi-OOP
                            $query = $conn->query($sql);
                            while($row = $query->fetch_assoc()){

    echo '<tr class="package-row">
        <td id="package" name="package">'.$row['user_name'].'</td>
        <td><input type="text" name="numberUsed" id="numberUsed" value="'.$row['energy_vended'].'" class="ev form-control" onkeyup="getValues()"/></td>
        <td><input type="text" name="price" id="price" value="'.$row['price'].'" class="form-control" onkeyup="getValues()"/></td>
        <td name="revenue" class="amnt" id="revenue">'.$row['amount'].'</td>
        <td name="value" id="value">'.$row['ebBefore'].'</td>
        <td id="inPackage" name="inPackage">'.$row['dt'].'</td>
    </tr>';
}
       $totalev = "SELECT SUM(energy_vended) AS total_ev FROM sales";

              //use for MySQLi-OOP
              $querytotalev = $pdo->query($totalev);
              while($row = $querytotalev->fetch()){

               $t_ev = $row['total_ev'];
}

                $totalamount = "SELECT SUM(amount) AS total_amount FROM sales";

              //use for MySQLi-OOP
              $querytotalamount = $pdo->query($totalamount);
              while($row = $querytotalamount->fetch()){

               $t_am = $row['total_amount'];
               }
    ?>
   <tfoot>
   <td id="">Total: </td>
   <td id="result"><?php echo $t_ev; ?></td>
   <td id=""></td>
   <td id="Totalamount"><?php echo $t_am; ?></td>
   <td id=""></td>
   <td id=""></td>
   </tfoot>
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
    </section>
 
    <!-- ##### Upcoming Events End ##### -->

    
        <!-- end contact -->

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
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>
   <script  src="../js/index.js"></script>
    <script src="../js/sweetalert.js"></script>
  
<script src="../datatable/jquery.dataTables.min.js"></script>
<script src="../datatable/dataTable.bootstrap.min.js"></script>

<!--<script type="text/javascript">
    $(document).ready(function(){
$('.ev').each(function() {
    calculateSum();
});
});

 function calculateSum() {

var sum = 0;
//iterate through each td based on class and add the values
    $(".ev").each(function() {

        //add only if the value is number
        if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }

    });
//$('#result').text(sum); 
document.getElementById('result').innerHTML = sum;   
};
</script>-->
<!-- generate datatable on our table -->


</body>
    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
 <script src="../datatable/jquery.dataTables.min.js"></script>
<script src="../datatable/dataTable.bootstrap.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').dataTable();
    });
</script>
<script>
$(document).ready(function(){

$('#search_field').on('keyup', function() {
  var value = $(this).val();
  var patt = new RegExp(value, "i");

  $('#myTable2').find('tr').each(function() {
    if (!($(this).find('td').text().search(patt) >= 0)) {
      $(this).not('.myHead').hide();
    }
    if (($(this).find('td').text().search(patt) >= 0)) {
      $(this).show();
    }
  });

});
});
</script>
</html>
