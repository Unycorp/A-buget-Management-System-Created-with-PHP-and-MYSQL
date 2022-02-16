<?php
//include 'connection/dbconnect.php';
include 'securitysystem.php';
$user_id = $user_id;

$month = date("m");
$year = date("Y");

$month_name = date("F", mktime(0,0,0,$month, 10));

$budget_id = "";
if(isset($_GET['b'])){
    $budget_id = $_GET['b'];
}

$expenses_name = "";
$query = "SELECT * FROM budget WHERE budget_id='$budget_id' AND user_id='$user_id' LIMIT 1";
$result = mysqli_query($conn, $query);
$a_exp = 0;
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
 $expenses_name = $row['name'];
 $bamt = $row['amount'];     
 $dte = array(); $dte_amt = array();
    $query = "SELECT * FROM expenses WHERE budget_id='$budget_id' AND user_id='$user_id' AND budget_limit_id='$budget_limit_id'";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result)>0){
                            
                                while($row = mysqli_fetch_array($result)){
                                        $amnt = $row['amount'] * 1;
                                        $a_exp += $amnt; 
                                        array_push($dte,$row['date_id']);
                                        array_push($dte_amt,$amnt);
                                }
                        }
}
}


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
                                <h4 class="card-title"><?php echo $expenses_name ?> Expenses</h4>
                                    <div class="text-right">
                                       <button type="button" class="btn btn-rounded btn-info mb-2" data-toggle="modal" data-target="#createModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span>Add Expenses</button>
                                    </div>
                            </div>
                           <div class="card-header" style="display:flex;flex-wrap:wrap">
                                <?php
                                    
                            //get total amount spent
                            $query = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_id='$budget_id' AND budget_limit_id='$budget_limit_id'";
                            $result = mysqli_query($conn, $query);
                            $t_amt = 0;
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    //get the budgetd limit for this day
                                    $t_amt += $row['amount'] * 1;
                                }
                            }
                            //get total amount spent
                            $query = "SELECT * FROM budget WHERE user_id='$user_id' AND budget_id='$budget_id'";
                            $result = mysqli_query($conn, $query);
                            $b_amt = 0;
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    //get the budgetd limit for this day
                                    $b_amt += $row['amount'] * 1;
                                }
                            }
    
                                ?>
                               
                           
                         <div class="topgravity">
                            <h4 class="card-title">
                                Total Spent
                            </h4>
                            <h1 style="color:limegreen">&#8358;<?php echo number_format($t_amt); ?></h1>
                        </div>
                         <div class="topgravity">
                            <h4 class="card-title">
                                Balance
                            </h4>
                            <h1 style="color:purple">&#8358;<?php echo number_format($b_amt - $t_amt); ?></h1>
                        </div>
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md table-striped primary-table-bordered">
                                        <thead class="thead-info">
                                            <tr>
                                                <th style="width:80px;"><strong>sn</strong></th>
                                                <th>Item</th>
                                                <th>Amount(&#8358;)</th>
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
       
            <div class="container-fluid">
            <!-- the chart for budget -->
                <div class="card">
                    <div class="card-header">
                                <h4 class="card-title"><?php echo $expenses_name ?> Budget Data</h4>
                    </div>
                    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:center">
                    <?php
                    if($a_exp > 0){ ?>
                    <canvas id='chrt' style="height:100px;width:400px;flex-shrink:0;margin-bottom:40px"></canvas>
                    <?php } 
                    if(sizeof($dte) > 0){ ?>
                    <canvas id='chrt2' style="flex-shrink:0;height:200px;width:500px;margin-bottom:40px"></canvas>
                    <?php } ?>
                    </div>
                </div>
                  <script>
                    var ctx = document.getElementById('chrt')
                    if(ctx != null){
                         var chart = new Chart(ctx.getContext('2d'), {
                    // The type of chart we want to create
                    type: 'doughnut',

        
                    // The data for our dataset
                    data: {
                        "labels": [
                            "Budget <?php echo number_format($bamt); ?>",
                            "Expenses <?php echo number_format($a_exp); ?>",
                        ],
                        "datasets": [{
                            "label": "Budget History",
                            "data": [<?php echo $bamt; ?>, <?php echo $a_exp; ?>],
                            "backgroundColor": [
                                "rgb(54, 162, 235)",
                                "rgb(255, 205, 86)",
                                 
                            ]
                        }]
                    },

                    // Configuration options go here
                    options: {}
                });
                   
                    }
                    
                    
                    var ctx1 = document.getElementById('chrt2') 
                    if(ctx1 != null){
                        var chart = new Chart(ctx1.getContext('2d'), {
                    // The type of chart we want to create
                    type: 'line',

        
                    // The data for our dataset
                    data: {
                        "labels": [
                            
                             <?php 
                            $x = 0;
                            foreach($dte as $val){
                                if($x > 0){echo ",";}
                                echo "\"$val\""; $x++;
                                
} ?>
                        ],
                        "datasets": [{
                            "label": "Budget History",
                            "data": [  
                                
                                <?php 
                                $x = 0;
                                foreach($dte_amt as $val){
                                if($x > 0){echo ",";}
                                echo $val;$x++;
} ?>
                                    ],
                            "borderColor": "rgb(75, 192, 192)",
                                "lineTension": 0.1
                        }]
                    },

                    // Configuration options go here
                    options: {}
                });
                    }
                      
                </script>
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
                <h5 class="modal-title">Add Expenses for <?php echo $expenses_name ?></h5>
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
                    <label>Enter Amount</label>
                    <input type="text" class="form-control" placeholder="Enter Amount" id="amount" />
                </div>
                 <div class="form-group">
                    <label>Item</label>
                    <input type="text" class="form-control" placeholder="What do you want to spend on" id="item" />
                </div>
                 
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="AddExpenses()">Save changes</button>
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
var _budget_id = "<?php echo $budget_id ?>";
refresh();
function butDelete(expenses_id){

 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("d_user_id", _user_id);
 data.append("d_expenses_id", expenses_id);
 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            //document.getElementById("class_main_id").innerHTML = result;
            if(result){
              location.reload()
              $('#deleteModal').modal('hide');
              speakSuccess("Deleted successfully");
             }
            }
        }
}
    
    
function butSaveEdit(expenses_id){
var amount = document.getElementById("uamount").value;
var item = document.getElementById("uitem").value;
var u_budegt_id = document.getElementById("ubudget_id").value;

 var data = new FormData();
 var ajax = new XMLHttpRequest();
 data.append("u_amount", amount);
 data.append("u_user_id", _user_id);
 data.append("u_expenses_id", expenses_id);
 data.append("u_budget_id", u_budegt_id);
 data.append("u_item", item);
 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText.replace(/[^0-9]/g,"")
            //document.getElementById("class_main_id").innerHTML = result;
            if(result == "1"){
              location.reload()
              $('#editModal').modal('hide');
              speakSuccess("Updated successfully");
             }else if(result == "3"){
                 alert("Cannot exceed budgeted limit")
             }else if(result == "2"){
                 alert("Cannot exceed budgeted amount")
             }
            }
        }
}
    
function butShowDeleteModal(expenses_id){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("dm_expenses_id", expenses_id);
 data.append("dm_user_id", _user_id);

 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("delete_id").innerHTML = result;
            }
        }
}
function butShowEditModal(expenses_id){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("expenses_id", expenses_id);
 data.append("user_id", _user_id);

 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("edit_id").innerHTML = result;
            }
        }
}

function AddExpenses(){

//var budget_id = document.getElementById("budget").value;
var amount = document.getElementById("amount").value;
var item = document.getElementById("item").value;
 
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("budget_id", _budget_id);
 data.append("budget_limit_id", "<?php echo $budget_limit_id; ?>");
 data.append("amount", amount);
 data.append("user_id", _user_id);
 data.append("item", item);


 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText//.replace(/[^0-9]/g,"");
            //document.getElementById("class_main_id").innerHTML = result;
                
            if(result == "1"){
              location.reload()
              $('#createModal').modal('hide');
              speakSuccess("Added successfully");
             }else if(result == "3"){
                 alert("Cannot exceed budgeted limit")
             }else if(result == "2"){
                 alert("Cannot exceed budgeted amount")
             }
             
            }
        }
}
function refresh(){

var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("refresh_id", "");
 data.append("user_id", _user_id);
 data.append("budget_id", _budget_id);

 ajax.open("post", "expensesAI.php", true);
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