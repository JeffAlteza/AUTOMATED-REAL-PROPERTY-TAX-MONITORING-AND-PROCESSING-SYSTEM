 <?php

    session_start();
    include 'connection.php';
    $tdNumber = '';
    $ownerName = '';
    $selectBarangay = '';
    $classification = '';

    if (isset($_POST['tdNumber']) && isset($_POST['ownerName']) && isset($_POST['selectBarangay']) && isset($_POST['classification'])) {
        $tdNumber = $_POST['tdNumber'];
        $ownerName = $_POST['ownerName'];
        $selectBarangay = $_POST['selectBarangay'];
        $classification = $_POST['classification'];

        $_SESSION['tdNumber'] = $tdNumber;
        $_SESSION['barangay'] = $selectBarangay;
        $_SESSION['ownerName'] = $ownerName;
        $_SESSION['classification'] = $classification;
    } 
    
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8" />
     <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
     <link rel="icon" type="image/png" href="../assets/img/favicon.png">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     <title>
         Tax Due
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
 <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="../homepage\public\index.html"><img class="" style="width: 30px; height: 30px;" src="../assets/img/favicon.png"/>&nbsp; Agoncillo RPT</a>
          </div>
         
         
        </div>
      </nav>
     <div class="wrapper d-flex justify-content-center" style="padding-top: 150px;">

         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-1"></div>
                 <div class="col-lg-4 ">
                     <div class="card">
                         <div class="card-header card-header-success">
                             <h4 class="card-title" style="font-weight: 600;">Property Details</h4>
                             <p class="card-category">Complete your property details.</p>
                         </div>
                         <div class="card-body mt-2">
                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                 <div class="row">

                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label class="bmd-label-floating">TD/ARP No.</label>
                                             <input type="text" name="tdNumber" value="<?php echo $tdNumber ?>" class="form-control" required>
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label class="bmd-label-floating">Owner Name</label>
                                             <input type="text" name="ownerName" value="<?php echo $ownerName ?>" class="form-control" required>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label class="bmd-label-floating">Classification</label>
                                             <input type="text" name="classification" value="<?php echo $classification ?>"class="form-control" required>
                                         </div>
                                     </div>


                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <select class="custom-select d-flex align-items-center justify-content-center"  id="selectBarangay" style="font-family: Roboto; height: 38px;" name="selectBarangay" required="">
                                                 <option selected value="" disabled>Select Barangay</option>
                                                 <!--<option value="adia">           Adia            </option>
            <option value="bagong Sikat">   Bagong Sikat    </option>
            <option value="balangon">       Balangon        </option>-->
                                                 <option value="bangin"> Bangin </option>
                                                 <option value="banyaga"> Banyaga </option>
                                                 <!--<option value="barigon">        Barigon         </option>-->
                                                 <option value="bilibinwang"> Bilinbiwang </option>
                                                 <option value="coral_na_munti"> Coral na Munti </option>
                                                 <!--<option value="guitna">         Guitna          </option>
            <option value="mabini">         Mabini          </option>-->
                                                 <option value="pamiga"> Pamiga </option>
                                                 <!--<option value="panhulan">       Panhulan        </option>-->
                                                 <option value="pansipit"> Pansipit </option>
                                                 <option value="poblacion"> Poblacion </option>
                                                 <option value="pook"> Pook </option>
                                                 <option value="san_jacinto"> San Jacinto </option>
                                                 <!--<option value="san_teodoro">    San Teodoro     </option>
            <option value="santa_cruz">     Santa Cruz      </option>
            <option value="santo_tomas">    Santo Tomas     </option>-->
                                                 <option value="subic_ibaba"> Subic Ibaba </option>
                                                 <option value="subic_ilaya"> Subic Ilaya </option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>

                                 <button type="submit" onclick="requireFunc()" name="checkBtn" class="btn btn-success pull-right">Check</button>
                                 <div class="clearfix"></div>
                             </form>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-6 ">
                     <div class="card">
                         <div class="card-header card-header-success">
                             <h4 class="card-title" style="font-weight: 600;">Payment History</h4>
                             <p class="card-category">Check your payment history here.</p>
                         </div>
                         <div class="card-body table-responsive mt-2">
                             <div class="container-fluid" style="overflow: auto; height: 500px;">
                                 <table class="table px-0 mx-0" width="100%" style="overflow: auto; ">
                                     <thead>
                                         <th>
                                             <tr>
                                                 <td style="font-weight: 600;">Name of Collector</td>
                                                 <td style="font-weight: 600;">Amount Paid</td>
                                                 <td style="font-weight: 600;">Date Covered</td>
                                                 <td style="font-weight: 600;">Date of Payment</td>
                                             </tr>
                                         </th>
                                     </thead>
                                     <tbody>
                                         <?php


                                            if (isset($_POST['checkBtn'])) {
                                                require 'connection.php';
                                                if (!$con) {
                                                    die("Connection failed: " . mysqli_connect_error());
                                                }

                                                $ownerName = $_POST['ownerName'];
                                                $classification = $_POST['classification'];
                                                $tdNumber = $_POST['tdNumber'];
                                                $barangay = $_POST['selectBarangay'];


                                                $sql = "SELECT * from $barangay where TD_ARP = '" . $tdNumber . "' AND NAME like '%" . $ownerName . "%' AND CLASSIFICATION = '" . $classification . "'";
                                                $result = mysqli_query($con, $sql);

                                                if ($result->num_rows > 0) {

                                                    $sql1 = ("SELECT * FROM payment_history WHERE TD_ARP = '" . $tdNumber . "' ORDER BY LAST_PAYMENT DESC");
                                                    $result1 = mysqli_query($con, $sql1);
                                                    if ($result1->num_rows > 0) {
                                                        while ($row1 = $result1->fetch_assoc()) {
                                                            echo '<tr>';
                                                            echo '<td>' . $row1['USERS_NAME'] . '</td>';
                                                            echo '<td> ₱' . number_format($row1['TOTAL_PAYMENT'], 2) . '</td>';
                                                            if ($row1['LAST_PAYMENT'] == 0) {
                                                                echo '<td>' . $row1['PAYMENT_YEAR'] . '</td>';
                                                            } else if ($row1['PAYMENT_YEAR'] == 0) {
                                                                echo '<td>' . $row1['LAST_PAYMENT'] . '</td>';
                                                            } else {
                                                                echo '<td>' . $row1['PAYMENT_YEAR'] . " - " . $row1['LAST_PAYMENT'] .  '</td>';
                                                            }

                                                            echo '<td>' . $row1['DATE'] . '</td>';
                                                            echo '</tr>';
                                                        }
                                                        echo '</table>';
                                                    } else {
                                                        echo '<div class="modal fade" id="failedSearch" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">No transaction history</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
                                                                        <h5>
                                                                            <center>No transaction history found. Please go to the the office of the treasurer to verify your records.</center>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                    }
                                                } else {
                                                    echo '
     <div class="modal fade" id="failedSearch" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Fail</h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
                     <h5>
                         <center>Your property was not found in the system.</center>
                     </h5>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>';
                                                }
                                            }



                                            ?>
                                     </tbody>
                                 </table>
                             </div>
                             <a type="button" name="checkLiabs"  href="userLiabilities.php" class="btn btn-success pull-right">Check Liabilities</a>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-1"></div>

                 
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