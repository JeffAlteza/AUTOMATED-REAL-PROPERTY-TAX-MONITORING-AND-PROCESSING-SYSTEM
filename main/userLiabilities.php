 <?php

    session_start();
    include 'connection.php';
    $tdNumber = $_SESSION['tdNumber'];
    $ownerName = $_SESSION['ownerName'];
    $barangay = $_SESSION['barangay'];
    $classification = $_SESSION['classification'];

    echo $_SESSION['tdNumber'];
    echo $tdNumber;
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8" />
     <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
     <link rel="icon" type="image/png" href="../assets/img/favicon.png">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     <title>
         Material Dashboard by Creative Tim
     </title>
     <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
     <!--     Fonts and icons     -->
     <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
     <!-- CSS Files -->
     <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
     <link href="../assets/css/material-dashboard2.css" rel="stylesheet" />
     <link href="../css/animate.css" rel="stylesheet" />
     <link href="../css/accordion.css" rel="stylesheet" />
     <!-- CSS Just for demo purpose, don't include it in your project -->
     <link href="../assets/demo/demo.css" rel="stylesheet" />



 </head>

 <body class="">
     <div class="wrapper d-flex justify-content-center" style="padding-top: 150px;">

         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-3"></div>
              
                 <div class="col-lg-6 ">
                     <div class="card">
                         <div class="card-header card-header-success">
                             <h4 class="card-title" style="font-weight: 600;">Liabilities</h4>
                             <p class="card-category">Check your liabilities here.</p>
                         </div>
                         <div class="card-body mt-2">
                             <?php

                                

    require 'connection.php';
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
   
                                $sql4 = "SELECT * from $barangay where TD_ARP = '" . $tdNumber . "' AND NAME like '%" . $ownerName . "%' AND CLASSIFICATION = '" . $classification . "'";
                                $result4 = mysqli_query($con, $sql4);

                                if ($result4->num_rows > 0) {
                                    while ($row4 = $result4->fetch_assoc()) {
                                        $assessedValue = $row4['AV_2021'];
                                   
                                    }
                                $currentYears = date('Y');
                                $sql3 = ("SELECT * FROM payment_history WHERE TD_ARP = '" . $tdNumber . "' ORDER BY LAST_PAYMENT DESC limit 1");
                                $result3 = mysqli_query($con, $sql3);
                                    
                                

                                if ($result3->num_rows > 0) {
                                    if ($row3 = $result3->fetch_assoc()) {
                                        $tdNo = $row3['TD_ARP'];
                                        $latestPayment = $row3['LAST_PAYMENT'];

                                        $yearDifference = $currentYears - $latestPayment;
                                        //echo $yearDifference;
                                        $_SESSION['latest_payment'] = $latestPayment + 1;
                                    }

                                    if ($latestPayment != $currentYears) {
                                        echo '<form method="POST" action="" ">
                                        <input type="hidden" name="assessedValue" value="'.$assessedValue.'">
                                        <input type="hidden" name="tdNumber" value="'.$tdNo.'">
          <div style="background-color:#f8d7da;font-weight: 400; font-size: 12px; padding: 10px 10px 8px 10px" class="alert alert-sm d-flex align-items-center" role="alert">
          <div class="container-fluid row px-0 mx-0">
          <div class="col-lg-8 col-md-6 col-sm-12">
            <p class="d-flex align-items-center my-2" style="padding: 0px; margin: 0px;">Liabilities:  ';
                                        $latestPayment1 = $latestPayment + 1;
                                        for ($k = $latestPayment + 1; $k <= $currentYears; $k++) {
                                            echo $k;
                                            echo ", ";
                                        }
                                        echo '
                
                You can select year range you want to pay. </p></div>';
                                        echo '
                <div class="col-lg-2 col-sm-12 my-1 mx-0 d-flex align-items-center">
                <select class="custom-select" style="height: 30px;" name="latestPaymentselect"  id="latestPaymentselect">
                
                <option selected>' . $latestPayment1 . '</option>';

                                        
                                        echo '</select> </div>';

                                        echo '
                <div class="col-lg-2  col-sm-12 mx-0 d-flex align-items-center">
                <select class="custom-select" style="height: 30px;" name="rangePaymentselect" id="rangePaymentselect">
                <option selected value="0">Year</option>';
                                        for ($j = $latestPayment + 2; $j <= $currentYears; $j++) {
                                            echo '
                    <option value="' . $j . '">' . $j . '</option>';
                                        }
                                        echo '</select> </div>';

                                        echo ' 
</div>
                </div>
               
                ';
                                    } else { 
                                       echo '<div style="background-color:#f8d7da;font-weight: 400; font-size: 12px; padding: 10px 10px 8px 10px" class="alert alert-sm d-flex align-items-center" role="alert">
                                       <div class="container-fluid row px-0 mx-0">
                                       <p class="d-flex align-items-center my-2" style="padding: 0px; margin: 0px;">No Liabilities Found.</p>
                                       </div>
                                       
                                       </div>';
                                    }}
                                }
                                ?>
                                <button type="submit" onclick="" name="compute" class="btn btn-success pull-right">Compute</button>
                                <?php 
                                if (isset($_POST['compute'])) {
                                    require 'computeForUser.php';
                                    echo' <p style="font-size: 20px; font-weight:  800;">Your tax due for the year '; 
                                    if($selRange == 0){
                                    echo $selYear;
                                      } else if($selRange != 0 && $selYear != 0)  {
                                       echo $selYear .'-'. $selRange;
                                      }
                                      echo ': ₱';
                                      echo number_format($totalAll,2); echo'</p>';
                                }
                               
                                ?>

                               


                            </form>
                         </div>
                     </div>

                 </div>
                 <div class="col-md-3"></div>
             </div>
         </div>
     </div>
                           







     <script src="../js\checks.js"></script>
     <script src="../js\md5.js"></script>
     <script src="../js\md5.min.js"></script>
     <!--   Core JS Files   -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
     <script src="../assets/js/core/jquery.min.js"></script>
     <script src="../assets/js/core/popper.min.js"></script>
     <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
     <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
     <!-- Plugin for the momentJs  -->
     <script src="../assets/js/plugins/moment.min.js"></script>
     <!--  Plugin for Sweet Alert -->
     <script src="../assets/js/plugins/sweetalert2.js"></script>
     <!-- Forms Validations Plugin -->
     <script src="../assets/js/plugins/jquery.validate.min.js"></script>
     <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
     <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
     <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
     <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
     <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
     <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
     <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
     <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
     <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
     <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
     <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
     <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
     <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
     <script src="../assets/js/plugins/fullcalendar.min.js"></script>
     <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
     <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
     <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
     <script src="../assets/js/plugins/nouislider.min.js"></script>
     <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
     <!-- Library for adding dinamically elements -->
     <script src="../assets/js/plugins/arrive.min.js"></script>
     <!--  Google Maps Plugin    -->
     <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
     <!-- Chartist JS -->
     <script src="../assets/js/plugins/chartist.min.js"></script>
     <!--  Notifications Plugin    -->
     <script src="../assets/js/plugins/bootstrap-notify.js"></script>
     <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
     <script src="../assets/js/material-dashboard.js" type="text/javascript"></script>
     <!-- Material Dashboard DEMO methods, don't include it in your project! -->
     <script src="../assets/demo/demo.js"></script>

     </script>
     <script>
         $('#selectBarangay').change(function() {
  localStorage.setItem('todoData', this.value); //$(this).val()
});
if (localStorage.getItem('todoData')) {
  $('#selectBarangay').val(localStorage.getItem('todoData')).trigger('change');
}

         $(document).ready(function() {
             $('#failedSearch').modal('show');
         });
         const queryString = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         if (urlParams.get('search') === 'failed') {
             $(document).ready(function() {

                 $('#failedSearch').modal('show');

             });
         }
     </script>
<script>


/*
                function sel(){
    var yr = $('#latestPaymentselect').val();
    var rg = $('#rangePaymentselect').val();
}*/
</script>
 </body>

 </html>