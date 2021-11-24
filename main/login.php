
<?php
include 'connection.php';
$error_msg = "";
session_start();
if(isset($_POST['login'])){
  $user = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
  $pass = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  $status = 'ACTIVE';
  $pass = md5($pass);
  $sql  = "SELECT * FROM accounts where Username=? and Password=? and status=?";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt,'sss',$user,$pass, $status);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_num_rows($result);
  $res = mysqli_fetch_assoc($result); 
  
  if($row == 1){
    $_SESSION['login'] = $res['FirstName'];
    $_SESSION['fullname'] = $res['FirstName'] ." ". $res['lastName'];
    $_SESSION['f_name'] = $res['FirstName'];
    $_SESSION['role'] = $res['priv'];
    $_SESSION['id_number'] = $res['ID'];
    $_SESSION['password'] = $res['Password'];


  }else{
    $error_msg = "Invalid Username or Password";
  }
  
}


if(isset($_SESSION['login'])){
  header("location: dashboard.php");
}
?>



<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <!-- Material Kit CSS -->
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
</head>


<style>
    .login,
.image {
  min-height: 600px;
}

.bg-image {
  background-image: url('../images/tax.jpg');
  background-size: cover;
  background-position: center center;
}
  </style>
  </head>

<body>
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
<form class="container col-xl-10 px-0 mx-auto shadow rounded" style="background-color:white; height: 600px;" 
    method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="container-fluid ">
    <div class="row no-gutter ">
        <!-- The image half -->
        
        <div class="col-md-7 d-none d-md-flex bg-image rounded-left">
        </div>


        <!-- The content half -->
        <div class="col-md-5 " sys_get_temp_dir>
            <div class="login d-flex align-items-center  py-2">

                <!-- Demo content-->
                <div class="container ">
                    <div class="row">
                        <div class="text-center">
                           <a href="../homepage\public\index.html"> <img src="../images/icon.png" alt="computer icon" /> </a>
                            </div>

                            <div class="col-12 text-center">
                            <h5 class="mb-0" style="font-size: 35px">My Account</h5>
                            <p style="font-size: 14px" class="text-muted mb-3">Sign in to your Account.</p>
                            </div>
                        <div class="col-lg-10 col-xl-10 mx-auto">

                         
                         
                            <form>
                                <div class="form-group">
                                <label for="inputEmail"   style="font-weight: normal; font-size: 13px; margin-bottom: 0px">Username</label>
                                    <input id="inputEmail" type="text" name="username" placeholder="Enter Username" required="" autofocus="" class="form-control">
                                    
                                  </div>
                                <div class="form-group ">
                                <label for="inputPassowrd"  style="font-weight: normal; font-size: 13px; margin-bottom: 0px">Password</label>
                                    <input id="inputPassword" type="password" name="password" placeholder="Enter Password" required="" class="form-control">
                                    
                                  </div>
                                  <?php if(isset($error_msg)){
                              echo '<span style="color:red; font-size: 12px">'.$error_msg.'</span>';
                            } ?>
                                <button type="submit" name="login" class="btn btn-success btn-block col-12 text-uppercase mb-1 rounded-0  shadow-sm">Sign in</button>
                                <div class="form-group mt-0 p-0 text-center">
                                  <a style="font-size: 12px; color: #6c757d;" class="" href="../res\forgot\forgot-password.php" id="forgotPass">Forgot Password? Click here</a>
                                  </div>
                             
                                                          
                            </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
</form>
</div>





  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>