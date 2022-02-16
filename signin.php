<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Budget Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="lodgy/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="lodgy/assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="lodgy/assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="motaAdmin/images/logo.png" type="image/x-icon" >
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="lodgy/assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="lodgy/assets/css/skins/default.css">

    <link rel="stylesheet" href="notification/jquery-toast-plugin/dist/jquery.toast.min.css">
    <!-- Color of the notification -->
    <link rel="stylesheet" href="notification/notification.css">

</head>
<body id="top">
<div class="page_loader"></div>
<!-- Login 3 start -->
<div class="login-3 tab-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-pad-0 form-section">
                <div class="login-inner-form">
                    <div class="details">
                        <a href="#">
                            <img src="motaAdmin/images/logo.png" style="width: 120px; height: 120px">
                        </a>
                        <h3>Sign into your account</h3>
                        <div>
                            <div class="form-group">
                                <input type="email" name="email" class="input-text" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="input-text" placeholder="Password">
                            </div>
                            <div class="checkbox clearfix">
                                <!--<div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>-->
                             </div>
                            <div class="form-group">
                                <button onclick="butSignIn()" class="btn-md btn-theme btn-block">Login</button>
                            </div>
                            <p class="none-2">Don't have an account?<a href="reg.php"> Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-pad-0 bg-img none-992">
                <div class="informeson">
                    <div class="btn-section">
                        <a href="signin.php" class="active link-btn">Login</a>
                        <a href="reg.php" class="link-btn">Register</a>
                    </div>
                    <h3>Know It, Budget It</h3>
                    <p>Take control of your spending</p>
                    <div class="social-box">
                        <ul class="social-list clearfix">
                            <li><a href="#" class="facebook-color"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter-color"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="google-color"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="linkedin-color"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 3 end -->

<!-- External JS libraries -->
<script src="lodgy/assets/js/jquery-2.2.0.min.js"></script>
<script src="lodgy/assets/js/popper.min.js"></script>
<script src="lodgy/assets/js/bootstrap.min.js"></script>
<!-- Custom JS Script -->
<script src="notification/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<script type="text/javascript">
function butSignIn(){

var email = document.getElementsByName("email")[0].value;
var password = document.getElementsByName("password")[0].value;


var data = new FormData();
var ajax = new XMLHttpRequest();

data.append("email", email);
data.append("password", password);
ajax.open("post", "signinAI.php", true);
ajax.send(data);

ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
      var result = ajax.responseText;
      if(result){
        window.location.href = "index.php";
      }else{
        speakError("Wrong email or password. Please check your spellings and correct. Remember email or password is case-sensitive");
      }
    }
  }
     
}
function speakSuccess(message){

    $.toast({
      heading: 'successful',
      text: message,
      showHideTransition: 'slide',
      icon: 'success',
      loaderBg: '#f96868',
      position: {
        right: 70,
        top: 10
      }
    });
}

function speakError(message){

    $.toast({
      heading: 'error!',
      text: message,
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#f96868',
      position: {
        right: 70,
        top: 10
      }
    });
}


function speakInfo(message){

    $.toast({
      heading: 'processing',
      text: message,
      showHideTransition: 'slide',
      icon: 'info',
      loaderBg: '#f96868',
      position: {
        right: 70,
        top: 10
      }
    });
}
</script>
</body>
</html>