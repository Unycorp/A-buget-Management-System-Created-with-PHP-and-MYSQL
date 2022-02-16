<?php
session_start();
if(isset($_SESSION['email_budget_id'])){
    
    if(session_destroy()){
        unset($_SESSION['email_budget_id']);

        header("location:signin.php");
        
        echo "<script type='text/javascript'>
        window.location.href = 'signin.php'
        </script>";
        
    }
    else{
        $error = "Could not signout. Please try again later. If the problem persist,
 contact the service administration for possible solutions";
    }
}
else{
    
    header("location:signin.php");
    
    echo "<script type='text/javascript'>
        window.location.href = 'signin.php'
        </script>";
    
}


?>