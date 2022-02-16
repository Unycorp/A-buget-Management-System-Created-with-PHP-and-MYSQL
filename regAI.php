<?php
include 'connection/dbconnect.php';
if(isset($_FILES['file']) && isset($_POST['name']) && isset($_POST['occupation']) && isset($_POST['email']) && isset($_POST['password'])){

  $name = $_POST['name'];
  $occupation = $_POST['occupation'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $occupation = strtolower($occupation);

  $post_id = uniqid();

  $file_path = "images/";

  $filename = $_FILES['file']['name'];
  $unique_file_name = "images/".$post_id.".png";

  $file_tmp_name = $_FILES['file']['tmp_name'];

  $target_file = $file_path.basename($unique_file_name);
 
  // occurs if no students is found in the database
  if(move_uploaded_file($file_tmp_name, $target_file)){
    $query4 = "INSERT INTO registration (name, email, password, user_id, photo, occupation) VALUES('$name', '$email', '$password', '$post_id', '$unique_file_name', '$occupation')";
    $result4 = mysqli_query($conn, $query4);
    if($result4){
      echo true;
      ///insert default budget limts
    $cat = ['Food','Transportation','Lunch','Electricity','Stationaries','Housing','Electronics','Entertainment','Tax','Waste Management'];
      foreach($cat as $val){
      
          $id = uniqid();
          $year = date("Y");
          $query4 = "INSERT INTO budget (budget_id, user_id, name, amount, month_id, year_id)
          VALUES('$id', '$post_id', '$val', '10000', 'none', '$year')";
          $result4 = mysqli_query($conn, $query4);
      
      }
 







    }
      
  }
}

?>