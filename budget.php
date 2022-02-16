<?php
//include 'connection/dbconnect.php';
include 'securitysystem.php';
$user_id = $user_id;
$month = date("m");
$year = date("Y");

$month_name = date("F", mktime(0,0,0,$month, 10));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'csslibraries.php';  ?>
    <style type="text/css">
    td {
    color: #181c32;
    font-weight: 500;
    line-height: 40px;
}
    </style>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manage Budget Limits</h4>
                                    <div class="text-right">
                                       <button type="button" class="btn btn-rounded btn-primary mb-2" data-toggle="modal" data-target="#createModal"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i>
                                        </span>Add Budget Limit</button>
                                    </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;"><strong>sn</strong></th>
                                                <th><strong>Budget Name</strong></th>
                                                <th>Budgeted Limit</th>
                                                <th>Balance</th>
                                                <th>Date Added</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb">
                                            
                                            
                                        </tbody>
                                    </table>
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
<!-- Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Budget Limit</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <!--<div class="alert alert-primary alert-left alert-dismissible fade show" style="background: #cce5ff; color: #004085;  border-color: #b8daff;">
                    <p>
                        Input the name of the class and click the save changes button
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>-->
                <div class="form-group">
                    <label>Enter Name of Budget e.g Transportation</label>
                    <input type="text" class="form-control" placeholder="Enter name of budget" id="name" />
                </div>
                <div class="form-group">
                    <label>Enter Amount</label>
                    <input type="text" class="form-control" placeholder="Enter Budgeted Amount" id="amount" />
                </div>
              </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="AddBudget()">Save changes</button>
         </div>
        </div>
    </div>
</div>
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
function butDelete(budget_id){

 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("d_user_id", _user_id);
 data.append("d_budget_id", budget_id);
 ajax.open("post", "budgetAI.php", true);
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
function butSaveEdit(budget_id){
var name = document.getElementById("uname").value;
var amount = document.getElementById("uamount").value;
 
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("uname", name);
 data.append("uamount", amount);
 data.append("user_id", _user_id);
 data.append("budget_id", budget_id);
 ajax.open("post", "budgetAI.php", true);
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
function butDeleteBudget(budget_id){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("did", "");
 data.append("d_budget_id", budget_id);
 data.append("user_id", _user_id);

 ajax.open("post", "budgetAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("delete_id").innerHTML = result;
            }
        }
}
function butEditBudget(budget_id){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("budget_id", budget_id);
 data.append("user_id", _user_id);

 ajax.open("post", "budgetAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("edit_id").innerHTML = result;
            }
        }
}

function AddBudget(){

var name = document.getElementById("name").value;
var amount = document.getElementById("amount").value;

 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("name", name);
 data.append("amount", amount);
 data.append("user_id", _user_id);


 ajax.open("post", "budgetAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            //document.getElementById("class_main_id").innerHTML = result;
            //alert(result);
            if(result){
              refresh();
              $('#createModal').modal('hide');
              speakSuccess("Added successfully");
             }
            }
        }
}
function refresh(){

var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("refresh_id", "");
 data.append("user_id", _user_id);

 ajax.open("post", "budgetAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("tb").innerHTML = result;
            //if(result){
            //  alert("Added Successfully");
            // }
            }
        }

}

</script>
</body>
</html>