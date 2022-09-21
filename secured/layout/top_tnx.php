<div class="col-md-6">
  <div class="card shadow mb-4 eq-card">
    <div class="card-header">
      <strong>Top Transaction</strong>
    </div>
    <div class="card-body px-4">
      <div class="row border-bottom">
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted">Total Transaction</p>                          
          <span class="h3"><?php echo count($fetchtnx_arry = fetchTnxdata($conn, $userid)); ?></span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted">Highest Debit</p>
          <span class="h3">$<?php print_r(fetch_max($conn, $userid, 'debit')); ?></span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted">Highest Cedit</p>
          <span class="h3">$<?php echo thousandsCurrencyFormatb(fetch_max($conn, $userid, 'credit')); ?></span><br />
        </div>
      </div>
      <table class="table table-borderless h6 mt-3 mb-1 mx-n1 table-sm">
        <thead>
          <tr>
            <th class="w-50">Transaction</th>
            <th class="text-right">Amount</th>
            <th class="text-right">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Top Credit</td>
            <?php 
              $tnx_data_credit = fetch_data_arry_sort($conn, $userid, 'credit', 'success');
              if (empty($tnx_data_credit)) { ?>
                <td class="text-right" colspan="2">No data yet</td>
              <?php }
              else{ ?>
                <td class="text-right">$<?php echo thousandsCurrencyFormat($tnx_data_credit[4]); ?></td>
                <td class="text-right"><?php $data_exp_date = explode(" ", $tnx_data_credit[6]); echo $data_exp_date[0]." ".$data_exp_date[1]." ".$data_exp_date[2] ?></td>
              <?php }
            ?>
          </tr>

          <tr>
            <td>Top Debit</td>
            <?php 
              $tnx_data_debit = fetch_data_arry_sort($conn, $userid, 'debit', 'success');
              if (empty($tnx_data_debit)) { ?>
                <td class="text-right" colspan="2">No data yet</td>
              <?php }
              else{ ?>
                <td class="text-right">$<?php echo thousandsCurrencyFormat($tnx_data_debit[4]); ?></td>
                  <td class="text-right"><?php $data_exp_date = explode(" ", $tnx_data_debit[6]); echo $data_exp_date[0]." ".$data_exp_date[1]." ".$data_exp_date[2] ?></td>
              <?php }              
            ?>
          </tr>
        </tbody>
      </table>
    </div> <!-- .card-body -->
  </div> <!-- .card -->
</div> <!-- .col -->