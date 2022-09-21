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
		<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
			<!--begin::Logo-->
			<a href="../index.php" class="mb-12">
				<img alt="Logo" src="assets/media/logo/creaxus.png" class="h-25px">
			</a>
			<!--end::Logo-->
			<!--begin::Wrapper-->
			<div class="w-lg-600px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto" id="section_top">
				<!--begin::Form-->
				<form>
					<!--begin::Heading-->
					<div class="mb-10 text-center">
						<!--begin::Title-->
						<h1 class="text-dark mb-3">Setup an Account</h1>
						<!--end::Title-->
						<!--end::Link-->
					</div>
					<div>
					   <div id="hero_message" class="alert hiddenX"></div>
					</div>
					<!--end::Separator-->
					<!--begin::Input group-->
					<div class="row fv-row mb-7 fv-plugins-icon-container">
						<!--begin::Col-->
						<div class="col-xl-6">
							<label class="form-label fw-bolder text-dark fs-6">First Name</label>
							<input class="form-control form-control-lg form-control-solid input_validator" type="text" id="firstname" placeholder="" autocomplete="off">
						<div class="fv-plugins-message-container invalid-feedback"></div></div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-xl-6">
							<label class="form-label fw-bolder text-dark fs-6">Last Name</label>
							<input class="form-control form-control-lg form-control-solid input_validator" type="text" id="lastname" placeholder="" autocomplete="off">
						<div class="fv-plugins-message-container invalid-feedback"></div></div>
						<!--end::Col-->
					</div>
					<!--end::Input group-->
					<!--begin::Input group-->
					<div class="fv-row mb-7 fv-plugins-icon-container">
						<label class="form-label fw-bolder text-dark fs-6">Email</label>
						<input class="form-control form-control-lg form-control-solid input_validator" type="email" id="email" placeholder="" autocomplete="off">
					<div class="fv-plugins-message-container invalid-feedback"></div></div>
					<div class="fv-row mb-7 fv-plugins-icon-container">
						<label class="form-label fw-bolder text-dark fs-6">Mobile</label>
						<input class="form-control form-control-lg form-control-solid input_validator" type="text" id="mobile" placeholder="" autocomplete="off">
					<div class="fv-plugins-message-container invalid-feedback"></div></div>
					<!--end::Input group-->
					<div class="row fv-row mb-7 fv-plugins-icon-container">
						<!--begin::Col-->
						<div class="col-xl-6">
							<label class="form-label fw-bolder text-dark fs-6">Date Of Birth</label>
							<input class="form-control form-control-lg form-control-solid input_validator" type="date" id="dob" placeholder="" autocomplete="off">
						<div class="fv-plugins-message-container invalid-feedback"></div></div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-xl-6">
							<label class="form-label fw-bolder text-dark fs-6">Address</label>
							<input class="form-control form-control-lg form-control-solid input_validator" type="text" id="address" placeholder="" autocomplete="off">
						<div class="fv-plugins-message-container invalid-feedback"></div></div>
						<!--end::Col-->
					</div>
					<!--begin::Input group-->
					<div class="mb-7 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
						<!--begin::Wrapper-->
						<div class="mb-1">
							<!--begin::Label-->
							<label class="form-label fw-bolder text-dark fs-6">Password</label>
							<!--end::Label-->
							<!--begin::Input wrapper-->
							<div class="position-relative mb-3">
								<input class="form-control form-control-lg form-control-solid input_validator" id="password" type="password" placeholder="" name="password" autocomplete="off">
								</span>
							</div>
						</div>
						<!--end::Wrapper-->
						<!--begin::Hint-->
						<div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
						<!--end::Hint-->
					</div>
					<div class="fv-row mb-10 fv-plugins-icon-container">
						<label class="form-label fw-bolder text-dark fs-6">Account Type</label>
						<input class="form-control form-control-lg form-control-solid input_validator" id="accounttype" placeholder="" autocomplete="off">
					</div>
					<!--end::Input group=-->
					<!--end::Input group-->
					<!--begin::Actions-->
					<div>
						<button type="button" id="pygetstarted" class="btn btn-md btn-primary" style="width: 100%;">
							<span class="indicator-label">Submit</span>
						</button>
					</div>
					<!--end::Actions-->
					<div></div>
				</form>
				<!--end::Form-->
			</div>
			<!--end::Wrapper-->
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
	</body>
	<!--end::Body-->
	<script type="text/javascript">
	   $(document).ready(function () {
	      var pyreturn = "";
	     $("#pygetstarted").click(function (e) {
	       e.preventDefault();
	       $(".input_validator").each(function () {
	         if ($(this).val() == "") {
	           $("#hero_message").html("All fields are required");
	           $("#hero_message").show();
	           $("#hero_message").addClass("alert-warning");
	           setTimeout(function () {
	               $("#hero_message").hide(500);
	           }, 7000);
	           $('html, body').animate({
	             scrollTop: $("#section_top").offset().top
	           }, 500); 

	           return pyreturn = false;           
	         }
	         else{
	           return pyreturn = true;
	         }
	       });
	       if (pyreturn == true) {
	         var firstname = $("#firstname").val();
	         var lastname = $("#lastname").val();
	         var email = $("#email").val();
	         var mobile = $("#mobile").val();
	         var dob = $("#dob").val();
	         var address= $("#address").val();
	         var password = $("#password").val();
	         var accounttype = $("#accounttype").val();

	         $.ajax({
	           url: "../includes/formdata.php",
	           method: "POST",
	           beforeSend: function () {
	             $("#pygetstarted").prop("disabled", true);
	             $("#loader_checker").removeClass("hiddenX");
	           },
	           complete: function () {
	             $("#pygetstarted").prop("disabled", false);
	             $("#loader_checker").addClass("hiddenX");
	           },
	           data: {firstname, lastname, email, mobile, dob, address, password, accounttype, "pysubmitform":"pysubmitform"},
	           success: function (e) {
	             console.log(e);
	             var fetchsplit = e.split('|');
	             if (fetchsplit[0] == 1) {
	               window.location.href = fetchsplit[1];
	             }
	             else{
	               $("#hero_message").html(e);
	               $("#hero_message").show();
	               $("#hero_message").addClass("alert-warning");
	               setTimeout(function () {
	                   $("#hero_message").hide(500);
	               }, 7000);
	               $('html, body').animate({
	                 scrollTop: $("#section_top").offset().top
	               }, 500); 
	             }
	           }
	         });
	       }
	     });
	   })
	</script>
</html>


