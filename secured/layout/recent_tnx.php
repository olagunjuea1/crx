<div class="col-md-6">
  <div class="card shadow mb-4 eq-card">
    <div class="card-header">
      <strong class="card-title">Recent Transaction</strong>
      <a class="float-right small text-muted" href="Transaction.php">View all</a>
    </div>
    <div class="card-body">
      <?php 
        $fetchtnx_arry = fetchTnxdata_rev($conn, $userid);
        if (!empty($fetchtnx_arry)) {
          if (count($fetchtnx_arry) > 5) {$ycount = 5;}
          else{$ycount = count($fetchtnx_arry);}
          $counter = 1;
          for ($x=0; $x < $ycount; $x++) { ?>
            <?php $tnx_data_list = explode("--", $fetchtnx_arry[$x]); ?>
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col-3 col-md-2">
                    <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                  </div>
                  <div class="col">
                    <?php 
                      if ($tnx_data_list[1] == 'credit') {
                        $tnxtype = 'Transfer In';
                      }
                      elseif ($tnx_data_list[1] == 'debit') {
                        $tnxtype = 'Transfer Out';
                      }
                      elseif ($tnx_data_list[1] == 'deposit') {
                        $tnxtype = 'Deposit';
                      }
                      else{
                        $tnxtype = 'Transfer';
                      }
                    ?>
                    <strong><?php echo $tnxtype; ?></strong>
                    <div class="my-0 text-muted small">Gear, Bags</div>
                  </div>
                  <div class="col-auto">
                    <strong>$<?php echo thousandsCurrencyFormat($tnx_data_list[4]); ?></strong>
                    <div class="progress mt-2" style="height: 4px;">
                      <?php 
                        if ($tnx_data_list[5] == 'success') {
                          $tnxcolor = 'success';
                          $tnxwidth = '100';
                        }
                        elseif ($tnx_data_list[5] == 'pending') {
                          $tnxcolor = 'warning';
                          $tnxwidth = '50';
                        }
                        elseif ($tnx_data_list[5] == 'failed') {
                          $tnxcolor = 'danger';
                          $tnxwidth = '100';
                        }
                        else{
                          $tnxcolor = 'success';
                          $tnxwidth = '100';
                        }
                      ?>
                      <div class="progress-bar bg-<?php echo $tnxcolor; ?>" role="progressbar" style="width: <?php echo $tnxwidth; ?>%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- / .list-group -->
          <?php }  
        }
        else{ ?>
          <tr>
            <td colspan="5">You don't have an active transaction yet</td>
          </tr>
        <?php }



       
      ?>
      
    </div> <!-- / .card-body -->
  </div> <!-- .card -->
</div> <!-- .col -->