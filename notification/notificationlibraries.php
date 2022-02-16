
	<!--===============================================================================================-->
    <link rel="stylesheet" href="jquery-toast-plugin/dist/jquery.toast.min.css">
    <!-- Color of the notification -->
    <link rel="stylesheet" href="notification.css">
 
<!--<script src="vendor/jquery-3.3.1.min.js"></script>-->
<script src="jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<script type="text/javascript">
	function speakWarning(message){

    $.toast({
      heading: 'warning!',
      text: message,
      showHideTransition: 'slide',
      icon: 'warning',
      loaderBg: '#f96868',
      position: {
        right: 70,
        top: 10
      }
    });
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