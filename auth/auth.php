<?php
    include "../includes/inc_functions.php";
    $email = "";
    if(isset($_GET['crxauth'])){
        $realmail = base64_decode(base64_decode($_GET['crxauth']));
        if (!filter_var($realmail, FILTER_VALIDATE_EMAIL)) {
            header("location:../includes/logout.php");
        }
        $check = mysqli_query($conn, "SELECT * FROM clients WHERE email='$realmail'");
        $fetchdata = mysqli_fetch_array($check);
        if(mysqli_num_rows($check) < 1){
            header("Location:../includes/logout.php");
        }
        elseif ($fetchdata['email_verified'] == 'Y') {
          echo "<script>window.location.href='verify/index.php?verify=emVuc3VjZXNzZnVsbHl2ZXJpZmllZA3D3D';</script>";
        }
        else{
            echo "";
        }
    }
    else{
        header("Location:../includes/logout.php");
    }
?>

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
			<!--begin::Authentication - Signup Verify Email -->
			<div class="d-flex flex-column flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-row-fluid flex-column flex-column-fluid text-center p-10 py-lg-20">
					<!--begin::Logo-->
					<div>
					   <div id="hero_message" class="alert hiddenX"></div>
					</div>
					<a href="/jet-html-free/index.html" class="pt-lg-20 mb-12">
						<img alt="Logo" src="/jet-html-free/assets/media/logos/logo-default.svg" class="h-70px">
					</a>
					<!--end::Logo-->
					<!--begin::Logo-->
					<h1 class="fw-bolder fs-2qx text-gray-800 mb-7">Verify Your Email</h1>
					<!--end::Logo-->
					<!--begin::Message-->
					<div class="fs-3 fw-bold text-muted mb-10">We have sent an email to 
					<a href="#" class="link-primary fw-bolder"><?php echo $realmail; ?></a>
					<br>pelase follow a link to verify your email.</div>
					<!--end::Message-->
					<!--begin::Action-->
					<div class="text-center mb-10">
						<a href="signin.php" class="btn btn-md btn-primary fw-bolder">Return to sign in</a>
					</div>
					<!--end::Action-->
					<!--begin::Action-->
					<input type="hidden" value="<?php echo $realmail; ?>" id="rogers_user_mail">
					<div class="fs-5">
						<span class="fw-bold text-gray-700">Did’t receive an email?</span>
						<button class="link-primary fw-bolder" onsubmit="return false" id="resend_link" style="background-color: transparent; border: none;">Resend</button>
					</div>
					<!--end::Action-->
				</div>
				<!--end::Content-->
				<!--begin::Illustration-->
				<!--end::Illustration-->
			</div>
			<!--end::Authentication - Signup Verify Email-->
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

		<script type="text/javascript">
		  $(document).ready(function () {
		    var usermail = $("#rogers_user_mail").val();
		    var emailCheck = <?php echo json_encode($realmail); ?>;
		    $("#resend_link").click(function () {
		      if ($('#rogers_user_mail').val() == "") {
		        window.location.href ='../includes/logout.php';
		      }
		      else if ($('#rogers_user_mail').val() !== emailCheck) {
		        window.location.href ='../includes/logout.php';
		      }
		      else{
		        $.ajax({
		          url: "../includes/inc_functions.php",
		          method: "POST",
		          beforeSend: function () {
		            $("#resend_link").prop("disabled", true);
		            $("#resend_link").css("opacity","0.5");
		            $("#loader_checker").removeClass("hiddenX");
		          },
		          complete: function () {
		            $("#resend_link").prop("disabled", false);
		            $("#resend_link").css("opacity","1");
		            $("#loader_checker").addClass("hiddenX");
		          },
		          data: {usermail:usermail, "verifymail":"verifymail"},
		          success: function (e) {
		            if (e == "null") {
		                window.location.href ='../includes/logout.php';
		            }
		            else if (e == "mail_sent") {
		                $("#hero_message").html("Verification Mail Sent");
		                $("#hero_message").show();
		                $("#hero_message").addClass("alert-success");
		                setTimeout(function () {
		                    $("#hero_message").hide(500);
		                }, 5000)
		            }
		            else{
		              $("#hero_message").html(e);
		              $("#hero_message").show();
		              $("#hero_message").addClass("alert-warning");
		              setTimeout(function () {
		                  $("#hero_message").hide(500);
		              }, 5000)
		            }
		          }
		        })
		      }
		    })
		  })
		</script>
	</body>
</html>


