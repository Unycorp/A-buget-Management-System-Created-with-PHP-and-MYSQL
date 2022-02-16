<?php
include 'securitysystem.php';
$user_id = $user_id;

$month = date("m");
$year = date("Y");

$month_name = date("F", mktime(0,0,0,$month, 10));
if(isset($_GET['date_id'])){
$gBid = $_GET['date_id'];
}else{
    header('location:budget_record.php');
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
                <!-- the chart for budget -->
                <div class="card">
                      <?php 
                                  function cDate($dte){
                                                $date_time_arr = explode(" ", $dte);
                                                $date_arr = explode("-", $date_time_arr[0]);
                                                $year = $date_arr[0];
                                                $month = $date_arr[1];
                                                $day_num = $date_arr[2];

                                                $month = date("F", mktime(0,0,0,$month, 10));
                                                
                                                $day = date("D", strtotime($dte));
                                                return $day.", ".$day_num."-".$month."-".$year;

                                            }
                                  function cMDate($dte){
                                                $date_time_arr = explode(" ", $dte);
                                                $date_arr = explode("-", $date_time_arr[0]);
                                                $year = $date_arr[0];
                                                $month = $date_arr[1];
                                                $day_num = $date_arr[2];

                                                $month = date("F", mktime(0,0,0,$month, 10));
                                                
                                                $day = date("D", strtotime($dte));
                                                return $month."-".$year;

                                            }
                                  function cYDate($dte){
                                                $date_time_arr = explode(" ", $dte);
                                                $date_arr = explode("-", $date_time_arr[0]);
                                                $year = $date_arr[0];
                                                $month = $date_arr[1];
                                                $day_num = $date_arr[2];

                                                $month = date("F", mktime(0,0,0,$month, 10));
                                                
                                                $day = date("D", strtotime($dte));
                                                return $year;

                                            }
                             
                        $b_bol = false;
                           
                        //get total amount spent
                        $query = "SELECT * FROM expenses WHERE user_id='$user_id'";
                        $result = mysqli_query($conn, $query);
                        $t_amt = 0;
                        if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    //get the budgetd limit for this day
                                    if($_GET['type'] == 'daily'){
                                        $tmp = cDate($row['date_id']);
                                        if($tmp == $_GET['date_id']){
                                            $t_amt += $row['amount'] * 1;
                                        }
                                    }else if($_GET['type'] == 'monthly'){
                                        $tmp = cMDate($row['date_id']);
                                        if($tmp == $_GET['date_id']){
                                            $t_amt += $row['amount'] * 1;
                                        }
                                    }else if($_GET['type'] == 'yearly'){
                                        $tmp = cYDate($row['date_id']);
                                        if($tmp == $_GET['date_id']){
                                            $t_amt += $row['amount'] * 1;
                                        }
                                    }
                                    
                                }
                        }
                ?>
                    <div class="card-header">
                        <h3><?php echo $_GET['date_id']; ?> Budget History<br>
                            
                     </div>
                    <div class="card-header" style="display:flex;flex-wrap:wrap;">
                    
                        
                         <div class="topgravity">
                            <h4 class="card-title">
                                Total Spent
                            </h4>
                            <h1 style="color:limegreen">&#8358;<?php echo number_format($t_amt); ?></h1>
                        </div> 
                        
                    </div>
                    <?php
                        
                                    $name = "";
                                    $sn = 0;
                                    $amount = "";
                                    $date = "";
                                  
                    
                                    $query = "SELECT * FROM budget WHERE user_id='$user_id' ORDER BY id DESC";
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result)>0){
                                        $b_arr = array();
                                        while($row = mysqli_fetch_array($result)){
                                                $tmp = $row['budget_id'];
                                                // select expenses that belong to this budget
                                                $query = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_limit_id='$gBid' AND budget_id='$tmp' ORDER BY id DESC";
                                                $resultx = mysqli_query($conn, $query);
                                            $tamt = 0;
                                                   
                                                if(mysqli_num_rows($resultx)>0){
                                                    while($rown = mysqli_fetch_array($resultx)){
                                                            $tamt += $rown['amount'] *1;

                                                    }
                                                }
                                                array_push($b_arr,[$row['name'],"$tamt"]);
                                                
                                        }
                                    }
                    
                                    // select expenses that belong to this budget
                                    $query = "SELECT * FROM expenses WHERE user_id='$user_id' ORDER BY id DESC";
                                    $result = mysqli_query($conn, $query);
                                    $rowx = array();
                                    if(mysqli_num_rows($result)>0){
                                      
                                        while($row = mysqli_fetch_array($result)){
                                                if($_GET['type'] == 'daily'){
                                                    $tmp = cDate($row['date_id']);
                                                    if($tmp == $_GET['date_id']){
                                                       array_push($rowx,$row);
                                                    }
                                                }else if($_GET['type'] == 'monthly'){
                                                    $tmp = cMDate($row['date_id']);
                                                    if($tmp == $_GET['date_id']){
                                                       array_push($rowx,$row);
                                                    }
                                                }else if($_GET['type'] == 'yearly'){
                                                    $tmp = cYDate($row['date_id']);
                                                    if($tmp == $_GET['date_id']){
                                                        array_push($rowx,$row);
                                                    }
                                                }
                                            
                                                    
                                        }
                                    }
                    $row = "";
                    
                    ?>
                     
                     <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md table-striped primary-table-bordered">
                                        <thead class="thead-info">
                                            <tr>
                                                <th style="width:80px;"><strong>sn</strong></th>
                                                <th>Date</th>
                                                <th>Item</th>
                                                <th>Category</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                               
                                        <tbody id="tb">
                                            
                                            <?php 
            $total_amount = 0;
                                    
            foreach($rowx as $row){
                 $sn++;
                $id = $row['id'];
                $expenses_id = $row['expenses_id'];
                $amount = $row['amount'];
                $item = $row['item'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
                $month_id = $row['month_id'];
                $year_id = $row['year_id'];

                $total_amount = $total_amount + $amount;
                //get the budget name
                $query = "SELECT * FROM budget WHERE budget_id='$budget_id'";
                $resultx = mysqli_query($conn, $query);
                if(mysqli_num_rows($resultx)>0){
                    $budg = mysqli_fetch_array($resultx)['name'];
                }
                else{$budg = "Miscellaneous";}
                
                $amount = number_format($amount);

                $date_time_arr = explode(" ", $date);
                $date_arr = explode("-", $date_time_arr[0]);
                $year = $date_arr[0];
                $month = $date_arr[1];
                $day_num = $date_arr[2];

                $month = date("F", mktime(0,0,0,$month, 10));
                $month_id = date("F", mktime(0,0,0,$month_id, 10));

                $day = date("D", strtotime($date));
                $tme = date("h:ia", strtotime($date));
                $date = $day.", ".$day_num."-".$month."-".$year." $tme";

            echo "<tr>
                            <td><strong>$sn</strong></td>
                            <td>$date</td>
                            <td>$item</td>
                            <td>$budg</td>
                            <td>&#8358;$amount</td>
                            
                        </tr>";
                }
                if($total_amount > 0){
                    $total_amount = number_format($total_amount);
                }
                echo "<tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#8358;$total_amount</td>
                </tr>";
            

                                ?> 
                                        </tbody>
                                    </table>
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
<div class="modal fade" id="spend">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">How much are you budgeting</h5>
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
                    <input value="<?php echo $b_amt; ?>" type="text" class="form-control" placeholder="Enter Amount" id="budget_amount" />
                </div>
             </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="AddBudgetLimit()">Save changes</button>
         </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Expenses for Today</h5>
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
                    <input type="text" class="form-control" placeholder="What are you spending on" id="budget_item" />
                </div>
                <div class="form-group">
                    <select class="form-control" id="budget_category">
                        <?php
                            //get total amount spent
                            $query = "SELECT * FROM budget WHERE user_id='$user_id'";
                            $result = mysqli_query($conn, $query);
                            $t_amt = 0;
                            if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_array($result)){ 
                                       //get the budgetd limit for this day 
                                        $bid = $row['budget_id'];
                                        $query = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_id = '$bid' AND budget_limit_id='$budget_limit_id';";
                                        $resultx = mysqli_query($conn, $query);
                                        $tmp = 0;
                                        if(mysqli_num_rows($resultx)>0){
                                                while($rowx = mysqli_fetch_array($resultx)){ 
                                                    $tmp += $rowx['amount']*1;
                                                }}
                                    
                                    ?>

                                     <option value="<?php echo $row['budget_id'] ?>" selected><?php echo $row['name'] . " <strong>balance</strong> &#8358;" . number_format(($row['amount']*1) - $tmp); ?></option>
                       
                                 <?php   }
                            }
                        ?>
                         
                    </select>
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
var _budget_id = "";
 
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
var b_id = document.getElementById("budget_category").value; 
var itm = document.getElementById("budget_item").value;

    if(amount * 1 > 0){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("budget_id", b_id);
 data.append("budget_limit_id", "<?php echo $budget_limit_id; ?>");
 data.append("amount", amount);
 data.append("user_id", _user_id);
 data.append("item", itm);


 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText//.replace(/[^0-9]/g,"");
            
            if(result == "1"){
               $('#createModal').modal('hide');
              speakSuccess("Added successfully");
                location.reload()
             }
                else if(result == "2"){
                    alert("Budgeted amount exceeded")
                } else if(result == "3"){
                    alert("Budgeted amount for this category exceeded")
                }
            }
        }
    }
    }
    else{
        alert('Invalid Number')
    }
} 
function AddBudgetLimit(){

//var budget_id = document.getElementById("budget").value;
var amount = document.getElementById("budget_amount").value;
 if(amount * 1 > 0){
 var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("budget_limit", "<?php echo $budget_limit_id; ?>");
 data.append("amount", amount);
 data.append("user_id", _user_id);


 ajax.open("post", "expensesAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            if(result){
               $('#spend').modal('hide');
              speakSuccess("Added successfully");
                location.reload()
             }
            }
        }
 }
    else{
        alert('Invalid amount')
    }
} 

</script>
</body>
</html>













