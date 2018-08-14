<?php
//if login button is clicked
if (isset($_POST['u_login'])){
//post form details
$c_username = $_POST['u_username'];
$c_pass = $_POST['u_pass'];
$idno2 = mt_rand(10000,999999);//generate random id number
//check if login details exist
$stmt = $conn->prepare("SELECT * FROM users WHERE user_pass = :u_pass AND user_name= :u_name");

$stmt->bindParam(":u_pass",$c_pass,PDO::PARAM_STR);
$stmt->bindParam(":u_name",$c_username,PDO::PARAM_STR);

$stmt->execute();


$auth_customer = $stmt->fetch();
//if no records found show login error
if($auth_customer==0){

$_SESSION['loginerror1']=$idno2;
    
header('Location:'.$_SERVER['REQUEST_URI']);
die;
}else if ($auth_customer > 0 ){
//if login details are found, create user session
 $_SESSION['user_name']=$c_username;

$host   = 'localhost';
$dbname = 'sahara_assessment';
$username = "root";
$password = "";
$pdo = new PDO('mysql:dbname=sahara_assessment;host=localhost', $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$mysqli = new mysqli("localhost", "root", "", "sahara_assessment");

        $gettrend = $pdo->prepare("SELECT * FROM users WHERE user_name= '$c_username'");


$gettrend->execute();


    while($obj = $gettrend->fetch())
        {
           $user1 = $obj['full_name'];
}
$_SESSION['name'] = $user1;//session created

header('Location:'.$_SERVER['REQUEST_URI']);
die;

}

}

?>