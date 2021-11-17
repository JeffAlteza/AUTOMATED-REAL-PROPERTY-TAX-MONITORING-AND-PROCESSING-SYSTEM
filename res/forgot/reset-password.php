<?php

use Phppot\PasswordReset;
use Phppot\Member;

 require_once __DIR__ . '/Model/PasswordReset.php';
$passwordReset = new PasswordReset();

if (empty($_GET["token"])) {
    // token not found so exit
    echo 'Invalid request!';
    exit();
} else {
    $token = $_GET["token"];
    // token found, let's validate it
    $memberRecord = $passwordReset->getMemberForgotByResetToken($token);
    if (empty($memberRecord)) {
        // token expired
        // do not say that your token has expired for security reasons
        // never reveal system state to the end user
        echo 'Invalid request!';
        exit();
    }
}
if (! empty($_POST["reset-btn"])) {
    $passwordReset->expireToken($token);
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    $displayMessage = $member->updatePassword($memberRecord[0]['member_id'], $_POST["password"]);
}
?>
<HTML>

<HEAD>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<TITLE>Reset Password</TITLE>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../../css/animate.css">
	<link href="../../assets/css/material-dashboard.css" rel="stylesheet" />
	<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>

<BODY>


	<?php
	if (!empty($displayMessage["status"])) {
		if ($displayMessage["status"] == "error") {
	?>
	
	<div class="modal fade" id="resetSuccess" tabindex="-1" aria-hidden="true">
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
            <center><div class="server-response error-msg"><?php echo $displayMessage["message"]; ?></div></center>
          </h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
			
		<?php
		} else if ($displayMessage["status"] == "success") {
		?>
			<div class="modal fade" id="resetSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
										<center> <div class="server-response success-msg"><?php echo $displayMessage["message"]; ?></div></center>
									</h5>
								</div>
								<div class="modal-footer">
									<a href="../../login.php" class="btn btn-success">Proceed to login</a>
								</div>
							</div>
						</div>
					</div>
			
	<?php
		}
	}
	?>


	<div class="wrapper ">

		<form name="reset-password" action="" method="post" onsubmit="return resetPasswordValidation()">
		
			<div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
						<div class="col-sm-12 col-lg-4 col-md-6">
				<div class="error-msg" id="error-msg"></div>
			
				<div class="card">
					<div class="card-header">
						<h5> New Password <h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<label for="password" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">New Password<span class="required error" id="forgot-password-info"></span></label>
								<input class="input-box-330 form-control mb-3" type="password" name="password" id="password">
							</div>
							<div class="col-12">
								<label for="confirm-password" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">Confirm Password<span class="required error" id="confirm-password-info"></span></label>
								<input class="input-box-330 form-control mb-3" type="password" name="confirm-password" id="confirm-password">
							</div>


						</div>
						<div class="row d-flex justify-content-end">
							<div class="col-md-4 col-sm-12">
								<button type="submit" class="btn btn-success btn-block" name="reset-btn" id="reset-btn" value="Reset Password">CONFIRM</button>
							</div>
						</div>
		</form>
	</div>
	</div>
	
	</div>

</div>
	</div>

		
	<div class="modal fade" id="resetFail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Failed</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
          <h5>
            <center>Both passwords must be the same. </center>
          </h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

	<script>
			$(document).ready(function() {
  $('#resetSuccess').modal('show');
});

		function resetPasswordValidation() {
			var valid = true;
			$("#password").removeClass("error-field");
			$("#confirm-password").removeClass("error-field");

			var Password = $('#password').val();
			var ConfirmPassword = $('#confirm-password').val();

			if (Password.trim() == "") {
				$("#forgot-password-info").html(" required.").css("color", "#ee0000").show();
				$("#password").addClass("error-field");
				valid = false;
			}
			if (ConfirmPassword.trim() == "") {
				$("#confirm-password-info").html(" required.").css("color", "#ee0000").show();
				$("#confirm-password").addClass("error-field");
				valid = false;
			}
			if (Password != ConfirmPassword) {
				$('#resetFail').modal('show');
				valid = false;
			}
			if (valid == false) {
				$('.error-field').first().focus();
				valid = false;
			}
			return valid;
		}
	</script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</BODY>

</HTML>