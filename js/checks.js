function checks() {
	var username = $("#usersField").val();
	$(document).ready(function () {
		$.ajax({
			url: "check_username.php",
			type: "POST",
			data: {
				username: username
			},
			success: function (response) {
				if (username == "" || (document.getElementById("passField").value == "" && document.getElementById("passField1").value == "")) {
					$("#message").text("");
					document.getElementById("message2").innerHTML = "";
					document.getElementById("add_user_btn").disabled = false;
				} else {
					if (response == "success" && (document.getElementById("passField").value == document.getElementById("passField1").value)) {
						document.getElementById("message2").innerHTML = "Password Match";
						document.getElementById('message2').style.color = "green";
						$("#message").text("Username available");
						$("#message").css("color", "green");

						var passwordinput = document.getElementById("passField").value;
						var passwordinput1 = document.getElementById("passField1").value;
						if (passwordinput.length < 6 && passwordinput1.length < 6) {
							document.getElementById("message_3").innerHTML = "Password must be 6 characters minimum";
							document.getElementById('message_3').style.color = "red";
							document.getElementById("add_user_btn").disabled = true;
						} else if (passwordinput.search(/[A-Z]/) < 0 && passwordinput1.search(/[A-Z]/) < 0) {
							document.getElementById("message_3").innerHTML = "Password must have atleast one Upper case letter";
							document.getElementById('message_3').style.color = "red";
							document.getElementById("add_user_btn").disabled = true;

						} else if (passwordinput.search(/[a-z]/) < 0 && passwordinput1.search(/[a-z]/) < 0) {
							document.getElementById("message_3").innerHTML = "Password must have atleast one Lower case letter";
							document.getElementById('message_3').style.color = "red";
							document.getElementById("add_user_btn").disabled = true;

						} else {
							document.getElementById("add_user_btn").disabled = false;
							document.getElementById("message_3").innerHTML = "";
						}


					} else if (response == "fail" && (document.getElementById("passField").value == document.getElementById("passField1").value)) {
						document.getElementById("message2").innerHTML = "Password Matchqeqwewq";
						document.getElementById('message2').style.color = "green";
						$("#message").text("Username already taken.");
						$("#message").css("color", "red");
						document.getElementById("add_user_btn").disabled = true;
					} else if (response == "success" && (document.getElementById("passField").value != document.getElementById("passField1").value)) {
						document.getElementById("message2").innerHTML = "Password do not Match";
						document.getElementById('message2').style.color = "red";
						$("#message").text("Username available.");
						$("#message").css("color", "green");
						document.getElementById("add_user_btn").disabled = true;
					} else {
						document.getElementById("message2").innerHTML = "Password do not match";
						document.getElementById('message2').style.color = "red";
						$("#message").text("Username already taken.");
						$("#message").css("color", "red");
						document.getElementById("add_user_btn").disabled = true;

					}
				}
			}
		});

	});

}

function clear_input() {
	document.getElementById("fnamesField").value = '';
	document.getElementById("lnamesField").value = '';
	document.getElementById("usersField").value = '';
	document.getElementById("rolesField").value = '';
	document.getElementById("passField").value = '';
	document.getElementById("passField1").value = '';
	document.getElementById('message').innerHTML = '';
	document.getElementById('message2').innerHTML = '';
	document.getElementById('message_3').innerHTML = '';
}


function refresh() {
	location.reload();
}

function checkPASS() {
	var pass = document.getElementById("oldPass").value;
	$(document).ready(function () {
		$.ajax({
			url: "check_password.php",
			type: "POST",
			data: {
				pass: pass
			},
			success: function (response) {
				if (response == "fail") {
					document.getElementById("message4").innerHTML = "Old Password is incorrect";
					document.getElementById('message4').style.color = "red";
				} else if (response == "success") {
					document.getElementById("message4").innerHTML = " Old Password is correct";
					//document.getElementById('message4').style.color = "red";
				}
			}
		});

	});

}

function change_Pass() {
	$('#changepassmodal').modal('show');
}


