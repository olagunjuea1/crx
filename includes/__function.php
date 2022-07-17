<?php 
  include 'inc_functions.php';
  // $userid = $_SESSION['userid'];
  $userid = 'olagunjuea1@gmail.com';

  
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
      if($num > 999999) {
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
      $charges = (0.7 / 100) * $amount;
      $charged_amount = number_format($charges + $amount, 2);

      if (!preg_match('/^\d+(\.\d{2})?$/', $charged_amount)) {
          return false;
      }
      elseif ($charged_amount > $fetch_data["available_balance"]) {
        return false;
      }
      else{      
        $debit_balance = $fetch_data["balance"] - $charged_amount;
        $debit_available_balance = $fetch_data["available_balance"] - $charged_amount;
        $total_debit = $fetch_data["debit"] + $amount;

        $debit_qry = mysqli_query($conn, "UPDATE `account` SET `balance`='$debit_balance',`available_balance`='$debit_available_balance',`debit`='$total_debit' WHERE `userid` = '$sender_userid'");

        return true;
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
      if (!preg_match('/^\d+(\.\d{2})?$/', $amount)) {
          return false;
      }
      else{      
        $credit_balance = $fetch_data["balance"] + $amount;
        $credit_available_balance = $fetch_data["available_balance"] + $amount;
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
  function checkkeys($conn, $randstr){
      $fetch = mysqli_query($conn, "SELECT * FROM `tbl_deposit`");
      if (mysqli_num_rows($fetch) > 0) {
          while ($row = mysqli_fetch_array($fetch)) {
              if ($row['tnx_key'] == $randstr) {
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
  function checkkeys_arry($conn, $randstr, $userid){
     $fetch = fetchdata($conn, 'tnx', 'userid', $userid, 'transaction');
     $exp_arry = explode("=>", $fetch); 
     $keyexist = "";
     if (!empty($fetch)) {
        foreach ($exp_arry as $keyval) {
        $expallarry = explode("--", $keyval);
          if (trim($expallarry[0]) == $randstr) {
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
     echo $keyexist;
  }
  function generaterandomnum($conn, $userid){
      $length = 12;
      $str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      $random_num = substr(str_shuffle($str), 0, $length);

      $keycheck = checkkeys_arry($conn, $random_num, $userid);

      while ($keycheck == true) {
          $random_num = substr(str_shuffle($str), 0, $length);
          $keycheck = checkkeys_arry($conn, $random_num, $userid);
      }

      return $random_num;
  }
  function generaterandomotp($conn){
      $length = 9;
      $str = "0123456789";
      $random_num = substr(str_shuffle($str), 0, $length);

      return $random_num;
  }
  function fetchTnxdata($conn, $userid){
    $fetch_tnx_arry = fetchdata($conn, 'tnx', 'userid', $userid, 'transaction');
    return $exp_tnx_arry = explode("=>", $fetch_tnx_arry);
  }
  function fetchTnxdata_rev($conn, $userid) {
    $fetch_tnx_arry = fetchdata($conn, 'tnx', 'userid', $userid, 'transaction');
    $exp_tnx_arry = explode("=>", $fetch_tnx_arry);
    return array_reverse($exp_tnx_arry);
  }

  function fetch_max($conn, $userid, $tnxtype) {
    $fetchtnx_arry_top_tnx = fetchTnxdata($conn, $userid);
    $searchresult = "";
    foreach ($fetchtnx_arry_top_tnx as $key_toptnx) {
      // $data_tnx_top = "";
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == 'success') {
        $searchresult .= $key_toptnx_exp[4].",";
      }                                                            
    }
    $arry_tnx_key_fetch = explode(",", rtrim($searchresult, ','));
    if (empty(max($arry_tnx_key_fetch))) {
      return (int)0;
    }
    else{
      return max($arry_tnx_key_fetch);
    }
  }

  function sort_arry_desc($array_data) {
    $array = array();
    for ($x=0; $x < count($array_data); $x++) { 
        $array[] = explode("--", $array_data[$x]);
    }
    $arrayName = $array;

    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1[6]);
        $datetime2 = strtotime($element2[6]);
        return $datetime2 - $datetime1;
    }
    usort($arrayName, 'date_compare');
    function convert_multi_array($array) {
      return $out = implode(" => ",array_map(function($a) {return implode("--",$a);},$array));
    }
    return trim(convert_multi_array($arrayName));
  }

  // function fetch_highest_tnx_credit($conn, $userid, $status) {
  //   $array = array();
  //   for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
  //       $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
  //   }
  //   $arrayName = $array;

  //   function date_compare($element1, $element2) {
  //       $datetime1 = strtotime($element1[6]);
  //       $datetime2 = strtotime($element2[6]);
  //       return $datetime2 - $datetime1;
  //   }
  //   usort($arrayName, 'date_compare');
  //   function convert_multi_array($array) {
  //     return $out = implode(" => ",array_map(function($a) {return implode("--",$a);},$array));
  //   }
  //   $data_arry = explode("=>", trim(convert_multi_array($arrayName)));
    
  //   $searchresult = [];
  //   foreach ($data_arry as $key_toptnx) {
  //     $key_toptnx_exp = explode("--", $key_toptnx);
     

  //     if ($key_toptnx_exp[1] == 'credit' && $key_toptnx_exp[5] == $status) {
  //       $searchresult[] = $key_toptnx_exp;
  //     }                                                            
  //   }

  //   if (empty($searchresult)) {
  //     return "";
  //   }
  //   else{
  //     foreach($searchresult as $entry) {
  //         if($entry[4] == max(array_column($searchresult, 4))){
  //           $newArr[] = $entry;
  //         }
  //     }
  //     return $newArr[0];
  //   }
  // }

  // function fetch_highest_tnx_debit($conn, $userid, $status) {
  //   $array = array();
  //   for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
  //       $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
  //   }
  //   $arrayName = $array;

  //   function date_compare_b($element1, $element2) {
  //       $datetime1 = strtotime($element1[6]);
  //       $datetime2 = strtotime($element2[6]);
  //       return $datetime2 - $datetime1;
  //   }
  //   usort($arrayName, 'date_compare_b');
  //   function convert_multi_array_b($array) {
  //     return $out = implode(" => ",array_map(function($a) {return implode("--",$a);},$array));
  //   }
  //   $data_arry = explode("=>", trim(convert_multi_array_b($arrayName)));
    
  //   $searchresult = [];
  //   foreach ($data_arry as $key_toptnx) {
  //     $key_toptnx_exp = explode("--", $key_toptnx);
     

  //     if ($key_toptnx_exp[1] == 'debit' && $key_toptnx_exp[5] == $status) {
  //       $searchresult[] = $key_toptnx_exp;
  //     }                                                            
  //   }

  //   if (empty($searchresult)) {
  //     return "";
  //   }
  //   else{
  //     foreach($searchresult as $entry) {
  //         if($entry[4] == max(array_column($searchresult, 4))){
  //           $newArr[] = $entry;
  //         }
  //     }
  //     return $newArr[0];
  //   }
  // }

  function convert_array_multiple($array) {
    return $out = implode(" => ",array_map(function($a) {return implode("--",$a);},$array));
  }

  function fetch_data_arry_sort($conn, $userid, $tnxtype, $status) {
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));
    
    $searchresult = [];
    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
     
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == $status) {
        $searchresult[] = $key_toptnx_exp;
      }                                                            
    }

    // print_r($searchresult);

    if (empty($searchresult)) {
      return "";
    }
    else{
      foreach($searchresult as $entry) {
          if($entry[4] == max(array_column($searchresult, 4))){
            $newArr[] = $entry;
          }
      }
      return $newArr[0];
    }

  }

  function calc_sum($conn, $userid){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    $searchresult = [];

    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      $searchresult[] = $key_toptnx_exp[4];                                                          
    }
    return array_sum($searchresult);
  }

  function calc_sum_type($conn, $userid, $tnxtype, $status){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    $searchresult = [];

    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == $status) {
        $searchresult[] = $key_toptnx_exp[4];
      }                                                           
    }

    return array_sum($searchresult);
  }

  function calc_sum_num($conn, $userid, $tnxtype, $status){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    $searchresult = [];

    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == $status) {
        $searchresult[] = $key_toptnx_exp[4];
      }                                                           
    }

    return count($searchresult);
  }

  function calc_sum_last_week($conn, $userid, $tnxtype, $status){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    $searchresult = [];

    $previous_week = strtotime("-1 week +1 day");

    $start_week = strtotime("last sunday midnight",$previous_week);
    $end_week = strtotime("next saturday",$start_week);

    $start_week = date("Y-m-d",$start_week);
    $end_week = date("Y-m-d",$end_week);

    
    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == $status) {
        $originalDate = $key_toptnx_exp[6];
        $newDate = date("Y-m-d", strtotime($originalDate));
        if (($newDate >= $start_week) && ($newDate <= $end_week)){
            $searchresult[] = $key_toptnx_exp[4];
        }        
      }                                                           
    }

    return array_sum($searchresult);
  }

  function calc_sum_this_month($conn, $userid, $tnxtype, $status){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    $searchresult = [];


    $last_month_start = strtotime(date('Y-m-01'));
    $last_month_end = strtotime(date('Y-m-t 23:59:59'));
    

    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == $status) {
        $originalDate = $key_toptnx_exp[6];

        $newDate = strtotime(date("Y-m-d", strtotime($originalDate)));
        if (($newDate >= $last_month_start) && ($newDate <= $last_month_end)){
            $searchresult[] = $key_toptnx_exp[4];
        }        
      }                                                           
    }

    return array_sum($searchresult);
  }

  function calc_sum_last_month($conn, $userid, $tnxtype, $status){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    $searchresult = [];


    $last_month_start = strtotime(date("Y-m-01",strtotime("-1 month")));
    $last_month_end = strtotime(date('Y-m-t 23:59:59',strtotime("-1 month")));
    

    foreach ($data_arry as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == $tnxtype && $key_toptnx_exp[5] == $status) {
        $originalDate = $key_toptnx_exp[6];

        $newDate = strtotime(date("Y-m-d", strtotime($originalDate)));
        if (($newDate >= $last_month_start) && ($newDate <= $last_month_end)){
            $searchresult[] = $key_toptnx_exp[4];
        }        
      }                                                           
    }

    return array_sum($searchresult);
  }

  function get_last_pending_tnx_debit($conn, $userid){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));
    $data_arry_rev = array_reverse($data_arry);

    $searchresult = [];
    

    foreach ($data_arry_rev as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if ($key_toptnx_exp[1] == 'debit' && $key_toptnx_exp[5] == 'pending') {
        $searchresult[] = $key_toptnx_exp; 
      }                                                           
    }

    return $searchresult;
  }

  function get_array_by_id($conn, $userid, $arrayid){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));
    $data_arry_rev = array_reverse($data_arry);

    $searchresult = [];
    

    foreach ($data_arry_rev as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if (trim($key_toptnx_exp[0]) == $arrayid) {
        $searchresult[] = $key_toptnx_exp; 
      }                                                           
    }

    return $searchresult[0];
  }

  function check_if_key_exists($conn, $userid, $arrayid){
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }
    $data_arry = explode("=>", trim(convert_array_multiple($array)));

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));
    $data_arry_rev = array_reverse($data_arry);

    $searchresult = [];
    

    foreach ($data_arry_rev as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
      if (trim($key_toptnx_exp[0]) == $arrayid) {
        $existkey = true; 
        break;
      }    
      else{
        $existkey = false; 
      }                                                       
    }

    return $existkey;
  }

  function update_arry_tnx($conn, $userid, $status, $tnx_id_val){
    $txndatafetchtnx = fetchTnxdata($conn, $userid);
    $data_output = "";
    for ($x=0; $x < count($txndatafetchtnx); $x++) { 
      $expdataval = explode("--", $txndatafetchtnx[$x]);
      if (trim($expdataval[0]) == $tnx_id_val) {
        $arryrep = array(5 => $status);
        $data_update = implode("--", array_replace($expdataval, $arryrep))." => ";
      }
      else{
        $data_update = $txndatafetchtnx[$x]." => ";
      }
      $data_output .= $data_update;
    }
    return rtrim($data_output, " => ");
  }

  function fetch_modify_tnx($conn, $userid, $tnx_id, $tnx_type, $tnx_localinter, $tnx_data, $amount, $status, $data_tnx){
      $fetchtnxdata = fetchdata($conn, 'tnx', 'userid', $userid, 'transaction');

      if (!empty($fetchtnxdata)) {
        $withdrawdata = $tnx_id."--".$tnx_type."--".$tnx_localinter."--".$tnx_data."--".$amount."--".$status."--".$data_tnx;
        $insertval = $fetchtnxdata.' => '.$withdrawdata;
      }
      else{
        $insertval = $tnx_id."--".$tnx_type."--".$tnx_localinter."--".$tnx_data."--".$amount."--".$status."--".$data_tnx;
      }

      return $insertval;
  }

  function fetch_data_by_type($conn, $userid, $tnxtype) {
    $array = array();
    for ($x=0; $x < count(fetchTnxdata($conn, $userid)); $x++) { 
        $array[] = explode("--", fetchTnxdata($conn, $userid)[$x]);
    }

    usort($array, function ($a, $b) {
        return strtotime($a[6]) - strtotime($b[6]);
    });

    $data_arry = explode("=>", trim(convert_array_multiple($array)));
    $data_arry_rev = array_reverse($data_arry);

    $searchresult = [];

    foreach ($data_arry_rev as $key_toptnx) {
      $key_toptnx_exp = explode("--", $key_toptnx);
     
      if ($key_toptnx_exp[1] == $tnxtype) {
        $searchresult[] = $key_toptnx_exp;
      }                                                            
    }

    if (empty($searchresult)) {
      return "";
    }
    else{
      return $data_arry = explode("=>", trim(convert_array_multiple($searchresult)));
    }

  }
  
  // fetch account data
  if (isset($_POST['data_fetcher'])) {
      $balance = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'balance'));
      $availablebalance = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'available_balance'));
      $credit = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'credit'));
      $debit = thousandsCurrencyFormat(fetchdatabalance($conn, 'account', 'userid', $userid, 'debit'));
      $credit_b = thousandsCurrencyFormatb(fetchdatabalance($conn, 'account', 'userid', $userid, 'credit'));
      $debit_b = thousandsCurrencyFormatb(fetchdatabalance($conn, 'account', 'userid', $userid, 'debit'));

      // $firstname = ucfirst(fetchdata($conn, 'clients', 'email', $userid, 'firstname'));
      // $lastname = ucfirst(fetchdata($conn, 'clients', 'email', $userid, 'lastname'));

      // $data_credit = fetchdatabalance($conn, 'account', 'userid', $userid, 'credit');
      // $data_debit = fetchdatabalance($conn, 'account', 'userid', $userid, 'debit');

      // $data_credit_cut = thousandsCurrencyFormatb($data_credit);

      // if ($data_credit > $data_debit) {
      //   $credit_debit_perval = $data_debit / $data_credit * 100;
      //   $data_name = "Payment Sent In";
      //   $data_val = "Credit";

      //   $data_a = thousandsCurrencyFormatb($data_debit);
      //   $data_b = thousandsCurrencyFormatb($data_credit);
      // }
      // elseif ($data_debit > $data_credit) {
      //   $credit_debit_perval = $data_credit / $data_debit * 100;
      //   $data_name = "Payment Sent Out";
      //   $data_val = "Debit";

      //   $data_a = thousandsCurrencyFormatb($data_credit);
      //   $data_b = thousandsCurrencyFormatb($data_debit);
      // }
      // elseif ($data_debit = $data_credit) {
      //   $credit_debit_perval = $data_credit / $data_debit * 100;
      //   $data_name = "Payment Sent Out";
      //   $data_val = "Debit";

      //   $data_a = thousandsCurrencyFormatb($data_credit);
      //   $data_b = thousandsCurrencyFormatb($data_debit);
      // }
      // else{
      //   $credit_debit_perval = 0;
      //   $data_name = "";
      //   $data_val = "";

      //   $data_a = thousandsCurrencyFormatb($data_credit);
      //   $data_b = thousandsCurrencyFormatb($data_debit);
      // }

      $user_data = array('balance' => $balance, 'available' => $availablebalance, 'credit' => $credit, 'debit' => $debit, 'credit_b' => $credit_b, 'debit_b' => $debit_b);

      echo json_encode($user_data);
  }
  // fetch account data

  if (isset($_POST['make_transfer'])) {
    $data_routing = cleanstring($conn, $_POST['data_routing']);
    $data_accountNumber = cleanstring($conn, $_POST['data_accountNumber']);
    $data_amount = cleanstring($conn, $_POST['data_amount']);
    $data_userid = $userid;

    $routing_filter = preg_replace("/[^0-9]/", '', $data_routing);
    $filteramount = preg_replace("/[^0-9.]/", '', $data_amount);
    $filteracctnum = preg_replace("/[^0-9]/", '', $data_accountNumber);

    $acctchecker = mysqli_query($conn, "SELECT * FROM `clients` WHERE `account_number` = '$data_accountNumber'");
    $personal_acctchecker = mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$userid' AND `account_number` = '$data_accountNumber'");

    $checkactivetnx = mysqli_query($conn, "SELECT * FROM `tnx` WHERE `userid` = '$data_userid' AND `tnx_status` = 'active'");

    if (empty($data_routing) || empty($data_accountNumber) || empty($data_amount) || empty($data_userid)) {
        echo "All fields are required";
    }
    elseif (strlen($routing_filter) !== 9) {
        echo "Invalid Routing Number";
    }
    elseif (strlen($data_accountNumber) < 8 || strlen($data_accountNumber) > 10) {
        echo "Invalid Account Number";
    }
    elseif ($data_amount < 1) {
        echo "Invalid Amount";
    }
    elseif (!preg_match('/^\d+(\.\d{2})?$/', $data_amount)) {
        echo "Invalid Amount";
    }
    elseif (!checkbalance($conn, $data_amount, $data_userid)) {
        echo "Insufficient fund";
    }
    elseif (!preg_match('/^[0-9]+$/', $data_accountNumber)) {
        echo "Invalid Account Number";
    }
    elseif (mysqli_num_rows($checkactivetnx) > 0) {
        echo "You have a pending transaction"; 
    } 
    // elseif (in_array($new_bsb, $me_bsb) && mysqli_num_rows($personsl_acctchecker) > 0) {
    //   echo "You can't make a payment to this recipient.";
    // }
    // elseif (in_array($new_bsb, $me_bsb) && mysqli_num_rows($acctchecker) < 1) {
    //   echo "The ME Bank recipient account doesn't exists";
    // }
    else{
      $tnx_id = generaterandomnum($conn, $userid);
      $full_date = date("d M, Y H:i:s");
      $data_tnx = date("M d, Y H:i:s");
      $day = strtoupper(date('D'));
      $month = strtoupper(date('M'));
      $year = date('Y');
      $tnx_data = $routing_filter.",".$filteracctnum;
      $otp = generaterandomotp($conn);

      $fetchtnxdata = fetchdata($conn, 'tnx', 'userid', $data_userid, 'transaction');

      if (!empty($fetchtnxdata)) {
        $withdrawdata = $tnx_id."--"."debit"."--"."local"."--".$tnx_data."--".$filteramount."--"."pending"."--".$data_tnx;
        $insertval = $fetchtnxdata.' => '.$withdrawdata;
      }
      else{
        $insertval = $tnx_id."--"."debit"."--"."local"."--".$tnx_data."--".$filteramount."--"."pending"."--".$data_tnx;
      }

      $insertqry = mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$insertval',`tnx_status`='active',`tnx_otp`='$otp' WHERE userid = '$data_userid'");

      if ($insertqry) {
        echo "1".'|'.urlencode(base64_encode(base64_encode($tnx_id)));
      }
      else{
        echo "System Error";
      }
    }
  }
  if (isset($_POST['check_active_tnx'])) {
    $fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tnx` WHERE `userid` = '$userid' ORDER BY id DESC LIMIT 1"));
    if ($fetch['tnx_status'] == 'active') {
      echo "1";
    }
    else {
      echo "0";
    }
  }
  if (isset($_POST['py_submitOTP'])) {
    $data_otp = cleanstring($conn, $_POST['data_otp']);
    $data_ID = cleanstring($conn, $_POST['data_ID']);

    $otp_filter = preg_replace("/[^0-9]/", '', $data_otp);
    $otp_data_val = (string)$otp_filter;

    $otp_fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tnx` WHERE `userid` = '$userid' ORDER BY id DESC LIMIT 1"));

    $get_data = get_array_by_id($conn, $userid, trim($data_ID));

    $amount = $get_data[4];
    
    if (empty($data_otp) || empty($data_ID)) {
      echo "Enter OTP";
    }
    elseif (!check_if_key_exists($conn, $userid, trim($data_ID))) {
      echo "error";
    }
    elseif (strlen($otp_data_val) !== 9) {
      echo "Invalid OTP";
    }
    elseif ($otp_fetch['tnx_otp'] !== $otp_data_val) {
      echo "Invalid OTP";
    }
    elseif (!checkbalance($conn, $get_data[4], $userid)) {
      echo "Insufficient fund";
    }
    else{      
      $transfer_lock_status = fetchdata($conn, 'clients', 'email', $userid, 'tnx_lock');

      if ($transfer_lock_status == 'on') {
        mysqli_query($conn, "UPDATE `tnx` SET `tnx_status` = 'active' WHERE `userid` = '$userid'");

        // echo "2".'|'.urlencode(base64_encode(base64_encode($otp_fetch['tnx_id'])));
      }
      else{
        if (trim(strtolower($get_data[5])) == 'pending' && trim(strtolower($get_data[1])) == 'debit') {

        $status = 'success';   

        $site_routing = fetchdataall($conn, 'site_data', 'routing');

        $account_data_exp = explode(",", $get_data[3]);

        if ($site_routing == $account_data_exp[0]) {

            $receiver_account = $account_data_exp[1];

            $receiver_fetch_id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `clients` WHERE `account_number` = '$receiver_account'"));

            $sender_id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$userid'"));

            $receive_userid = $receiver_fetch_id['email'];
            $tnx_id = generaterandomnum($conn, $receive_userid);
            $full_date = date("d M, Y H:i:s");
            $receiver_tnx_data = $sender_id['routing_number'].",".$sender_id['account_number'];

            $new_data_tnx = update_arry_tnx($conn, $userid, $status, trim($data_ID));  

            $receiver_data = fetch_modify_tnx($conn, $receive_userid, $tnx_id, 'credit', 'local', $receiver_tnx_data, $amount, $status, $full_date);

            mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$new_data_tnx', `tnx_status`='inactive' WHERE userid = '$userid'");

            mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$receiver_data' WHERE userid = '$receive_userid'");

            debit_balance($conn, $amount, $userid);

            credit_balance($conn, $amount, $receive_userid);
        }
        else{
            $new_data_tnx = update_arry_tnx($conn, $userid, $status, trim($data_ID)); 

            mysqli_query($conn, "UPDATE `tnx` SET `transaction`='$new_data_tnx', `tnx_status`='inactive' WHERE userid = '$userid'");

            debit_balance($conn, $amount, $userid);
        }
        echo "1".'|'.urlencode(base64_encode(base64_encode(trim($data_ID))));
        }
        else{
            echo "2".'|'.urlencode(base64_encode(base64_encode(trim($data_ID))));
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
