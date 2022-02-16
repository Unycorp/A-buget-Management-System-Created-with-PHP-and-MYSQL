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
                        <h3>Register a new account</h3>
                        <div>
                            <div class="form-group">
                                <input type="text" id="name" class="input-text" placeholder="Full name">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" class="input-text" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" class="input-text" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" id="confirmpassword" class="input-text" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <input type="text" id="occupation" class="input-text" placeholder="Occupation">
                            </div>
                            <div class="form-group">
                              <h6 class="text-muted">Upload a profile image</h6>
                              <input type="file" id="file">
                            </div>
                            <div class="form-group">
                                <button onclick="butRegister()" class="btn-md btn-theme btn-block">Register</button>
                            </div>
                            <p class="none-2">Already have an account?<a href="signin.php"> login here</a></p>
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
    function butRegister(){
        // input name
        var name = document.getElementById("name").value;
        // input email
        var email = document.getElementById("email").value;
        // input password
        var password = document.getElementById("password").value;
        // input confirm password
        var confirmpassword = document.getElementById("confirmpassword").value;
        // input occupation
        var occupation = document.getElementById("occupation").value;
        // uploading of file
        var file = document.getElementById("file").files[0];
        if(file==undefined){
          file = new File([""], "filename");
        }
        // invalid name
        else if(!/^[A-Za-z.,' ]+$/.test(name)){
            speakError("Name should contain characters only");
        }
        // email validation
        else if(email.indexOf("@") < 1 || email.lastIndexOf(".") < email.indexOf("@") + 2 || email.lastIndexOf(".")+ 2 > email.length){
            speakError("Invalid Email");
        }
        // password should contain only alphabet, number and space
        else if(!/^[A-Za-z0-9 ]+$/.test(password)){
            speakError("Password cannot contain any special characters");
        }
        else if(password.length < 8){
            speakError("Password should be atleast 8 in characters")
        }
        // confirm password should contain only alphabet, number and space
        else if(!/^[A-Za-z0-9 ]+$/.test(confirmpassword)){
            speakError("Confirm password cannot contain any special characters");
        }
        // password should be equal to conform password before you can continue
        else if(password !== confirmpassword){
            speakError("Pasword is not the same as confirm password");
        }
        else if(!/^[A-Za-z0-9.,' ]+$/.test(occupation)){
            speakError("Occupation contain some illegal characters");
        }
        //valiate file size of 5mb
        else if(file.size > 5 * 1024 * 1024){
            speakError("File is too large to upload. File size should be below 5mb");
        }else{
            var data = new FormData();
            var ajax = new XMLHttpRequest();
            data.append("file", file);
            data.append("name", name);
            data.append("email", email);
            data.append("password", password);
            data.append("occupation", occupation);

            ajax.open("post", "regAI.php", true);
            ajax.send(data);

            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var result = ajax.responseText;
                    if(result){
                        speakSuccess("Registratration was successfull. You will be redirect in the next 5 seconds");
                        setTimeout(function(){window.location.href="signin.php";},5000);
                    }else{
                        speakError("Failed to register");
                    }
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