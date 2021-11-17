<?php

use Phppot\Member;

if (!empty($_POST["forgot-btn"])) {
	require_once __DIR__ . '/Model/Member.php';
	$member = new Member();
	$displayMessage = $member->handleForgot();
}
?>
<HTML>

<HEAD>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<TITLE>Forgot Password</TITLE>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link href="../../assets/css/material-dashboard.css" rel="stylesheet" />
	<link rel="stylesheet" href="../../css/animate.css">
	<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<style>

</style>

<BODY>

	<div class="wrapper ">
		<form name="login" action="" method="post" onsubmit="return loginValidation()">
			<?php
			if (!empty($displayMessage["status"])) {
				if ($displayMessage["status"] == "error") {
			?>

					<div class="modal fade" id="checkEmail" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Notice</h5>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
										<center>
											<div class="server-response error-msg"><?php echo $displayMessage["message"]; ?></div>
										</center>
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

					<div class="modal fade" id="checkEmail" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Notice</h5>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
										<center>
											<div class="server-response success-msg"><?php echo $displayMessage["message"]; ?></div>
										</center>
									</h5>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

			<?php
				}
			}
			?>
			<div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
						<div class="col-sm-12 col-lg-4 col-md-6">
				<div class="card">

					<div class="card-header">
						<h5> Forgot Password <h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-sm-12 mb-3">
								<label for="username" style="font-weight: normal; font-size: 13px; margin-bottom: 0px" class="form-label">Username<span class="required error" id="username-info"></span></label>
								<input class="form-control" type="text" name="username" id="username" require>
							</div>
						</div>


						<div class="row d-flex justify-content-end">
							<div class="col-lg-4 col-sm-12">
								<button type="submit" name="forgot-btn" id="forgot-btn" value="Forgot Password" class="btn btn-success btn-block">CONFIRM</button>
							</div>
	
		</div>
	</div>
	</div>

	</div>
	
	</div>
	</div>
	</form>

	<script>
		$(document).ready(function() {
			$('#checkEmail').modal('show');

		});

		function loginValidation() {
			var valid = true;
			$("#username").removeClass("error-field");
			var UserName = $("#username").val();
			$("#username-info").html("").hide();

			if (UserName.trim() == "") {
				$("#username-info").html(" required.").css("color", "#ee0000").show();
				$("#username").addClass("error-field");
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