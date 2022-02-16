<?php
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
					
					<div class="form-group">
                    <h2 class="card-inside-title"><b>Upload Image</b></h2>
                      <div class="alert alert-success" style="background: #deecfa; color: black">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="color: black">&times;</span>
                          </button>
                          <strong>Note:</strong> Expenses resulting to image should be uploaded here.
                      </div>
                      <div>
                        <img id="img-tag1">
                      </div>
                    <input type="file" id="file1">
                    <button class="btn btn-primary" onclick="butAddImage()">Upload</button>
                            
                  </div>
                        <div id="img_div">
                      
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

<?php include 'jslibraries.php'; ?>	
<script type="text/javascript">
var _user_id = "<?php echo $user_id ?>";
refresh();

function butDelete(id){
var data = new FormData();
var ajax = new XMLHttpRequest();
data.append("delete_id", id);
data.append("user_id", _user_id);

ajax.open("post", "budget_imageAI.php", true);
ajax.send(data);
ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
        if(result == true){
          speakSuccess("Deleted Successfully.");
          refresh();
        }
        else{
          refresh();
          speakError("An error occur please verify and try again if nothing happens");
            }

        }
    }
}

function butAddImage(){

var file1 = document.getElementById("file1").files[0];
  // mine type of the file
  var mime_type = ["image/jpeg", "image/png"];
        // validate mime
  if(mime_type.indexOf(file1.type)==-1){
    alert("Error: Incorrect file type");
  }
  //valiate file size of 2mb
  //else if(file.size > 2 * 1024 * 1024){
  //speakError("File is too large to upload. File size should be below 2mb");
  //}
  else{
var data = new FormData();
var ajax = new XMLHttpRequest();

data.append("user_id",_user_id);
data.append("photo1", file1);

ajax.open("post", "budget_imageAI.php", true);

ajax.upload.addEventListener("progress", function(event){
    var percent = parseInt((event.loaded / event.total)) * 100;
    console.log("percentage--------------"+percent);
});

ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
        var result = ajax.responseText;
        if(result == true){
          speakSuccess("image Added Successfully.");
        refresh();
        }
        else{
          refresh();
          speakError("An error occur please verify and try again");
        }

             }
        }

    ajax.send(data);

      }  
}

function refresh(){

var data = new FormData();
 var ajax = new XMLHttpRequest();

 data.append("refresh_id", "");
 data.append("user_id", _user_id);

 ajax.open("post", "budget_imageAI.php", true);
 ajax.send(data);

 ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            document.getElementById("img_div").innerHTML = result;
            //if(result){
            //  alert("Added Successfully");
            // }
            }
        }

}
              // To Preview Images
         var input1 = document.getElementById("file1");

         input1.addEventListener("change", myFunction);

         function myFunction(){
          var imageholder = document.getElementById("img-tag1");
          //user selected file
          var file = input1.files[0];
          var mime_type = ["image/jpeg", "image/png", "image/jpg"];
          // validate mime
          if(mime_type.indexOf(file.type)==-1){
            speakError("Warning: File type not supported but you can continue anyway");
            return;
          }
          //valiate file size of 3mb
          if(file.size > 1 * 1024 * 1024){
            speakError("Error: Exceededsize 1mb. This file may not upload but you can continue anyway");
            return;
          }
          var ft = file.type;

           imageholder.style.display = "inline-block";
          imageholder.style.width = "120px";
          imageholder.style.height = "120px";
          //imageholder.style.borderRadius = "50%";
          imageholder.style.border = "5px solid #ccc";
         
          var preview_url = URL.createObjectURL(file);

          imageholder.setAttribute("src", preview_url);
        }
</script>
</body>

</html>