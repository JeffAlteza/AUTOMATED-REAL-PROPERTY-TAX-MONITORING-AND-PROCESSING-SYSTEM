<?php 

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
$declaration_no = $_SESSION['TD_ARPS'];
//echo $declaration_no;
$currentYear = date('Y');
//$currentYear=2020;
//$currentDate = date('m-d',  strtotime("01/10"));
require 'connection.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql3 = ("SELECT * FROM payment_history WHERE TD_ARP = '".$declaration_no."' ORDER BY LAST_PAYMENT DESC limit 1");
$result3 = mysqli_query($con, $sql3);



if ($result3->num_rows>0){
    if($row3 = $result3-> fetch_assoc()){
        $latestPayment= $row3['LAST_PAYMENT'];
        $yearDifference =$currentYear - $latestPayment ;
        //echo $yearDifference;
        $_SESSION['latest_payment'] = $latestPayment+1;
    }




$penaltys=0;
if(isset($_POST['proceed_button'] ))
{
    if (isset($_POST['latestPaymentselect']) && isset($_POST['rangePaymentselect'])) {
        $selYears = $_POST['latestPaymentselect'];
        $selRange = $_POST['rangePaymentselect'];
    }

    //$selYear =   $_SESSION['SEL_YEAR'];
    //$selRange =   $_SESSION['SEL_RANGE'];

//echo $selYear;
//echo $selRange;
if ($selYear == $latestPayment+1 && $selRange == 0) { //year only
   // echo $selYear; echo '123'; 
    $yearDifference = $currentYear - $selYear;
    switch($yearDifference){
        case 0:
        //========================================================================discount for 1 year
        
        
        switch(true){
            case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';

                    break;
            
            case (($currentDate >= $Feb1) && ($currentDate <= $Feb15)):

                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';

                break;
            
            case (($currentDate >= $Feb16) && ($currentDate <= $Mar31)):

                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.$SEFq1.'</td>
                <td>'.$penalty.'</td>
                <td>'.$SEFq1.'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';

                break;
            
            case (($currentDate >= $Apr1) && ($currentDate <= $May15)):

                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';
                break;
            case (($currentDate >= $May16) && ($currentDate <= $Jun30)):

                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$SEFq2.'</td>
                <td>0</td>
                <td>'.$SEFq2.'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';
                break;
            
            case (($currentDate >= $Jul1) && ($currentDate <= $Aug15)):
                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';
                break;
            
            case (($currentDate >= $Aug16) && ($currentDate <= $Sep30)):
                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.$RPTq3.'</td>
                <td>0</td>
                <td>'.$RPTq3.'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';

                break;
            
            case (($currentDate >= $Oct1) && ($currentDate <= $Nov15)):
                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
               ';
                

                break;
            
            case (($currentDate >= $Nov16) && ($currentDate <= $Dec31)):

                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.$RPTq4.'</td>
                <td>0</td>
                <td>'.$RPTq4.'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                ';

                break;
            
            default:
            break;
            }//========================================================================END penalty for 1 year
            //echo "paidss";
            break;
        
        case 1: 
            switch(true){
                case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                    $penaltys= 0.26;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                        break;
                
                case (($currentDate >= $Feb1) && ($currentDate <= $Feb29)):
                    $penaltys= 0.28;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penalty.'</td>
                    <td>'.($AV1 * $penalty).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                    break;
                
                case (($currentDate >= $Mar1) && ($currentDate <= $Mar31)):
                    $penaltys= 0.30;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                    break;
                
                case (($currentDate >= $Apr1) && ($currentDate <= $Apr30)):
                    $penaltys= 0.32;
            echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $May1) && ($currentDate <= $May31)):
                    $penaltys= 0.34;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $Jun1) && ($currentDate <= $Jun30)):
                    $penaltys= 0.36;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $Jul1) && ($currentDate <= $Jul31)):
                    $penaltys= 0.38;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                    break;
                
                case (($currentDate >= $Aug1) && ($currentDate <= $Aug31)):
                    $penaltys= 0.40;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $Sep1) && ($currentDate <= $Sep30)):
                    $penaltys= 0.42;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                    case (($currentDate >= $Oct1) && ($currentDate <= $Oct31)):
                        $penaltys= 0.44;
                        echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;

                        case (($currentDate >= $Nov1) && ($currentDate <= $Nov30)):
                            $penaltys= 0.46;
                            echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                            break;

                            case (($currentDate >= $Dec1) && ($currentDate <= $Dec31)):
                                $penaltys= 0.48;
                                echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                                break;



                default:
                break;
                }
                break;
        case 2: 
            switch(true){
                case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                    $penaltys= 0.50;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                        break;
                
                case (($currentDate >= $Feb1) && ($currentDate <= $Feb29)):
                    $penaltys= 0.52;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penalty.'</td>
                    <td>'.($AV1 * $penalty).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                    break;
                
                case (($currentDate >= $Mar1) && ($currentDate <= $Mar31)):
                    $penaltys= 0.54;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                    break;
                
                case (($currentDate >= $Apr1) && ($currentDate <= $Apr30)):
                    $penaltys= 0.56;
            echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $May1) && ($currentDate <= $May31)):
                    $penaltys= 0.58;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $Jun1) && ($currentDate <= $Jun30)):
                    $penaltys= 0.60;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $Jul1) && ($currentDate <= $Jul31)):
                    $penaltys= 0.62;
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                    break;
                
                case (($currentDate >= $Aug1) && ($currentDate <= $Aug31)):
                    $penaltys= 0.64;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                
                case (($currentDate >= $Sep1) && ($currentDate <= $Sep30)):
                    $penaltys= 0.66;
                    echo '
            <tbody>
            <tr>
            <td>'.$selYear.'</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            <tr>
            <td>SEF</td>
            <td>'.$AV1.'</td>
            <td>+'.$penaltys.'</td>
            <td>'.($AV1 * $penaltys).'</td>
            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
            </tr>
            
            </tbody>
            ';
                    break;
                    case (($currentDate >= $Oct1) && ($currentDate <= $Oct31)):
                        $penaltys= 0.68;
                        echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;

                        case (($currentDate >= $Nov1) && ($currentDate <= $Nov30)):
                            $penaltys= 0.70;
                            echo '
                    <tbody>
                    <tr>
                    <td>'.$selYear.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                            break;

                            case (($currentDate >= $Dec1) && ($currentDate <= $Dec31)):
                                $penaltys= 0.72;
                                echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                                break;



                default:
                break;
                }
            break;
         default:
        $penaltys =0.72;
                echo '
                <tbody>
                <tr>
                <td>'.$selYear.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
        break;
        }//end of switch case
        echo '<tfoot>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold;">
        TOTAL
        </td>
        <td style="font-weight: bold;"> ₱'.number_format($totalAll,2).'</td>
        </tr>
        </tfoot>';
    
} else if($selRange != 0 && $selRange != $currentYear && $selYear == $latestPayment +1) {//specific range only

    $currentYear1 = $currentYear;
    for ($i=$selYear; $i <= $selRange; $i++){
        $diff = $currentYear1- $i ;
        switch($diff){
            case 0:

                switch(true){
                    case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                            break;
                    
                    case (($currentDate >= $Feb1) && ($currentDate <= $Feb15)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                        break;
                    
                    case (($currentDate >= $Feb16) && ($currentDate <= $Mar31)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.$SEFq1.'</td>
                        <td>'.$penalty.'</td>
                        <td>'.$SEFq1.'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                       ';
        
                        break;
                    
                    case (($currentDate >= $Apr1) && ($currentDate <= $May15)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        break;
                    case (($currentDate >= $May16) && ($currentDate <= $Jun30)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$SEFq2.'</td>
                        <td>0</td>
                        <td>'.$SEFq2.'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Jul1) && ($currentDate <= $Aug15)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Aug16) && ($currentDate <= $Sep30)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.$RPTq3.'</td>
                        <td>0</td>
                        <td>'.$RPTq3.'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                        break;
                    
                    case (($currentDate >= $Oct1) && ($currentDate <= $Nov15)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        
        
                        break;
                    
                    case (($currentDate >= $Nov16) && ($currentDate <= $Dec31)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$selYear.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.$RPTq4.'</td>
                        <td>0</td>
                        <td>'.$RPTq4.'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                        break;
                    
                    default:
                    break;
                    }
                //========================================================================END penalty for 1 year
                //echo "paidss";
                break;
            
            case 1: 
                switch(true){
                    case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                        $penaltys= 0.26;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                            break;
                    
                    case (($currentDate >= $Feb1) && ($currentDate <= $Feb29)):
                        $penaltys= 0.28;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.($AV1 * $penalty).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Mar1) && ($currentDate <= $Mar31)):
                        $penaltys= 0.30;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Apr1) && ($currentDate <= $Apr30)):
                        $penaltys= 0.32;
                echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $May1) && ($currentDate <= $May31)):
                        $penaltys= 0.34;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jun1) && ($currentDate <= $Jun30)):
                        $penaltys= 0.36;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jul1) && ($currentDate <= $Jul31)):
                        $penaltys= 0.38;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Aug1) && ($currentDate <= $Aug31)):
                        $penaltys= 0.40;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Sep1) && ($currentDate <= $Sep30)):
                        $penaltys= 0.42;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                        case (($currentDate >= $Oct1) && ($currentDate <= $Oct31)):
                            $penaltys= 0.44;
                            echo '
                    <tbody>
                    <tr>
                    <td>'.$i.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                            break;

                            case (($currentDate >= $Nov1) && ($currentDate <= $Nov30)):
                                $penaltys= 0.46;
                                echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                                break;

                                case (($currentDate >= $Dec1) && ($currentDate <= $Dec31)):
                                    $penaltys= 0.48;
                                    echo '
                            <tbody>
                            <tr>
                            <td>'.$i.'</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            <tr>
                            <td>SEF</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            
                            </tbody>
                            ';
                                    break;



                    default:
                    break;
                    }
                    break;
            case 2: 
                switch(true){
                    case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                        $penaltys= 0.50;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                            break;
                    
                    case (($currentDate >= $Feb1) && ($currentDate <= $Feb29)):
                        $penaltys= 0.52;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.($AV1 * $penalty).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Mar1) && ($currentDate <= $Mar31)):
                        $penaltys= 0.54;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Apr1) && ($currentDate <= $Apr30)):
                        $penaltys= 0.56;
                echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $May1) && ($currentDate <= $May31)):
                        $penaltys= 0.58;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jun1) && ($currentDate <= $Jun30)):
                        $penaltys= 0.60;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jul1) && ($currentDate <= $Jul31)):
                        $penaltys= 0.62;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Aug1) && ($currentDate <= $Aug31)):
                        $penaltys= 0.64;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Sep1) && ($currentDate <= $Sep30)):
                        $penaltys= 0.66;
                        echo '
                <tbody>
                <tr>
                <td>'.$i.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                        case (($currentDate >= $Oct1) && ($currentDate <= $Oct31)):
                            $penaltys= 0.68;
                            echo '
                    <tbody>
                    <tr>
                    <td>'.$i.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                            break;

                            case (($currentDate >= $Nov1) && ($currentDate <= $Nov30)):
                                $penaltys= 0.70;
                                echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                                break;

                                case (($currentDate >= $Dec1) && ($currentDate <= $Dec31)):
                                    $penaltys= 0.72;
                                    echo '
                            <tbody>
                            <tr>
                            <td>'.$i.'</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            <tr>
                            <td>SEF</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            
                            </tbody>
                            ';
                                    break;



                    default:
                    break;
                    }
                break;
            default:

                        echo '
                        <tbody>
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.($AV1 * $penalty).'</td>
                        <td>'.(($AV1 * $penalty)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.($AV1 * $penalty).'</td>
                        <td>'.(($AV1 * $penalty)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';

                        
            break;
            }//end of switch case 
    }
    echo '<tfoot>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: bold;">
            TOTAL
            </td>
            <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
            </tr>
            </tfoot>';

} else if($currentYear == $selRange && $selYear == $latestPayment+1) {//whole range
    for($j=$latestPayment+1; $j<=$currentYear ;$j++){
        $yearDifferences =$currentYear - $j;
        switch($yearDifferences){
           case 0:

                switch(true){
                    case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                            break;
                    
                    case (($currentDate >= $Feb1) && ($currentDate <= $Feb15)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                        break;
                    
                    case (($currentDate >= $Feb16) && ($currentDate <= $Mar31)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$SEFq1.'</td>
                        <td>'.$penalty.'</td>
                        <td>'.$SEFq1.'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                       ';
        
                        break;
                    
                    case (($currentDate >= $Apr1) && ($currentDate <= $May15)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        break;
                    case (($currentDate >= $May16) && ($currentDate <= $Jun30)):
        
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$SEFq2.'</td>
                        <td>0</td>
                        <td>'.$SEFq2.'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Jul1) && ($currentDate <= $Aug15)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Aug16) && ($currentDate <= $Sep30)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.$RPTq3.'</td>
                        <td>0</td>
                        <td>'.$RPTq3.'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                        break;
                    
                    case (($currentDate >= $Oct1) && ($currentDate <= $Nov15)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>-'.$discount.'</td>
                        <td>'.(($AV1 / 2) * $discount).'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
                        
        
                        break;
                    
                    case (($currentDate >= $Nov16) && ($currentDate <= $Dec31)):
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq1.'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$SEFq2.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.($AV1 / 2).'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.(($AV1 / 2) * $penalty).'</td>
                        <td>'.$RPTq3.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>'.$RPTq4.'</td>
                        <td>0</td>
                        <td>'.$RPTq4.'</td>
                        <td>'.$RPTq4.'</td>
                        </tr>
                        </tbody>
                        ';
        
                        break;
                    
                    default:
                    break;
                    }
                //========================================================================END penalty for 1 year
       
                break;
            
            case 1: 
                switch(true){
                    case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                        $penaltys= 0.26;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                            break;
                    
                    case (($currentDate >= $Feb1) && ($currentDate <= $Feb29)):
                        $penaltys= 0.28;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.($AV1 * $penalty).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Mar1) && ($currentDate <= $Mar31)):
                        $penaltys= 0.30;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Apr1) && ($currentDate <= $Apr30)):
                        $penaltys= 0.32;
                echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $May1) && ($currentDate <= $May31)):
                        $penaltys= 0.34;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jun1) && ($currentDate <= $Jun30)):
                        $penaltys= 0.36;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jul1) && ($currentDate <= $Jul31)):
                        $penaltys= 0.38;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Aug1) && ($currentDate <= $Aug31)):
                        $penaltys= 0.40;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Sep1) && ($currentDate <= $Sep30)):
                        $penaltys= 0.42;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                        case (($currentDate >= $Oct1) && ($currentDate <= $Oct31)):
                            $penaltys= 0.44;
                            echo '
                    <tbody>
                    <tr>
                    <td>'.$j.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                            break;

                            case (($currentDate >= $Nov1) && ($currentDate <= $Nov30)):
                                $penaltys= 0.46;
                                echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                                break;

                                case (($currentDate >= $Dec1) && ($currentDate <= $Dec31)):
                                    $penaltys= 0.48;
                                    echo '
                            <tbody>
                            <tr>
                            <td>'.$j.'</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            <tr>
                            <td>SEF</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            
                            </tbody>
                            ';
                                    break;



                    default:
                    break;
                    }
                    break;
            case 2: 
                switch(true){
                    case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                        $penaltys= 0.50;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                            break;
                    
                    case (($currentDate >= $Feb1) && ($currentDate <= $Feb29)):
                        $penaltys= 0.52;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penalty.'</td>
                        <td>'.($AV1 * $penalty).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Mar1) && ($currentDate <= $Mar31)):
                        $penaltys= 0.54;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Apr1) && ($currentDate <= $Apr30)):
                        $penaltys= 0.56;
                echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $May1) && ($currentDate <= $May31)):
                        $penaltys= 0.58;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jun1) && ($currentDate <= $Jun30)):
                        $penaltys= 0.60;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Jul1) && ($currentDate <= $Jul31)):
                        $penaltys= 0.62;
                        echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                        break;
                    
                    case (($currentDate >= $Aug1) && ($currentDate <= $Aug31)):
                        $penaltys= 0.64;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                    
                    case (($currentDate >= $Sep1) && ($currentDate <= $Sep30)):
                        $penaltys= 0.66;
                        echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
                        break;
                        case (($currentDate >= $Oct1) && ($currentDate <= $Oct31)):
                            $penaltys= 0.68;
                            echo '
                    <tbody>
                    <tr>
                    <td>'.$j.'</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    <tr>
                    <td>SEF</td>
                    <td>'.$AV1.'</td>
                    <td>+'.$penaltys.'</td>
                    <td>'.($AV1 * $penaltys).'</td>
                    <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                    </tr>
                    
                    </tbody>
                    ';
                            break;

                            case (($currentDate >= $Nov1) && ($currentDate <= $Nov30)):
                                $penaltys= 0.70;
                                echo '
                        <tbody>
                        <tr>
                        <td>'.$j.'</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        <tr>
                        <td>SEF</td>
                        <td>'.$AV1.'</td>
                        <td>+'.$penaltys.'</td>
                        <td>'.($AV1 * $penaltys).'</td>
                        <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                        </tr>
                        
                        </tbody>
                        ';
                                break;

                                case (($currentDate >= $Dec1) && ($currentDate <= $Dec31)):
                                    $penaltys= 0.72;
                                    echo '
                            <tbody>
                            <tr>
                            <td>'.$j.'</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            <tr>
                            <td>SEF</td>
                            <td>'.$AV1.'</td>
                            <td>+'.$penaltys.'</td>
                            <td>'.($AV1 * $penaltys).'</td>
                            <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                            </tr>
                            
                            </tbody>
                            ';
                                    break;



                    default:
                    break;
                    }
                break;
            default:
            $penaltys =0.72;
                echo '
                <tbody>
                <tr>
                <td>'.$j.'</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$AV1.'</td>
                <td>+'.$penaltys.'</td>
                <td>'.($AV1 * $penaltys).'</td>
                <td>'.(($AV1 * $penaltys)+$AV1).'</td>
                </tr>
                
                </tbody>
                ';
    break;
            }//end of switch case
    }//end of for loop
    echo '<tfoot>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="font-weight: bold;">
    TOTAL
    </td>
    <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
    </tr>
    </tfoot>';
}//end of whole range

}//end of isset

}else{
    
        
        switch(true){
            case (($currentDate >= $Jan1) && ($currentDate <= $Jan31)):
                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';

                    break;
            
            case (($currentDate >= $Feb1) && ($currentDate <= $Feb15)):

                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';

                break;
            
            case (($currentDate >= $Feb16) && ($currentDate <= $Mar31)):

                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.$SEFq1.'</td>
                <td>'.$penalty.'</td>
                <td>'.$SEFq1.'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';

                break;
            
            case (($currentDate >= $Apr1) && ($currentDate <= $May15)):

                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';
                break;
            case (($currentDate >= $May16) && ($currentDate <= $Jun30)):

                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.$SEFq2.'</td>
                <td>0</td>
                <td>'.$SEFq2.'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';
                break;
            
            case (($currentDate >= $Jul1) && ($currentDate <= $Aug15)):
                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';
                break;
            
            case (($currentDate >= $Aug16) && ($currentDate <= $Sep30)):
                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.$RPTq3.'</td>
                <td>0</td>
                <td>'.$RPTq3.'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';

                break;
            
            case (($currentDate >= $Oct1) && ($currentDate <= $Nov15)):
                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>-'.$discount.'</td>
                <td>'.(($AV1 / 2) * $discount).'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';
                

                break;
            
            case (($currentDate >= $Nov16) && ($currentDate <= $Dec31)):

                echo '
                <tbody>
                <tr>
                <td>'.$currentYear.'</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq1.'</td>
                </tr>
                <tr>
                <td>SEF</td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$SEFq2.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.($AV1 / 2).'</td>
                <td>+'.$penalty.'</td>
                <td>'.(($AV1 / 2) * $penalty).'</td>
                <td>'.$RPTq3.'</td>
                </tr>
                <tr>
                <td></td>
                <td>'.$RPTq4.'</td>
                <td>0</td>
                <td>'.$RPTq4.'</td>
                <td>'.$RPTq4.'</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                TOTAL
                </td>
                <td style="font-weight: bold;">₱'.number_format($totalAll,2).'</td>
                </tr>
                </tfoot>';

                break;
            
            default:
            break;
            }
}