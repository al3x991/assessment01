<?php 

if (isset($_SESSION['user_name'])){
                             
        
$uname =  $_SESSION['user_name'];
$uFname =  $_SESSION['name'];

$host   = 'localhost';
$dbname = 'sahara_assessment';
$username = "root";
$password = "";
$pdo = new PDO('mysql:dbname=sahara_assessment;host=localhost', $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$mysqli = new mysqli("localhost", "root", "", "sahara_assessment");

$seen_status = 0;
$defaultstatus= 0;



        $gettrend = $pdo->prepare("SELECT * FROM users WHERE user_name= '$uname'");


$gettrend->execute();


    while($obj = $gettrend->fetch())
        {
           $user1 = $obj['user_id'];
           $userImg = $obj['user_image'];
            $userNme = $obj['user_name'];
            $fname = $obj['full_name'];


    echo ' <div class="register-login-area">
                            </div>
                            <div class="login-state d-flex align-items-center">
                                <div class="user-name mr-30">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$fname.'</a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                            <a class="dropdown-item" href="user/dashboard.php"><i class="fa fa-laptop"></i>&nbsp;Dashboard</a>
                                            <a class="dropdown-item" href="user/settings.php"><i class="fa fa-cog fa-spin"></i>&nbsp;Settings</a>
                                            <a class="dropdown-item" href="logout.php"><i class="fa fa-door"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="userthumb mr-30">
                                    <img src="user/usr_image/'.$userImg.'" alt="">
                                </div>';

//<i class='fa fa-bell' style='color: #cda569;margin-left: -20px;font-size:24px;'></i>
                            echo '</div>';
}}else {
                         echo'
             
                            <div class="register-login-area main-nav">
                                
                                <a href="#0" class="btn active cd-signin">Login</a>
                            </div>';
           
        }
             ?>        