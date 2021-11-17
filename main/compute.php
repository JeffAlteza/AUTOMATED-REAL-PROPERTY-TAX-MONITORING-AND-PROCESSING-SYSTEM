<?php

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
require 'connection.php';
$declaration_no=$_SESSION['TD_ARPS'];
$idnumber=$_SESSION['ID_NO'];
//echo $declaration_no;
$currentYear=date('Y');
$_SESSION['CURRENT_YEAR']=$currentYear;
//$currentYear=2020;

if ( !$con) {
    die("Connection failed: ". mysqli_connect_error());
}


//========================================================================discount range

$Jan1=date('m-d', strtotime("01/01"));
$Jan31=date('m-d', strtotime("01/31"));

$Feb1=date('m-d', strtotime("02/01"));
$Feb15=date('m-d', strtotime("02/15"));

$Feb16=date('m-d', strtotime("02/16"));
$Mar31=date('m-d', strtotime("03/31"));

$Apr1=date('m-d', strtotime("04/01"));
$May15=date('m-d', strtotime("05/15"));

$May16=date('m-d', strtotime("05/16"));
$Jun30=date('m-d', strtotime("06/30"));

$Jul1=date('m-d', strtotime("07/01"));
$Aug15=date('m-d', strtotime("08/15"));

$Aug16=date('m-d', strtotime("08/16"));
$Sep30=date('m-d', strtotime("09/30"));

$Oct1=date('m-d', strtotime("10/01"));
$Nov15=date('m-d', strtotime("11/15"));

$Nov16=date('m-d', strtotime("11/16"));
$Dec31=date('m-d', strtotime("12/31"));

//========================================================================months
$Feb29=date('m-d', strtotime("02/29"));

$Mar1=date('m-d', strtotime("03/01"));

$Apr30=date('m-d', strtotime("04/30"));

$May1=date('m-d', strtotime("05/1"));

$May31=date('m-d', strtotime("05/31"));

$Jun1=date('m-d', strtotime("06/01"));

$Jul31=date('m-d', strtotime("07/31"));

$Aug1=date('m-d', strtotime("08/01"));

$Aug31=date('m-d', strtotime("08/31"));

$Sep1=date('m-d', strtotime("09/01"));

$Oct31=date('m-d', strtotime("10/31"));

$Nov1=date('m-d', strtotime("11/01"));

$Nov30=date('m-d', strtotime("11/30"));

$Dec1=date('m-d', strtotime("12/01"));

$AV=$row['AV_2021'];
$AV1=$AV * 0.01;
$discount=0;
$penalty=0;
$total=0;
$totalAll=0;
$SEFq1=0;
$SEFq2=0;
$RPTq3=0;
$RPTq4=0;
$SEF_penalty=0;
$RPT_penalty=0;
$currentDate=date('m-d');
$RPT =0;
$av_discount = 0;
$av_penalty=0;


$subtotal_penalty=0;
$subtotal_discount=0;
$grandtotal_penalty=0;
$grandtotal_discount=0;

//$currentDate = date('m-d',  strtotime("12/10"));
//$currentYear = date('Y', strtotime("2020"));

//=======================================================================
//if(isset($_POST['latestPaymentselect'] ))


$sql3=("SELECT * FROM payment_history WHERE TD_ARP = '".$declaration_no."' ORDER BY LAST_PAYMENT DESC limit 1");
$result3=mysqli_query($con, $sql3);



if ($result3->num_rows>0) {
    if($row3=$result3-> fetch_assoc()) {
        $latestPayment=$row3['LAST_PAYMENT'];
        
        $yearDifference=$currentYear - $latestPayment;
        //echo $yearDifference;
        $_SESSION['latest_payment']=$latestPayment+1;
    }

    if($latestPayment == $currentYear){

        echo '<button style="display:none;" type="hidden" id="disable_proceed"> </button>';
    }



    if(isset($_POST['proceed_button'])) {
        $selYear=$_POST["latestPaymentselect"];
        $selRange=$_POST["rangePaymentselect"];
        $_SESSION['sel_year']=$selYear;
        $_SESSION['sel_range']=$selRange;

        //$selYear =   $_SESSION['SEL_YEAR'];
        //$selRange =   $_SESSION['SEL_RANGE'];

        //echo $selYear;
        //echo $selRange;
         if ($selYear==$latestPayment+1 && $selRange==0) {
            //year only
            // echo $selYear; echo '123'; 
            $yearDifference=$currentYear - $selYear;

            switch($yearDifference) {
                case 0: switch(true) {

                    case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                        $penalty=0.08;
                    break;
                    case (($currentDate >=$May1) && ($currentDate <=$May31)):
                        $penalty=0.10;
                    break;
                    case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                        $penalty=0.12;
                    break;
                    case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                        $penalty=0.14;
                    break;
                    case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                        $penalty=0.16;
                    break;
                    case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                        $penalty=0.18;
                    break;
                    case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                        $penalty=0.20;
                    break;
                    case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                        $penalty=0.22;
                    break;
                    case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                        $penalty=0.24;
                    break;
                }

                //========================================================================discount for 1 year


                switch(true) {
                    case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                        $discount=0.15;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $penalty=0;
                    $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = (($AV1/2) * $discount);
                    $subtotal_penalty = $subtotal_penalty + 0;
                    $subtotal_discount = $subtotal_discount + ($av_discount * 4);
                    break;

                    case (($currentDate >=$Feb1) && ($currentDate <=$Feb15)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $penalty=0;
                    $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + 0;
                    $subtotal_discount = $subtotal_discount + ($av_discount * 4);
                    break;

                    case (($currentDate >=$Feb16) && ($currentDate <=$Mar31)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $penalty=0;
                    $SEFq1=$AV1 / 2;
                    $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + 0;
                    $subtotal_discount = $subtotal_discount + ($av_discount * 3);
                    break;

                    case (($currentDate >=$Apr1) && ($currentDate <=$May15)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + ($av_penalty);
                    $subtotal_discount = $subtotal_discount + ($av_discount * 3);
                    break;

                    case (($currentDate >=$May16) && ($currentDate <=$Jun30)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $SEFq2=$AV1 / 2;
                    $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + ($av_penalty);
                    $subtotal_discount = $subtotal_discount + ($av_discount * 2);
                    break;

                    case (($currentDate >=$Jul1) && ($currentDate <=$Aug15)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
                    $subtotal_discount = $subtotal_discount + ($av_discount * 2);
                    break;

                    case (($currentDate >=$Aug16) && ($currentDate <=$Sep30)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $RPTq3=$AV1 / 2;
                    $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
                    $subtotal_discount = $subtotal_discount + ($av_discount);
                    
                    break;

                    case (($currentDate >=$Oct1) && ($currentDate <=$Nov15)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $SEFq1=$AV1 / 2+($av_penalty);
                    $SEFq2=$AV1 / 2+($av_penalty);
                    $RPTq3=$AV1 / 2+($av_penalty);
                    $RPTq4=$AV1 / 2 - ($av_discount);
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + ($av_penalty * 3);
                    $subtotal_discount = $subtotal_discount + ($av_discount);
                    
                    break;

                    case (($currentDate >=$Nov16) && ($currentDate <=$Dec31)):
                        $discount=0.10;
                        $av_discount = ($AV1 / 2) * $discount;
                        $av_penalty = ($AV1 / 2) * $penalty;
                    $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $RPTq3=$AV1 / 2+(($AV1 / 2) * $penalty);
                    $RPTq4=$AV1 / 2;
                    $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                    $subtotal_penalty = $subtotal_penalty + ($av_penalty * 4);
                    $subtotal_discount = $subtotal_discount + 0;
                    break;

                    default:
                        break;
                }

                //========================================================================END penalty for 1 year
                //echo "paidss";
                break;

                case 1: switch(true) {
                    case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                        $penalty=0.26;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                        $penalty=0.28;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                        $penalty=0.30;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                        $penalty=0.32;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$May1) && ($currentDate <=$May31)):
                        $penalty=0.34;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                        $penalty=0.36;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                        $penalty=0.38;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                        $penalty=0.40;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                        $penalty=0.42;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                        $penalty=0.44;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                        $penalty=0.46;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                        $penalty=0.48;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                }




                //echo "paidss";
                break;

                case 2: switch(true) {
                    case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                        $penalty=0.50;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                        $penalty=0.52;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                        $penalty=0.54;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                        $penalty=0.56;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$May1) && ($currentDate <=$May31)):
                        $penalty=0.58;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                        $penalty=0.60;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                        $penalty=0.62;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                        $penalty=0.64;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                        $penalty=0.66;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                        $penalty=0.68;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                        $penalty=0.70;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                    case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                        $penalty=0.72;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;
                    break;
                }

                //echo "paidss";
                break;
                default: $penalty=0.72;
                $SEF_penalty=($AV1 * $penalty)+$AV1;
                $RPT_penalty=($AV1 * $penalty)+$AV1;
                $total=($SEF_penalty + $RPT_penalty);
                $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                $subtotal_discount = $subtotal_discount + 0 ;
                break;
            }

            //end of switch case
            $RPT=$RPT+$AV1;
            $_SESSION['SEF_RPT']=$RPT;
            $totalAll=(round($totalAll+$total,2));
            $_SESSION['totalAll']=$totalAll;

        }

        else if($selRange !=0&& $selRange !=$currentYear && $selYear==$latestPayment +1) {
            //specific range only

            $currentYear1=$currentYear;

            for ($i=$selRange; $i >=$selYear; $i--) {
                $diff=$currentYear1- $i;

                switch($diff) {
                    case 0: switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $penalty=0;
                        break;
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                            $penalty=0;
                        break;
                        case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                            $penalty=0;
                        break;
                        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                            $penalty=0.08;
                        break;
                        case (($currentDate >=$May1) && ($currentDate <=$May31)):
                            $penalty=0.10;
                        break;
                        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                            $penalty=0.12;
                        break;
                        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                            $penalty=0.14;
                        break;
                        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                            $penalty=0.16;
                        break;
                        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                            $penalty=0.18;
                        break;
                        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                            $penalty=0.20;
                        break;
                        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                            $penalty=0.22;
                        break;
                        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                            $penalty=0.24;
                        break;
                    }

                    //========================================================================discount for 1 year


                    switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $discount=0.15;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $penalty=0;
                        $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = (($AV1/2) * $discount);
                        $subtotal_penalty = $subtotal_penalty + 0;
                        $subtotal_discount = $subtotal_discount + ($av_discount * 4);
                        break;
    
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $penalty=0;
                        $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + 0;
                        $subtotal_discount = $subtotal_discount + ($av_discount * 4);
                        break;
    
                        case (($currentDate >=$Feb16) && ($currentDate <=$Mar31)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $penalty=0;
                        $SEFq1=$AV1 / 2;
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + 0;
                        $subtotal_discount = $subtotal_discount + ($av_discount * 3);
                        break;
    
                        case (($currentDate >=$Apr1) && ($currentDate <=$May15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty);
                        $subtotal_discount = $subtotal_discount + ($av_discount * 3);
                        break;
    
                        case (($currentDate >=$May16) && ($currentDate <=$Jun30)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2;
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty);
                        $subtotal_discount = $subtotal_discount + ($av_discount * 2);
                        break;
    
                        case (($currentDate >=$Jul1) && ($currentDate <=$Aug15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
                        $subtotal_discount = $subtotal_discount + ($av_discount * 2);
                        break;
    
                        case (($currentDate >=$Aug16) && ($currentDate <=$Sep30)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq3=$AV1 / 2;
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
                        $subtotal_discount = $subtotal_discount + ($av_discount);
                        
                        break;
    
                        case (($currentDate >=$Oct1) && ($currentDate <=$Nov15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+($av_penalty);
                        $SEFq2=$AV1 / 2+($av_penalty);
                        $RPTq3=$AV1 / 2+($av_penalty);
                        $RPTq4=$AV1 / 2 - ($av_discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 3);
                        $subtotal_discount = $subtotal_discount + ($av_discount);
                        
                        break;
    
                        case (($currentDate >=$Nov16) && ($currentDate <=$Dec31)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq3=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq4=$AV1 / 2;
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 4);
                        $subtotal_discount = $subtotal_discount + 0;
                        break;
    
                        default:
                            break;
                    }

                    //========================================================================END penalty for 1 year
                    //echo "paidss";
                    break;

                    case 1: switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $penalty=0.26;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                            $penalty=0.28;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                            $penalty=0.30;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                            $penalty=0.32;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$May1) && ($currentDate <=$May31)):
                            $penalty=0.34;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                            $penalty=0.36;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                            $penalty=0.38;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                            $penalty=0.40;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                            $penalty=0.42;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                            $penalty=0.44;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                            $penalty=0.46;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                            $penalty=0.48;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                    }




                    //echo "paidss";
                    break;

                    case 2: switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $penalty=0.50;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                            $penalty=0.52;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                            $penalty=0.54;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                            $penalty=0.56;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$May1) && ($currentDate <=$May31)):
                            $penalty=0.58;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                            $penalty=0.60;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                            $penalty=0.62;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                            $penalty=0.64;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                            $penalty=0.66;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                            $penalty=0.68;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                            $penalty=0.70;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                            $penalty=0.72;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                    }

                    //echo "paidss";
                    break;
                    default: $penalty=0.72;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;

                    break;
                }

                //end of switch case
                $RPT=$RPT+$AV1;
                $_SESSION['SEF_RPT']=$RPT;
                $totalAll=(round($totalAll+$total,2));
                $_SESSION['totalAll']=$totalAll;
            }

        }

        else if($currentYear==$selRange && $selYear==$latestPayment+1) {

            //whole range
            for($j=$latestPayment+1; $j<=$currentYear; $j++) {


                $yearDifferences=$currentYear - $j;



                switch($yearDifferences) {
                    case 0: switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $penalty=0;
                        break;
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                            $penalty=0;
                        break;
                        case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                            $penalty=0;
                        break;
                        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                            $penalty=0.08;
                        break;
                        case (($currentDate >=$May1) && ($currentDate <=$May31)):
                            $penalty=0.10;
                        break;
                        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                            $penalty=0.12;
                        break;
                        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                            $penalty=0.14;
                        break;
                        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                            $penalty=0.16;
                        break;
                        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                            $penalty=0.18;
                        break;
                        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                            $penalty=0.20;
                        break;
                        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                            $penalty=0.22;
                        break;
                        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                            $penalty=0.24;
                        break;
                    }

                    //========================================================================discount for 1 year


                    switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $discount=0.15;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $penalty=0;
                        $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = (($AV1/2) * $discount);
                        $subtotal_penalty = $subtotal_penalty + 0;
                        $subtotal_discount = $subtotal_discount + ($av_discount * 4);
                        break;
    
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $penalty=0;
                        $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + 0;
                        $subtotal_discount = $subtotal_discount + ($av_discount * 4);
                        break;
    
                        case (($currentDate >=$Feb16) && ($currentDate <=$Mar31)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $penalty=0;
                        $SEFq1=$AV1 / 2;
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + 0;
                        $subtotal_discount = $subtotal_discount + ($av_discount * 3);
                        break;
    
                        case (($currentDate >=$Apr1) && ($currentDate <=$May15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty);
                        $subtotal_discount = $subtotal_discount + ($av_discount * 3);
                        break;
    
                        case (($currentDate >=$May16) && ($currentDate <=$Jun30)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2;
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty);
                        $subtotal_discount = $subtotal_discount + ($av_discount * 2);
                        break;
    
                        case (($currentDate >=$Jul1) && ($currentDate <=$Aug15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
                        $subtotal_discount = $subtotal_discount + ($av_discount * 2);
                        break;
    
                        case (($currentDate >=$Aug16) && ($currentDate <=$Sep30)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq3=$AV1 / 2;
                        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
                        $subtotal_discount = $subtotal_discount + ($av_discount);
                        
                        break;
    
                        case (($currentDate >=$Oct1) && ($currentDate <=$Nov15)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+($av_penalty);
                        $SEFq2=$AV1 / 2+($av_penalty);
                        $RPTq3=$AV1 / 2+($av_penalty);
                        $RPTq4=$AV1 / 2 - ($av_discount);
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 3);
                        $subtotal_discount = $subtotal_discount + ($av_discount);
                        
                        break;
    
                        case (($currentDate >=$Nov16) && ($currentDate <=$Dec31)):
                            $discount=0.10;
                            $av_discount = ($AV1 / 2) * $discount;
                            $av_penalty = ($AV1 / 2) * $penalty;
                        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq3=$AV1 / 2+(($AV1 / 2) * $penalty);
                        $RPTq4=$AV1 / 2;
                        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
                        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 4);
                        $subtotal_discount = $subtotal_discount + 0;
                        break;
    
                        default:
                            break;
                    }

                    //========================================================================END penalty for 1 year
                    //echo "paidss";
                    break;

                    case 1: switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $penalty=0.26;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                            $penalty=0.28;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                            $penalty=0.30;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                            $penalty=0.32;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$May1) && ($currentDate <=$May31)):
                            $penalty=0.34;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                            $penalty=0.36;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                            $penalty=0.38;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                            $penalty=0.40;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                            $penalty=0.42;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                            $penalty=0.44;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                            $penalty=0.46;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                            $penalty=0.48;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                    }




                    //echo "paidss";
                    break;

                    case 2: switch(true) {
                        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
                            $penalty=0.50;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Feb1) && ($currentDate <=$Feb29)):
                            $penalty=0.52;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Mar1) && ($currentDate <=$Mar31)):
                            $penalty=0.54;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
                            $penalty=0.56;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$May1) && ($currentDate <=$May31)):
                            $penalty=0.58;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
                            $penalty=0.60;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
                            $penalty=0.62;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
                            $penalty=0.64;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
                            $penalty=0.66;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
                            $penalty=0.68;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
                            $penalty=0.70;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
                            $penalty=0.72;
                        $SEF_penalty=($AV1 * $penalty)+$AV1;
                        $RPT_penalty=($AV1 * $penalty)+$AV1;
                        $total=($SEF_penalty + $RPT_penalty);
                        $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                        $subtotal_discount = $subtotal_discount + 0 ;
                        break;
                    }

                    //echo "paidss";
                    break;
                    default: $penalty=0.72;
                    $SEF_penalty=($AV1 * $penalty)+$AV1;
                    $RPT_penalty=($AV1 * $penalty)+$AV1;
                    $total=($SEF_penalty + $RPT_penalty);
                    $subtotal_penalty = $subtotal_penalty + (($AV1 * $penalty) * 2);
                    $subtotal_discount = $subtotal_discount + 0 ;

                    break;
                }

                //end of switch case
                $RPT=$RPT+$AV1;
                $_SESSION['SEF_RPT']=$RPT;
                $totalAll=(round($totalAll+$total,2));
                $_SESSION['totalAll']=$totalAll;
            }

            //end of for loop
        }

    }

    //end of isset

}



else  {

    switch(true) {

        case (($currentDate >=$Apr1) && ($currentDate <=$Apr30)):
            $penalty=0.08;
        break;
        case (($currentDate >=$May1) && ($currentDate <=$May31)):
            $penalty=0.10;
        break;
        case (($currentDate >=$Jun1) && ($currentDate <=$Jun30)):
            $penalty=0.12;
        break;
        case (($currentDate >=$Jul1) && ($currentDate <=$Jul31)):
            $penalty=0.14;
        break;
        case (($currentDate >=$Aug1) && ($currentDate <=$Aug31)):
            $penalty=0.16;
        break;
        case (($currentDate >=$Sep1) && ($currentDate <=$Sep30)):
            $penalty=0.18;
        break;
        case (($currentDate >=$Oct1) && ($currentDate <=$Oct31)):
            $penalty=0.20;
        break;
        case (($currentDate >=$Nov1) && ($currentDate <=$Nov30)):
            $penalty=0.22;
        break;
        case (($currentDate >=$Dec1) && ($currentDate <=$Dec31)):
            $penalty=0.24;
        break;
    }

    //========================================================================discount for 1 year


    switch(true) {
        case (($currentDate >=$Jan1) && ($currentDate <=$Jan31)):
            $discount=0.15;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $penalty=0;
        $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = (($AV1/2) * $discount);
        $subtotal_penalty = $subtotal_penalty + 0;
        $subtotal_discount = $subtotal_discount + ($av_discount * 4);
        break;

        case (($currentDate >=$Feb1) && ($currentDate <=$Feb15)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $penalty=0;
        $SEFq1=$AV1 / 2 - (($AV1 / 2) * $discount);
        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + 0;
        $subtotal_discount = $subtotal_discount + ($av_discount * 4);
        break;

        case (($currentDate >=$Feb16) && ($currentDate <=$Mar31)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $penalty=0;
        $SEFq1=$AV1 / 2;
        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + 0;
        $subtotal_discount = $subtotal_discount + ($av_discount * 3);
        break;

        case (($currentDate >=$Apr1) && ($currentDate <=$May15)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
        $SEFq2=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + ($av_penalty);
        $subtotal_discount = $subtotal_discount + ($av_discount * 3);
        break;

        case (($currentDate >=$May16) && ($currentDate <=$Jun30)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
        $SEFq2=$AV1 / 2;
        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + ($av_penalty);
        $subtotal_discount = $subtotal_discount + ($av_discount * 2);
        break;

        case (($currentDate >=$Jul1) && ($currentDate <=$Aug15)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
        $RPTq3=$AV1 / 2 - (($AV1 / 2) * $discount);
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
        $subtotal_discount = $subtotal_discount + ($av_discount * 2);
        break;

        case (($currentDate >=$Aug16) && ($currentDate <=$Sep30)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
        $RPTq3=$AV1 / 2;
        $RPTq4=$AV1 / 2 - (($AV1 / 2) * $discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 2);
        $subtotal_discount = $subtotal_discount + ($av_discount);
        
        break;

        case (($currentDate >=$Oct1) && ($currentDate <=$Nov15)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $SEFq1=$AV1 / 2+($av_penalty);
        $SEFq2=$AV1 / 2+($av_penalty);
        $RPTq3=$AV1 / 2+($av_penalty);
        $RPTq4=$AV1 / 2 - ($av_discount);
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 3);
        $subtotal_discount = $subtotal_discount + ($av_discount);
        
        break;

        case (($currentDate >=$Nov16) && ($currentDate <=$Dec31)):
            $discount=0.10;
            $av_discount = ($AV1 / 2) * $discount;
            $av_penalty = ($AV1 / 2) * $penalty;
        $SEFq1=$AV1 / 2+(($AV1 / 2) * $penalty);
        $SEFq2=$AV1 / 2+(($AV1 / 2) * $penalty);
        $RPTq3=$AV1 / 2+(($AV1 / 2) * $penalty);
        $RPTq4=$AV1 / 2;
        $total=($SEFq1 + $SEFq2 + $RPTq3 + $RPTq4);
        $subtotal_penalty = $subtotal_penalty + ($av_penalty * 4);
        $subtotal_discount = $subtotal_discount + 0;
        break;

        default:
            break;
    }
    $RPT=$RPT+$AV1;
    $_SESSION['SEF_RPT']=$RPT;
    $totalAll=(round($totalAll+$total,2));
    $_SESSION['totalAll']=round($totalAll,2);
}