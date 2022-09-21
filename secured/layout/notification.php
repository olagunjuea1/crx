<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="list-group list-group-flush my-n3">
          <?php 
            $fetch_tnx_arry = fetchdata($conn, 'tbl_notif', 'userid', $userid, 'message');
            $notif = explode("=>", $fetch_tnx_arry);

            if (empty($notif)) {
              if (count($notif) > 10) {$ycount = 10;}
              else{$ycount = count($notif);}
              $counter = 1;
              for ($x=0; $x < $ycount; $x++) { ?>
                <?php $exp_data = explode("--", $notif[$x]); ?>
                <div class="list-group-item bg-transparent">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="fe fe-box fe-24"></span>
                    </div>
                    <div class="col">
                      <small><strong><?php echo ucfirst($exp_data[1]); ?></strong></small>
                      <div class="my-0 text-muted small"><?php echo ucfirst($exp_data[2]); ?> </div>
                      <small class="badge badge-pill badge-light text-muted"><?php echo time_elapsed_string(strtotime(str_replace(",", "", $exp_data[3]))); ; ?></small>
                    </div>
                  </div>
                </div>
              <?php }  
            }
            else{ ?>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-box fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>No New Notification</strong></small>
                    <div class="my-0 text-muted small">You don't have a new notification currently</div>
                  </div>
                </div>
              </div>
            <?php }
          ?>         
          
        </div> <!-- / .list-group -->
      </div>
      <a href="Notification.php">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-block">See All</button>
        </div>
      </a>
    </div>
  </div>
</div>