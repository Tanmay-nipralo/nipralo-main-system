<?php 
    include '_includes/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard | Payment</title>
    <?php include '_includes/header.php'; ?>
  </head>
  <body class="layout layout-header-fixed">
    <?php include '_includes/topbar.php'; ?>
    <div class="layout-main">
      <?php include '_includes/sidebar.php'; ?>
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Payment</span>
            </h1>
          </div>
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <table id="demo-datatables-responsive-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Booking ID</th>
                        <th>Client Name</th>
                        <th>Project Name</th>
                        <th>Total Payment</th>
                        <th>Pending Payment</th>
                        <th>Payment</th>
                        <th>Stage</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        // fetch all data form booking table

                        $clientt = "SELECT * FROM booking";
                        $result = mysqli_query($con, $clientt);

                        while ($rows= mysqli_fetch_assoc($result)) {

                          //fetch name from client table

                          $client_details="SELECT `name` FROM client WHERE client_id=$rows[client_id]";
                          $client_result=mysqli_query($con,$client_details);
                          $client_rows=mysqli_fetch_assoc($client_result);
                      ?>
                      <tr>
                        <td><?php echo $rows['id']?></td>
                        <td><?php echo $rows['booking_id']?></td>
                        <td><?php echo $client_rows['name']?></td>
                        <td><?php echo $rows['project_name']?></td>

                        <!-- select all record from project master which matches project name -->

                        <?php 
                          $project_name=$rows['project_name'];

                          $project_var="SELECT * FROM `project-master` WHERE projectname = '$project_name'";
                          $project_result = mysqli_query($con, $project_var);

                          $bookkid=$rows['booking_id'];
                          $varr="SELECT * FROM `client_payment` WHERE book_id = '$bookkid'";
                          $resultt = mysqli_query($con, $varr);
                          $rowss_pay= mysqli_fetch_assoc($resultt);
                        ?>

                        <td><?php echo $rows['new_cost']?></td>

                        <?php
                        $total_value=$rows_pay['act_val'];
                        $col1_value = $rowss_pay['token_amt'];
                        $col2_value = $rowss_pay['dp_amt'];
                        $col3_value = $rowss_pay['slap1_amt'];
                        $col4_value = $rowss_pay['slap2_amt'];
                        $col4_value = $rowss_pay['slap3_amt'];

                        $difference = abs($col1_value + $col2_value + $col3_value + $col4_value - $total_value);
                        ?>
                        <td><?php echo  $difference?></td>
                        <td><button class="btn btn-outline-info btn-sm btn-labeled" type="button" data-toggle="modal" data-target="#payment<?php echo $rows['booking_id'];?>">Payment</button></td>

                        <!-- Display status of payment -->
                        <td>
                          <?php 
                          if ($resultt->num_rows > 0) {

                            if (!empty($rowss_pay['sc1']) && !empty($rowss_pay['sc2']) && !empty($rowss_pay['sc3']) && !empty($rowss_pay['sc4']) || !empty($rowss_pay['sc5'])) {
                              echo "DONE";
                            }elseif (!empty($rowss_pay['sc1']) && !empty($rowss_pay['sc2']) && !empty($rowss_pay['sc3']) && !empty($rowss_pay['sc4'])) {
                              echo "Slab2 DONE";
                            }elseif (!empty($rowss_pay['sc1']) && !empty($rowss_pay['sc2']) && !empty($rowss_pay['sc3'])) {
                              echo "Slab1 DONE";
                            }elseif (!empty($rowss_pay['sc1']) && !empty($rowss_pay['sc2'])) {
                              echo "DP DONE";
                            } elseif (!empty($rowss_pay['sc1'])) {
                              echo "TOKEN DONE";
                            }
                          } else {
                            echo "PENDING";
                          }
                          ?> 
                        </td>
                        
                        <td>
                          <button class="btn btn-outline-default btn-icon sq-24" type="button" data-toggle="modal" data-target="#sendsms<?php echo $rows['booking_id'];?>">
                              <span class="icon icon-send" data-toggle="tooltip" data-placement="top" title="Send Message"></span>
                          </button>

                          <a href="client_payment.php?bookingid=<?php echo $rows['booking_id'] ?>">
                            <button class="btn btn-outline-default btn-icon sq-24" type="button" data-toggle="tooltip" data-placement="top" title="Payment">
                              <span class="icon icon-inr"></span>
                            </button>
                          </a>

                          <a href="booking-details.php?bookingid=<?php echo $rows['booking_id'] ?>">
                            <button class="btn btn-outline-default btn-icon sq-24" type="button" data-toggle="tooltip" data-placement="top" title="View">
                              <span class="icon icon-eye"></span>
                            </button>
                          </a>

                          <?php                                      
                            if($_SESSION['role']=="Superadmin"){
                          ?>
                          <a href="delete.php?bookingdelid=<?php echo $rows['booking_id'] ?>">
                            <button class="btn btn-outline-default btn-icon sq-24" type="button" data-toggle="tooltip" data-placement="top" title="Delete">
                            <span class="icon icon-trash-o"></span>
                            </button></a>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include '_includes/footer.php'; ?>
    </div>
  </body>
</html>

<!-- Start Modal for payment information -->

<?php
    $client = "select * from client_payment";
    $result = mysqli_query($con, $client);

    while($client_row = mysqli_fetch_assoc($result)){
?>
  <div id="payment<?php echo $client_row['book_id'];?>" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-sm-7">
              <h4 class="modal-title">Payment Details</h4>
            </div>
            <div class="col-sm-5">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
              </button>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <form class="form" data-toggle="validator" method="post">
            <div class="row">
              <div class="col-sm-4">
                <span class="btn btn-sm btn-danger" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Token</span>
              </div>
              <div class="col-sm-4">
                <?php
                if(!empty($client_row['token_amt'])){
                  ?>
                  <span class="btn btn-sm btn-success" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Done</span>
                  <?php
                }else{
                  ?>
                  <span class="btn btn-sm btn-primary" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Pending</span>
                  <?php
                }
                ?>
              </div>
              <div class="col-sm-4">
                <span class="btn btn-sm btn-default" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;"><?php echo $client_row['token_date']?></span>
              </div>

              <div class="col-sm-4">
                <span class="btn btn-sm btn-danger" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Down Payment</span>
              </div>
              <div class="col-sm-4">
                <?php
                if(!empty($client_row['dp_amt'])){
                  ?>
                  <span class="btn btn-sm btn-success" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Done</span>
                  <?php
                }else{
                  ?>
                  <span class="btn btn-sm btn-primary" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Pending</span>
                  <?php
                }
                ?>
              </div>
              <div class="col-sm-4">
                <span class="btn btn-sm btn-default" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;"><?php echo $client_row['dp_date']?></span>
              </div>
              <div class="col-sm-4">
                <span class="btn btn-sm btn-danger" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Slab 1</span>
              </div>
              <div class="col-sm-4">
                <?php
                if(!empty($client_row['slap1_amt'])){
                  ?>
                  <span class="btn btn-sm btn-success" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Done</span>
                  <?php
                }else{
                  ?>
                  <span class="btn btn-sm btn-primary" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Pending</span>
                  <?php
                }
                ?>
              </div>
              <div class="col-sm-4">
                <span class="btn btn-sm btn-default" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;"><?php echo $client_row['slap1_date']?></span>
              </div>
              <div class="col-sm-4">
                <span class="btn btn-sm btn-danger" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Slab 2</span>
              </div>
              <div class="col-sm-4">
                <?php
                if(!empty($client_row['slap2_amt'])){
                  ?>
                  <span class="btn btn-sm btn-success" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Done</span>
                  <?php
                }else{
                  ?>
                  <span class="btn btn-sm btn-primary" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Pending</span>
                  <?php
                }
                ?>
              </div>
              <div class="col-sm-4">
                <span class="btn btn-sm btn-default" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;"><?php echo $client_row['slap2_date']?></span>
              </div>

              <?php
              if($client_row['slap3_amt'] != NULL){
              ?>
                <div class="col-sm-4">
                  <span class="btn btn-sm btn-danger" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Slab 3</span>
                </div>
                <div class="col-sm-4">
                  <?php
                  if(!empty($client_row['slap3_amt'])){
                    ?>
                    <span class="btn btn-sm btn-success" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Done</span>
                    <?php
                  }else{
                    ?>
                    <span class="btn btn-sm btn-pspan" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;">Pending</span>
                    <?php
                  }
                  ?>
                </div>
                <div class="col-sm-4">
                  <span class="btn btn-sm btn-default" style="width:100%;margin-bottom: 10px; border-bottom: 1px solid black;"><?php echo $client_row['slap3_date']?></span>
                </div>
                <?php
                }
                ?>
            </div> 
            <button class="btn btn-info btn-block btn-next btn-sm" type="button" data-toggle="modal" data-target="#payint<?php echo $client_row['book_id']?>" style="margin:auto;width:120px;">Send Alert</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
<?php
    $clientt = "SELECT * FROM client_payment";
    //var_dump($clientt);
    $resultt = mysqli_query($con, $clientt);
    while($client_roww = mysqli_fetch_assoc($resultt)){
    //var_dump($client_roww);
?>
<div class="modal fade" id="payint<?php echo $client_roww['book_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-sm-7">
            <h4 class="modal-title">Payment</h4>
          </div>
          <div class="col-sm-5">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
            </button>
          </div>
      </div>
      <div class="modal-body">
        <label>Amount to Pay</label>
        <input type="text" class="form-control" name="interest" value="<?php echo $payment_row['book_id'];?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="send" class="btn btn-primary btn-sm">Send Message</button>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>

<!-- modal for Sending sms -->
<?php
  $client = "select * from booking";
  $result = mysqli_query($con, $client);

  while($client_row = mysqli_fetch_assoc($result)){
?>

  <div id="sendsms<?php echo $client_row['booking_id'];?>" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-sm-7">
              <h4 class="modal-title">Message</h4>
            </div>
            <div class="col-sm-5">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
              </button>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <form class="form" data-toggle="validator" method="post">
            <div class="rows">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Client ID</label>
                  <input class="form-control" name="client_id" value="<?php echo $client_row['client_id'];?>" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Booking ID</label>
                  <input class="form-control" name="book_id" value="<?php echo $client_row['booking_id'];?>"  readonly="readonly">
                </div>
              </div>
              <?php
              $bookked= $client_row['client_id'];
              $selectvar="select * from client where client_id = $bookked";
              $resultt = mysqli_query($con, $selectvar);
              $clientt_row = mysqli_fetch_assoc($resultt)
              ?>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Contact</label>
                  <input class="form-control" type="text" value="<?php echo $clientt_row['contact'];?>" >                           
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Contact</label>
                  <input class="form-control" type="text" value="<?php echo $clientt_row['email'];?>" >                           
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Message</label>
                  <textarea class="form-control"></textarea>                          
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Attachment</label>
                  <input type="file" class="form-control" name="attachh">                          
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <button class="btn btn-default btn-block btn-next" style="margin:auto;width:200px;" type="submit" name="send_sms">Send SMS</button>
              </div>
              <div class="col-sm-6">
                <button class="btn btn-default btn-block btn-next" style="margin:auto;width:200px;" type="submit" name="send_mail">Send Mail</button> 
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<?php
    $client = "select * from client";
    $result = mysqli_query($con, $client);

    while($client_row = mysqli_fetch_assoc($result)){
?>
<div id="modalEditClient<?php echo $client_row['id'];?>" aria-labelledby="modalEditClient<?php echo $client_row['id'];?>" tabindex="-1" role="dialog" class="modal fade">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <div class="row">
        <div class="col-sm-7">
          <h4 class="modal-title">Client Details</h4>
        </div>
        <div class="col-sm-5">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
          </button>
        </div>
      </div>
    </div>
    <div class="modal-body">
      <form class="form" data-toggle="validator" method="post" action="update.php">
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $client_row['id'];?>">

          <label class="control-label">Client ID</label>
          <input class="form-control" type="text" name="client_id" value="<?php echo $client_row['client_id'];?>">
        </div>
        <div class="form-group">
          <label class="control-label">Name</label>
          <input class="form-control" type="text" name="client_name" value="<?php echo $client_row['name'];?>">
        </div>
        <div class="form-group">
          <label cmlass="control-label">Project Name</label>
          <select id="form-control-6" class="form-control" name="client_projectname">
            <option><?php echo $client_row['projectname'];?></option>
            <?php 
              foreach ($options as $option) {
                ?>
                  <option><?php echo $option['projectname']; ?> </option>
                <?php 
              }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label class="control-label">Email ID</label>
          <input class="form-control" type="text" name="client_mail" value="<?php echo $client_row['email'];?>">
        </div>
        <div class="form-group">
          <label class="control-label">Contact</label>
          <input class="form-control" type="number" name="client_con" value="<?php echo $client_row['contact'];?>">
        </div>
        <div class="row"> 
          <div class="col-sm-6">
            <div class="form-group">
            <label class="control-label">DOB</label>
            <input class="form-control" type="text" name="client_dob" value="<?php echo $client_row['dob'];?>">
          </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
            <label class="control-label">Payment</label>
            <input class="form-control" type="text" name="client_dob" value="<?php echo $client_row['dob'];?>">
          </div>
            </div>
        </div>
        <button class="btn btn-default btn-block btn-next" type="submit" name="client_update">Update</button>
      </form>
    </div>
  </div>
</div>
</div>
<?php
}
?>