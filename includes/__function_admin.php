<?php 
  include 'inc_functions.php';
  
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
  function fetchdataprofile($conn, $tbl, $tbl_key, $userid, $data) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid'");
      if (mysqli_num_rows($qry) > 0) {
          $fetch = mysqli_fetch_array($qry);
          if (isset($fetch[$data])) {
              return $fetch[$data];
          }
          else{
              return "";
          }
      }
      else{
          return "N/A";
      }
  }   
  function fetchTnxdata_rev($conn, $userid) {
    $fetch_tnx_arry = fetchdata($conn, 'tnx', 'userid', $userid, 'transaction');
    $exp_tnx_arry = explode("=>", $fetch_tnx_arry);
    return array_reverse($exp_tnx_arry);
  }
  function fetchrowalladmoin($conn, $tbl) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl`");
      return $qry->num_rows;
  } 
  function fetchrowall($conn, $tbl, $tbl_key, $userid, $key, $keyval) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid' AND `$key` = '$keyval'");
      return $qry->num_rows;
  } 
  function fetchrowb($conn, $tbl, $tbl_key, $table_id) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$table_id'");
      return $qry->num_rows;
  } 
  function fetchtotal($conn, $tbl, $key, $keyval){
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$key` = '$keyval' AND `status` = 'success'");
      $sum = 0;
      while ($row = mysqli_fetch_array($qry)) {
          $sum += (int)$row['amount'];
      }
      return $sum;
  }
  function fetchtotalinvest($conn, $tbl, $tbl_key, $userid, $key, $keyval){
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid' AND `$key` = '$keyval' AND `status` = 'success'");
      $sum = 0;
      while ($row = mysqli_fetch_array($qry)) {
          $sum += $row['amount'];
      }
      return $sum;
  }
  function fetchdatab($conn, $tbl, $tbl_key, $userid, $data) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid' ORDER BY id DESC LIMIT 1");
      if (mysqli_num_rows($qry) > 0) {
          $fetch = mysqli_fetch_array($qry);
          return $fetch[$data];
      }
      else{
          return "0";
      }
  }
  function fetchdatac($conn, $tbl, $tbl_key, $userid, $data) {
      $qry = mysqli_query($conn, "SELECT * FROM `$tbl` WHERE `$tbl_key` = '$userid' AND `status` = 'success' ORDER BY id DESC LIMIT 1");
      if (mysqli_num_rows($qry) > 0) {
          $fetch = mysqli_fetch_array($qry);
          return $fetch[$data];
      }
      else{
          return "0";
      }
  }
  function fetchUser($conn, $userid, $val){
   $fetchqry = mysqli_query($conn, "SELECT * FROM `clients` WHERE email = '$userid'");
   if (mysqli_num_rows($fetchqry)) {
     $fetcharry = mysqli_fetch_array($fetchqry);
     return $fetcharry[$val];
   }
   else{
    return "";
   }
  }
  function thousandsCurrencyFormat($num) {
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
      return $num;
  }
  function generateRandCurrency(){
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
  function generateTransaction($startmonth){
    $year = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    $currentdatemonth = date('M');
    if (in_array($currentdatemonth, $year)) {
      $startdate = $startmonth;
      $arrysearch = array_search($startdate, $year);
      $arrycount = count($year);
      $length = (int)$arrycount - (int)$arrysearch;
      $totalval = "";
      if ($length >= 8) {
        for ($x=0; $x < 8; $x++) { 
          $amount = generateRandCurrency();
          $monthpos = $x + $arrysearch;
          $totalval .= $year[$monthpos].'=>'.$amount." ";
        }
        return $totalval;
      }
      else{
        $distance = 8 - $length;
        $totalvalb = "";
        for ($y=0; $y < $distance; $y++) {
          $amount = generateRandCurrency(); 
          $lessmonth = $y + $arrysearch - $distance;
          $totalvalb .= $year[$lessmonth].'=>'.$amount." ";
        }
        $totalvalc = "";
        for ($x=0; $x < $length; $x++) { 
          $amount = generateRandCurrency();
          $monthpos = $x + $arrysearch;
          $totalvalc .= $year[$monthpos].'=>'.$amount." ";
        }
        return $totalvalb.$totalvalc;
      }
    }
  }
  function generateRandCurrencyTnx(){
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
  function generaterandstatpmttype(){
    $txtstatus = array('credit', 'debit');
    $txtrand = count($txtstatus) - 1;
    $txtrandval = rand(0, $txtrand);
    return $txtstatus[$txtrandval];
  }
  function generaterandstat(){
    $pmtstatus = array('success','pending','failed');
    $pmttxtrand = count($pmtstatus) - 1;
    $pmttxtrandval = rand(0, $pmttxtrand);
    return $pmtstatus[$pmttxtrandval];
  }
  function randdate($startdate, $enddate){
    $mindate = strtotime($startdate);
    $maxdate = strtotime($enddate);
    $val = rand($mindate, $maxdate);
    return date("M d, Y H:i:s", $val);
  }
  function generateRandomname(){
    $namesarray = array("william", "james", "john", "mason", "elijah", "noah", "jackson", "michael", "liam", "carter", "oliver", "joseph", "lucas", "owen", "logan", "david", "jacob", "wyatt", "benjamin", "gabriel", "henry", "sebastian", "daniel", "alexander", "julian", "grayson", "matthew", "ethan", "samuel", "dylan", "jayden", "aiden", "luke", "ezekiel", "lincoln", "jack", "jaxon", "theodore", "kingston", "ryker", "anthony", "josiah", "isaiah", "easton", "hudson", "jose", "levi", "hunter", "sawyer", "braxton", "isaac", "bridger", "cooper", "ava", "emma", "olivia", "elizabeth", "harper", "madison", "amelia", "caroline", "isabella", "ella", "charlotte", "sophia", "abigail", "aurora", "chloe", "evelyn", "mia", "lillian", "addison", "aria", "scarlett", "emily", "sofia", "paisley", "avery", "brooklyn", "camila", "victoria", "riley", "aubrey", "zoe", "grace", "mila", "nora", "natalie", "skylar", "lily", "zoey", "layla", "ximena", "hazel", "lucy", "claire", "piper", "hailey");
    $randnum = rand(0, count($namesarray) - 1);
    return $namesarray[$randnum];
  }
  function rand_rout($bsb_file){
    $rows = $clients = file($bsb_file, FILE_IGNORE_NEW_LINES);
    $len = count($clients);
    $rand = [];

    while (count($rand) < 5) {
        $r = rand(0, $len);
        if (!in_array($r, $rand)) {
            $rand[] = $r;
        }
    }
    foreach ($rand as $r) {
       $csv = $rows[$r];
       $split = str_getcsv($csv);
       return $split[0];
    }
  } 
  function generaterandomtnx($length){
      $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $random_num = substr(str_shuffle($str), 0, $length);

      return $random_num;
  }
  function generaterandomacct($length){
      $str = "0123456789";
      $random_num = substr(str_shuffle($str), 0, $length);

      return $random_num;
  }

  // [generateTrans(transact_length, failure_max  pending_max, tnx_date_min, tnx_date_max)] 
  function generateTrans($translen, $failedlen, $pendlen, $datemin, $datemax){
    if ($translen > 0) {
      $genarry = "";
      for ($x=0; $x < $translen; $x++) { 
        $generate_tnxid = generaterandomtnx(12);
        $tnx_data = rand_rout("../../secured/rout/data.csv").','.generaterandomacct(9);
        $genarry .= $generate_tnxid.'--'.generaterandstatpmttype().'--'.$tnx_data.'--'.generateRandCurrencyTnx().'--'.generaterandstat()." ";
      }
      $exp1 = explode(" ", rtrim($genarry, " "));
      $transactval = "";
      $sumpend = 0;
      $sum = 0;
      $findtnx = 0;
      for ($y=0; $y < count($exp1); $y++) { 
        $newexparry = explode("--", $exp1[$y]);
        if (array_search("pending", $newexparry)) {
          $sumpend += 1;
        }
        if (array_search("failed", $newexparry)) {
          $sum += 1;
        }
        if ($newexparry[4] == 'failed' && $sum > $failedlen || $newexparry[4] == 'pending' && $sumpend > $pendlen) {
          $val = $exp1[$y] = $newexparry[0].'--'.$newexparry[1].'--'.$newexparry[2].'--'.$newexparry[3].'--'."success".'--'.randdate($datemin, $datemax);
        }      
        else{
          $val = $exp1[$y] = $newexparry[0].'--'.$newexparry[1].'--'.$newexparry[2].'--'.$newexparry[3].'--'.$newexparry[4].'--'.randdate($datemin, $datemax);
        }
        $transactval .= $val." => ";
      }
      $tnxval = rtrim($transactval, " => ");

      $array = array();
      for ($x=0; $x < count($y = explode("=>", $tnxval)); $x++) { 
          $array[] = explode("--", $y[$x]);
      }
      $arrayName = $array;
      function date_compare($element1, $element2) {
          $datetime1 = strtotime($element1[5]);
          $datetime2 = strtotime($element2[5]);
          return $datetime1 - $datetime2;
      }
      usort($arrayName, 'date_compare');
      function convert_multi_array($array) {
        return $out = implode(" => ",array_map(function($a) {return implode("--",$a);},$array));
      }
      return trim(convert_multi_array($arrayName));
    }
    else{
      return "";
    }
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
  function truncateNum($ccNum){
    return str_pad(substr($ccNum, -4), strlen($ccNum), '*', STR_PAD_LEFT);
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
  function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }
  function checkdatelenth($x, $y){
    $data1 = strtotime($x);
    $data2 = strtotime($y);
    if ($data1 >= $data2) {
      return false;
    }
    return true;
  }
  function checkdatelenthtoday($x){
    $data1 = strtotime($x);
    $data2 = strtotime(date('Y-m-d'));
    if ($data1 > $data2) {
      return false;
    }
    return true;
  }
  function FormatDate($x){
    $date = date_create($x);
    return date_format($date, "M d, Y");
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
      else{      
       $debit_balance = $fetch_data["balance"] - $amount;
       $debit_available_balance = $fetch_data["available_balance"] - $amount;
       $total_debit = $fetch_data["debit"] + $amount;

       mysqli_query($conn, "UPDATE `account` SET `balance`='$debit_balance',`available_balance`='$debit_available_balance',`debit`='$total_debit' WHERE `userid` = '$sender_userid'");
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
       $credit_balance = $fetch_data["balance"] + $amount;
       $credit_available_balance = cutoffpercent($fetch_data["available_balance"] + $amount);
       $total_credit = $fetch_data["credit"] + $amount;

       mysqli_query($conn, "UPDATE `account` SET `balance`='$credit_balance',`available_balance`='$credit_available_balance',`credit`='$total_credit' WHERE `userid` = '$receiver_userid'");
       if ($credit_available_balance) {
         return true;
       }
      }
    }
    else{
     return false;
    }
  }
  function check_bsb($bsb_num){
    $clients = file("../secured/bsb/data.csv", FILE_IGNORE_NEW_LINES);
    foreach ($clients as $index => $client_line) {
        $split = str_getcsv($client_line);
        if ($split[0] == $bsb_num) {
            return true;
            break;
        }
        else{}
    }
  }
  function fetch_bsb($bsb_num){
    $clients = file("../secured/bsb/data.csv", FILE_IGNORE_NEW_LINES);

    foreach ($clients as $index => $client_line) {
        $split = str_getcsv($client_line);
        if ($split[0] == $bsb_num) {
            return $split;
            break;
        }
        else{}
    }
  }
  function fetch_bsb_b($path, $bsb_num){
    $clients = file($path, FILE_IGNORE_NEW_LINES);

    foreach ($clients as $index => $client_line) {
        $split = str_getcsv($client_line);
        if ($split[0] == $bsb_num) {
            return $split;
            break;
        }
        else{}
    }
  }
  function checkkeys($conn, $randstr){
      $fetch = mysqli_query($conn, "SELECT * FROM `clients`");
      if (mysqli_num_rows($fetch) > 0) {
          while ($row = mysqli_fetch_array($fetch)) {
              if ($row['customer_id'] == $randstr) {
                  $keyexist = true;
                  break;
              }
              else{
                  $keyexist = false;
              }
          }
      }
      else{
         $keyexist = false; 
      }
      return $keyexist;
  }
  function generatecustomerid($conn){
      $length = 8;
      $str = "0123456789";
      $random_num = substr(str_shuffle($str), 0, $length);

      $keycheck = checkkeys($conn, $random_num);

      while ($keycheck == true) {
          $random_num = substr(str_shuffle($str), 0, $length);
          $keycheck = checkkeys($conn, $random_num);
      }

      return $random_num;
  }
  function generateaccesscode($conn){
      $length = 8;
      $str = "0123456789";
      $random_num = substr(str_shuffle($str), 0, $length);
      return $random_num;
  }

  function checkkeyaccountnum($conn, $randstr){
      $fetch = mysqli_query($conn, "SELECT * FROM `clients`");
      if (mysqli_num_rows($fetch) > 0) {
          while ($row = mysqli_fetch_array($fetch)) {
              if ($row['account_number'] == $randstr) {
                  $keyexist = true;
                  break;
              }
              else{
                  $keyexist = false;
              }
          }
      }
      else{
         $keyexist = false; 
      }
      return $keyexist;
  }
  function generatecustomeraccountnum($conn){
      $length = 6;
      $str = "0123456789";
      $random_num = '015'.substr(str_shuffle($str), 0, $length);

      $keycheck = checkkeyaccountnum($conn, $random_num);

      while ($keycheck == true) {
          $random_num = substr(str_shuffle($str), 0, $length);
          $keycheck = checkkeyaccountnum($conn, $random_num);
      }

      return $random_num;
  }

  function generaterandomotp($conn){
      $length = 6;
      $str = "0123456789";
      $random_num = substr(str_shuffle($str), 0, $length);

      return $random_num;
  }
  function signinAdmin($conn, $adminVal){
     $username = cleanString($conn, $adminVal[0]);
     $password = cleanString($conn, $adminVal[1]);
     $encrpt = sha1($password);
     $check = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id='$username' AND password ='$encrpt'");
     if(mysqli_num_rows($check) > 0){
       $result = mysqli_fetch_array($check);
       $_SESSION['admin_userid'] = $result['admin_id'];
       return "<script>window.location.href='index.php';</script>";
     }
     else{
       return message('danger', "Invalid Login Parameters");
     }  
  }
  function checkuserid($conn, $val){
    $qry = mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$val' AND `account_status` = 'N'");
    if (mysqli_num_rows($qry) < 1) {
      echo "<script>window.location.href='index.php';</script>";
    }
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
  
  if (isset($_POST['activateuser'])) {
    $adminData = array($_POST['uicustomerid'], $_POST['uiaccesscode'], $_POST['uiaccountnumber'], $_POST['uibalance'], $_POST['uidebit'], $_POST['uicredit'], $_POST['uitnxnum'], $_POST['uifailedlength'], $_POST['uipendinglength'], $_POST['uistartdate'], $_POST['uienddate'], $_POST['uicard_number'], $_POST['uicreditcardName'], $_POST['uicard_expiry'], $_POST['uiuserID']);
    
    $customerid = cleanString($conn, $adminData[0]);
    $accesscode = cleanString($conn, $adminData[1]);
    $accountnumber = cleanString($conn, $adminData[2]);
    $balance = cleanString($conn, $adminData[3]);
    $debit = cleanString($conn, $adminData[4]);
    $credit = cleanString($conn, $adminData[5]);
    $tnxnum = cleanString($conn, $adminData[6]);
    $failedlength = cleanString($conn, $adminData[7]);
    $pendinglength = cleanString($conn, $adminData[8]);
    $startdate = cleanString($conn, $adminData[9]);
    $enddate = cleanString($conn, $adminData[10]);
    $card_number = cleanString($conn, $adminData[11]);
    $creditcardName = cleanString($conn, strtolower($adminData[12]));
    $card_expiry = cleanString($conn, strtolower($adminData[13]));
    $userID = cleanString($conn, strtolower($adminData[14]));

    $expdate = explode("/", $card_expiry);

    $filterbalance = preg_replace("/[^0-9]/", '', $balance);
    $filterdebit = preg_replace("/[^0-9]/", '', $debit);
    $filtercredit = preg_replace("/[^0-9]/", '', $credit);

    $filtertnxlen = preg_replace("/[^0-9]/", '', $tnxnum);
    $filterfailedlen = preg_replace("/[^0-9]/", '', $failedlength);
    $filterpendlen = preg_replace("/[^0-9]/", '', $pendinglength);

    $filterCardname = strtolower($creditcardName);
    $filtercardNum = preg_replace("/[^0-9]/", '', $card_number);

    $checkusersetup = mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$userID' AND `account_status` = 'Y'");

    if (empty($customerid) || empty($accesscode) || empty($accountnumber) || empty($card_number) || empty($creditcardName) || empty($card_expiry) || empty($startdate) || empty($enddate) || empty($userID)) {
      echo "All fields are reqiuired";
    }
    elseif (!isset($filterbalance) || trim($filterbalance) == "" || !isset($filterdebit) || trim($filterdebit) == "" || !isset($filtercredit) || trim($filtercredit) == "") {
      echo "All fields are reqiuired";
    }
    elseif (!isset($filtertnxlen) || trim($filtertnxlen) == "" || !isset($filterfailedlen) || trim($filterfailedlen) == "" || !isset($filterpendlen) || trim($filterpendlen) == "") {
      echo "All fields are reqiuired";
    }
    elseif (strlen($customerid) !== 8) {
     echo "Customer ID requires 8 character";
    }
    elseif (!preg_match('/^[0-9]*$/', $customerid)) {
     echo "Customer ID require numbers only";
    }
    elseif (strlen($accesscode) < 7 || strlen($accesscode) > 20) {
     echo "Access Code Minimum of 7 character and Maximum of 20";
    }
    elseif (strlen($creditcardName) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $creditcardName)) {
      echo "Invalid Card Holder Name";
    }
    elseif (strlen($accountnumber) !== 9) {
     echo "Account Number requires 9 character";
    }
    elseif (!preg_match('/^[0-9]*$/', $accountnumber)) {
      echo "Account Number require numbers only";
    }
    elseif (!validate_cc($filtercardNum, 'all')) {
      echo "Card Not Supported";
    }
    elseif ($filterfailedlen > $filtertnxlen) {
      echo "Failed Transaction cannot be greater than total transaction";
    }
    elseif ($filterpendlen > $filtertnxlen) {
      echo "Pending Transaction cannot be greater than total transaction";
    }
    elseif (validateDate($startdate) == false) {
      echo "Invalid Start Date";
    }
    elseif (validateDate($enddate) == false) {
      echo "Invalid End Date";
    }
    elseif (checkdatelenth($startdate, $enddate) == false) {
      echo "Start Date Can't be greater than or Equal to End date";
    }
    elseif (checkdatelenthtoday($enddate) == false) {
      echo "End Date Can't be greater than current date";
    }
    elseif (validateCCExp($expdate[0], $expdate[1])) {
      echo "Invalid Expiry Date";
    }
    elseif (check_cc_mc($filtercardNum, $extra_check = false) == "") {
      echo "Enter Master Card Only";
    }
    elseif (mysqli_num_rows($checkusersetup) > 0) {
      echo "User already activated";
    }
    else{
      $clientqrycheckerqry = mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$userID' AND `account_status` = 'Y'");

      if (mysqli_num_rows($clientqrycheckerqry) > 0) {
        echo "Data already exist";
      }
      else{
        $dateMiny = FormatDate($startdate);
        $dateMaxy = FormatDate($enddate);
        $avilablebalance = cutoffpercent($filterbalance);

        mysqli_query($conn, "UPDATE `account` SET `balance`='$balance',`available_balance`='$avilablebalance',`credit`='$credit',`debit`='$debit' WHERE `userid` = '$userID'");


        $genTNX = generateTrans($filtertnxlen, $filterfailedlen, $filterpendlen, $dateMiny, $dateMaxy);
        mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$genTNX' WHERE `userid` = '$userID'");
        $updateClienty = mysqli_query($conn, "UPDATE `clients` SET `customer_id`='$customerid', `account_number`='$accountnumber', `account_status`='Y' WHERE `email` = '$userID'");
        if ($updateClienty) {  
          $firstname_mail = ucfirst(fetchdata($conn, 'clients', 'email', $userID, 'firstname')); 
          $subject = "Hello ". $firstname_mail ." Welcome to ADMIN.";
          $message = "<!DOCTYPE html><html lang='en' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0);background-color:#f7fcfa;height:100%;'>
            <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>ME</title>
            <meta name='description' content='ME '>
            <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'>
            </head>
            <body style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;font-family:Montserrat,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#3a3434;height:100%;background-color:#d5efe4;display:table;width:100%;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-background-size:contain;-moz-background-size:contain;-o-background-size:contain;background-size:contain;'><div style='-webkit-box-sizing:
            border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width:auto;max-width:430px;padding:0 15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding-top:60px;padding-bottom:40px;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:
            border-box;position:relative;min-height:1px;padding-left:15px;padding-right:15px;width:100%;margin:0 auto;float:none;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'><h1 style='-webkit-box-sizing:border-box;
            -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:36px;text-align:center;font:34px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>Hello $firstname_mail.<br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:
            center;font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Welcome to ADMIN, below is your account details, you will be required your customer Id and Access code to access your account</p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <img src='https://mecapital-au.com/mailer_img/MMG_ED_50-50_500x3006b4d.png' height='150' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0
            auto;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'><div>Customer ID: $customerid</div> <div>Acces Code: $accesscode</div></p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:
            border-box;'></div></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-bottom:15px;'> <a href='https://mecapital-au.com/secured/dashboard' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-decoration:none;display:inline-block;margin-bottom:0;text-align:center;vertical-align:middle;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;
            -webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;padding:10px 16px;border-radius:6px;font:16px Montserrat,Arial,sans-serif;letter-spacing:0.004em;color:#fff;background-color:#000;border-color:#58595b;width:100%;hieght:48px;font-size:16px;font-weight:bold;line-height:150%;'>Go to Dashboard</a></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:
            border-box;box-sizing:border-box;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:14px;margin-bottom:30px;padding-bottom:30px;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500.
            <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background-color:transparent;text-decoration:none;font-family:Montserrat,Arial,sans-serif;font-size:13px;color:#3a3434;'><u style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>Terms of use</u></a></p></div></div></div>
            </body>
            </html>";
          $mail = mailer($mail, 'noreply@mecapital-au.com', $userID, $subject, $message);
          echo "1";
        }
      }
    }
  }

  function delete($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $qry_up = mysqli_query($conn, "UPDATE `clients` SET `account_state`='deleted' WHERE `email` = '$user_id'");
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }

  function deactivate($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $qry_up = mysqli_query($conn, "UPDATE `clients` SET `account_state`='deactivated' WHERE `email` = '$user_id'");
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }

  function active($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $qry_up = mysqli_query($conn, "UPDATE `clients` SET `account_state`='active' WHERE `email` = '$user_id'");
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }

  function failedtnx($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $tnx_id = cleanString($conn, $data[1]);

    $qry_up = mysqli_query($conn, "UPDATE `transact` SET `status`='failed' WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id'");
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }
  function successtnx($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $tnx_id = cleanString($conn, $data[1]);

    $fectch_data_tnx = fetchdata($conn, 'tnx', 'userid', $user_id, 'transaction');

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

    $status = 'success';
    $new_data_tnx = update_arry_tnx($fectch_data_tnx, $status, $tnx_id);

    mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$new_data_tnx' WHERE userid = '$user_id'");

    $qry_up = mysqli_query($conn, "UPDATE `transact` SET `status`='success' WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id'");
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }
  function canceltnx($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $tnx_id = cleanString($conn, $data[1]);

    $qry_up = mysqli_query($conn, "UPDATE `transact` SET `status`='cancel' WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id'");
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }

  function tnxlock($conn, $data){
    $user_id = cleanString($conn, $data[0]);
    $status = fetchdata($conn, 'clients', 'email', $user_id, 'tnx_lock');

    if ($status == "off") {
      $qry_up = mysqli_query($conn, "UPDATE `clients` SET `tnx_lock`='on' WHERE `email` = '$user_id'");
    }
    else{
      $qry_up = mysqli_query($conn, "UPDATE `clients` SET `tnx_lock`='off' WHERE `email` = '$user_id'");
    }
    if ($qry_up) {
      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }


  function failedtnx_hold($conn, $data, $mail){
    $user_id = cleanString($conn, $data[0]);
    $tnx_id = cleanString($conn, $data[1]);

    $fectch_data_tnx = fetchdata($conn, 'tnx', 'userid', $user_id, 'transaction');

    $fetch_data_admin_failed = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `transact` WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id' ORDER BY id DESC LIMIT 1"));
    $amount = $fetch_data_admin_failed['amount'];

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

    $status = 'failed';
    $new_data_tnx = update_arry_tnx($fectch_data_tnx, $status, $tnx_id);

    mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$new_data_tnx' WHERE userid = '$user_id'");

    $qry_up = mysqli_query($conn, "UPDATE `transact` SET `status`='failed',`tnx_check`='open' WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id'");


    if ($qry_up) {
      $title = "Transfer Failed";
      $message = "Your transfer of AU&#36;".number_format($amount, 2)." has been declined.";
      $icon = "error";
      $alert = "danger";
      notify($conn, $user_id, $title, $message, $icon, $alert);

      $subject = "Transfer Declined";
      $message = "<html lang='en' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0);background-color:#efd5d59c;height:100%;'><head> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta name='viewport' content='width=device-width, initial-scale=1'> <title>ME</title> <meta name='description' content='ME '> <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'> </head> <body style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;font-family:Montserrat,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#3a3434;height:100%;background-color:#efd5d59c;display:table;width:100%;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-background-size:contain;-moz-background-size:contain;-o-background-size:contain;background-size:contain;'><div style='-webkit-box-sizing: border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width:auto;max-width:430px;padding:0 15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding-top:60px;padding-bottom:40px;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;position:relative;min-height:1px;padding-left:15px;padding-right:15px;width:100%;margin:0 auto;float:none;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'><h1 style='-webkit-box-sizing:border-box; -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:36px;text-align:center;font:34px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>Transfer Declined.<br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align: center;font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Your transfer has been declined. To check the status of your transfer, go to the dashboard.</p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;'></div></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-bottom:15px;'> <a href='https://mecapital-au.com/secured/dashboard' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-decoration:none;display:inline-block;margin-bottom:0;text-align:center;vertical-align:middle;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap; -webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;padding:10px 16px;border-radius:6px;font:16px Montserrat,Arial,sans-serif;letter-spacing:0.004em;color:#fff;background-color:#000;border-color:#58595b;width:100%;hieght:48px;font-size:16px;font-weight:bold;line-height:150%;'>Go to Dashboard</a></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing:border-box;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:14px;margin-bottom:30px;padding-bottom:30px;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500. <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background-color:transparent;text-decoration:none;font-family:Montserrat,Arial,sans-serif;font-size:13px;color:#3a3434;'><u style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>Terms of use</u></a></p></div></div></div>  </body></html>";
      $mail = mailer($mail, 'noreply@mecapital-au.com', $user_id, $subject, $message);

      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
  }
  function successtnx_hold($conn, $data, $mail){
    $user_id = cleanString($conn, $data[0]);
    $tnx_id = cleanString($conn, $data[1]);

    $fectch_data_tnx = fetchdata($conn, 'tnx', 'userid', $user_id, 'transaction');

    $fetch_data_admin = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `transact` WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id' ORDER BY id DESC LIMIT 1"));

    $me_bsb = explode(",", fetchdataall($conn, 'site_data', 'bsb'));

    $otptnx_data_exp = explode(",", $fetch_data_admin['tnx_data']);   

    $status = 'success';

    $amount = $fetch_data_admin['amount'];

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

       $sender_id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$user_id'"));

       $receive_userid = $receiver_fetch_id['email'];
       $tnx_id_receiver = generaterandomnum($conn);
       $full_date = date("d M, Y H:i:s");
       $day = strtoupper(date('D'));
       $month = strtoupper(date('M'));
       $year = date('Y');
       $tnx_data = $fetch_data_admin['tnx_data'];
       $data_tnx = date("M d, Y H:i:s");

       $new_data_tnx = update_arry_tnx($fectch_data_tnx, $status, $tnx_id);

       $fectch_data_tnx_receiver = fetchdata($conn, 'tnx', 'userid', $receive_userid, 'transaction');

       if (!empty($fectch_data_tnx_receiver)) {
         $transfer_data_receiver = $tnx_id_receiver."--"."credit"."--".$tnx_data."--".$amount."--"."success"."--".$data_tnx;
         $insertval_receiver = $fectch_data_tnx_receiver.' => '.$transfer_data_receiver;
       }
       else{
         $insertval_receiver = $tnx_id_receiver."--"."credit"."--".$tnx_data."--".$amount."--"."success"."--".$data_tnx;
       }

       $insert_transfer = mysqli_query($conn, "INSERT INTO `transact`(`userid`, `tnx_id`, `tnx_type`, `tnx_data`, `amount`, `status`, `key_day`, `key_month`, `key_year`, `otp`, `trn_date`) VALUES ('$receive_userid', '$tnx_id_receiver', 'credit', '$tnx_data', '$amount', 'success', '$day', '$month', '$year', '', '$full_date')");    

       mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$new_data_tnx' WHERE userid = '$user_id'");

       mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$insertval_receiver' WHERE userid = '$receive_userid'");
       
       debit_balance($conn, $amount, $user_id);
       credit_balance($conn, $amount, $receive_userid);

       $sender_fullname = ucfirst($sender_id['firstname']);
       $title = "ADMIN Transfer";
       $message = "You have received a payment of AU&#36;".number_format($amount, 2)." from $sender_fullname";
       $icon = "check-circle";
       $alert = "success";
       notify($conn, $receive_userid, $title, $message, $icon, $alert);
    }
    else{
       mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$new_data_tnx' WHERE userid = '$user_id'");
       debit_balance($conn, $amount, $user_id);
    }

    $qry_up = mysqli_query($conn, "UPDATE `transact` SET `status`='success',`tnx_check`='open' WHERE `userid` = '$user_id' AND `tnx_id` = '$tnx_id'");

    if ($qry_up) {
      $title = "Transfer Aproved";
      $message = "Your transfer of AU&#36;".number_format($amount, 2)." has been approved and money have been sent to the recipient.";
      $icon = "check-circle";
      $alert = "success";
      notify($conn, $user_id, $title, $message, $icon, $alert);

      $subject = "Transfer Approved";
      $message = "<html lang='en' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0);background-color:#f7fcfa;height:100%;'><head> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <meta name='viewport' content='width=device-width, initial-scale=1'> <title>ME</title> <meta name='description' content='ME '> <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'> </head> <body style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;font-family:Montserrat,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#3a3434;height:100%;background-color:#d5efe4;display:table;width:100%;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-background-size:contain;-moz-background-size:contain;-o-background-size:contain;background-size:contain;'><div style='-webkit-box-sizing: border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width:auto;max-width:430px;padding:0 15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding-top:60px;padding-bottom:40px;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;position:relative;min-height:1px;padding-left:15px;padding-right:15px;width:100%;margin:0 auto;float:none;'><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;'> <img src='https://mecapital-au.com/mailer_img/logo.png' height='60' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'><h1 style='-webkit-box-sizing:border-box; -moz-box-sizing:border-box;box-sizing:border-box;margin:0.67em 0;font-family:Montserrat,Arial,sans-serif;line-height:1.1;margin-bottom:10px;font-size:36px;text-align:center;font:34px Montserrat,Arial,sans-serif;font-weight:bold;letter-spacing:-0.03em;color:#000;margin-top:16px;'>Transfer Approved.<br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'></h1><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align: center;font-size:16px;line-height:150%;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Your transfer has been approved Succesfully. To check the status of your transfer, go to the dashboard.</p></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <img src='https://mecapital-au.com/mailer_img/meban_k.png' height='150' alt='me-logo' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;vertical-align:middle;display:block;max-width:100%;height:auto;margin:0 auto;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;'></div></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-bottom:15px;'> <a href='https://mecapital-au.com/secured/dashboard' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-decoration:none;display:inline-block;margin-bottom:0;text-align:center;vertical-align:middle;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap; -webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;padding:10px 16px;border-radius:6px;font:16px Montserrat,Arial,sans-serif;letter-spacing:0.004em;color:#fff;background-color:#000;border-color:#58595b;width:100%;hieght:48px;font-size:16px;font-weight:bold;line-height:150%;'>Go to Dashboard</a></div> <br style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'> <br style='-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing:border-box;'></div><div style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;text-align:center;font-size:14px;margin-bottom:30px;padding-bottom:30px;'><p style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin:0 0 10px;'>Members Equity Bank Limited ABN 56 070 887 679 AFSL and Australian Credit Licence 229500. <a href='https://www.mecapital-au.com/getmedia/cbf4c4a1-b766-48f6-990a-740400563989/EA_terms_and_conditions.pdf' target='_blank' rel='noopener' style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background-color:transparent;text-decoration:none;font-family:Montserrat,Arial,sans-serif;font-size:13px;color:#3a3434;'><u style='-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;'>Terms of use</u></a></p></div></div></div>  </body></html>";
      $mail = mailer($mail, 'noreply@mecapital-au.com', $user_id, $subject, $message);

      return message('success', "User Data Updated Succesfully");
    }
    else{
      return message('danger', "ERROR");
    }
    
  }
 
?>  
