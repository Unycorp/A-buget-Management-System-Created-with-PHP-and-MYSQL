<?php
//include 'connection/dbconnect.php';
include 'securitysystem.php';
$user_id = $user_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'csslibraries.php';  ?>
</head>
<body>

  <?php include 'preloader.php'; ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include 'leftsidebarmenu.php' ?>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		<?php include 'rightsidebar.php'; ?>
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<?php include 'leftsidebarinfo.php'; ?>
		
		
        <!--**********************************
            Header start
        ***********************************-->
        <?php include 'header.php'; ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'leftsidebar.php'; ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row">
					
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Notification</h4>
                            </div>
                            <div class="card-body">
                                <div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:450px; overflow-y: auto;">
                                    <ul class="timeline" id="notification_id">
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
					
			   </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php include 'footer.php'; ?>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
<!-- Edit Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="edit_id">
            
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="delete_id">
            
        </div>
    </div>
</div>
<?php include 'jslibraries.php'; ?>	
<script type="text/javascript">
    var _user_id = "<?php echo $user_id ?>";
refresh();
function butDelete(notification_id){

 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("d_user_id", _user_id);
 data.append("d_notification_id", notification_id);
 ajax.open("post", "notificationAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            //document.getElementById("class_main_id").innerHTML = result;
            if(result){
              refresh();
              $('#deleteModal').modal('hide');
              speakSuccess("Deleted successfully");
             }
            }
        }
}
function butSaveEdit(notification_id){

 var data = new FormData();
 var ajax = new XMLHttpRequest();
 data.append("u_notification_id", notification_id);
 data.append("u_user_id", _user_id);
 ajax.open("post", "notificationAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            //document.getElementById("class_main_id").innerHTML = result;
            if(result){
              refresh();
              $('#editModal').modal('hide');
              speakSuccess("Updated successfully");
             }
            }
        }
}
function butShowDeleteModal(notification_id){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("dm_notification_id", notification_id);
 data.append("dm_user_id", _user_id);

 ajax.open("post", "notificationAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("delete_id").innerHTML = result;
            }
        }
}
function butShowEditModal(notification_id){
 var data = new FormData();
 var ajax = new XMLHttpRequest();
 data.append("em_notification_id", notification_id);
 data.append("em_user_id", _user_id);

 ajax.open("post", "notificationAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("edit_id").innerHTML = result;
            }
        }
}
function refresh(){

var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("refresh_id", "");
 data.append("user_id", _user_id);

 ajax.open("post", "notificationAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("notification_id").innerHTML = result;
            //if(result){
            //  alert("Added Successfully");
            // }
            }
        }

}

</script>
</body>

</html>