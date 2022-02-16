<?php
session_start();
include 'connection/dbconnect.php';
//error_reporting("E_ALL");
$user_id = "";
$name = "";
$position = "";
$photo = "";
if(isset($_SESSION['email_budget_id'])){
   $email = $_SESSION['email_budget_id'];
   
   $query = "SELECT * FROM registration WHERE email='$email' LIMIT 1";
   $result = mysqli_query($conn, $query);
   if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_array($result)){
           $user_id = $row['user_id'];
           $name = $row['name'];
           $occupation = $row['occupation'];
           $photo = $row['photo'];
           $budget_limit_id = $row['budget_id'];
       }
       
   }
   
   
}

else{
    header("location:signin.php");
    
    echo "<script type='text/javascript'>
        window.location.href = 'signin.php'
        </script>";
}

?>