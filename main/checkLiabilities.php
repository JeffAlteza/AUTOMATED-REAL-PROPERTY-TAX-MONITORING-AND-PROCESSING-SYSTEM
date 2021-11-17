<?php


if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
require 'connection.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$declaration_no = $_SESSION['TD_ARPS'];
//$currentYears =2020;
$currentYears = date('Y');
$sql3 = ("SELECT * FROM payment_history WHERE TD_ARP = '".$declaration_no."' ORDER BY LAST_PAYMENT DESC limit 1");
$result3 = mysqli_query($con, $sql3);




if ($result3->num_rows>0){
    if($row3 = $result3-> fetch_assoc()){
        
        $latestPayment= $row3['LAST_PAYMENT'];
        
        $yearDifference =$currentYears - $latestPayment ;
        //echo $yearDifference;
        $_SESSION['latest_payment'] = $latestPayment+1;
    }   
    
    if ($latestPayment != $currentYears){
        echo'<form method="POST" id="Year_Selected">
          <div style="background-color:#f8d7da;font-weight: 400; font-size: 12px; padding: 10px 10px 8px 10px" class="alert alert-sm d-flex align-items-center" role="alert">
          <div class="container-fluid row px-0 mx-0">
          <div class="col-lg-8 col-md-6 col-sm-12">
            <p class="d-flex align-items-center my-2" style="padding: 0px; margin: 0px;">Liabilities:  ';
        $latestPayment1 = $latestPayment +1;
        for($k=$latestPayment+1; $k<=$currentYears ;$k++){
            echo $k;
            echo ", ";
            
                }
                echo '
                
                You can select year range you want to pay. </p></div>';
                echo '
                <div class="col-lg-2 col-sm-12 my-1 mx-0 d-flex align-items-center">
                <select class="custom-select" style="height: 30px;" name="latestPaymentselect"  id="latestPaymentselect">
                
                <option selected>'.$latestPayment1.'</option>'
                ;
                
                for($k=$latestPayment+2; $k<=$currentYears ;$k++){
                echo '
                    <option value="'.$k.'">'.$k.'</option>';
                }
                echo '</select> </div>';

                echo '
                <div class="col-lg-2  col-sm-12 mx-0 d-flex align-items-center">
                <select class="custom-select" style="height: 30px;" name="rangePaymentselect" id="rangePaymentselect">
                <option selected value="0">Year</option>';
                for($j=$latestPayment+2; $j<=$currentYears ;$j++){
                echo '
                    <option value="'.$j.'">'.$j.'</option>';
                }
                echo '</select> </div>';
               
echo'   </form>
</div>
                </div>
               
                ';
              
               
               

    }   
    
 
} 

else {

    echo'
    <div style="background-color:#ffe5d0; font-weight: 400; font-size: 12px; padding: 5px"class="alert alert-sm d-flex align-items-center" role="alert">
        <div class="container-fluid row mx-0 px-0">
        <div class="col-lg-2 col-md-3">                                               
    <button type="button" style ="background-color: #3d8bfd;"class="btn btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#addHistory">Add </button>
    </div>
    <div class="col-lg-10 col-md-9">
    <p class="d-flex align-items-center my-2" style="padding: 0px; margin: 0px;">This button is for adding old payment record. Please use this to migrate old records.</p>
     </div>
  </div>
</div>   '; 
}

?>
<script>
function getselectedYear() {

    var select_container = document.getElementById('latestPaymentselect');
    var selected = select_container.options[select_container.selectedIndex].value;


    var select_range = document.getElementById('rangePaymentselect');
    var selected_range = select_range.options[select_range.selectedIndex].value;

    $.ajax({
            url: "try1.php",
            type: "post",
            async: true,
            data: {
                selected: selected,
                selected_range: selected_range
            },
            success: function(data) {
                //$('#pay').attr("disabled", false);
                alert(selected);
                alert(selected_range);
                $('#pay').trigger('click');




            },
            fail: function(data) {

            },
        }

    );
}

/*
                function sel(){
    var yr = $('#latestPaymentselect').val();
    var rg = $('#rangePaymentselect').val();
}*/
</script>

<?php
/*
$year="<script>document.getElementById(yr);</script>";
$_SESSION['SEL_YEAR']=$year;

$rnge="<script>document.getElementById(rg);</script>";
$_SESSION['SEL_RANGE']=$rnge;
*/
?>