<?php
// to store persistent data
session_start();
// connection to the database
include 'connection/dbconnect.php';

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = strip_tags(mysqli_real_escape_string($conn, $_POST['email']));
    $password = strip_tags(mysqli_real_escape_string($conn, $_POST['password']));
    
    $query = "SELECT * FROM registration WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        //while($row= mysqli_fetch_array($result)){
        $_SESSION['email_budget_id'] = $email;
        echo true;
    }
}
?>