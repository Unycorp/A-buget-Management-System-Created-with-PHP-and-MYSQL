<?php
include 'securitysystem.php';
$user_id = $user_id;

$month = date("m");
$year = date("Y");

$month_name = date("F", mktime(0,0,0,$month, 10));

    //check if there is reste 
    if(isset($_GET['reset'])){
        if($_GET['reset'] == 'true'){
            
            //create new budget
            $budget_limit_id = uniqid();
            if($_GET['usebalance'] == 'true'){
                $bal = $_GET['balance'];
            }else{$bal ="0";}
            $query2 = "INSERT INTO budget_limit (user_id, amount,date_id)
            VALUES('$user_id', '$bal','$budget_limit_id')";
            $result2 = mysqli_query($conn, $query2);
            //save user that you are using this budget
            $query2 = "UPDATE registration SET budget_id='$budget_limit_id' WHERE user_id='$user_id'";
            $result2 = mysqli_query($conn, $query2);
            //set the budegt of the balance as the amount - the balance
            $tmp = ($_GET['budget_amount'] * 1) - ($_GET['balance'] * 1);
            $bid = $_GET['budget_id'];
            $query2 = "UPDATE budget_limit SET amount='$tmp' WHERE date_id='$bid'";
            $result2 = mysqli_query($conn, $query2);
            header('Location:index.php');
                       
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
                <!-- the chart for budget -->
                <div class="card">
                    
                    <div class="card-header" style="display:flex;flex-wrap:wrap;">
                      <?php  
                        $b_bol = false;
                        // select expenses that belong to this budget
                        $query = "SELECT * FROM budget_limit WHERE user_id='$user_id' AND date_id='$budget_limit_id' LIMIT 1";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    //get the budgetd limit for this day
                                    $b_amt = $row['amount'];
                                }
                        }
                        else{
                            $b_amt = 0;$nx=0;$b_bol = true;
                            //has no budget amount.. use AI to predict budget amount
                            $query = "SELECT * FROM budget_limit WHERE user_id='$user_id' ORDER BY id DESC LIMIT 31";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_array($result)){
                                        //get the budgetd limit for this day
                                        $b_amt += $row['amount']*1;$nx++;
                                    }
                                //use average
                                $b_amt = $b_amt / $nx;
                            }
                            else{
                                //ask user to set budget limit
                                $b_amt = 0;
                            }
                        }
                        
                        if($b_amt > 0 && $b_bol){
                             //save the budget amount
                             $budget_limit_id = uniqid();
                             $query2 = "INSERT INTO budget_limit (user_id, amount,date_id)
                             VALUES('$user_id', '$b_amt','$budget_limit_id')";
                             $result2 = mysqli_query($conn, $query2);
                             //save user that you are using this budget
                             $query2 = "UPDATE registration SET budget_id='$budget_limit_id' WHERE user_id='$user_id'";
                             $result2 = mysqli_query($conn, $query2);
                             
                              
                        }
                        
                       
                        //get total amount spent
                        $query = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_limit_id='$budget_limit_id'";
                        $result = mysqli_query($conn, $query);
                        $t_amt = 0;
                        if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    //get the budgetd limit for this day
                                    $t_amt += $row['amount'] * 1;
                                }
                        }
                ?>
                        <div class="topgravity">
                            <h4 class="card-title">
                                Budgeted Amount
                            </h4>
                            <div class="leftGravity">
                            <button id='thisButton' type="button"  class='nobut' style="margin-left:10px;" data-toggle="modal" data-target="#spend">
                                <span class="btn-icon-left text-info"><i class="fa fa-pencil color-info"></i>
                                </span></button>
                                   
                            <h1 style="color:#1cceff">&#8358;<?php echo number_format($b_amt) ?>  </h1>
                            </div>
                        </div>
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
                    <div class="text-right">
                                       <button onclick="newBudget(event)" style="margin-top:15px;margin-right:20px" type="button" class="btn btn-rounded btn-info mb-2 btn-green"><span class="btn-icon-left text-info"><i class="fa fa-plus " style="color:limegreen"></i>
                                        </span>New Budgeted Amount</button>
                             <button onclick="validateTotal(event)" style="margin-top:15px;margin-right:20px" type="button" class="btn btn-rounded btn-info mb-2" data-toggle="modal" data-target="#createModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                        </span>Add Expenses</button>
                                    </div> 
                    <script>
                        function validateTotal(e){
                            //to see if there is enough balance to add or budget limit is set
                            if(<?php echo $b_amt; ?> <= 0){
                                //show how much do you want to budget today
                                alert("You need to set a budgeted amount");
                                document.getElementById('thisButton').click()
                                e.stopPropagation()
                            }
                            else if(<?php echo $b_amt - $t_amt; ?> <= 0){
                                alert("You have reached your budgeted amount")
                                e.stopPropagation()
                            }
                            
                        }
                        function newBudget(){
                            if(<?php echo $b_amt - $t_amt; ?> > 0){
                                //show the alert balance message
                                if(confirm('Do you want to carry the balance over')){
                                    window.location = "index.php?reset=true&usebalance=true&balance=<?php echo ($b_amt - $t_amt) ."&budget_id=$budget_limit_id&budget_amount=$b_amt"; ?>"   
                                }
                                else{
                                   window.location = "index.php?reset=true&usebalance=false&balance=<?php echo ($b_amt - $t_amt) ."&budget_id=$budget_limit_id&budget_amount=$b_amt"; ?>"   
                                }
                            }
                        }
                    </script>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md table-striped primary-table-bordered">
                                        <thead class="thead-info">
                                            <tr>
                                                <th style="width:80px;"><strong>sn</strong></th>
                                                <th>Item</th>
                                                <th>Category</th>
                                                <th>Amount(&#8358;)</th>
                                                <th>Year</th>
                                                <th>Date Added</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                               
                                        <tbody id="tb">
                                            
                                            <?php 
                                    $name = "";
                                    $sn = 0;
                                    $amount = "";
                                    $date = "";
                                    //get today's date
                                    
                                    // select expenses that belong to this budget
                                    $query = "SELECT * FROM expenses WHERE user_id='$user_id' ORDER BY id DESC";
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $sn++;
                $id = $row['id'];
                $expenses_id = $row['expenses_id'];
                $amount = $row['amount'];
                $item = $row['item'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
                $month_id = $row['month_id'];
                $year_id = $row['year_id'];
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
                            <td>$item</td>
                            <td>$budg</td>
                            <td>&#8358;$amount</td>
                            <td>$year_id</td>
                            <td>$date</td>
                            <td class='text-center'>
                            <div class='dropdown'>
                            <button type='button' class='btn btn-danger light sharp' data-toggle='dropdown'>
                                <svg width='20px' height='20px' viewBox='0 0 24 24' version='1.1'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'/><circle fill='#000000' cx='5' cy='12' r='2'/><circle fill='#000000' cx='12' cy='12' r='2'/><circle fill='#000000' cx='19' cy='12' r='2'/></g></svg>
                            </button>
                            <div class='dropdown-menu'>
                            <a class='dropdown-item' href='javascript:void(0)' onclick='butShowEditModal(\"$expenses_id\")' data-toggle='modal' data-target='#editModal'>Edit</a>
                            <a class='dropdown-item' href='javascript:void(0)' onclick='butShowDeleteModal(\"$expenses_id\")' data-toggle='modal' data-target='#deleteModal'>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>";
                }
            }

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













