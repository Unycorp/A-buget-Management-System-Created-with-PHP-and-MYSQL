  <script src="motaAdmin/vendor/global/global.min.js"></script>
	<script src="motaAdmin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="motaAdmin/vendor/chart.js/Chart.bundle.min.js"></script>
  <!--<script src="motaAdmin/js/custom.min.js"></script>-->
  <script src="motaAdmin/js/preloader.js"></script>
  <script src="motaAdmin/js/autoScreenWidth.js"></script>
  <script src="motaAdmin/js/deznav-init.js"></script>
	
	<script src="notification/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
  <script type="text/javascript">

(function($) {
    "use strict";

    $("#menu").metisMenu();
    
  // Chart All Pages
  
  //#dailySalesChart
  if(jQuery('#daily-sales-chart').length > 0 ){
    const dailySalesChart = document.getElementById("daily-sales-chart").getContext('2d');
    
    // dailySalesChart.height = 100;

    let barChartData = {
        defaultFontFamily: 'Poppins',
        labels: ['hjgh', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Expense',
            backgroundColor: '#3a7afe',
            hoverBackgroundColor: '#3a7afe', 
            data: [
                '20',
                '14',
                '18',
                '25',
                '27',
                '22',
                '12', 
                '24', 
                '20', 
                '14', 
                '18', 
                '16'
            ]
        }, {
            label: 'Earning',
            backgroundColor: '#dfe3ec',
            hoverBackgroundColor: '#dfe3ec', 
            data: [
                '12',
                '18',
                '14',
                '7',
                '5',
                '10',
                '20', 
                '8', 
                '12', 
                '18', 
                '14', 
                '16'
            ]
        }]

    };

    new Chart(dailySalesChart, {
        type: 'bar',
        data: barChartData,
        options: {
            legend: {
                display: false
            }, 
            title: {
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            maintainAspectRatio: false, 
            scales: {
                xAxes: [{
                    display: false, 
                    stacked: true,
                    barPercentage: 0.5, 
                    ticks: {
                        display: false
                    }, 
                    gridLines: {
                        display: false, 
                        drawBorder: false
                    }
                }],
                yAxes: [{
                    display: false, 
                    stacked: true, 
                    gridLines: {
                        display: false, 
                        drawBorder: false
                    }, 
                    ticks: {
                        display: false
                    }
                }]
            }
        }
    });
  }
  
  if(jQuery('#ShareProfit').length > 0 ){
    //doughut chart
    const ShareProfit = document.getElementById("ShareProfit").getContext('2d');
    // ShareProfit.height = 100;
    new Chart(ShareProfit, {
      type: 'doughnut',
      data: {
        defaultFontFamily: 'Poppins',
        datasets: [{
          data: [45, 25, 20],
          borderWidth: 3, 
          borderColor: "rgba(255, 243, 224, 1)",
          backgroundColor: [
            "rgba(58, 122, 254, 1)",
            "rgba(255, 159, 0, 1)",
            "rgba(41, 200, 112, 1)"
          ],
          hoverBackgroundColor: [
            "rgba(58, 122, 254, 0.9)",
            "rgba(255, 159, 0, .9)",
            "rgba(41, 200, 112, .9)"
          ]

        }],
        
      },
      options: {
        weight: 1,  
         cutoutPercentage: 65,
        responsive: true,
        maintainAspectRatio: false
      }
    });
  }
  
})(jQuery); 
  </script>
	<script type="text/javascript">
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