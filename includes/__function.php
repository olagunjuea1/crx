<?php 
  include 'inc_functions.php';
  $userid = $_SESSION['userid'];
  
  function fetchdataall($conn, $tbl, $data) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl`");
      if (mysqli_num_rows($qry) > 0) {
          $fetch = mysqli_fetch_array($qry);
          return $fetch[$data];
      }
      else{
          return "N/A";
      }
  } 
  function fetchdata($conn, $tbl, $tbl_key, $userid, $data) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid'");
      if (mysqli_num_rows($qry) > 0) {
          $fetch = mysqli_fetch_array($qry);
          return $fetch[$data];
      }
      else{
          return "N/A";
      }
  } 
  function fetchdatabalance($conn, $tbl, $tbl_key, $userid, $data) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid'");
      if (mysqli_num_rows($qry) > 0) {
          $fetch = mysqli_fetch_array($qry);
          return $fetch[$data];
      }
      else{
          return (int)0;
      }
  } 
  function fetchrownum($conn, $tbl, $tbl_key, $userid) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid'");
      return $qry->num_rows;
  } 
  function thousandsCurrencyFormat($num) {
      if($num > 100000000) {
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
          return $x_display;
      }
      return number_format($num, 2);
  }
  function thousandsCurrencyFormatb($num) {
      if($num > 1000) {
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
          return $x_display;
      }
      return number_format($num);
  }
  function check_cc($cc, $extra_check = false){
      $cards = array(
          "visa" => "(4\d{12}(?:\d{3})?)",
          "amex" => "(3[47]\d{13})",
          "jcb" => "(35[2-8][89]\d\d\d{10})",
          "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
          "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
          "mastercard" => "(5[1-5]\d{14})",
          "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
          "diners" => "(?:3(0[0-5]|[68]\d)\d{11})|(?:5[1-5]\d{14})"
      );
      $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch", "Diners");
      $matches = array();
      $pattern = "#^(?:".implode("|", $cards).")$#";
      $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
      if($extra_check && $result > 0){
          $result = (validatecard($cc))?1:0;
      }
      return ($result>0)?$names[sizeof($matches)-2]:false;
  }
  function check_cc_mc($cc, $extra_check = false){
      $cards = array(
          "mastercard" => "(5[1-5]\d{14})"
      );
      $names = array("Mastercard");
      $matches = array();
      $pattern = "#^(?:".implode("|", $cards).")$#";
      $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
      if($extra_check && $result > 0){
          $result = (validatecard($cc))?1:0;
      }
      return ($result>0)?$names[sizeof($matches)-2]:false;
  }
  function validate_cc($ccNum, $type = 'all', $regex = null) {

      $ccNum = str_replace(array('-', ' '), '', $ccNum);
      if (mb_strlen($ccNum) < 13) {
          return false;
      }

      if ($regex !== null) {
          if (is_string($regex) && preg_match($regex, $ccNum)) {
              return true;
          }
          return false;
      }

      $cards = array(
          'all' => array(
              'amex'      => '/^3[4|7]\\d{13}$/',
              'bankcard'  => '/^56(10\\d\\d|022[1-5])\\d{10}$/',
              'diners'    => '/^(?:3(0[0-5]|[68]\\d)\\d{11})|(?:5[1-5]\\d{14})$/',
              'disc'      => '/^(?:6011|650\\d)\\d{12}$/',
              'electron'  => '/^(?:417500|4917\\d{2}|4913\\d{2})\\d{10}$/',
              'enroute'   => '/^2(?:014|149)\\d{11}$/',
              'jcb'       => '/^(3\\d{4}|2100|1800)\\d{11}$/',
              'maestro'   => '/^(?:5020|6\\d{3})\\d{12}$/',
              'mc'        => '/^5[1-5]\\d{14}$/',
              'solo'      => '/^(6334[5-9][0-9]|6767[0-9]{2})\\d{10}(\\d{2,3})?$/',
              'switch'    =>
              '/^(?:49(03(0[2-9]|3[5-9])|11(0[1-2]|7[4-9]|8[1-2])|36[0-9]{2})\\d{10}(\\d{2,3})?)|(?:564182\\d{10}(\\d{2,3})?)|(6(3(33[0-4][0-9])|759[0-9]{2})\\d{10}(\\d{2,3})?)$/',
              'visa'      => '/^4\\d{12}(\\d{3})?$/',
              'voyager'   => '/^8699[0-9]{11}$/'
          ),
          'fast' =>
          '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/'
      );

      if (is_array($type)) {
          foreach ($type as $value) {
              $regex = $cards['all'][strtolower($value)];

              if (is_string($regex) && preg_match($regex, $ccNum)) {
                  return true;
              }
          }
      } elseif ($type === 'all') {
          foreach ($cards['all'] as $value) {
              $regex = $value;

              if (is_string($regex) && preg_match($regex, $ccNum)) {
                  return true;
              }
          }
      } else {
          $regex = $cards['fast'];

          if (is_string($regex) && preg_match($regex, $ccNum)) {
              return true;
          }
      }
      return false;
  }
  function time_elapsed_string($ptime){
      $etime = time() - $ptime;

      if ($etime < 1)
      {
          return '0 seconds';
      }

      $a = array( 365 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60  =>  'month',
                        24 * 60 * 60  =>  'day',
                              60 * 60  =>  'hour',
                                  60  =>  'minute',
                                    1  =>  'second'
                  );
      $a_plural = array( 'year'   => 'years',
                          'month'  => 'months',
                          'day'    => 'days',
                          'hour'   => 'hours',
                          'minute' => 'minutes',
                          'second' => 'seconds'
                  );

      foreach ($a as $secs => $str)
      {
          $d = $etime / $secs;
          if ($d >= 1)
          {
              $r = round($d);
              return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
          }
      }
  } 
  function validateCCExp($month, $date){
    $expiryMonth = "$month";
    $expiryYear = "$date";
    $timezone = new DateTimeZone('America/New_York');
    $expiryTime = \DateTime::createFromFormat(
      'm-y',
        $expiryMonth.'-'.$expiryYear,
        $timezone
    );
    $currentTime = new \DateTime('now', $timezone);

    if ($expiryTime < $currentTime) {
        return true;
    }
  }
  function cutoffpercent($amount){
    $numrand = array('1', '2', '3', '4');
    $countarry = count($numrand) - 1;
    $randarry = rand(0, $countarry);
    $arryval = $numrand[$randarry];

    $rand = rand(3, 10) / 10;
    if ($amount <= 40) {
      $xrand = rand(1, 10);
      return $amount - ($xrand / 100) * $amount;
    }
    elseif ($amount >= 1000 && $amount < 1000000) {
      $arryval = $numrand[$randarry];
    }
    elseif ($amount >= 1000000 && $amount < 1000000000) {
      $arryval = $numrand[$randarry]."00";
    } 
    elseif ($amount >= 1000000000 && $amount < 1000000000000) {
      $arryval = $numrand[$randarry]."000";
    }   
    return $calamoun = (($amount - $rand) - (rand() % 10) / 100) - $arryval;
  }
  function checkbalance($conn, $amount, $userid){
    $fetch_balance = mysqli_query($conn, "SELECT * FROM `account` WHERE `userid` = '$userid'");
    if (mysqli_num_rows($fetch_balance) > 0) {
      $fetch_data = mysqli_fetch_array($fetch_balance);
      if ($amount > $fetch_data["available_balance"]) {
        return false;
      }
      else{
        return true;
      }
    }
    else{
      return false;
    }
  }
  function debit_balance($conn, $amount, $sender_userid){
    $fetch_balance = mysqli_query($conn, "SELECT * FROM `account` WHERE `userid` = '$sender_userid'");
    if (mysqli_num_rows($fetch_balance) > 0) {
      $fetch_data = mysqli_fetch_array($fetch_balance);
      $amount_filter = preg_replace("/[^0-9]/", '', $amount);
      if (!preg_match('/^[0-9]*$/', $amount)) {
          return false;
      }
      elseif ($amount > $fetch_data["available_balance"]) {
        return false;
      }
      else{      
        $debit_balance = $fetch_data["total_balance"] - $amount;
        $debit_available_balance = $fetch_data["available_balance"] - $amount;
        $total_debit = $fetch_data["debit"] + $amount;

        mysqli_query($conn, "UPDATE `account` SET `total_balance`='$debit_balance',`available_balance`='$debit_available_balance',`debit`='$total_debit' WHERE `userid` = '$sender_userid'");
        if ($debit_available_balance) {
          return true;
        }
      }
    }
    else{
      return false;
    }
  }
  function credit_balance($conn, $amount, $receiver_userid){
    $fetch_balance = mysqli_query($conn, "SELECT * FROM `account` WHERE `userid` = '$receiver_userid'");
    if (mysqli_num_rows($fetch_balance) > 0) {
      $fetch_data = mysqli_fetch_array($fetch_balance);
      $amount_filter = preg_replace("/[^0-9]/", '', $amount);
      if (!preg_match('/^[0-9]*$/', $amount)) {
          return false;
      }
      else{      
        $credit_balance = $fetch_data["total_balance"] + $amount;
        $credit_available_balance = cutoffpercent($fetch_data["available_balance"] + $amount);
        $total_credit = $fetch_data["credit"] + $amount;

        mysqli_query($conn, "UPDATE `account` SET `total_balance`='$credit_balance',`available_balance`='$credit_available_balance',`credit`='$total_credit' WHERE `userid` = '$receiver_userid'");
        if ($credit_available_balance) {
          return true;
        }
      }
    }
    else{
      return false;
    }
  }
  if (isset($_POST['data_fetcher'])) {
      $totalbalance = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'total_balance'));
      $availablebalance = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'available_balance'));
      $credit = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'credit'));
      $debit = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'debit'));
      $firstname = ucfirst(fetchdata($conn, 'clients', 'email', $userid, 'firstname'));
      $lastname = ucfirst(fetchdata($conn, 'clients', 'email', $userid, 'lastname'));

      $data_credit = fetchdatabalance($conn, 'account', 'userid', $userid, 'credit');
      $data_debit = fetchdatabalance($conn, 'account', 'userid', $userid, 'debit');

      $data_credit_cut = thousandsCurrencyFormatb($data_credit);

      if ($data_credit > $data_debit) {
        $credit_debit_perval = $data_debit / $data_credit * 100;
        $data_name = "Payment Sent In";
        $data_val = "Credit";

        $data_a = thousandsCurrencyFormatb($data_debit);
        $data_b = thousandsCurrencyFormatb($data_credit);
      }
      elseif ($data_debit > $data_credit) {
        $credit_debit_perval = $data_credit / $data_debit * 100;
        $data_name = "Payment Sent Out";
        $data_val = "Debit";

        $data_a = thousandsCurrencyFormatb($data_credit);
        $data_b = thousandsCurrencyFormatb($data_debit);
      }
      elseif ($data_debit = $data_credit) {
        $credit_debit_perval = $data_credit / $data_debit * 100;
        $data_name = "Payment Sent Out";
        $data_val = "Debit";

        $data_a = thousandsCurrencyFormatb($data_credit);
        $data_b = thousandsCurrencyFormatb($data_debit);
      }
      else{
        $credit_debit_perval = 0;
        $data_name = "";
        $data_val = "";

        $data_a = thousandsCurrencyFormatb($data_credit);
        $data_b = thousandsCurrencyFormatb($data_debit);
      }

      $user_data = array('balance' => $totalbalance, 'available' => $availablebalance, 'credit' => $credit, 'debit' => $debit, 'firstname' => $firstname, 'lastname' => $lastname, 'credit_debit_per' => round($credit_debit_perval, 2), 'credit_debit_per_b' => round($credit_debit_perval), 'data_name' => $data_name, 'data_val' => $data_val, 'py_dataa' => $data_a, 'py_datab' => $data_b, 'data_credit_cut' => $data_credit_cut);

      echo json_encode($user_data);
  }
  function generaterandomnum($conn){
      $length = 12;
      $str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      $random_num = substr(str_shuffle($str), 0, $length);

      $keycheck = checkkeys($conn, $random_num);

      while ($keycheck == true) {
          $random_num = substr(str_shuffle($str), 0, $length);
          $keycheck = checkkeys($conn, $random_num);
      }

      return $random_num;
  }
  function generaterandomotp($conn){
      $length = 6;
      $str = "0123456789";
      $random_num = substr(str_shuffle($str), 0, $length);

      return $random_num;
  }
  if (isset($_POST['make_transfer'])) {
    $data_bsb = cleanstring($conn, $_POST['data_bsb']);
    $data_account_number = cleanstring($conn, $_POST['data_account_number']);
    $data_amount = cleanstring($conn, $_POST['data_amount']);
    $data_userid = $userid;

    $bsb_filter = preg_replace("/[^0-9]/", '', $data_bsb);
    $bsb_data_val = (string)$bsb_filter;
    $bsb_data_val_rev = strrev($bsb_data_val);
    $arr_bsb = str_split($bsb_data_val, "3");
    $new_bsb = implode("-", $arr_bsb);

    $filteramount = preg_replace("/[^0-9.]/", '', $data_amount);
    $filteracctnum = preg_replace("/[^0-9]/", '', $data_account_number);

    $me_bsb = explode(",", fetchdataall($conn, 'site_data', 'bsb'));

    $acctchecker = mysqli_query($conn, "SELECT * FROM `clients` WHERE `account_number` = '$data_account_number'");
    $personsl_acctchecker = mysqli_query($conn, "SELECT * FROM `clients` WHERE email = '$userid' AND `account_number` = '$data_account_number'");

    if (empty($data_bsb) || empty($data_account_number) || empty($data_amount) || empty($data_userid)) {
      echo "All fields are required";
    }
    elseif (strlen($bsb_filter) !== 6) {
      echo "Invalid BSB";
    }
    elseif (strlen($data_account_number) < 8 || strlen($data_account_number) > 10) {
      echo "Invalid Account Number";
    }
    elseif ($data_amount < 1) {
      echo "Invalid Amount";
    }
    elseif (!preg_match('/^\d+(\.\d{2})?$/', $data_amount)) {
      echo "Invalid Amount";
    }
    elseif (!check_bsb($new_bsb)) {
      echo "The BSB you entered does not exist in our database. Please try again";
    }
    elseif (!checkbalance($conn, $data_amount, $data_userid)) {
      echo "Insufficient fund";
    }
    elseif (!preg_match('/^[0-9]+$/', $data_account_number)) {
      echo "Invalid Account Number";
    } 
    elseif (in_array($new_bsb, $me_bsb) && mysqli_num_rows($personsl_acctchecker) > 0) {
      echo "You can't make a payment to this recipient.";
    }
    elseif (in_array($new_bsb, $me_bsb) && mysqli_num_rows($acctchecker) < 1) {
      echo "The ME Bank recipient account doesn't exists";
    }
    else{
      $tnx_id = generaterandomnum($conn);
      $full_date = date("d M, Y H:i:s");
      $data_tnx = date("M d, Y H:i:s");
      $day = strtoupper(date('D'));
      $month = strtoupper(date('M'));
      $year = date('Y');
      $tnx_data = $new_bsb.",".$filteracctnum;
      $otp = generaterandomotp($conn);

      $fetchtnxdata = fetchdata($conn, 'tnx_history', 'userid', $data_userid, 'transaction');

      if (!empty($fetchtnxdata)) {
        $withdrawdata = $tnx_id."--"."debit"."--".$tnx_data."--".$filteramount."--"."pending"."--".$data_tnx;
        $insertval = $fetchtnxdata.' => '.$withdrawdata;
      }
      else{
        $insertval = $tnx_id."--"."debit"."--".$tnx_data."--".$filteramount."--"."pending"."--".$data_tnx;
      }

      $insertqry = mysqli_query($conn, "UPDATE `tnx_history` SET `transaction`='$insertval' WHERE userid = '$data_userid'");

      $insert_transfer = mysqli_query($conn, "INSERT INTO `transact`(`userid`, `tnx_id`, `tnx_type`, `tnx_data`, `amount`, `status`, `key_day`, `key_month`, `key_year`, `otp`, `otp_verify`, `trn_date`) VALUES ('$data_userid', '$tnx_id', 'debit', '$tnx_data', '$filteramount', 'pending', '$day', '$month', '$year', '$otp', 'N', '$full_date')");

      if ($insert_transfer) {
        $title = "ME Bank Transfer";
        $message = "You have a AU&#36;".number_format($filteramount, 2)." transaction waiting, please check your email for an OTP to confirm your transaction.";
        $icon = "alert-circle-outline";
        $alert = "warning";
        notify($conn, $data_userid, $title, $message, $icon, $alert);

        $subject = "ME BANK OTP";
        $message ="<!DOCTYPE html> <html> <head> <title></title> </head> <body> </body> </html> <html lang='en' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0);background-color:#f7fcfa;height:100%;'><head> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta name='viewport' content='width=device-width, initial-scale=1'> <title>ME BANK</title> <meta name='description' content='ME BANK '> <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'> </head> <body style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;font-family:Montserrat,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#3a3434;height:100%;background-color:#d5efe4;display:table;width:100%;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-background-size:contain;-moz-background-size:contain;-o-background-size:contain;background-size:contain;'><div style='-webkit-box-sizing: border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width:auto;max-width:430px;padding:0 15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding-top:60px;padding-bottom:40px;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;position:relative;min-height:1px;padding-left:15px;padding-right:15px;width:100%;margin:0 auto;float:none;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'><h1 style='-webkit-box-sizing:border-box; -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:36px;text-align:center;font:34px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>Hi,<br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align: center;font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Please use the OTP code below to complete your transaction</p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>  <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;'></div> <h1 style='-webkit-box-sizing:border-box; -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:28px;text-align:center;font:28px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>$otp<br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1> </div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing:border-box;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:14px;margin-bottom:30px;padding-bottom:30px;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500. <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background-color:transparent;text-decoration:none;font-family:Montserrat,Arial,sans-serif;font-size:13px;color:#3a3434;'><u style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>Terms of use</u></a></p></div></div></div> </body></html>";
        $mail = mailer($mail, 'noreply@mecapital-au.com', $data_userid, $subject, $message);
        echo "1";
      }
      else{
        echo "System Error";
      }
    }
  }
  if (isset($_POST['getdata'])) {
    $fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `transact` WHERE `userid` = '$userid' ORDER BY id DESC LIMIT 1"));
    if ($fetch['status'] == 'pending' && $fetch['otp_verify'] == 'N') {
      echo "1".'-'.$fetch['tnx_id'];
    }
    else {
      echo "0";
    }
  }
  if (isset($_POST['fetch_data_otp'])) {
    $fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `transact` WHERE `userid` = '$userid' ORDER BY id DESC LIMIT 1"));
    $tnx_data_exp = explode(",", $fetch['tnx_data']);
    $bsb_data = fetch_bsb($tnx_data_exp[0]);

    if (!empty($bsb_data)) { ?>
        <tr>
          <td>BSB NUMBER</td>
          <td><?php echo $bsb_data[0]; ?></td>
        </tr>
        <tr>
          <td>Bank</td>
          <td><?php echo $bsb_data[1]; ?></td>
        </tr>
        <tr>
          <td>Branch</td>
          <td><?php echo $bsb_data[2]; ?></td>
        </tr>
        <tr>
          <td>Account Nmber</td>
          <td><?php echo $tnx_data_exp[1]; ?></td>
        </tr>   
    <?php }
    else{
      echo "The requested data does not exist in our database. Please try again";
    }
  }
  if (isset($_POST['py_submitOTP'])) {
    $data_otp = cleanstring($conn, $_POST['data_otp']);
    $userid;
    $otp_fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `transact` WHERE `userid` = '$userid' ORDER BY id DESC LIMIT 1"));
    $amount = $otp_fetch['amount'];
    if (empty($data_otp)) {
      echo "Enter OTP";
    }
    elseif (strlen($data_otp) !== 6) {
      echo "Invalid OTP";
    }
    elseif ($otp_fetch['otp'] !== $data_otp) {
      echo "Invalid OTP";
    }
    elseif (!checkbalance($conn, $amount, $userid)) {
      echo "Insufficient fund";
    }
    else{
      
      $transfer_lock_status = fetchdata($conn, 'clients', 'email', $userid, 'tnx_lock');

      if ($transfer_lock_status == 'on') {
        mysqli_query($conn, "UPDATE `transact` SET `otp_verify` = 'Y', `tnx_check` = 'locked' WHERE `userid` = '$userid' AND `otp` = '$data_otp'");

        $title = "Transfer Restricted";
        $message = "Your transfer of AU&#36;".number_format($amount, 2)." has been declined and transfer is currently on hold, message customer support to resolve this.";
        $icon = "error";
        $alert = "danger";
        notify($conn, $userid, $title, $message, $icon, $alert);

        $firstname_mail = ucfirst(fetchdata($conn, 'clients', 'email', $userid, 'firstname'));
        $mail_amount = number_format($amount, 2);
        $subject = "Transfer Restricted";
        $message = "<html lang='en' style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: sans-serif; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 10px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: #f7fcfa; height: 100%; '><head> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta name='viewport' content='width=device-width, initial-scale=1'> <title>ME</title> <meta name='description' content='ME '> <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'> </head> <body style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin: 0; font-family: Montserrat, Arial, sans-serif; font-size: 14px; line-height: 1.42857143; color: #3a3434; height: 100%; background-color: #efd5d59c; display: table; width: 100%; ' data-new-gr-c-s-check-loaded='14.1057.0' data-gr-ext-installed='> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; -webkit-background-size: contain; -moz-background-size: contain; -o-background-size: contain; background-size: contain;'> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin-right: auto; margin-left: auto; padding-left: 15px; padding-right: 15px; width: auto; max-width: 430px; padding: 0 15px;'> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 60px; padding-bottom: 40px;'></div> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding: 15px;'> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; width: 100%; margin: 0 auto; float: none;'> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: center;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 0; vertical-align: middle; display: block; max-width: 100%; height: auto; margin: 0 auto;'> <h1 style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin: 0.67em 0; font-family: Montserrat, Arial, sans-serif; line-height: 1.1; margin-bottom: 10px; font-size: 36px; text-align: center; font: 34px Montserrat, Arial, sans-serif; font-weight: bold; letter-spacing: -0.03em; color: #000; margin-top: 16px; '> Opps! transfer error<br style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;'> </h1> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: center; font-size: 16px; line-height: 150%; margin-top: 30px;'> <p style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin: 0 0 10px;'> Your account has been restricted from making transfers; to resolve this, send a message or contact ME support. </p> </div> <br style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;'> </div> </div> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin-bottom: 15px;'> <a href='mailto:support@mecapital-au.com' style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-decoration: none; display: inline-block; margin-bottom: 0; text-align: center; vertical-align: middle; touch-action: manipulation; cursor: pointer; background-image: none; border: 1px solid transparent; white-space: nowrap; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; padding: 10px 16px; border-radius: 6px; font: 16px Montserrat, Arial, sans-serif; letter-spacing: 0.004em; color: #fff; background-color: #000; border-color: #58595b; width: 100%; hieght: 48px; font-size: 16px; font-weight: bold; line-height: 150%; '> Message Support </a> </div> <br style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;'> <br style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;'> </div> <div style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: center; font-size: 14px; margin-bottom: 30px; padding-bottom: 30px;'> <p style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin: 0 0 10px;'> Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500. <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; background-color: transparent; text-decoration: none; font-family: Montserrat, Arial, sans-serif; font-size: 13px; color: #3a3434; '> <u style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;'>Terms of use</u> </a> </p> </div> </div> </div></body></html>";
        $mail = mailer($mail, 'noreply@mecapital-au.com', $userid, $subject, $message);

        echo "2".'|'.urlencode(base64_encode(base64_encode($otp_fetch['tnx_id'])));
      }
      else{
        if ($otp_fetch['status'] == 'pending' && $otp_fetch['otp_verify'] == 'N') {
        $me_bsb = explode(",", fetchdataall($conn, 'site_data', 'bsb'));

        $otptnx_data_exp = explode(",", $otp_fetch['tnx_data']);

        $fectch_data_tnx_sender = fetchdata($conn, 'tnx_history', 'userid', $userid, 'transaction');

        $status = 'success';
        
        function update_arry_tnx($arraydata, $status, $tnx_id_val){
          $txndatafetchtnx = explode(" => ", $arraydata);
          $data_output = "";
          for ($x=0; $x < count($txndatafetchtnx); $x++) { 
            $expdataval = explode("--", $txndatafetchtnx[$x]);
            if (trim($expdataval[0]) == $tnx_id_val) {
              $arryrep = array(4 => $status);
              $data_update = implode("--", array_replace($expdataval, $arryrep))." => ";
            }
            else{
              $data_update = $txndatafetchtnx[$x]." => ";
            }
            $data_output .= $data_update;
          }
          return rtrim($data_output, " => ");
        }

        if (in_array($otptnx_data_exp[0], $me_bsb)) {
            $receiver_account = $otptnx_data_exp[1];
            $receiver_fetch_id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `clients` WHERE `account_number` = '$receiver_account'"));

            $sender_id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$userid'"));

            $receive_userid = $receiver_fetch_id['email'];
            $tnx_id = generaterandomnum($conn);
            $full_date = date("d M, Y H:i:s");
            $day = strtoupper(date('D'));
            $month = strtoupper(date('M'));
            $year = date('Y');
            $tnx_data = $otp_fetch['tnx_data'];

            $new_data_tnx = update_arry_tnx($fectch_data_tnx_sender, $status, $otp_fetch['tnx_id']);

            $insert_transfer = mysqli_query($conn, "INSERT INTO `transact`(`userid`, `tnx_id`, `tnx_type`, `tnx_data`, `amount`, `status`, `key_day`, `key_month`, `key_year`, `otp`, `trn_date`) VALUES ('$receive_userid', '$tnx_id', 'credit', '$tnx_data', '$amount', 'success', '$day', '$month', '$year', '', '$full_date')");    

            mysqli_query($conn, "UPDATE `tnx_history` SET `transaction`='$new_data_tnx' WHERE userid = '$userid'");
            mysqli_query($conn, "UPDATE `transact` SET `status`='success', `otp_verify` = 'Y', `tnx_check` = 'open' WHERE `userid` = '$userid' AND `otp` = '$data_otp'");
            debit_balance($conn, $amount, $userid);
            credit_balance($conn, $amount, $receive_userid);

            $sender_fullname = ucfirst($sender_id['firstname']);
            $title = "ME Bank Transfer";
            $message = "You have received a payment of AU&#36;".number_format($amount, 2)." from $sender_fullname";
            $icon = "check-circle";
            $alert = "success";
            notify($conn, $receive_userid, $title, $message, $icon, $alert);
        }
        else{
            $new_data_tnx = update_arry_tnx($fectch_data_tnx_sender, $status, $otp_fetch['tnx_id']);

            mysqli_query($conn, "UPDATE `tnx_history` SET `transaction`='$new_data_tnx' WHERE userid = '$userid'");
            mysqli_query($conn, "UPDATE `transact` SET `status`='success', `otp_verify` = 'Y', `tnx_check` = 'open' WHERE `userid` = '$userid' AND `otp` = '$data_otp'");
            debit_balance($conn, $amount, $userid);
        }
        $title = "Transfer successfully Verified";
        $message = "Your transfer of AU&#36;".number_format($amount, 2)." has been validated and money have been sent to the recipient.";
        $icon = "check-circle";
        $alert = "success";
        notify($conn, $userid, $title, $message, $icon, $alert);

        $firstname_mail = ucfirst(fetchdata($conn, 'clients', 'email', $userid, 'firstname'));
        $mail_amount = number_format($amount, 2);
        $subject = "Transfer in Process";
        $message = "
            <html lang='en' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0);background-color:#f7fcfa;height:100%;'><head> <title></title> </head> <body style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;font-family:Montserrat,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#3a3434;height:100%;background-color:#d5efe4;display:table;width:100%;'> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta name='viewport' content='width=device-width, initial-scale=1'> <title>ME BANK</title> <meta name='description' content='ME BANK '> <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'> <div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-background-size:contain;-moz-background-size:contain;-o-background-size:contain;background-size:contain;'><div style='-webkit-box-sizing: border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width:auto;max-width:430px;padding:0 15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding-top:60px;padding-bottom:40px;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;position:relative;min-height:1px;padding-left:15px;padding-right:15px;width:100%;margin:0 auto;float:none;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:left;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align: middle;display:block;max-width:100%;height:auto;/* margin:0 auto; */'><h1 style='-webkit-box-sizing:border-box; -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:36px;text-align: lefy;font: 25px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>Hello $firstname_mail, <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;/* text-align: center; */font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>We have received your confirmation for a Transfer of $mail_amount AUD. which is currently being processed. Please allow 2-3 minutes for your Transfer to be processed; however, due to security concerns, it may take up to 3 business days. Please keep in mind that Transfer processing will take place between 9 a.m. and 9 p.m. daily.</p><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin: 0 0 10px;margin-top: 20px;'>Why did you receive this email? <small><p>ME Bank requires verification whenever a Transfer is made Sending and receiving funds requires an account with ME</p></small> <p><small>Please do not reply to this email. We are unable to respond to inquiries sent to this address. For immediate answers to your questions, visit our Help Center by clicking 'Help' located on any ME page or Email. </small></p></p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>  <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;'></div> </div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing:border-box;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:14px;margin-bottom:30px;padding-bottom:30px;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500. <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background-color:transparent;text-decoration:none;font-family:Montserrat,Arial,sans-serif;font-size:13px;color:#3a3434;'><u style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>Terms of use</u></a></p></div></div></div> </body></html>
        ";
        $mail = mailer($mail, 'noreply@mecapital-au.com', $userid, $subject, $message);

        echo "1".'|'.urlencode(base64_encode(base64_encode($otp_fetch['tnx_id'])));
        }
        else{
          echo "Transaction has been updated";
        }
      }  
    }
  } 
  // International Transfer
  if (isset($_POST['int_make_transfer'])) {
    $int_tnx_option = cleanString($conn, $_POST['data_int_tnx_option']);
    $receipent_full_name = cleanString($conn, strtolower($_POST['data_receipent_full_name']));
    $int_amount = cleanString($conn, $_POST['data_int_amount']);
    $receipent_routing_number = cleanString($conn, $_POST['data_receipent_routing_number']);
    $receipent_account_number = cleanString($conn, $_POST['data_receipent_account_number']);
    $receipent_iban_number = cleanString($conn, trim(str_replace(" ", '', $_POST['data_receipent_iban_number'])));
    $receipent_ifsc_number = cleanString($conn, trim(str_replace(" ", '', $_POST['data_receipent_ifsc_number'])));

    $data_userid = $userid;

    $country_arry = array("us", "india", "mebankiban");
    $filteramount = preg_replace("/[^0-9.]/", '', $int_amount);

    if (empty($int_tnx_option) || empty($receipent_full_name) || empty($int_amount)) {
      echo "All fields are required";
    }
    elseif (!in_array($int_tnx_option, $country_arry)) {
      echo "Error";
    } 
    elseif (!preg_match("/^[a-zA-Z'\s-]+$/", $receipent_full_name)) {
      echo "Invalid Recipient full name";
    }
    elseif (strlen($receipent_full_name) < 5) {
      echo "Invalid Recipient full name";
    }
    elseif (!preg_match('/^\d+(\.\d{2})?$/', $int_amount)) {
      echo "Invalid Amount";
    }
    elseif (strtolower($int_tnx_option) == 'us' && empty($receipent_routing_number) && empty($receipent_account_number)) {
      echo "Opps! All fields are required";
    }
    elseif (strtolower($int_tnx_option) == 'us' && (strlen($receipent_routing_number) !== 9 || !preg_match('/^[0-9]+$/', $receipent_routing_number))) {
      echo "Invalid Recipient routing number";
    } 
    elseif (strtolower($int_tnx_option) == 'us' && (strlen($receipent_account_number) < 10 || strlen($receipent_account_number) > 12 || !preg_match('/^[0-9]+$/', $receipent_account_number))) {
      echo "Invalid account number";
    }
    elseif (strtolower($int_tnx_option) == 'india' && strlen($receipent_ifsc_number) < 11) {
      echo "Invalid Recipient IFSC";
    }
    elseif (strtolower($int_tnx_option) == 'mebankiban' && (strlen($receipent_account_number) < 5 || strlen($receipent_account_number) > 17 || !preg_match('/^[0-9]+$/', $receipent_account_number))) {
      echo "Invalid account number";
    }
    elseif (strtolower($int_tnx_option) == 'mebankiban' && !verify_iban($receipent_iban_number,$machine_format_only=false)) {
      echo "Invalid IBAN";
    }
    elseif (!checkbalance($conn, $filteramount, $data_userid)) {
      echo "Insufficient fund";
    }
    else{
      $tnx_id = generaterandomnum($conn);
      $full_date = date("d M, Y H:i:s");
      $data_tnx = date("M d, Y H:i:s");
      $day = strtoupper(date('D'));
      $month = strtoupper(date('M'));
      $year = date('Y');

      if ($int_tnx_option == 'us') {
        $tnx_data_b = $int_tnx_option.",".$receipent_full_name.",".$filteramount.",".$receipent_account_number.",".$receipent_routing_number;
      }
      elseif ($int_tnx_option == 'india') {
        $tnx_data_b = $int_tnx_option.",".$receipent_full_name.",".$filteramount.",".$receipent_account_number.",".$receipent_ifsc_number;
      }
      elseif ($int_tnx_option == 'mebankiban') {
        $tnx_data_b = $int_tnx_option.",".$receipent_full_name.",".$filteramount.",".$receipent_account_number.",".iban_to_human_format($receipent_iban_number);
      }
      else{
        $tnx_data_b = $int_tnx_option.",".$receipent_full_name.",".$filteramount.",".$receipent_account_number.",".iban_to_human_format($receipent_iban_number);
      }

      if ($int_tnx_option == 'us') {
        $tnx_data = 'inter_routing'.",".$receipent_routing_number.",".$receipent_account_number;
      }
      elseif ($int_tnx_option == 'india') {
        $tnx_data = 'inter_ifsc'.",".$receipent_ifsc_number.",".$receipent_account_number;
      }
      elseif ($int_tnx_option == 'mebankiban') {
        $tnx_data = 'inter_iban'.",".iban_to_human_format($receipent_iban_number).",".$receipent_account_number;
      }
      else{
        $tnx_data = 'inter_iban'.",".iban_to_human_format($receipent_iban_number).",".$receipent_account_number;
      }

      $fetchtnxdata = fetchdata($conn, 'tnx_history', 'userid', $data_userid, 'transaction');

      if (!empty($fetchtnxdata)) {
        $withdrawdata = $tnx_id."--"."debit"."--".$tnx_data."--".$filteramount."--"."success"."--".$data_tnx;
        $insertval = $fetchtnxdata.' => '.$withdrawdata;
      }
      else{
        $insertval = $tnx_id."--"."debit"."--".$tnx_data."--".$filteramount."--"."success"."--".$data_tnx;
      }

      $insertqry = mysqli_query($conn, "UPDATE `tnx_history` SET `transaction`='$insertval' WHERE userid = '$data_userid'");

      $insert_transfer = mysqli_query($conn, "INSERT INTO `transact`(`userid`, `tnx_id`, `tnx_type`, `tnx_category`, `tnx_data`, `amount`, `status`, `key_day`, `key_month`, `key_year`, `otp`, `otp_verify`, `trn_date`) VALUES ('$data_userid', '$tnx_id', 'debit', 'international', '$tnx_data_b', '$filteramount', 'success', '$day', '$month', '$year', '', 'Y', '$full_date')");

      debit_balance($conn, $filteramount, $data_userid);

      if ($insert_transfer) {
        $title = "International Transfer";
        $message = "Your International transfer of AU&#36;".number_format($filteramount, 2)." was successful";
        $icon = "check-circle";
        $alert = "success";
        notify($conn, $data_userid, $title, $message, $icon, $alert);

        $subject = "Transfer Succesful";
        $mail_amount = number_format($filteramount, 2);
        $message = "<html lang='en' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0);background-color:#f7fcfa;height:100%;'><head> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta name='viewport' content='width=device-width, initial-scale=1'> <title>ME</title> <meta name='description' content='ME '> <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'> </head> <body style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;font-family:Montserrat,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#3a3434;height:100%;background-color:#d5efe4;display:table;width:100%;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-background-size:contain;-moz-background-size:contain;-o-background-size:contain;background-size:contain;'><div style='-webkit-box-sizing: border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width:auto;max-width:430px;padding:0 15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding-top:60px;padding-bottom:40px;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;position:relative;min-height:1px;padding-left:15px;padding-right:15px;width:100%;margin:0 auto;float:none;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'><h1 style='-webkit-box-sizing:border-box; -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:36px;text-align:center;font:34px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>Transfer Successful.<br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align: center;font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Your International transfer of $mail_amount AUD was successful, Please wait 1-3 hours for your transfer to be processed; however, due to security concerns, it may take up to 3 business days.</p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <img src='https://mecapital-au.com/mailer_img/meban_k.png' height='150' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;'></div></div> </div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:14px;margin-bottom:30px;padding-bottom:30px;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500. <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background-color:transparent;text-decoration:none;font-family:Montserrat,Arial,sans-serif;font-size:13px;color:#3a3434;'><u style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>Terms of use</u></a></p></div></div></div>  </body></html>";
        $mail = mailer($mail, 'noreply@mecapital-au.com', $data_userid, $subject, $message);

        
        echo "1".'|'.urlencode(base64_encode(base64_encode($tnx_id)));
      }
      else{
        echo "System Error";
      }
    }

  }
  // International Transfer ends here
  if (isset($_POST['notif'])) {
      $notifuserid = $userid;
      $notifqry = mysqli_query($conn, "SELECT * FROM `tbl_notif` WHERE userid = '$notifuserid' ORDER BY id DESC LIMIT 8");
      if (mysqli_num_rows($notifqry) > 0) {
          while ($notifrow = mysqli_fetch_array($notifqry)) { ?>
              <div class="dropdown-list">
                <?php 
                  if (!empty($notifrow['alert'])) {
                      $notifbg = $notifrow['alert'];
                  }
                  else{
                      $notifbg = 'primary';
                  }
                ?>
                <?php 
                  if (!empty($notifrow['icon'])) {
                      $notificonfetch = "mdi-".$notifrow['icon'];
                  }
                  else{
                      $notificonfetch = 'mdi-information';
                  }
                ?>
                <div class="icon-wrapper rounded-circle bg-inverse-<?php echo $notifbg; ?> text-<?php echo $notifbg; ?>">
                  <i class="mdi <?php echo $notificonfetch; ?>"></i>
                </div>
                <div class="content-wrapper">
                  <small class="name"><?php echo $notifrow['title']; ?></small>
                  <small class="content-text"><?php echo $notifrow['message']; ?></small>
                </div>
              </div>
          <?php }
      }
      else{ ?>
          <div class="dropdown-list">
            <div class="icon-wrapper rounded-circle bg-inverse-warning text-warning">
              <i class="mdi mdi-alert-octagon"></i>
            </div>
            <div class="content-wrapper">
              <small class="content-text">No new Notification</small>
            </div>
          </div>
      <?php }
  }
  if (isset($_POST["notiread"])) {
      $notifid = $userid;
      mysqli_query($conn, "UPDATE tbl_notif SET status='Y' WHERE userid='$notifid'");
  } 
  if (isset($_POST['notif_py_full'])) {
      $notifuserid_b = $userid;
      $notifqry_b = mysqli_query($conn, "SELECT * FROM `tbl_notif` WHERE userid = '$notifuserid_b' ORDER BY id DESC LIMIT 20");
      if (mysqli_num_rows($notifqry_b) > 0) {
          while ($notifrow_b = mysqli_fetch_array($notifqry_b)) { ?>
              <div class="activity-log">
                <p class="log-name"><?php echo $notifrow_b['title']; ?></p>
                <div class="log-details"><?php echo $notifrow_b['message']; ?></div>
                <!-- <small class="log-time">8 mins Ago</small> -->
              </div>
          <?php }
      }
      else{ ?>
          <div class="activity-log">
            <p class="log-name">Opps!</p>
            <div class="log-details">No new Notification</div>
            <!-- <small class="log-time">8 mins Ago</small> -->
          </div>
      <?php }
  }
  function deactivate($conn, $userid, $arraydata){
    $py_data = $arraydata[0];
    if ($py_data == "on") {
      $qry = mysqli_query($conn, "UPDATE `clients` SET `account_state`='deactivated' WHERE `email` = '$userid'");
      if ($qry) {
        return "<script>window.location.href='../../includes/logout.php';</script>";
      }
    }
    else{

    }
  }
// 
?>  
