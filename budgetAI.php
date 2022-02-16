<?php
include 'connection/dbconnect.php';
// for deleting
if(isset($_POST['d_budget_id']) && isset($_POST['d_user_id'])){
    $user_id = $_POST['d_user_id'];
    $budget_id = $_POST['d_budget_id'];
    
    $query = "DELETE FROM budget WHERE user_id='$user_id' AND budget_id='$budget_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result){
        echo true;
    }

}
// for updating using edit button
if(isset($_POST['budget_id']) && isset($_POST['user_id']) && isset($_POST['uname']) && isset($_POST['uamount'])){
    $user_id = $_POST['user_id'];
    $budget_id = $_POST['budget_id'];
    $name = $_POST['uname'];
    $amount = $_POST['uamount'];
    
    
    $query = "UPDATE budget SET amount='$amount', name='$name' WHERE user_id='$user_id' AND budget_id='$budget_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result){
        echo true;
    }

}
// for viewing delete budget
if(isset($_POST['d_budget_id']) && isset($_POST['user_id'])){
    $budget_id = $_POST['d_budget_id'];
    $user_id = $_POST['user_id'];
    $amount = "";
    $name = "";
    $date = "";
            // select the students created by the admin
            $query = "SELECT * FROM budget WHERE budget_id='$budget_id' AND user_id='$user_id' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $name = $row['name'];
                $amount = $row['amount'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
            }
        }
echo "<div class='modal-header'>
                <h5 class='modal-title'>Delete Budget</h5>
                <button type='button' class='close' data-dismiss='modal'><span>&times;</span>
                </button>
            </div>
        <div class='modal-body'>
            <div class='form-group'>
                <h6>Delete $name budget plan with an exceeding limit of &#8358;$amount dated $date. You cannot undo your action. Are you sure you want to continue?</h6>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger light' data-dismiss='modal'>No</button>
            <button type='button' class='btn btn-danger' onclick='butDelete(\"$budget_id\")'>Yes</button>
         </div>";
}
// for viewing editing budget
if(isset($_POST['budget_id']) && isset($_POST['user_id'])){
    $budget_id = $_POST['budget_id'];
    $user_id = $_POST['user_id'];
    $amount = "";
    $name = "";
    $date = "";
    $month = "";
    $month_name = "";
            $query = "SELECT * FROM budget WHERE budget_id='$budget_id' AND user_id='$user_id' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $name = $row['name'];
                $amount = $row['amount'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
                 
            }
        }
echo "<div class='modal-header'>
                <h5 class='modal-title'>Edit Budget</h5>
                <button type='button' class='close' data-dismiss='modal'><span>&times;</span>
                </button>
            </div>
        <div class='modal-body'>
            <div class='form-group'>
                <div class='form-group'>
                    <label>Enter Name of Budget e.g Transportation</label>
                    <input type='text' class='form-control' placeholder='Enter name of budget' id='uname' value='$name' />
                </div>
                <div class='form-group'>
                    <label>Enter Amount</label>
                    <input type='text' class='form-control' placeholder='Enter Budgeted Amount' id='uamount' value='$amount' />
                </div>
                 
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger light' data-dismiss='modal'>Close</button>
            <button type='button' class='btn btn-success' onclick='butSaveEdit(\"$budget_id\")'>Save changes</button>
         </div>";
}
// for adding a budget
if(isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['user_id'])){
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];
     
    $year = date("Y");

    $budget_id = uniqid();
    $query2 = "INSERT INTO budget (budget_id, user_id, name, amount, month_id, year_id) 
    VALUES('$budget_id', '$user_id', '$name', '$amount', 'none', '$year')";
    $result2 = mysqli_query($conn, $query2);
    if($result2){
        echo true;
    }

}
// for viewing all budgeting
if(isset($_POST['refresh_id']) && isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $name = "";
    $sn = 0;
    $budget_id = "";
    $amount = "";
    $date = "";
    $budget_limit_id = "";
    
   $query = "SELECT * FROM registration WHERE user_id='$user_id' LIMIT 1";
   $result = mysqli_query($conn, $query);
   if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_array($result)){
          $budget_limit_id = $row['budget_id'];
       }
       
   }
    
        // select the students created by the admin
            $query = "SELECT * FROM budget WHERE user_id='$user_id' ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $sn++;
                $id = $row['id'];
                $name = $row['name'];
                $amount = $row['amount'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
                $month_id = "04";
                
                $query = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_id = '$budget_id' AND budget_limit_id='$budget_limit_id';";
                $resultx = mysqli_query($conn, $query);$tmp = 0;
                if(mysqli_num_rows($resultx)>0){
                        while($rowx = mysqli_fetch_array($resultx)){ 
                            $tmp += $rowx['amount']*1;
                }}
                
                $bll = number_format(($amount * 1) - $tmp);
                $amount = number_format($amount);

                $date_time_arr = explode(" ", $date);
                $date_arr = explode("-", $date_time_arr[0]);
                $year = $date_arr[0];
                $month = $date_arr[1];
                $day_num = $date_arr[2];

                $month = date("F", mktime(0,0,0,$month, 10));
                $month_id = date("F", mktime(0,0,0,$month_id, 10));

                $day = date("D", strtotime($date));
                $date = $day.", ".$day_num."-".$month."-".$year;
                
                
                                    
                
            echo "<tr>
                                                <td><strong>$sn</strong></td>
                                                <td>$name</td>
                                                <td>&#8358;$amount</td>
                                                <td>&#8358;$bll</td>
                                                <td>$date</td>
                                                <td><a href='expenses.php?b=$budget_id' class='btn btn-outline-success'>view</a></td>
                                                <td class='text-center'>
                                                    <div class='dropdown'>
                                                        <button type='button' class='btn btn-danger light sharp' data-toggle='dropdown'>
                                                            <svg width='20px' height='20px' viewBox='0 0 24 24' version='1.1'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'/><circle fill='#000000' cx='5' cy='12' r='2'/><circle fill='#000000' cx='12' cy='12' r='2'/><circle fill='#000000' cx='19' cy='12' r='2'/></g></svg>
                                                        </button>
                                                        <div class='dropdown-menu'>
                                                            <a class='dropdown-item' href='javascript:void(0)' onclick='butEditBudget(\"$budget_id\")' data-toggle='modal' data-target='#editModal'>Edit</a>
                                                            <a class='dropdown-item' href='javascript:void(0)' onclick='butDeleteBudget(\"$budget_id\")' data-toggle='modal' data-target='#deleteModal'>Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>";
                }
            }
        }
?>


