<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
require 'connection.php';
$invoice = '';
$tdarps = '';
$names = '';
$address = '';
$ass_val = '';
$grand_total = 0;
$payment_year = '';
$last_payment = '';
$date = '';
$collector = '';
$classification = '';
$payors = '';
$decnum= $_SESSION['TD_ARPS']; 
$sql=("SELECT * FROM payment_history WHERE TD_ARP = '".$decnum."' ORDER BY RECEIPT_NO DESC limit 1 ");
$results=mysqli_query($con, $sql);
if ($results->num_rows>0) {
  if($result=$results-> fetch_assoc()) {
if(isset($results)) {
$invoice = $result['RECEIPT_NO'];
$tdarps = $result['TD_ARP'];
$names = $result['TAXPAYER_NAME'];
$address = $result['ADDRESS'];
$ass_val = $result['ASSESSED_VALUE'];
//$basic = $result['BASIC'];
//$sef = $result['SEF'];
//$subtotal = $result['SUBTOTAL'];
$grand_total = $result['TOTAL_PAYMENT'];
$payment_year = $result['PAYMENT_YEAR'];
$last_payment = $result['LAST_PAYMENT'];
$date = $result['DATE'];
$collector = $result['USERS_NAME'];
$classification = $result['CLASSIFICATION'];
$payors = $result['PAYOR'];
    } else {

    }
  } 
}
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
thead {
  column-count: 14;
}
 th {
  font-size: 10px;
  border: 1px solid #000000;
  text-align: center;
  padding: 0px;
  margin-bottom: 0px;
  padding: 3px;
  font-weight: 400;

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
 width:100%;
 border-top:1px solid black;
}
.example::-webkit-scrollbar {
  display: none;
}
</style>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <br><p style="margin-bottom: 0px;" class="text-center"> Accountable Form No. 56 </p>
       <p class="text-center">(Revised Jan, 1994)</p>
       
    </div>
    <div class="col-1 mt-3">
      <img src="../images/ROP.png" width="50px" height="50px">
    </div>
    <div class="col-3 py-0">
      <p><center style="font-size: 12px;"> Republic of the Philippines </center>
  <center style="font-size: 12px; font-weight: 600;">Province of Batangas</center>
     <center style="font-size: 12px; font-weight: 600; "> OFFICE OF THE TREASURER</center> 
    </div>
    <div class="col-1 mt-3">
      <img src="../images/batangaslogo.png" width="50px" height="50px">
    </div>
    <div class="col-1">
    </div>
    <div class="col-3 mt-0 py-0 text-center" >
   <br><span style="font-size: 12px; font-weight: bold;" class="mt-0 py-0">No.</span> <span style="font-weight: 500; font-size: 16px;">BTG </span><span style="font-weight: 500; font-size: 16px;"><?php echo $invoice ?></span>
    <p style="font-weight: 500; font-size: 12px" class="mb-0">OFFICIAL RECEIPT</p>
  </div>
  </div>
</div>



  <table width="100%">
 <thead>
  <tr>
  
    <th width="35%" colspan="5" style="text-align:  left;">Municipality: Agoncillo</th>
    <th width="35%" colspan="5" style="text-align:  left;">Province: Batangas</th>
    <th width="30%" colspan="3" style="text-align:  left;">Date: <?php echo $date; ?></th >
     
  </tr>
</thead>
<tbody>
  <tr> 
    <th width="25%" colspan="4" style=" text-align:  left;" contenteditable="true">Received from: <?php echo $payors; ?></th>
    <th width="15%" colspan="3" style="text-align:  left;">the Sum of: &#8369; <?php echo number_format($grand_total,2); ?> </th>
    <th width="40%" colspan="3" style=" text-align:  left; ">Philippine currency, in full or installation payment of REAL PROPERTY TAX upon property(ies) described below for the Calendar Year: 
    <?php  if($payment_year == 0){
      echo $last_payment; 
    }else if($last_payment == 0){
      echo $payment_year;
    } else if($payment_year != 0 && $payment_year != 0)  {
      echo $payment_year.'-'. $last_payment;
    }
    ?> 
    </th>
    <th width="20%" colspan="3" style=" text-align:  left; ">
     <p class="mb-1" style="font-size: 10px;"> <label>
      <input type="checkbox" checked/> Basic Tax </label> </p><p class="mb-0" style="font-size: 10px;">
      <label><input type="checkbox" checked/> Special Education Fund
    </label> </p></th>
    
  </tr>
</tbody>

</table width="100%">

  <table style="margin-top: 3px">
    <thead>
  <tr>
    <th colspan="1" rowspan="2">NAME OF DECLARED OWNER</th>
    <th colspan="1" rowspan="2">LOCATION</th>
    <th colspan="1" rowspan="2">LOT BLOCK NO.</th>
    <th colspan= "1" rowspan="2">TAX DECLARATION NO.</th>
    <th colspan="3">ASSESSED VALUE</th>
    <th  colspan="1" rowspan="2">TAX DUE</th>
    <th  colspan="2">INSTALLMENT</th>
    <th  colspan="1" rowspan="2">FULL PAYMENT</th>
    <th  colspan="1" rowspan="2">PENALTY PERCENT</th>
    <th  colspan="1" rowspan="2">TOTAL</th>

  </tr>
  
  <tr>
    
    <th colspan="1">Land</th>
    <th colspan="1">Improvement</th>
    <th colspan="1">Total</th>
    <th colspan="1">No.</th>
    <th colspan="1">Payment</th>

  </tr>
  </thead>
  <tbody>
  <tr class="withData">
    <td><?php echo $names; ?></td>
    <td contenteditable="true"><?php echo strstr( $address . ' ', ' ', true ); ?></td>
    <td></td>
    <td><?php echo $tdarps; ?></td>
    <td><?php echo $classification?></td>
    <td></td>
    <td><?php echo $ass_val; ?></td>
    <td></td>
    <td></td>
    <td>    
    <?php  
    if($payment_year == 0){
      echo $last_payment. ' '.'SEF';
    }else if($last_payment == 0){
      echo $payment_year. ' '.'SEF';
    } else if($payment_year != 0 && $payment_year != 0)  {
      echo $payment_year.'-'. $last_payment. ' '.'SEF';
    }
    ?> 
    </td>
    <td></td>
    <td></td>
    <td>  <?php echo number_format($grand_total,2); ?></td>
   
  
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
   
  
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  
  
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
   
  
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
 
  
  </tr>

  </tbody>
  <tfoot>
  <tr class="total">
    <td colspan="10"></td>
    <td colspan="3" class="text-center">Total: &#8369; <?php echo number_format($grand_total,2); ?> </td>
    
   
  </tr>
  </tfoot>
</table>
<div class="row">
  <div class="col-4">
     <p style="font-size: 9px; margin-top: 10px;">Payment without penalty may be made with the periods stated below if by installment.<br><br>
      1st Installment - January 1 to March 31 <br>
        2nd Installment - April 1 to June 30<br>
        3rd Installment - July 1 to September 30 <br>
        4th Installment - October 1 to December 31
      </p>
  </div>
  <div class="col-4" >
    <table style="margin-top: 10px; column-count: 2;">
      <tr>
        <th colspan="2" style="font-size: 9px; ">Mode of Payment</th>
      </tr>
      <tr class="withData">
        <td width="50%" style="font-size: 9px; padding: 2px;">CASH</td>
        <td class="text-center"><input type="checkbox" /></td>
      </tr>
      <tr class="withData">
        <td width="50%" style="font-size: 9px; padding: 2px;">CHECK</td>
        <td  class="text-center"><input type="checkbox" /></td>
      </tr>
      <tr class="withData">
        <td width="50%" style="font-size: 9px; padding: 2px;">TW/PMO</td>
        <td class="text-center"><input type="checkbox"/></td>
      </tr>
      <tr class="withData">
        <td width="50%" class="text-center" style="font-size: 9px; padding: 2px;">TOTAL</td>
        <td class="text-center">Total: &#8369; <?php echo number_format($grand_total,2); ?></td>
      </tr>
    </table>
  </div>
  <div class="col-4" style="margin-top: 20px;">
    
    <p style="font-size: 11px; margin-bottom: 0px;" class="text-center" >BRIGIDA ZAYDA M. CABAÑOG</p>
    <div class="h-divider"></div>
    <p style="font-size: 9px; margin-top: 0px;" class="text-center" >Deputy Collecting Agent </p>

  
  <p style="font-size: 11px;  margin-bottom: 0px;" class="text-center" >  FORTUNATA M. LAT  </p>
  <div class="h-divider"></div>
  <p style="font-size: 9px; margin-top: 0px;" class="text-center" >Provincial Treasurer </p>
</div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>