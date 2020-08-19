<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
    $con = mysqli_connect("localhost","root","","users") or die("error");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>

    <?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No hemos podido detectar su navegador';


}


$navegador = getBrowser($user_agent);
 


?>



    <table id="example1"  class="table table-striped table-bordered">

<thead>
    <th>ID</th>
    <th>Date</th>

    <th>Navegador</th>
    <th>Ip</th>
    <th>Reset Password</th>
    <th>Log Out</th>

    </thead>


<?php
    $file = "SELECT * FROM users";

    $ejecutar = mysqli_query($con, $file);

    $i = 0;

    while($fila = mysqli_fetch_array($ejecutar))
    {
        $id = $fila['id'];
        $date = $fila['username'];
        $i++;
  
?>



<tr >

    <td><?php echo $id; ?></td>
    <td><?php echo $date; ?></td>
  
    <td><?php echo $navegador;?></td>
    <td><?php echo "{$_SERVER['REMOTE_ADDR']}";?></td>
    <td><a href="reset-password.ph?ppdf=<?php echo $id; ?>" class="btn btn-warning">Reset Your Password</a></td>
    <td><a href="logout.ph?ppdf=<?php echo $id; ?>" class="fas fa-power-off">Sign Out of Your Account </a></td>

 </tr>

<?php } ?>

</table>

</body>
</html>