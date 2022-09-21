<?php 
  include '../includes/__function.php';
  include 'inc/__user.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Dashboard</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <link rel="stylesheet" href="css/card.css">
  </head>
  <body class="vertical light">
    <div class="wrapper">
      <!-- nav bar -->
      <?php include"layout/navbar.php"; ?>
      <!-- nav bar -->
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <!-- header -->
              <?php include"layout/header.php"; ?>
              <!-- header ends here -->

              <div class="row align-items-center mb-4">
                <div class="col">
                  <h2 class="h3 page-title">Bank account **<?php echo substr(fetchdata($conn, 'clients', 'email', $userid, 'account_number'), 5) ?></h2>
                </div>
              </div> <!-- .row -->
              <?php 
                $qry = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `card` WHERE userid = '$userid'"));
                $datacard = json_encode($qry['card']);
              ?>
              <div class="row align-items-center justify-content-betwee">  
                <div class="col-main1 wow zoomIn">
                    <div class="img-fluid">
                      <div class="card-list">
                         <div class="card-item">
                            <div class="card-item__side -front">
                               <div class="card-item__focus" ref="focusElement"></div>
                               <div class="card-item__cover_wrapper"></div>
                               <div class="card-item__cover">                                
                                  <img src="assets/card_skin/1.jpeg" class="card-item__bg" id="card__img">
                               </div>
                               <div class="card-item__wrapper">
                                  <div class="card-item__top">
                                     <img src="assets/card_skin/chip.png" class="card-item__chip">
                                     <div class="card-item__type">
                                        <transition name="slide-fade-up">
                                           <img src="assets/card_skin/mastercard.png" alt="" class="card-item__typeImg">
                                        </transition>
                                     </div>
                                  </div>
                                  <label for="cardNumber" class="card-item__number" id="card_user">
                                  </label>
                                  <div class="card-item__content">
                                     <label for="cardName" class="card-item__info" ref="cardName">
                                        <div class="card-item__holder">Card Holder</div>
                                        <transition name="slide-fade-up">
                                           <div class="card-item__name">
                                              <transition-group name="slide-fade-right">
                                                 <span class="card-item__nameItem"><?php echo ucwords(fetchdata($conn, 'clients', 'email', $userid, 'firstname'))." ".ucwords(fetchdata($conn, 'clients', 'email', $userid, 'lastname')); ?></span>
                                              </transition-group>
                                           </div>
                                        </transition>
                                     </label>
                                     <div class="card-item__date" ref="cardDate">
                                        <label for="cardMonth" class="card-item__dateTitle mb-0">Expires</label>
                                        <label for="cardMonth" class="card-item__dateItem">
                                           <transition name="slide-fade-up">                                              
                                              <span><?php echo $qry['expiry'] ?></span>
                                           </transition>
                                        </label>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="card-item__side -back">
                               <div class="card-item__cover">
                                  <img  v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
                               </div>
                               <div class="card-item__band"></div>
                               <div class="card-item__cvv">
                                  <div class="card-item__cvvTitle">CVV</div>
                                  <div class="card-item__cvvBand">
                                     <span v-for="(n, $index) in cardCvv" :key="$index">
                                     *
                                     </span>
                                  </div>
                                  <div class="card-item__type">
                                     <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                    </div>
                  </div>              
                <div class="col-main2 wow fadeInLeft">
                  <!-- charts-->
                  <div class="row my-4">
                    <div class="col-md-12">
                      <div class="chart-box">
                        <div id="columnChart"></div>
                      </div>
                    </div> <!-- .col -->
                  </div> <!-- end section -->
                </div>                
              </div>

              <div class="row">
                <!-- Recent orders -->
                <div class="col-md-12">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">Transactions</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>TNX ID</th>
                            <th>Transaction</th>
                            <th>Amount</th>
                            <th>TNX Type</th>
                            <th>Date</th>    
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                            $total_data = fetchTnxdata_rev($conn, $userid);
                            if (!empty($total_data)) {
                              if (count($total_data) > 10) {$ycount = 10;}
                              else{$ycount = count($total_data);}
                              $counter = 1;
                              for ($x=0; $x < $ycount; $x++) { ?>
                                <?php $exp_data = explode("--", $total_data[$x]); ?>
                                <tr>
                                  <td><?php echo $counter++; ?></td>  
                                  <td><small><?php echo $exp_data[0]; ?></small></td>  
                                  <?php 
                                    if (strtolower($exp_data[1]) == 'credit') {
                                      $tnx_color = 'success';
                                    }
                                    elseif (strtolower($exp_data[1]) == 'debit') {
                                      $tnx_color = 'danger';
                                    }
                                    else{
                                      $tnx_color = 'secondary';
                                    }
                                  ?>     
                                  <?php 
                                    $exp_data_account_info = explode(",", $exp_data[3]);   
                                  ?>                             
                                  <td><?php echo ucfirst($exp_data[1]); ?><br /><span class="dot dot-md bg-<?php echo $tnx_color; ?> mr-2"></span><span class="small"><?php if (!empty($exp_data_account_info[2])) {echo $exp_data_account_info[2];} else{echo "N/A";} ?></span></td>     
                                  <td>
                                    $<?php echo number_format($exp_data[4], 2); ?>                                      
                                  </td> 
                                  <td>
                                    <?php
                                      if (strtolower($exp_data[2]) == 'local') {
                                        echo "Local Transfer";
                                      }
                                      elseif (strtolower($exp_data[2]) == 'inter') {
                                        echo "International Transfer";
                                      }
                                      else{
                                        echo "N/A";
                                      }
                                    ?>                                      
                                  </td>                              
                                  <td>
                                    <?php 
                                      $date_exp = explode(" ", $exp_data[6]);
                                      $time_exp = explode(":", $date_exp[3]);
                                      echo $date_exp[0]." ".$date_exp[1]." ".$date_exp[2]." ".$time_exp[0].":".$time_exp[1];
                                    ?>                                      
                                  </td>
                                  <?php 
                                    if (strtolower($exp_data[5]) == 'success') {
                                      $stat_color = 'success';
                                      $stat_message = 'Successful';
                                    }
                                    elseif (strtolower($exp_data[5]) == 'pending') {
                                      $stat_color = 'warning';
                                      $stat_message = 'pending';
                                    }
                                    elseif (strtolower($exp_data[5]) == 'failed') {
                                      $stat_color = 'danger';
                                      $stat_message = 'Failed';
                                    }
                                    else{
                                      $stat_color = 'secondary';
                                      $stat_message = $exp_data[5];
                                    }
                                  ?>
                                  <td><span class="dot dot-md bg-<?php echo $stat_color; ?> mr-2"></span> <small class="text-muted"><?php echo ucfirst($stat_message); ?></small></td>
                                </tr>
                              <?php }  
                            }
                            else{ ?>
                              <tr>
                                <td colspan="5">No Data yet</td>
                              </tr>
                            <?php }
                          ?>
                        </tbody>
                      </table>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- / .col-md-8 --> <!-- / .col-md-3 -->
              </div>

            </div>
          </div> <!-- .row -->
        </div> 
         <?php include 'layout/notification.php'; ?>
        <?php include 'inc/__chart.php'; ?>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src="js/apps.js"></script>
    <script>var cardnum = <?php echo json_encode($datacard);  ?>;</script>
    <script src="script/card.js"></script>
  </body>
</html>