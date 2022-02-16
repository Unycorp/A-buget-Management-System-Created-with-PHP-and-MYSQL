<?php
include 'connection/dbconnect.php';
// for deleting
if(isset($_POST['d_expenses_id']) && isset($_POST['d_user_id'])){
    $user_id = $_POST['d_user_id'];
    $expenses_id = $_POST['d_expenses_id'];
    
    $query = "DELETE FROM expenses WHERE user_id='$user_id' AND expenses_id='$expenses_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result){
        echo true;
    }

}
// for updating using edit button
if(isset($_POST['u_budget_id']) && isset($_POST['u_user_id']) && isset($_POST['u_expenses_id']) && isset($_POST['u_amount'])){
    $user_id = $_POST['u_user_id'];
    $expenses_id = $_POST['u_expenses_id'];
    $amount = $_POST['u_amount'];
    $budget_id = $_POST['u_budget_id'];
    $item = $_POST['u_item'];
   
   
     //get the budget_limit_id of this expenses
    $query = "SELECT * FROM expenses WHERE expenses_id='$expenses_id' AND user_id='$user_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
            $budget_limit_id = $row['budget_limit_id'];
            $bamt = $row['amount'];
        }
    }
    
    $budget_limit = 0;
    $query2 = "SELECT * FROM budget_limit WHERE user_id='$user_id'  AND date_id='$budget_limit_id' LIMIT 1;";
    $result2 = mysqli_query($conn, $query2);
    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_array($result2)){
                $budget_limit = $budget_limit + (int)$row['amount'];
            }
        }
    
    $budget_amount = 0;
    $query2 = "SELECT * FROM budget WHERE user_id='$user_id'  AND budget_id='$budget_id' LIMIT 1;";
    $result2 = mysqli_query($conn, $query2);
    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_array($result2)){
                $budget_amount = (int)$row['amount'];
            }
        }
    
    $expenses_amount = 0;
    $query2 = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_id='$budget_id' AND budget_limit_id='$budget_limit_id'";
    $result2 = mysqli_query($conn, $query2);
    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_array($result2)){
            $expenses_amount = $expenses_amount + (int)$row['amount'];
        }
    }
   
    $a_expenses_amount = 0;
    $query2 = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_limit_id='$budget_limit_id'";
    $result2 = mysqli_query($conn, $query2);
    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_array($result2)){
            $a_expenses_amount = $a_expenses_amount + (int)$row['amount'];
        }
    }
    
    //add the new amount
    $expenses_amount = ($expenses_amount - $bamt) + abs($amount - $bamt);
    $a_expenses_amount = ($a_expenses_amount - $bamt) + abs($amount - $bamt);
   
    if($expenses_amount <= $budget_amount && $a_expenses_amount <= $budget_limit){
        $query = "UPDATE expenses SET item='$item' , amount='$amount' WHERE user_id='$user_id' AND expenses_id='$expenses_id' AND budget_id='$budget_id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result){
            echo true;
        }
    }else if($expenses_amount > $budget_amount){
       echo "3";
    }else if($a_expenses_amount > $budget_limit){
       echo "2";
    }

}
// for viewing delete expenses
if(isset($_POST['dm_expenses_id']) && isset($_POST['dm_user_id'])){
    $expenses_id = $_POST['dm_expenses_id'];
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
            <button type='button' class='btn btn-danger' onclick='butDelete(\"$expenses_id\")'>Yes</button>
         </div>";
}
// for viewing editing expenses modal
if(isset($_POST['expenses_id']) && isset($_POST['user_id'])){
    $expenses_id = $_POST['expenses_id'];
    $user_id = $_POST['user_id'];
    $amount = "";
    $date = "";
            // select a specific expenses
            $query = "SELECT * FROM expenses WHERE expenses_id='$expenses_id' AND user_id='$user_id' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $amount = $row['amount'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
                $item = $row['item'];

             }
        }

echo "<div class='modal-header'>
                <h5 class='modal-title'>Edit Expenses</h5>
                <button type='button' class='close' data-dismiss='modal'><span>&times;</span>
                </button>
            </div>
        <div class='modal-body'>
                <div class='form-group'>
                    <label>Enter Amount</label>
                    <input type='number' class='form-control' placeholder='Enter Expenses Amount' id='uamount' value='$amount' />
                </div>
               <div class='form-group'>
                    <label>Item</label>
                    <input type='text' class='form-control' placeholder='What do you want to spend on' id='uitem' value='$item' />
                    <input style='display:none' id='ubudget_id' value='$budget_id' />
                </div>
               
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger light' data-dismiss='modal'>Close</button>
            <button type='button' class='btn btn-success' onclick='butSaveEdit(\"$expenses_id\")'>Save changes</button>
         </div>";
}
// for adding an expenses
if(isset($_POST['budget_id']) && isset($_POST['amount']) && isset($_POST['user_id']) ){
    $budget_id = $_POST['budget_id'];  
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];
    $bid = $_POST['budget_limit_id'];
    $month = date("m");
   
    $itm = $_POST['item'];
    if($itm == ""){$itm == "others";}

            $email = "";
            $query3i = "SELECT * FROM registration WHERE user_id='$user_id' LIMIT 1";
            $result3i = mysqli_query($conn, $query3i);
            if(mysqli_num_rows($result3i)>0){
            while($row = mysqli_fetch_array($result3i)){
                $email = $row['email'];
                }
            }

            $to = $email;
            $subject = "Budget Alert";

            $bugeted_amount = 0;
            $b_name = "";
            $query3 = "SELECT * FROM budget WHERE user_id='$user_id' AND budget_id='$budget_id' LIMIT 1";
            $result3 = mysqli_query($conn, $query3);
            if(mysqli_num_rows($result3)>0){
            while($row = mysqli_fetch_array($result3)){
                $b_amount = $row['amount'];
                $b_name = $row['name'];

                $bugeted_amount = (int)$b_amount;
            }
        }
    
        $budget_limit = 0;
        $query2 = "SELECT * FROM budget_limit WHERE user_id='$user_id'  AND date_id='$bid' LIMIT 1;";
            $result2 = mysqli_query($conn, $query2);
            if(mysqli_num_rows($result2)>0){
            while($row = mysqli_fetch_array($result2)){
                $budget_limit = $budget_limit + (int)$row['amount'];
            }
        }
    
        $expenses_amount = 0;
        $query2 = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_id='$budget_id' AND budget_limit_id='$bid'";
            $result2 = mysqli_query($conn, $query2);
            if(mysqli_num_rows($result2)>0){
            while($row = mysqli_fetch_array($result2)){
                $expenses_amount = $expenses_amount + (int)$row['amount'];
            }
        }
    
        $a_expenses_amount = 0;
        $query2 = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_limit_id='$bid'";
        $result2 = mysqli_query($conn, $query2);
        if(mysqli_num_rows($result2)>0){
            while($row = mysqli_fetch_array($result2)){
                $a_expenses_amount = $a_expenses_amount + (int)$row['amount'];
            }
        }
            //add the new amount
        $expenses_amount += $amount;
        $a_expenses_amount += $amount;
    
    if($a_expenses_amount <= $budget_limit && $expenses_amount <= $bugeted_amount){
        $year = date("Y");
        $expenses_id = uniqid();
        $query2 = "INSERT INTO expenses (item,expenses_id, budget_id, user_id, amount, month_id, year_id,budget_limit_id)
        VALUES('$itm','$expenses_id', '$budget_id', '$user_id', '$amount', '$month', '$year','$bid')";
        $result2 = mysqli_query($conn, $query2);
        if($result2){
        
             echo true;
        
        $average_budgeted_amount = (int)$bugeted_amount / 2; // 50%
        $average_budgeted_amount2 = ((int)$bugeted_amount / 4)+$average_budgeted_amount; // 75%
        $average_budgeted_amount3 = ((int)$bugeted_amount / 8)+$average_budgeted_amount2; // 87.5%
        $average_budgeted_amount4 = ((int)$bugeted_amount / 16)+$average_budgeted_amount3; // 93.5%

        $message = "";
        $result4 = false;
        $notification_id = uniqid();
        if($expenses_amount > $average_budgeted_amount && $expenses_amount < $average_budgeted_amount2){
            // warn the person that he has used average of what he budgted
            $message = "You have reach the center mark. You have spend 50% of your budget on $b_name. Henceforth, you are advice to spend wisely";
            $query4 = "INSERT INTO notification(notification_id, budget_id, expenses_id, user_id, message, status_id) VALUES('$notification_id', '$budget_id', '$expenses_id', '$user_id', '$message', 'false')";
            $result4 = mysqli_query($conn, $query4);
        }elseif($expenses_amount > $average_budgeted_amount2 && $expenses_amount < $average_budgeted_amount3){
            // Advice the person to be very careful how he spend
            $message = "You have spend 75% of your budget on $b_name. Be very careful on how you spend. Be advice!!!";
            $query4 = "INSERT INTO notification(notification_id, budget_id, expenses_id, user_id, message, status_id) VALUES('$notification_id', '$budget_id', '$expenses_id', '$user_id', '$message', 'false')";
            $result4 = mysqli_query($conn, $query4);
        }else if($expenses_amount > $average_budgeted_amount3 && $expenses_amount < $average_budgeted_amount4){
            // Warn the person should not spend any money again
            $message = "Please, do not spend any money again. You have spent 87.5% of your budgeted amount on $b_name";
            $query4 = "INSERT INTO notification(notification_id, budget_id, expenses_id, user_id, message, status_id) VALUES('$notification_id', '$budget_id', '$expenses_id', '$user_id', '$message', 'false')";
            $result4 = mysqli_query($conn, $query4);
        }else if($expenses_amount > $average_budgeted_amount4 && $expenses_amount < $bugeted_amount){
            // sent an email here..
            $message = "You have almost exhausted your budget. You have spent 93.5% of your budget on $b_name. Please do not spend any money again";
            $query4 = "INSERT INTO notification(notification_id, budget_id, expenses_id, user_id, message, status_id) VALUES('$notification_id', '$budget_id', '$expenses_id', '$user_id', '$message', 'false')";
            $result4 = mysqli_query($conn, $query4);
            mail($to, $subject, $message);
        }
        //echo "msg: ".$message;
           
    }
    }
    else if($a_expenses_amount > $budget_limit){
        echo "2";
    }else if($expenses_amount > $bugeted_amount){
        echo "3";
    }
    

}
// for adding an budget_limit
if(isset($_POST['budget_limit']) && isset($_POST['amount']) && isset($_POST['user_id'])){
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];
    $bid = $_POST['budget_limit'];
    
    $email = "";
    $query3i = "SELECT * FROM budget_limit WHERE user_id='$user_id' AND date_id='$bid' LIMIT 1";
    $result3i = mysqli_query($conn, $query3i);
    if(mysqli_num_rows($result3i)>0){
        //use pdate instead
        $query3i = "UPDATE budget_limit SET amount='$amount' WHERE user_id='$user_id' AND date_id='$bid' LIMIT 1";
        $result3i = mysqli_query($conn, $query3i);
    
    }
    else{
        //create 
        $query2 = "INSERT INTO budget_limit (user_id, amount,date_id)
        VALUES('$user_id', '$amount','$bid')";
        $result2 = mysqli_query($conn, $query2);
                       
    }

     echo true;      

  
}
// for viewing all budgeting
if(isset($_POST['refresh_id']) && isset($_POST['user_id']) && isset($_POST['budget_id'])){
    $user_id = $_POST['user_id'];
    $budget_id = $_POST['budget_id'];
    $name = "";
    $sn = 0;
    $amount = "";
    $date = "";
    
    $query = "SELECT * FROM registration WHERE user_id='$user_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                 $budget_limit_id = $row['budget_id'];
            }
    }
    
    // select expenses that belong to this budget
    $query = "SELECT * FROM expenses WHERE user_id='$user_id' AND budget_id='$budget_id' AND budget_limit_id ='$budget_limit_id' ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $sn++;
                $id = $row['id'];
                $expenses_id = $row['expenses_id'];
                $amount = $row['amount'];
                $date = $row['date_id'];
                $budget_id = $row['budget_id'];
                $month_id = $row['month_id'];
                $year_id = $row['year_id'];
                $item = $row['item'];

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
                            <td>$item</td>
                            <td>&#8358;$amount</td>
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
}

?>