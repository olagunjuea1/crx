<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>CREAXUS</title>
		<link rel="canonical" href="Https://preview.keenthemes.com/jet-free" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/jet-html-free/assets/media/illustrations/sigma-1/14.png)">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="../index.php" class="mb-12">
						<img alt="Logo" src="assets/media/logo/creaxus.png" class="h-25px">
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-400px bg-white rounded shadow-sm px-5 py-10 px-lg-10 mx-auto">
						<!--begin::Form-->
						<div>
						   <div id="hero_message" class="alert hiddenX"></div>
						</div>							
						<form>
							<!--begin::Heading-->
							<div class="mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign in to your account</h1>
								<!--end::Title-->
								<!--end::Link-->
							</div>
							<!--end::Separator-->
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7 fv-plugins-icon-container">
								<label class="form-label fw-bolder text-dark fs-6">Account Number or Email</label>
								<input class="form-control form-control-lg form-control-solid input_validator" type="email" id="username" placeholder="" autocomplete="off">
							<div class="fv-plugins-message-container invalid-feedback"></div></div>
							<div class="fv-row mb-7 fv-plugins-icon-container">
								<label class="form-label fw-bolder text-dark fs-6">Password</label>
								<input class="form-control form-control-lg form-control-solid input_validator" type="password" id="password" placeholder="" autocomplete="off">
							<div class="fv-plugins-message-container invalid-feedback"></div></div>
							<!--end::Input group-->
							<div>
								<button type="button" id="pyauth" class="btn btn-md btn-primary" style="width: 100%;">
									<span class="indicator-label">Sign In</span>
								</button>
							</div>
							<!--end::Actions-->
							<div></div>
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--end::Footer-->
			</div>
		</div>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/widgets.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
		<script>
		  $(document).ready(function() {
		      $("#pyauth").click(function(e) {
		          var errors = false;
		          e.preventDefault();

		          var username = $("#username").val();
		          var password = $("#password").val();
		          

		          if (username == "" || password == "") {
		              errors = true;
		          }

		          if (!errors) {
		              if (username.length < 4) {
		                  errors = true;
		              }
		          }

		          if (!errors) {
		              if (password.length < 7 || password.length > 20) {
		                  errors = true;
		              }
		          }

		          if (errors) {		          	  
	               	  $("#hero_message").show();
	                  $("#hero_message").addClass("alert-warning");
	                  $("#hero_message").html("Please enter a valid Account Number and Password.");
		          }
		          else{
		            $.ajax({
		              url: "../includes/formdata.php",
		              method: "POST",
		              beforeSend: function () {
		                $("#pyauth").prop("disabled", true);
		                $("#loader_checker").removeClass("hiddenX");
		              },
		              complete: function () {
		                $("#pyauth").prop("disabled", false);
		                $("#loader_checker").addClass("hiddenX");
		              },
		              data: {username:username, password:password, "pysignin":"pysignin"},
		              success: function (e) {
		                var datasplit = e.split("|");
		                if (e == 1) {		          		  
	               	  	  $("#hero_message").show();
	                  	  $("#hero_message").addClass("alert-success");
	                  	  $("#hero_message").html("Login successful.");
		                  setTimeout( () => {
		                    window.open("../../secured/dashboard", "_self");
		                  }, 2000);
		                }
		                else if (datasplit[0] == 2) {
		          		  $("#hero_message").show();
		          	   	  $("#hero_message").addClass("alert-warning");
		          	   	  $("#hero_message").html("Email has not been verified.");
		                  setTimeout(function () {
		                      $("#hero_message").hide(500);
		                      window.location.href = datasplit[1];
		                  }, 2000);
		                }
		                else{
		          		  $("#hero_message").show();
		          	   	  $("#hero_message").addClass("alert-warning");
		          	   	  $("#hero_message").html(e);
		                }
		              }
		            })
		          }
		      });
		  });

		  //Keep the Log in button disbaled if any of the input field is empty
		  $('#username').keyup(function() {
		      validateInputs();
		  });

		  $('#password').keyup(function() {
		      validateInputs();
		  });

		  function validateInputs() {
		      var disableButton = false;

		      var val1 = $("#username").val();
		      var val2 = $("#password").val();


		      if (val1.length == 0 || val2.length < 7)
		          disableButton = true;

		      $('#pyauth').attr('disabled', disableButton);
		  }

		  $(document).ready(function() {
		      $('#password').bind("cut copy", function(e) {
		          e.preventDefault();

		          $('#password').bind("contextmenu", function(e) {
		              e.preventDefault();
		          });
		      });
		  });
		</script>
	</body>
	<!--end::Body-->
</html>


