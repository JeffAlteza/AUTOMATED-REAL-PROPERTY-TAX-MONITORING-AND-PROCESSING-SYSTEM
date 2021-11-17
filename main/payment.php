<?php
date_default_timezone_set('Asia/Manila');
require 'connection.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    session_destroy();
    exit;
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
    Payment
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
  <link href="../css/animate.css" rel="stylesheet"/>
  <link href="../css/accordion.css" rel="stylesheet" />
  <link href="../css/navpayment.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
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
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      <i class="material-icons">note</i>Tax Collection
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#taxCollectionAccordion">
      <div class="accordion-body px-0">
      <li class="nav-item">
            <a class="nav-link" href="myCollection.php">
              
              <p>Daily Collection</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="taxCollection.php">
              
              <p>All Collection</p>
            </a>
          </li>
      </div>
    </div>
  </div>
</div>
        
          <li class="nav-item active">
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
            <a class="navbar-brand" href="javascript:;">Payment</a>
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
      <?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['ID_NO'] = $id;
    $_SESSION['TD_ARPS'] = $_GET['tdID'];
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $brgys = $_SESSION['barangay'];
    $sql = "SELECT * from $brgys WHERE ID=" . $id;
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //$SESSION['TD_ARPS'] = $row['TD_ARP'];

?>
        <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
            <div class="col-lg-8 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-success">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                                                    <!-- Credit card form tabs -->
                                                    <ul class="nav nav-pills bg-light  rounded nav-fill" id="pills-tab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="liabs" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab" aria-controls="pills-home" aria-selected="true">History</button>
                                                        </li>

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="transaction_details" data-bs-toggle="pill" data-bs-target="#details" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" disabled>Payment</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="receiptOfficial" data-bs-toggle="pill" data-bs-target="#receipt" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Receipt</button>
                                                        </li>
                                                    </ul>
                </div>
</div>
</div>

                <div class="card-body">
                <div class="tab-content">
                 <div id="history" class="tab-pane fade show active pt-3">
                 <form role="form" method="post" class="form-row" action="payment.php">

<div class="col-sm-6">
    <label for="taxDecNo" style="font-weight: normal; font-size: 13px; margin-bottom: 0px;" class="form-label form-label-sm">TD/ARP No.</label>
    <input disabled type="text" name="taxDecNo" id="taxDecNo" placeholder="Tax Declaration No." required class="form-control " value="<?php echo $row['TD_ARP']; ?>">
</div>
<div class=" col-sm-6">
    <label for="payerAddress" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Address</label>
    <input disabled type="text" name="payerAddress" id="payerAddress" placeholder="Address" required class="form-control " value="<?php echo $row['ADDRESS']; ?>">
</div>
<div class="col-sm-6">
    <label for="payerName" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Name of Tax
        Payer</label>
    <input disabled type="text" name="payerName" id="payerName" placeholder="Name of Tax Payer" required class="form-control " value="<?php echo $row['NAME']; ?>">
</div>

<div class="col-sm-6">
    <label for="assessValue" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Assessed Value</label>
    <input disabled type="text" name="assessValue" id="assessValue" placeholder="Assessed Value" required class="form-control " value="₱ <?php echo number_format($row['AV_2021'],2); ?>">
</div>




</form>

<?php
                                                                require 'checkLiabilities.php';
                                                                ?>
                                                                <div class="container-fluid" style="height: 200px; overflow: auto;">
                                                                <table class="table table-striped table-sm" style="padding: 0;">
                                                                    <thead>
                                                                        <tr>

                                                                            <th scope="col" style="font-weight: 500;">Name of
                                                                                Collector</th>
                                                                            <th scope="col" style="font-weight: 500;">Amount Paid
                                                                            </th>
                                                                            <th scope="col" style="font-weight: 500;">Payment Covered
                                                                            </th>
                                                                            <th scope="col" style="font-weight: 500;">Date of
                                                                                Payment</th>
                                                                            <th scope="col" style="font-weight: 500;">Action</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        $declarationNo =  $row['TD_ARP'];
                                                                        $payerName = $row['NAME'];
                                                                        require 'connection.php';
                                                                        if (!$con) {
                                                                            die("Connection failed: " . mysqli_connect_error());
                                                                        }

                                                                        $sql1 = ("SELECT * FROM payment_history WHERE TD_ARP = '" . $declarationNo . "' ORDER BY LAST_PAYMENT DESC");
                                                                        $result1 = mysqli_query($con, $sql1);
                                                                        $_SESSION['dec_num'] = $declarationNo =  $row['TD_ARP'];
                                                                        if ($result1->num_rows > 0) {
                                                                            while ($row1 = $result1->fetch_assoc()) {
                                                                                echo '<tr>';
                                                                                echo '<td>' . $row1['USERS_NAME'] . '</td>';
                                                                                echo '<td> ₱' .number_format($row1['TOTAL_PAYMENT'],2) . '</td>';
                                                                                if ($row1['LAST_PAYMENT'] == 0) {
                                                                                    echo '<td>' . $row1['PAYMENT_YEAR'] . '</td>';
                                                                                } else if ($row1['PAYMENT_YEAR'] == 0) {
                                                                                    echo '<td>' . $row1['LAST_PAYMENT'] . '</td>';
                                                                                } else {
                                                                                    echo '<td>' . $row1['PAYMENT_YEAR'] . " - " . $row1['LAST_PAYMENT'] .  '</td>';
                                                                                }
 
                                                                                echo '<td>' . $row1['DATE'] . '</td>';
                                                                                echo '<td>   <form  action= ' . $_SERVER["PHP_SELF"] . ' id="deleteHistory' . $row1['RECEIPT_NO'] . '" method="post">
                                                                                <input type="hidden" id="historyID' . $row1['RECEIPT_NO'] . '" name="historyID" value=' . $row1['RECEIPT_NO'] . '>
	
        <button type="button" form="deleteHistory' . $row1['RECEIPT_NO'] . '" id=' . $row1['RECEIPT_NO'] .'  title="Delete" class="btn btn-danger btn-link btn-sm delete_his" style="margin: 0px; padding: 5px"><i class="material-icons">delete</i></a>
                                                                                 </form></td>';
                                                                                echo '</tr>';
                                                                            }
                                                                            echo '</table>';
                                                                        } else {
                                                                            echo '<script>console.log("waleys");</script>';
                                                                        }
                                                                        ?>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                                <button type="submit" href="#" id="proceed_button" name="proceed_button" form="Year_Selected" onclick="goNext();" class="btn btn-success btn-block shadow-sm">

                                                                    Proceed to Payment
                                                                </button>
                    </div>
                    <?php

require 'compute.php'


?>
<div class="modal fade" id="addHistory" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Add Payment
                                                                        History</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="addHISTORY" action="">

                                                                        <input type="hidden" name="td_ARP" id="td_ARP" placeholder="Assessed Value" required class="form-control " value="<?php echo $row['TD_ARP']; ?>">
                                                                        <input type="hidden" name="addRess" id="addRess" placeholder="Assessed Value" required class="form-control " value="<?php echo $row['ADDRESS']; ?>">
                                                                        <input type="hidden" name="namePayer" id="namePayer" placeholder="Assessed Value" required class="form-control " value="<?php echo $row['NAME']; ?>">
                                                                        <input type="hidden" name="nameUser" id="nameUser" placeholder="Assessed Value" required class="form-control " value="<?php echo $_SESSION['fullname']; ?>">
                                                                        <input type="hidden" name="valueAsssessed" id="valueAssessed" placeholder="Assessed Value" required class="form-control " value="<?php echo $row['AV_2021']; ?>">
                                                                        <div class=" col-sm-12">
                                                                            <label for="receiptNumber" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Receipt No. </label>
                                                                            <input type="text" name="receiptNumber" id="receiptNumber" onkeyup="check_input();" required class="form-control " value="">
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <label for="dateSelect" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Date</label>
                                                                            <input type="date" name="dateSelect" id="dateSelect" placeholder="DD/MM/YYYY" onkeyup="check_input();" required class="form-control " value="">
                                                                        </div>

                                                                        <div class="col-sm-12">
                                                                            <label for="amountPaid" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Amount</label>
                                                                            <input type="text" name="amountPaid" id="amountPaid" placeholder="Enter Amount" onkeyup="check_input();" required class="form-control " value="" onkeypress="return isNumberKey(event)">
                                                                        </div>
                                                                        <span style="font-family: Roboto; font-size: 13px; font-weight: normal; margin-bottom: 0px" id="receipt_message"></span>




                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clear_add();">Close</button>

                                                                    <button type="button" id="addHistory_btn" form="addHISTORY" onclick="addPaymentHistory()" class="btn btn-success" disabled >Add</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (isset($_POST['latestPaymentselect']) && isset($_POST['rangePaymentselect'])) {
                                                        $selyears = $_POST['latestPaymentselect'];
                                                        $selranges = $_POST['rangePaymentselect'];
                                                    }

                                                    ?>  
                    <div id="details" class="tab-pane fade pt-3">
                      
                      <strong> Summary</strong>
                      <hr>
                                                                        <input type="hidden" name="Selected_Year" id="Selected_Year" class="form-control " value="<?php echo $selyears; ?>">
                                                                        <input type="hidden" name="Selected_Range" id="Selected_Range" class="form-control" value="<?php echo $selranges; ?>">
                                                                        <div class="row" style="font-weight: 400;">
                                                                        <div class="col-lg-6 col-sm-12">

                                                                                TD/ARP No : <?php echo $row['TD_ARP'];
                                                                                            echo '<br>'; ?>
                                                                                Address : <?php echo $row['ADDRESS'];
                                                                                            echo '<br>'; ?>
                                                                                Name : <?php echo $row['NAME'];
                                                                                        echo '<br>'; ?>
                                                                            </div>
                                                                            <div class="col-1"></div>
                                                                            <div class="col-lg-5 col-sm-12">

                                                                                Date of Payment : <?php echo date('m-d-Y');
                                                                                                    echo '<br>'; ?>
                                                                                Payment for : <?php $current_Year = date('Y');
                                                                                                $decnum = $_SESSION['TD_ARPS'];
                                                                                                $sql3 = ("SELECT * FROM payment_history WHERE TD_ARP = '" . $decnum . "' ORDER BY LAST_PAYMENT DESC limit 1");
                                                                                                $result3 = mysqli_query($con, $sql3);
                                                                                                if ($result3->num_rows > 0) {
                                                                                                    if ($row3 = $result3->fetch_assoc()) {
                                                                                                        $latestPayments = $row3['LAST_PAYMENT'];
                                                                                                        $latestPayments1 = $latestPayments + 1;
                                                                                                        if (isset($selyears) || isset($selranges)) {
                                                                                                            if ($selranges == 0) { //year only
                                                                                                                echo  $selyears;
                                                                                                                echo '<br>';
                                                                                                            } else if ($selranges != 0 && $selranges != $current_Year && $selyears == $latestPayments1) { //range
                                                                                                                echo  $selyears;
                                                                                                                echo '-';
                                                                                                                echo $selranges;
                                                                                                                echo '<br>';
                                                                                                            } else if ($selyears == $latestPayments1 && $selranges == $current_Year) { //all year
                                                                                                                echo  $selyears;
                                                                                                                echo '-';
                                                                                                                echo $selranges;
                                                                                                                echo '<br>';
                                                                                                            } else { //default
                                                                                                                echo $current_Year;
                                                                                                                echo '<br>';
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } else { //default
                                                                                                    echo $current_Year;
                                                                                                    echo '<br>';
                                                                                                }

                                                                                                //if(($selyears==$latestPayments1) || ($selranges!=$current_Year) ){//year only and range


                                                                                                ?>
                                                                                Assessed Value : ₱ <?php echo number_format($row['AV_2021'],2); ?>
                                                                            </div>
                                                                            <div class="col-12" style="width: 100%; overflow:auto;">
                                                                                <hr>
                                                                                <table width="100%" style="overflow: auto; padding: 0">
                                                                                    <thead>
                                                                                        <th width="20%">Payment For</th>
                                                                                        <th width="20%">Full Payment</th>
                                                                                        <th width="20%">Discount/Penalty(%)</th>
                                                                                        <th width="20%">Discount/Penalty</th>
                                                                                        <th width="20%">Subtotal</th>
                                                                                    </thead>
                                                                                    <?php require "summary.php"; ?>

                                                                                </table>
                                                                                                </div>

                                                                                  <form method="POST" class="row px-0 mb-4" id="addPayment" name="addPayment" onsubmit="event.preventDefault()">

                                                                                <input type="hidden" name="sub_pen" id="sub_pen" required class="form-control " value="<?php echo $subtotal_penalty; ?>">
                                                                                <input type="hidden" name="sub_dis" id="sub_dis" required class="form-control " value="<?php echo $subtotal_discount; ?>">
                                                                                <input type="hidden" name="tdarp" id="tdarp" required class="form-control " value="<?php echo $row['TD_ARP']; ?>">
                                                                                <input type="hidden" name="addr" id="addr" required class="form-control " value="<?php echo $row['ADDRESS']; ?>">
                                                                                <input type="hidden" name="TPname" id="TPname" required class="form-control " value="<?php echo $row['NAME']; ?>">
                                                                                <input type="hidden" name="Users_name" id="Users_name" required class="form-control " value="<?php echo $_SESSION['fullname']; ?>">
                                                                                <input type="hidden" name="assessVal" id="assessVal" required class="form-control " value="<?php echo $row['AV_2021']; ?>">
                                                                                <input type="hidden" name="totalVal" id="totalVal" required class="form-control " value="<?php echo $_SESSION['totalAll']; ?>">
                                                                                <input type="hidden" name="sef_rpt" id="sef_rpt" required class="form-control " value="<?php echo $_SESSION['SEF_RPT']; ?>">
                                                                                <input type="hidden" name="selectDate" id="selectDate" disabled required class="form-control " value="<?= date('Y-m-d') ?>">
                                                                                <input type="hidden" name="classification" id="classification" disabled required class="form-control " value="<?php echo $row['CLASSIFICATION'];?>">

                                                                                <div class="col-lg-12">
                                                                                    <label for="payor_name" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Payor Name</label>
                                                                                    <input type="text" name="payor_name" id="payor_name" onkeyup="check_amount()" placeholder="Enter Name" required class="form-control " value="">
                                                                                </div>

                                                                                <div class="col-lg-6">
                                                                                    <label for="amount" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Payment</label>
                                                                                    <input type="text" name="amount" id="amount" onkeyup="check_amount()" onkeypress="return isNumberKey(event)"  placeholder="Enter Amount" required class="form-control " value="">
                                                                                </div>


                                                                                <div class="col-lg-6">
                                                                                    <label for="change" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label form-label-sm">Change</label>
                                                                                    <input type="text" name="change" id="change" onkeyup="" placeholder="Change" required class="form-control " value="" disabled>
                                                                                </div>

                                                                            </form>





                                                              <div class="col-lg-6 col-sm-12">
                                                            <button type="button" id="next_button1" class=" btn btn-secondary btn-block shadow-sm " onclick="goPrevious();">Back </button>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12">
                                                            <button type="button" id="conf_button" class=" btn btn-success btn-block shadow-sm " form="addPayment" onclick="conf_pay();" disabled> Confirm Payment </button>
                                                        </div>

                                                                      </div>
                                                                      </div>

                       <div id="receipt" class="tab-pane fade pt-3">
                         <div class="container-fluid" style="overflow: auto; width: 100%">
                       <iframe id="test" src="table.php" class="col-lg-12 mx-0 px-0" style="overflow: hidden; border: none;" width="100%" height="600px" frameborder="yes" name="myIframe" id="myIframe"> </iframe>
                       </div>
                       <div class="row">
                         <div class="col-sm-6">
                         
                                                            <button type="button" id="next_button" class="subscribe btn btn-secondary btn-block shadow-sm " onclick=" goPrevious()">Back </button>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <button type="button" id="next_button" onclick="print_receipt()" class=" btn btn-success btn-block shadow-sm ">
                                                                Print Receipt
                                                            </button>
                                                        </div>
                                                        </div>
                      </div>
                  </div>

                </div>


</div>
</div>
<div class="col-lg-2"></div>
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
  <?php
                            }
                        }
                    } else {
                        echo '
                            <div class="modal fade" id="noticePayment" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"  >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Notice</h5>
                                            
                                        </div>
                                        <div class="modal-body">
                                          
                                            <h4>
                                                <center>Please go to records and select which record you want to process into payment. Thank you!</center>
                                            </h4>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="button" id="proceedToRecords" class="btn btn-success" >Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    } ?>


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
<div class="modal fade" id="successADD" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                        </div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                        </div>
                    </div>
                    <h5>
                        <center>Successfully Added</center>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.location.reload()" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="successDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                        </div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                        </div>
                    </div>
                    <h5>
                        <center>Successfully Deleted</center>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.location.reload()" data-bs-dismiss="modal">Close</button>
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
$(document).ready(function() {

$('#disable_proceed').trigger('click');
$('#noticePayment').modal('show');

});

$(document).on('click', '#disable_proceed', function(event) {
event.preventDefault();
$('#proceed_button').attr("disabled", true);
});
$(document).on('click', '#proceedToRecords', function(event) {
event.preventDefault();
window.location.href = 'records.php';
});

function print_receipt() {
var frm = document.getElementById('test').contentWindow;
frm.focus();
frm.print();
return false;
}

function goPrevious() {
$('#liabs').attr("disabled", false);
//$('#pay').attr("disabled", true);
$('#liabs').trigger('click');
};

function goNext() {

$('#transaction_details').attr("disabled", false);
$('#transaction_details').trigger('click');
};
jQuery(document).ready(function() {

jQuery('button[data-bs-toggle="pill"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', jQuery(e.target).attr('data-bs-target'));
});

var activeTab = localStorage.getItem('activeTab');
if (activeTab) {
    jQuery('button[data-bs-target="' + activeTab + '"]').tab('show');
}
});


$(document).on('click', '.delete_his', function(event) {
event.preventDefault();
// alert($(this).attr('id'));
var id = $(this).attr('id');

if (confirm("Are you sure want to delete this record? ")) {
    $.ajax({
        url: "delete_history.php",
        type: "POST",
        async: false,
        data: {
            id: id
        },
        success: function(response) {
            $('#successDelete').modal('show');
        },
        fail: function(response) {

        },
    });
} else {
    return null;
}
return false;
});


function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode != 46 && charCode > 31 
&& (charCode < 48 || charCode > 57))
 return false;

return true;
}
function check_amount() {
var payors = document.getElementById('payor_name').value;
var total = parseFloat(document.getElementById('totalVal').value);
var paid = parseFloat(document.getElementById('amount').value);
var change = document.getElementById('change').value;
if (total > paid) {
    document.getElementById("conf_button").disabled = true;
}

else {

    if (payors == ''){
    document.getElementById("conf_button").disabled = true;
        }else{
    document.getElementById("conf_button").disabled = false;
        }
    change = (paid - total);

    let num = change.toFixed(2);
    //change = Math.round(paid - total);
    document.getElementById('change').value = num;
    if (isNaN(document.getElementById('change').value)) {
        document.getElementById('change').value = "";
        document.getElementById("conf_button").disabled = true;
    }



}

};

function check_input() {
var receipt_no = $("#receiptNumber").val();
$(document).ready(function() {
$.ajax({
url: "check_receipt_no.php",
type: "POST",
data: {
receipt_no:receipt_no
},
success: function(response) {

var receiptno = document.getElementById('receiptNumber').value;
var amountPaids = document.getElementById('amountPaid').value;
var dateSelects = document.getElementById('dateSelect').value;


if (response == "fail"){
    document.getElementById("receipt_message").innerHTML = "Reciept Number already taken";
document.getElementById('receipt_message').style.color = "red";
    document.getElementById("addHistory_btn").disabled = true;
}
else{
    document.getElementById("receipt_message").innerHTML = "";
    document.getElementById("addHistory_btn").disabled = true;
    
        if (amountPaids=='' || dateSelects=='' || receiptno=='') {
        document.getElementById("addHistory_btn").disabled = true;
        document.getElementById("receipt_message").innerHTML = "";
        }else{
        document.getElementById("addHistory_btn").disabled = false;
        document.getElementById("receipt_message").innerHTML = "";
        }
        
    }

}
});

});

};
function conf_pay() {
var td_arps = $("#tdarp").val();
var addrs = $("#addr").val();
var sub_pens = $("#sub_pen").val();
var sub_disc = $("#sub_dis").val();
var tp_names = $("#TPname").val();
var users_names = $("#Users_name").val();
var assess_val = $("#assessVal").val();
var total_val = $("#totalVal").val();
var select_date = $("#selectDate").val();
var selyear = $("#Selected_Year").val();
var selrange = $("#Selected_Range").val();
var sefrpt = $("#sef_rpt").val();
var classifications = $("#classification").val();
var payor_names = $("#payor_name").val();
$(document).ready(function() {

    $('#proceed_button').attr("disabled", true);
    $.ajax({
        url: "confirm_payment.php",
        type: "POST",
        async: false,
        data: {
            classification: classifications,
            sub_pen : sub_pens,
            sub_dis: sub_disc,
            tdarp: td_arps,
            addr: addrs,
            TPname: tp_names,
            Users_name: users_names,
            assessVal: assess_val,
            totalVal: total_val,
            selectDate: select_date,
            Selected_Year: selyear,
            Selected_Range: selrange,
            sef_rpt: sefrpt,
            payor_name: payor_names

        },
        success: function(response) {
            window.location.reload();
            $('#receiptOfficial').attr("disabled", false);
            $('#receiptOfficial').trigger('click');

            console.log(td_arps);

        },
        fail: function(response) {
            console.log("fail");
        },

    });

});
}

function addPaymentHistory() {
var td_arps = $("#td_ARP").val();
var addrs = $("#addRess").val();
var tp_names = $("#namePayer").val();
var users_names = $("#nameUser").val();
var assess_val = $("#valueAssessed").val();
var total_val = $("#amountPaid").val();
var select_date = $("#dateSelect").val();
$(document).ready(function() {
    $.ajax({
        url: "addPaymentHistory.php",
        type: "POST",
        async: false,
        data: {
            td_ARP: td_arps,
            addRess: addrs,
            namePayer: tp_names,
            nameUser: users_names,
            valueAssessed: assess_val,
            amountPaid: total_val,
            dateSelect: select_date
        },
        success: function(response) {
            $('#successADD').modal('show');
        },
        fail: function(response) {

        },

    });

});


}
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