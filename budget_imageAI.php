<?php 
include 'connection/dbconnect.php';

	if(isset($_POST['user_id']) && isset($_POST['delete_id'])){
		$id = $_POST['delete_id'];
		$user_id = $_POST['user_id'];

		$photo1 = "";
		$query = "SELECT * FROM budget_image WHERE id='$id' AND user_id='$user_id' LIMIT 1";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result)){
				$photo1 = $row['photo'];
			}
		}

		$query = "DELETE FROM budget_image WHERE id='$id' AND user_id='$user_id' LIMIT 1";
		$result = mysqli_query($conn, $query);
		if($result){	

			if(unlink("images/expenses/$photo1")){
				echo true;
			}
		}
	}
	if(isset($_POST['user_id']) && isset($_FILES['photo1'])){

	$user_id = $_POST['user_id'];

	$file_path = "images/expenses/";

	$post_id = uniqid();

	// The first file. i.e front view
    $filename1 = $_FILES['photo1']['name'];
    $unique_file_name1 = $post_id.$filename1;

    $file_tmp_name1 = $_FILES['photo1']['tmp_name'];

    $target_file1 = $file_path.basename($unique_file_name1);

	if(move_uploaded_file($file_tmp_name1, $target_file1)){
		
		$query = "INSERT INTO budget_image(user_id, photo)VALUES('$user_id','$unique_file_name1');";
		$result = mysqli_query($conn, $query);
			if($result){
			echo true;
		}else{
			echo false;
		}
	}
}

if(isset($_POST['refresh_id']) && isset($_POST['user_id'])){
	$user_id = $_POST['user_id'];

	echo "<div style='display:block'>";
	$query = "SELECT * FROM budget_image WHERE user_id='$user_id' ORDER BY id DESC";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
		$photo = $row['photo'];
		$id = $row['id'];

		echo "<div style='width: 100%;'><img src='images/expenses/$photo' style='width:100%; padding:30px'
		><div style='text-align:center'><button class='btn btn-danger' onclick='butDelete($id)'>Delete</button></div>
		</div>";
		}
	}
	echo "</div>";

}