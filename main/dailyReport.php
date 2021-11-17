<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
require 'connection.php';


?>

<!doctype html>

<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <!-- Material Kit CSS -->
 
</head>






<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
  column-count: 14;
}

 th {
  font-size: 10px;
  border: 1px solid #000000;
  text-align: center;
  padding: 0px;
  margin-bottom: 0px;
  padding: 3px;
  font-weight: 600;

}

td {
  font-size: 12px;
  border: 1px solid #000000;
  text-align: left;
  padding: 10px;
}

tr:nth-child(even) {
  border: 1px solid #000000;
}
p {
  font-size: 12px;
}
label {
  display: block;
  padding-left: 15px;
  text-indent: -15px;
}

input {
  width: 15px;
  height: 15px;
  padding: 0;
  margin: 0;
  vertical-align: bottom;
  position: relative;
  top: -1px;
  
}
tr.no-bottom-border th {
  border-bottom: none;
}
tr.withData td {
  font-size: 10px;
  padding: 3px;
}
tr.total td {
  font-size: 14px;
  padding: 6px;
}

.h-divider{
 margin-top:1px;
 margin-bottom:0px;
 height:1px;
 width: 100%;
 border-top:1px solid black;
}
.example::-webkit-scrollbar {
  display: none;
}



</style>
<body>
<div class="container-fluid">
<table width="100%" style="column-count: 6;">
<thead>
<tr colspan="6" width="100%">
<th colspan="6" width="100%" rowspan="4">
<div class="row d-flex justify-content-center align-items-center text-center">
  <div class="col-3"></div>
  <div class="col-md-6">
  <p class="mb-1" style="font-size: 14px; font-weight: bold;">REPORT OF DAILY COLLECTION</p>
  <p class="mb-0" style="font-size: 12px; font-weight: normal;">MUNICIPALITY OF AGONCILLO</p>
   <div class="row">
     <div class="col-4"></div>
     <div class="col-4">
  <div class="h-divider mt-0"></div>
  <span style="font-size: 12px;  font-weight: normal;" class="mb-2">Agency</span>
  <p class="mb-0 mt-2" style="font-size: 12px;  font-weight: normal;"><?php echo date('m-d-Y')?></p>
  <div class="h-divider mt-0"></div>
  <span style="font-size: 12px;  font-weight: normal;">Date</span>
  </div><div class="col-4"></div>
  </div>
  </div>
  <div class="col-3"></div>
</div>
</th>
</tr>
</thead>
<tbody>
<tr>
<th colspan="3" rowspan="1" width="40%">OFFICIAL RECEIPT</th>
<th colspan="1" rowspan="2" width="30%">PAYOR</th>
<th colspan="1" rowspan="2" width="15%">PARTICULARS(BASIC)</th>
<th colspan="1" rowspan="2" width="15%">AMOUNT</th>
</tr>
<tr>
  <th>AF FORM</th>
  <th>DATE</th>
  <th>NUMBER</th>
  
</tr>
<?php 
$currentDate=date('Y-m-d');
$userName = $_SESSION['fullname'];
$numberofRows = 0;
$total_basic_report = 0;
$sql=("SELECT * FROM payment_history WHERE USERS_NAME = '".$userName."' AND DATE = '".$currentDate."' ");
$results=mysqli_query($con, $sql);
if ($results->num_rows>0) {
  while($result=$results-> fetch_assoc()) {
    $payment_year = $result['PAYMENT_YEAR'];
    $last_payment = $result['LAST_PAYMENT'];

    $numberofRows++;
    echo '<tr class="withData">
    <td>No. 56</td>
    <td>'.$result['DATE'].'</td>
    <td>'.$result['TD_ARP'].'</td>
    <td>'.$result['PAYOR'].'</td>
    <td>'; if($payment_year == 0){
      echo $last_payment; 
    }else if($last_payment == 0){
      echo $payment_year;
    } else if($payment_year != 0 && $last_payment != 0)  {
      echo $payment_year.'-'. $last_payment;
    }echo '</td>
    <td>'.$result['BASIC_REPORT'].'</td>
  </tr>';
  $total_basic_report =  $total_basic_report + $result['BASIC_REPORT'];
  }  while($numberofRows <= 34){
    $numberofRows++;
      echo '<tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>';
  } echo '<tr class="withData">
  <th colspan="3" class="text-center">Total</th>
  <td></td>
  <td></td>
  <td>₱ '.number_format($total_basic_report, 2).'</td>
  
</tr>';
}
?>


</tbody>
<tfoot>
  <tr>
  <th colspan="6" class="text-center" style="font-weight: bold;">C E R T I F I C A T I O N</th>
  </tr>
  <tr>
    <td colspan="6">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-12">
    <p style="text-indent: 25px; margin-left: 25px; margin-right: 12px; text-align: justify; margin-bottom: 40px;">I hereby certify on my official oath that the above is true statement of all collections received by me during the period stated above for which Official Receipt Nos. ___________ to ___________ inclusive were actually issued by me in the amounts shown thereon. I also certify that I have not received money from whatever source without having issued the necessary Official Receipt acknowledgement thereof. Collections received by sub-collector are recorded above in lump-sum opposite their respective collection report numbers. I certify further that the balance shown above agrees with the balance a appearing in my Cash Receipts Record.</p>
    </div>
    <div class="col-3"></div>
    <div class="col-5 text-center mb-2">
      <p class="mb-0">BRIGIDA ZAYDA M. CABAÑOG</p>
    <div class="h-divider mt-0"></div>
    <p>Name and Signature of Collecting Officer</p>
    </div>
    <div class="col-3"></div>

    <div class="col-4 text-center">
    <p class="mb-0"><?php echo strtoupper($userName); ?></p>
    <div class="h-divider mt-0"></div>
    <p>Official</p>
    </div>

    <div class="col-4 text-center">
    <p class="mb-0"><?php echo date('m-d-Y')?></p>
    <div class="h-divider mt-0"></div>
    <p>Date</p>
    </div>

   
  
  
      </div>
      </div>
  </td>
  
  </tr>
</tfoot>



</table>


</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>