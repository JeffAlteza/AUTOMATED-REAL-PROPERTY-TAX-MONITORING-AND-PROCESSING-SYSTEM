<?php
date_default_timezone_set('Asia/Manila');
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
require 'connection.php';


?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Tax Collection
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
<link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
  <link href="../css/animate.css" rel="stylesheet"/>
  <link href="../css/accordion.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  

  <style>
  .dataTables_filter {
display: none;
}
.dataTables_length label { display:none;}
.dataTables_paginate  { display:none;}

</style>
</head>

<body class="">
<div class="wrapper ">
<div class="sidebar" data-color="green" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo"><a href="dashboard.php" class="simple-text logo-normal">
    <img src="../assets/img/favicon.png" alt="logo" style="height: 30px; width: 30px;">&nbsp;
     Real Property Tax
        </a>
      </div>
        <div class="sidebar-wrapper">
        <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="records.php">
              <i class="material-icons">folder_open</i>
              <p>Records</p>
            </a>
          </li>
<div class="accordion" id="taxCollectionAccordion"  style="margin-bottom: -1px; margin: 10px 15px 0;">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      <i class="material-icons">note</i>Tax Collection
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#taxCollectionAccordion">
      <div class="accordion-body px-0">
      <li class="nav-item">
            <a class="nav-link" href="myCollection.php">
              
              <p>Daily Collection</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="taxCollection.php">
              
              <p>All Collection</p>
            </a>
          </li>
      </div>
    </div>
  </div>
</div> 
        
          <li class="nav-item">
            <a class="nav-link" href="payment.php">
              <i class="material-icons">payment</i>
              <p>Payment</p>
            </a>
          </li>
          <?php if($_SESSION['role'] == 'Admin'){ ?>
          <li class="nav-item">
            <a class="nav-link" href="utilities.php">
              <i class="material-icons">build</i>
              <p>Utilities</p>
            </a>
          </li>
          <?php }else{
}
?>
   <?php if($_SESSION['role'] == 'Admin'){ ?>
          <li class="nav-item">
            <a class="nav-link" href="accounts.php">
              <i class="material-icons">manage_accounts</i>
              <p>Manage Accounts</p>
            </a>
          </li>
          <?php }else{
}
?>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">All Collection</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" onclick="change_Pass();" href="#">Change Password</a>
                  <a class="dropdown-item"  href="logout.php">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                <div class="row">
                  <div class="col-md-4 col-lg-2">
                <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#filterDate" class="btn btn-white d-flex align-items-center justify-content-center" style="color: #6c757d;"><i class="material-icons mr-1">event</i>Filter Date</a>
                </div>

</div>
</div>
<div class="card-body"> 
                  <div style="width: 100%; ">
                  <div class="table-responsive">
                 
                  <table id="reportTable" class="table table-sm display no-wrap table-responsive"  style="font-size: 12px; max-width: 2000px">
                <thead>
                  <th width="150px">RECEIPT NO.</th>
                  <th width="450px">NAME</th>
                  <th width="350px">LOCATION</th>
                  <th width="150px">TD NO.</th>
                  <th width="100px">CLASSIFICATION</th>
                  <th width="250px">ASSESSED VALUE</th>
                  <th width="250px">PERIOD COVERED</th>
                  <th width="100px">BASIC</th>
                  <th width="100px">SEF</th>
                  <th width="100px">SUBTOTAL</th>
                  <th width="100px">DISCOUNT</th>
                  <th width="100px">PENALTY</th>
                  <th width="200px">GRAND TOTAL</th>
                  <th width="200px">DATE PAID</th>
                  <th width="200px">PAYOR</th>
                  <th width="200px">COLLECTOR</th>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
                  </div>
                  </div>
                </div>

</div>
</div>
</div>
</div>

 
      </div>



      <footer class="footer">
      <div class="container-fluid">
                <nav class="float-right">
                    <ul>
                        <li>
                        <span>Date:</span>
<span>
<?php 
$CurrentDate = date('F d, Y'); 
echo $CurrentDate;?>
</span>
<span> |  Time:</span>
<span id="time"></span>

<script>
function setTime() {
var d = new Date(),
  el = document.getElementById("time");

  el.innerHTML = formatAMPM(d);

setTimeout(setTime, 1000);
}

function formatAMPM(date) {
  var hours = date.getHours(),
    minutes = date.getMinutes(),
    seconds = date.getSeconds(),
    ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
  return strTime;
}

setTime();
</script>
</li>
</ul>
<ul>
<li>
&copy;
<script>
document.write(new Date().getFullYear());
</script>, Municipality of Agoncillo Batangas
</li>
</ul>
                </nav>
                <!-- your footer here -->
            </div>
      </footer>
    </div>
  </div>



  <div class="modal fade" id="filterDate" tabindex="-1" aria-labelledby="filterDate" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="filterDate">Date Filter</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
   
      <form>
        <div class="row">
        <div class="col-md-6">
          <label for="selectDate1" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">From</label>
          
            <input type="date" class="form-control" id="selectDate1" name="selectDate1" value="" >
        
        </div>
        <div class="col-md-6 mb-3">
          <label for="selectDate2" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">To</label>
         
            <input type="date" class="form-control" id="selectDate2" name="selectDate2" value="">
      
        </div>

        <div class="col-md-12 mb-0 py-0">
        <div style="background-color:#d2f4ea; height: 45px; font-weight: 400; font-size: 12px;"class="alert alert-dark alert-sm d-flex align-items-center" role="alert">
        Input one date only if you want to filter a specific date.
      </div>
</div>
        </div>
  
       
        
    </div>

    <div class="modal-footer">
      <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-success"  id="getSelect" onclick="getselectedDate();" >Submit</button>

      </form>     
    </div>
  </div>
</div>
</div>
    <div class="modal fade" id="failedUpdate" tabindex="-1" aria-hidden="true">
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
              <center>Incorrect Password.</center>
              </h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="successUpdate" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Success</h5>
            <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
              <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
              <span class="swal2-success-line-tip"></span>
              <span class="swal2-success-line-long"></span>
              <div class="swal2-success-ring"></div>
              <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
              <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
            </div>
            <h5>
              <center>Record updated successfully!</center>
              </h5>
          </div>
          <div class="modal-footer">
            <button type="button" id="update_success" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  

    <!--CHANGE PASS-->
    <div class="modal fade" id="successUpdatePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Success</h5>
            
          </div>
          <div class="modal-body">
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
              <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
              <span class="swal2-success-line-tip"></span>
              <span class="swal2-success-line-long"></span>
              <div class="swal2-success-ring"></div>
              <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
              <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
            </div>
            <h5>
              <center>Password updated successfully. Please relogin!</center>
              </h5>
          </div>
          <div class="modal-footer">
            <form method="post"  id="successLogout" name="successLogout" action="logout.php">
            <button type="submit" id="update_success" name="update_success" class="btn btn-success">Okay</button>
        </form>
          </div>
        </div>
      </div>
    </div>


  <div class="modal fade" id="changepassmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
    <div class="modal-body">
   
      <form>
        <div class="row">
          <input type="hidden" id="passFIELD" value = "<?php echo $_SESSION['password'];?>"> 
        <div class="col-md-12">
          <label for="oldPass" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">Old Password:</label>
          
            <input type="password" class="form-control" id="oldPass" name="oldPass" >
        
        </div>
        <div class="col-md-12">
          <label for="newPass" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">New Password:</label>
         
            <input type="password" class="form-control" onkeyup="password_validation();" id="newPass" name="newPass">
      
        </div>
        <div class="col-md-12">
          <label for="confPass" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">Confirm Password:</label>
         
            <input type="password" class="form-control" onkeyup="password_validation();" id="confPass" name="confPass">
    
        </div>
        <span style="font-family: Roboto; font-size: 13px; font-weight: normal; margin-bottom: 0px" id="message5">!Note: Password must contain 1 Uppercase letter</span>
        <span style="font-family: Roboto; font-size: 13px; font-weight: normal; margin-bottom: 0px" id="message6"></span>
        </div>
        <label style="font-weight: normal; font-size: 13px; margin-bottom: 0px; color: green;" class="form-label"></label>
    </div>

    <div class="modal-footer">
      
      <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-success" id="changeP_button" >Submit</button>

      </form>     
    </div>
  </div>
</div>
</div>
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple" data-color="purple"></span>
              <span class="badge filter badge-azure" data-color="azure"></span>
              <span class="badge filter badge-green active" data-color="green"></span>
              <span class="badge filter badge-warning" data-color="orange"></span>
              <span class="badge filter badge-danger" data-color="danger"></span>
              <span class="badge filter badge-rose" data-color="rose"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Images</li>
        <li class="active">
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="../assets/img/sidebar-1.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="../assets/img/sidebar-2.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="../assets/img/sidebar-3.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="../assets/img/sidebar-4.jpg" alt="">
          </a>
        </li>
       
      
      </ul>
    </div>
  </div>




  <script src="../js\checks.js"></script>
  <script src="../js\md5.js"></script>
  <script src="../js\md5.min.js"></script>
    <!--   Core JS Files   -->
  
  
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
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
  
<script>
 function getselectedDate() {

var select1 = document.getElementById('selectDate1').value;
var select2 = document.getElementById('selectDate2').value;

//alert(select1);
$.ajax({
    url: "dateFilter.php",
    type: "post",
    async: true,
    data: {
      selectDate1: select1,
      selectDate2: select2
    },
    success: function(data){
      $('#filterDate').modal('hide');
      fetch_report();
    },
    fail: function(data) {

    },
  }

);


}



/*$(document).ready(function() {
     fetch_report();
      
    });*/
function fetch_report() {
  $('#reportTable').DataTable({
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData[0]);
      },
      'destroy': 'true',
      'serverSide':'true',
      'searching' :'false',
      'paging' : 'true',
      'lengthChange':'false',
      'scrollX': 'true',
      'scrollY': 500,
      'processing':'true',
     
        
      'order':[],
      'ajax': {
        'url':'fetch_report.php',
        'type':'post',

      },
      
      dom: 'lBfrtip',
     buttons: [
    'excel', 'csv'
   ],
      'aLengthMenu': [
        [25, 50,  -1],
        [25, 50,  "All"]
    ],
    'iDisplayLength': -1,
      
   
      
      "columnDefs": [{'targets':[0 , 1, 2, 3, 4, 5, 6 , 7 , 8 , 9 , 10 , 11, 12, 13, 14  ], 'orderable' :false,}

    ],
    });
    };


function password_validation() {
	if (document.getElementById("newPass").value == "" && document.getElementById("confPass").value == "") {
	   document.getElementById("message5").innerHTML = "";
	   document.getElementById("changeP_button").disabled = false;
	} else {
	   if (document.getElementById("newPass").value == document.getElementById("confPass").value) {
		  document.getElementById("message5").innerHTML = "Password Match";
		  document.getElementById('message5').style.color = "green";
		  
		  var passinputs = document.getElementById("newPass").value;
		  var passinputs1 = document.getElementById("confPass").value;
		  if(passinputs.length < 6  && passinputs1.length < 6)
			{  	
			  document.getElementById("changeP_button").disabled = true;
			  document.getElementById("message6").innerHTML = "Password must be 6 characters minimum";
			  document.getElementById('message6').style.color = "red";
			}
			else if(passinputs.search(/[A-Z]/) < 0 && passinputs1.search(/[A-Z]/) < 0){
			  document.getElementById("changeP_button").disabled = true;
			  document.getElementById("message6").innerHTML = "Password must have atleast one Upper case letter";
			  document.getElementById('message6').style.color = "red";

			}
			else if(passinputs.search(/[a-z]/) < 0 && passinputs1.search(/[a-z]/) < 0){
			  document.getElementById("changeP_button").disabled = true;
			  document.getElementById("message6").innerHTML = "Password must have atleast one Lower case letter";
			  document.getElementById('message6').style.color = "red";

			}
			else{
			  document.getElementById("changeP_button").disabled = false;
			  document.getElementById("message6").innerHTML = "";
			}
	   } else {
		  document.getElementById("message5").innerHTML = "Password do not match";
		  document.getElementById('message5').style.color = "red";
		  document.getElementById("changeP_button").disabled = true;



	   }
	}
 }

 $(document).on('click', '#changeP_button', function (e) {
	e.preventDefault();
	var globalPass = $('#passFIELD').val();
	var olds = $('#oldPass').val();
	var news = $('#newPass').val();
	var confs = $('#confPass').val();


	if (olds != '' && news != '' && confs != '') {
		if (md5(olds) == globalPass) {
			if (news == confs) {
				$.ajax({
					url: "change_password.php",
					type: "post",
					data: {
						oldPass: olds,
						newPass: news,
						confPass: confs
					},

					success: function (data) {

						$('#successUpdatePassword').modal('show');
						$('#changepassmodal').modal('hide');
					},
					fail: function (data) {

					}


				});
			} else {
				alert('Password do not match.');
			}
		} else {
			$('#failedUpdate').modal('show');
			$('#changepassmodal').modal('hide');
		}
	} else {
		alert('Fill all the required fields');
	}



});
</script>
</body>

</html>