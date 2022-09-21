<?php 
   $cyear = date('Y');

   function chartFunc($conn, $userid, $txntype, $cyear, $status){
    $fectch_data = fetchdata($conn, 'tnx', 'userid', $userid, 'transaction');
    $txndatafetch = explode(" => ", $fectch_data);

    if (!empty($fectch_data)) {
        $montharry = array("JAN","FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
        $countmonth = count($montharry);
        $needle = "";
        $datachart = "";

        for ($x=0; $x < $countmonth; $x++) { 
         $needle = $montharry[$x];
         $searchresult = array();
         foreach ($txndatafetch as $key => $value) {
           $expdataval = explode("--", $txndatafetch[$key]);
           $data_date = explode(" ", $expdataval[6]);
           if ($needle == strtoupper($data_date[0]) && $cyear == $data_date[2] && $txntype == $expdataval[1] && $status == $expdataval[5]) {
             $searchresult[] = $expdataval[4];
           }                          
         }  
         $datachart .= array_sum($searchresult)." ";
        }
        return $filterchartdata = rtrim($datachart, " ");
       }
    else{
        return $filterchartdata = "0 0 0 0 0 0 0 0 0 0 0 0";   
    }   
   }
?>
<?php 
  $credit_data = json_encode(explode(" ", chartFunc($conn, $userid, 'credit', $cyear, 'success')));
  $debit_data = json_encode(explode(" ", chartFunc($conn, $userid, 'debit', $cyear, 'success')));

  $ct_balance = fetchdatabalance($conn, 'account', 'userid', $userid, 'balance');
  $ct_available = fetchdatabalance($conn, 'account', 'userid', $userid, 'available_balance');

  $this_month = calc_sum_this_month($conn, $userid, 'credit', 'success');
  $last_month = calc_sum_last_month($conn, $userid, 'credit', 'success');

  function calcluate_per($a, $b){
    if ($a == 0 || $b == 0) {
      return (int)"100";
    }
    elseif ($a > $b) {
      return round(($b / $a) * 100, 2);
    }
    elseif ($b > $a) {
      return round(($a / $b) * 100, 2);
    }    
    else{
      return (int)"100";
    }
  }


  $cal_per_rad = calcluate_per($ct_balance, $ct_available);
  $cal_credit_month = calcluate_per($this_month, $last_month);

  $balance = fetchdatabalance($conn, 'account', 'userid', $userid, 'balance');
  $a_balance = fetchdatabalance($conn, 'account', 'userid', $userid, 'available_balance');
  $credit = fetchdatabalance($conn, 'account', 'userid', $userid, 'credit');
  $debit = fetchdatabalance($conn, 'account', 'userid', $userid, 'debit');
?>
<script type="text/javascript">
  var py_credit_chart = JSON.parse('<?= $credit_data; ?>');
  var py_debit_chart = JSON.parse('<?= $debit_data; ?>');
  var py_radial = JSON.parse('<?= $cal_per_rad; ?>');
  var py_radial_month = JSON.parse('<?= $cal_credit_month; ?>');
  var py_balance = JSON.parse('<?= $balance; ?>');
  var py_avail_balance = JSON.parse('<?= $a_balance; ?>');
  var py_credit = JSON.parse('<?= $credit; ?>');
  var py_debit = JSON.parse('<?= $debit; ?>');
</script>
