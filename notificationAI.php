<?php
include 'connection/dbconnect.php';
// for deleting
if(isset($_POST['d_notification_id']) && isset($_POST['d_user_id'])){
    $user_id = $_POST['d_user_id'];
    $notification_id = $_POST['d_notification_id'];
    
    $query = "DELETE FROM notification WHERE user_id='$user_id' AND notification_id='$notification_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result){
        echo true;
    }

}
// for updating using edit button
if(isset($_POST['u_notification_id']) && isset($_POST['u_user_id'])){
    $user_id = $_POST['u_user_id'];
    $notification_id = $_POST['u_notification_id'];

    $status_id = "";
	$query = "SELECT * FROM notification WHERE user_id='$user_id' AND notification_id='$notification_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
           	$status_id = $row['status_id'];
           }
       }
    if($status_id=="false"){
    	$status_id = "true";
    }else{
    	$status_id = "false";
    }

    $query = "UPDATE notification SET status_id='$status_id' WHERE user_id='$user_id' AND notification_id='$notification_id'LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result){
        echo true;
    }

}
// for viewing delete notification
if(isset($_POST['dm_notification_id']) && isset($_POST['dm_user_id'])){
    $notification_id = $_POST['dm_notification_id'];
    $user_id = $_POST['dm_user_id'];

echo "<div class='modal-header'>
                <h5 class='modal-title'>Delete Budget</h5>
                <button type='button' class='close' data-dismiss='modal'><span>&times;</span>
                </button>
            </div>
        <div class='modal-body'>
            <div class='form-group'>
                <h6>You cannot undo your action. Are you sure you want to continue?</h6>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger light' data-dismiss='modal'>No</button>
            <button type='button' class='btn btn-danger' onclick='butDelete(\"$notification_id\")'>Yes</button>
         </div>";
}
// for viewing editing notification modal
if(isset($_POST['em_notification_id']) && isset($_POST['em_user_id'])){
    $notification_id = $_POST['em_notification_id'];
    $user_id = $_POST['em_user_id'];

echo "<div class='modal-header'>
                <h5 class='modal-title'>Edit Expenses</h5>
                <button type='button' class='close' data-dismiss='modal'><span>&times;</span>
                </button>
            </div>
        <div class='modal-body'>
             Are you sure you want to change your notification status. You can always undo your action. Do you want to continue?
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger light' data-dismiss='modal'>Close</button>
            <button type='button' class='btn btn-success' onclick='butSaveEdit(\"$notification_id\")'>Save changes</button>
         </div>";
}
if(isset($_POST['user_id']) && isset($_POST['refresh_id'])){
    $user_id = $_POST['user_id'];
    // select a specific expenses
    $query = "SELECT * FROM notification WHERE user_id='$user_id' ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
           	$message = $row['message'];
           	$date = $row['date_id'];
           	$notification_id = $row['notification_id'];
           	$status_id = $row['status_id'];

           	$rand = rand(0,4);
if($rand==0){
    $col = "primary";
    $txt = "text-primary";
}elseif ($rand==1) {
    $col = "info";
    $txt = "text-info";
}elseif ($rand==2) {
    $col = "danger";
    $txt = "text-danger";
}elseif ($rand==3) {
    $col = "warning";
    $txt = "text-warning";
}elseif ($rand==4) {
    $col = "dark";
    $txt = "text-muted";
}

if($status_id=="false"){
	// have not seen the notification
	$seen = "<i class='fa fa-eye text-primary' style='font-size:17px'></i>";
}else{
	// have seen the notification
	$seen = "<i class='fa fa-eye text-muted' style='font-size:17px'></i>";
}
echo "<li>
        <div class='timeline-badge $col'></div>
        <a class='timeline-panel text-muted' href='javascript:void(0)'>
        	<span>$date</span>
        	<span class='text-right' onclick='butShowDeleteModal(\"$notification_id\")' data-toggle='modal' data-target='#deleteModal'><i class='fa fa-trash text-danger' style='font-size:17px'></i></span>
        	<h6 class='mb-0'>$message</h6>
        	<span class='text-right' onclick='butShowEditModal(\"$notification_id\")' data-toggle='modal' data-target='#editModal'>$seen</span>
        </a>
    </li>";
		}
	}
}
?>