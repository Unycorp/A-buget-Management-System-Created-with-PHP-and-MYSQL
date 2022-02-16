<?php
//include 'connection/dbconnect.php';
include 'securitysystem.php';
$user_id = $user_id;

$month = date("m");
$year = date("Y");
$month_name = date("F", mktime(0,0,0,$month, 10));
 
 
// Total expenses for the month
$total_expenses_amount = 0;
$amount3 = "";
$query = "SELECT * FROM expenses WHERE user_id='$user_id' AND month_id='$month' AND year_id='$year'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $amount3 = $row['amount'];
                $amount3 = (int)$amount3;
                $total_expenses_amount = $total_expenses_amount + $amount3;
            }
        }

// Total budget for the month
$total_bugeted_amount = 0;
$amount2 = "";
$query = "SELECT * FROM budget WHERE user_id='$user_id' AND month_id='$month' AND year_id='$year'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $budget_name = $row['name'];
                $amount2 = $row['amount'];
                $amount2 = (int)$amount2;
                $total_bugeted_amount = $total_bugeted_amount + $amount2;
            }
        }


//-------------------------For the graph. Works like an AI----------------------
 $name_arr = [];
 $amount_arr = [];
    $exp_amount_arr = [];    
    $budget_name = "";  
 $query = "SELECT * FROM budget WHERE user_id='$user_id' ORDER BY id DESC LIMIT 10";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                $budget_name = $row['name'];
                $amount = $row['amount'];
                $budget_id = $row['budget_id'];

                array_push($name_arr, $budget_name);
                array_push($amount_arr, $amount);
            $sum_exp_amount = 0;
            $query2 = "SELECT * FROM expenses WHERE budget_id='$budget_id' ORDER BY id DESC";
            $result2 = mysqli_query($conn, $query2);
            if(mysqli_num_rows($result2)>0){
                while($row = mysqli_fetch_array($result2)){
                    $exp_amount = $row['amount'];
                    $sum_exp_amount = $sum_exp_amount + $exp_amount;
                    
                    }
                }
                    array_push($exp_amount_arr, $sum_exp_amount);
            }
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/font\css\all.css">


	<?php include 'csslibraries.php';  ?>
    <style type="text/css">
        /*----------------------------------------*/
/*  12.  Dashboard v.1.0 income
/*----------------------------------------*/
.income-monthly{
  background:linear-gradient(to bottom, #b52ea4 0%, #f13800 100%);
}
.orders-monthly{
  background:linear-gradient(to bottom, #ad6c7c 0%, rgb(216, 0, 255) 100%);
}
.visitor-monthly{
  background:linear-gradient(to bottom, #039477 0%, #2dda7a 100%);
}
.user-monthly{
  background:linear-gradient(to bottom, #b96f77 0%, #ca0e0e 100%);
}
.income-title{
  padding:15px 20px;
  border-bottom:1px solid rgba(233, 157, 128, 0.18);
}
.income-dashone-pro {
    padding: 20px;
}
.main-income-head{
  position:relative;
}
.income-title h2{
  font-size:20px;
  color:#fff;
  margin:0px;
}
.income-title p{
  position:absolute;
  right:0;
  top:0px;
  font-size: 13px;
    color: #fff;
    padding: 2px 10px;
    background: #1c84c6;
    border-radius: 2px;
  margin:0;
}
.main-income-phara.visitor-cl p{
    background: #1ab394;
}
.income-rate-total h3{
  color:#fff;
  font-size:23px;
}
.income-range p{
  font-size:14px;
  color:#fff;
  margin:0;
  float:left;
}
.income-range .income-percentange{
  font-size:14px;
  color:#fff;
  float:right;
}
.income-range.visitor-cl .income-percentange{
  color:#fff;
}
.income-rate-total{
  position:relative;
}
.price-graph{
  position:absolute;
  top:0;
  right:0;
}
.main-income-phara.order-cl p{
  background:#23c6c8;
}
.main-income-phara.low-value-cl p{
  background:#ed5565;
}
.income-range.order-cl .income-percentange{
  color:#fff;
}
.income-range.low-value-cl .income-percentange{
  color:#fff;
}
.shadow-reset{
  box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
}
.nt-mg-b-30{
  margin-bottom:30px;
}

/* ///////////////////////////////////////////////////////////////////////// */

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
        <?php 
           if(isset($_POST['user_firstname'])){
            
            if($_POST['user_password'] == $_POST['re_user_password']){
                //insert all the data
                $name = $_POST['user_firstname'];
                $email = $_POST['user_email'];
                $job = $row['user_job'];
                $pass = $_POST['user_password'];
                $phone = $_POST['user_phone'];
                 
                $sql = "UPDATE registration SET name = '$name',  password = '$pass', 
                        occupation = '$job', email = '$email' WHERE user_id = '$user_id'";
                $res = mysqli_query($conn, $sql);
                if($res){
                
                }else{
                    ?>
                        <script>
                                alert('Unable to update profile at this moment')
                          </script>
                <?php
                }
                    
               
            }else{?>
                 <script>
                     alert('Passwords does not match')
                 </script>
           <?php }
            $box1= "none";
            $box2 = "";
        }
           else{
            $box1= "";
            $box2 = "none";  
        }
        
   
        
        $query = "SELECT * FROM registration WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0){
           $urow = mysqli_fetch_array($result);
        }
        
                 if(isset($_POST['pic'])){
                     if(isset($_FILES['dp'])){
                 
               $pic = "images/". $user_id;
               move_uploaded_file($_FILES['dp']['tmp_name'],$pic.".png");
               //delete the old file name
               if(file_exists('images/'.$urow['photo'])){
                   if($urow['photo'] != "images/default.png"){
                       unlink('images/'.$urow['photo']);
                   }
               }
               //save new file name
               $pic .= ".png";
               $sql = "UPDATE registration SET photo = '$pic'  WHERE user_id = '$user_id'";
               $res = mysqli_query($conn, $sql);
               if($res){
                $urow['photo'] = $pic;
                ?>
                     
               <?php }
                
                     }
       }
   
     ?>
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid" style="">
                    
                    <div id='box1' class="myBox" style="width:80%;display:<?php echo $box1; ?>">
                    <div class="myHeader" style="display:flex">
                            My Profile
                      </div>
                    <div style="display:flex;flex-wrap:wrap;width:100%;">
                        
                       <div style="width:100%;min-width;margin-bottom:20px;margin-left:20px;margin-top:20px">
                           <div id='dpdisplay' style="background-image:url(<?php echo $urow['photo']; ?>);
                                                      background-size:cover;border-radius:50%;width:200px;height:200px;background-color:#1cceff"></div> 
                           <div onclick="changeDp()" class="myBtn" style="display:flex;align-items:center;justify-content:center;margin-left:170px;margin-top:-20px;width:40px;height:40px;border-radius:50%">
                                <span class="fas fa-pencil-alt"></span>
                           </div>
                       </div>
                        <script>
                            function changeDp(){
                                document.getElementById('pic').onchange = function(e){
                                    let fle = e.target.files[0]
                                    if(fle.type.indexOf('image') > -1){
                                        document.getElementById('dpdisplay').style.backgroundImage = "url(" + URL.createObjectURL(fle) + ")"
                                        //simulate form submit
                                         document.getElementById('picsub').click()
                                    }else{
                                        alert('Select an image')
                                    }
                                }
                              document.getElementById('pic').click()
                                  
                            }
                        
                        </script>
                        <form method="post" enctype="multipart/form-data" style="display:none">
                            <input type="file" id='pic' name='dp'/>
                            <input type="submit" name='pic' id='picsub'/>
                        </form>
                        <!-- user info -->
                        <div class="myCat" style="width:calc((100% / 3) - 20px);text-transform:Uppercase">
                            <font style='margin-left:20px;color:#33afaf'><span class="fas fa-address-book" style="font-size:13px;margin-bottom:2px;margin-right:5px"></span>Name</font>
                            <h5 style='margin-left:20px;'><?php echo $urow['name']; ?></h5> 
                        </div>
                       
                        <div class="myCat" style="width:calc((100% / 3) - 20px);text-transform:Uppercase">
                            <font style='margin-left:20px;color:#33afaf'><span class="fas fa-envelope" style="font-size:13px;margin-bottom:2px;margin-right:5px"></span>Email</font>
                            <h5 style='margin-left:20px;word-break:break-all'><?php echo $urow['email']; ?></h5> 
                        </div>
                        
                        <!-- extra info -->
                        <div class="myCat" style="width:calc((100% / 3) - 20px);text-transform:Uppercase">
                            <font style='margin-left:20px;color:#33afaf'><span class="fas fa-user" style="font-size:13px;margin-bottom:2px;margin-right:5px"></span>Occupation</font>
                            <h5 style='margin-left:20px;'><?php echo $urow['occupation']; ?></h5> 
                        </div>
                      
                     
                    </div>
                    <div  style="display:flex;margin-top:30px">
                        <button  onclick = 'switchBox()' class='myBtn' style="margin-left:20px;width:150px">
                            Edit
                        </button>
                    </div>
                </div>
                <script>
                    function switchBox(){
                        //to show box 1 and hide box 2
                        document.getElementById('box1').style.display = "none"
                        document.getElementById('box2').style.display = "block"
                    }
                    function switchBox1(){
                        //to show box 2 and hide box 1
                        document.getElementById('box2').style.display = "none"
                        document.getElementById('box1').style.display = "block"
                    }
                </script>
                   <div id='box2' class="myBox" style="width:100%;display:<?php echo $box2; ?>">
                    <div class="myHeader">
                            Edit Your Profile
                    </div>
                    <form action="" method="post" id="regForm" name="regForm" style="width:calc(100% - 50px);margin:auto;margin-top:50px;">
<input type="hidden" name="acctSignUp" id="acctSignUp" value="1">



<div class="row">


<div class="col-md-6">
<div class="form-group">
<label for="user_firstname">Name*</label>
        <div class="input-group">
                        
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
       <input  value="<?php echo $urow['name']; ?>"   class="form-control"  required placeholder="Enter First Name" id="user_firstname" type="text" name="user_firstname"  pattern="^[A-Za-z ]+$" title="Numbers and Symbols not accepted">
                        </div>
                    </div>
</div>
    
 

 <div class="col-md-6">
    <div class="form-group">
        <label for="user_email">Email*</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input   class="form-control" name="user_email" value="<?php echo $urow['email']; ?>"  id="user_email" required placeholder="Email *" >
            </div>
    </div>
</div>

</div>


                        <div class="col-md-12">
    <div class="form-group">
        <label>Occupation*</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <input   class="form-control" name="user_job" value="<?php echo $urow['occupation']; ?>"  id="user_job"   placeholder="Occupation *" >
            </div>
    </div>
</div>

 

 

<div class="row">
<div class="col-md-6">
    <div class="form-group">
        <label for="password">Password *</label>
            <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" class="form-control" name="user_password" id="user_password" required placeholder="Enter your password *">
            </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="password">Retype your password *</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" class="form-control" name="re_user_password" id="re_user_password" required placeholder="Retype your password *">
            </div>
    </div>
</div>



          
   
</div>   






<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 centered">
<div class="form-group text-left">
<button class="btn btn-primary btn-block" type="submit" name="submit_form" style="padding-left:15px; padding-right:15px;">Update</button>
<button onclick="switchBox1()" class="btn btn-primary btn-block"  style="padding-left:15px; padding-right:15px;background:#00afaf">Cancel</button>
</div>

</div>
</div>

</form>

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
<div id="name" style="font-size: 0px"><?php echo json_encode($name_arr); ?></div>
<div id="amount" style="font-size: 0px"><?php echo json_encode($amount_arr); ?></div>
<div id="exp_amount" style="font-size: 0px"><?php echo json_encode($exp_amount_arr); ?></div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
<?php include 'jslibraries.php'; ?>	
<!-- Chart ChartJS plugin files -->
<script src="motaAdmin/vendor/chart.js/Chart.bundle.min.js"></script>
<!--<script src="motaAdmin/js/plugins-init/chartjs-init.js"></script>-->
<script type="text/javascript">
var name_json = document.getElementById("name").innerHTML;
var name_arr = [];
try{
    var obj = JSON.parse(name_json);
    for(var i=0; i<obj.length; i++){
        name_arr.push(obj[i])
    }
}catch(e){alert(e)}


var amount_json = document.getElementById("amount").innerHTML;
var amount_arr = [];
try{
    var obj = JSON.parse(amount_json);
    for(var i=0; i<obj.length; i++){
        amount_arr.push(Number(obj[i]));
    }
}catch(e){alert(e)}


var exp_amount_json = document.getElementById("exp_amount").innerHTML;
var exp_amount_arr = [];
try{
    var obj = JSON.parse(exp_amount_json);
    for(var i=0; i<obj.length; i++){
        exp_amount_arr.push(Number(obj[i]));
    }
}catch(e){alert(e)}

// reverse all the arrays here
name_arr.reverse();
amount_arr.reverse();
exp_amount_arr.reverse();

var max1 = Math.max.apply(Math, amount_arr);
max1 = Number(max1);

var min1 = Math.min.apply(Math, amount_arr);
min1 = Number(min1);

var max2 = Math.max.apply(Math, exp_amount_arr);
max2 = Number(max2);

var min2 = Math.min.apply(Math, exp_amount_arr);
min2 = Number(min2);

max = Math.max(max1, max2);
min = Math.min(min1, min2);

var stepSize = Number(max/10);

    (function($) {
    "use strict"
let draw = Chart.controllers.line.__super__.draw; //draw shadow

//dual line chart
if(jQuery('#lineChart_3').length > 0 ){
    const lineChart_3 = document.getElementById("lineChart_3").getContext('2d');
    //generate gradient
    const lineChart_3gradientStroke1 = lineChart_3.createLinearGradient(500, 0, 100, 0);
    lineChart_3gradientStroke1.addColorStop(0, "rgba(254, 0, 0, 1)");
    lineChart_3gradientStroke1.addColorStop(1, "rgba(254, 0, 0, 1)");

    const lineChart_3gradientStroke2 = lineChart_3.createLinearGradient(500, 0, 100, 0);
    lineChart_3gradientStroke2.addColorStop(0, "rgba(58, 122, 254, 1)");
    lineChart_3gradientStroke2.addColorStop(1, "rgba(58, 122, 254, 0.5)");

    Chart.controllers.line = Chart.controllers.line.extend({
        draw: function () {
            draw.apply(this, arguments);
            let nk = this.chart.chart.ctx;
            let _stroke = nk.stroke;
            nk.stroke = function () {
                nk.save();
                nk.shadowColor = 'rgba(0, 0, 0, 0)';
                nk.shadowBlur = 10;
                nk.shadowOffsetX = 0;
                nk.shadowOffsetY = 10;
                _stroke.apply(this, arguments)
                nk.restore();
            }
        }
    });
        
    lineChart_3.height = 100;

    new Chart(lineChart_3, {
        type: 'line',
        data: {
            defaultFontFamily: 'Poppins',
            labels: name_arr,
            datasets: [
                {
                    label: "My Budget",
                    data: amount_arr,
                    borderColor: lineChart_3gradientStroke1,
                    borderWidth: "2",
                    backgroundColor: 'transparent', 
                    pointBackgroundColor: 'rgba(255, 0, 0, 1)'
                }, {
                    label: "My Expenses",
                    data: exp_amount_arr,
                    borderColor: lineChart_3gradientStroke2,
                    borderWidth: "2",
                    backgroundColor: 'transparent', 
                    pointBackgroundColor: 'rgba(58, 122, 254, 1)'
                }
            ]
        },
        options: {
            legend: false, 
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true, 
                        max: max, 
                        min: 0, 
                        stepSize: stepSize, 
                        padding: 10
                    }
                }],
                xAxes: [{ 
                    ticks: {
                        padding: 5
                    }
                }]
            }
        }
    });
    

}

})(jQuery);
</script>
</body>

</html>