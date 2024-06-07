<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$gethardware=getHardware();
$vendor=getVendorShop();
?>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Hardware Type</label>
                                            <select class="form-control" name="hardware_type">
                                                <?php foreach($gethardware as $hardware){?>
                                                <option value="<?php echo $hardware['name'] ?>"><?php echo $hardware['name'] ?></option>
                                                <?php } ?>
                                            
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Model</label>
                                            <select class="form-control" name="model">
                                            <?php foreach($gethardware as $hardware){?>
                                                <option value="<?php echo $hardware['models'] ?>"><?php echo $hardware['models'] ?></option>
                                                <?php } ?>
                                            
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Vendor Name</label>
                                            <select class="form-control" name="vendor_name">
                                            <?php foreach($vendor as $vendor1){?>
                                                <option value="<?php echo $vendor1['name'] ?>"><?php echo $vendor1['name'] ?></option>
                                                <?php } ?>
                                            
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Price</label>
                                            <input type="text" name="price" class="form-control">
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Buying Date</label>
                                            <input type="date" name="buying_date" class="form-control">
                                        </div>
                                        </div>
                                        <h5>Warrenty</h5>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Start Date</label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                        </div>

                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">End Date</label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Upload Bill</label>
                                            <input type="file" name="fimages" class="form-control">
                                        </div>
                                        </div>
                                        <div class="text-end">
                                             <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php include './includes/footer.php'?>
		
    </body>
</html>


<?php
if (isset($_POST['submit'])) {
    $hardware_type = $_POST['hardware_type'];
    $model = $_POST['model'];
    $vendor_name = $_POST['vendor_name'];
    $price = $_POST['price'];
    $buying_date = $_POST['buying_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $created_time = date('Y-m-d H:i:s');

    $fimage = $_FILES['fimages']['name'];
    if ($fimage) {
      $fimage_temp = $_FILES['fimages']['tmp_name'];
      $filename = $hardware_type . '_' . time();
      $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
      $filename .= '.png';
  
      if (move_uploaded_file("$fimage_temp", "uploads/bills//$filename")) {
        $fimagee = 'uploads/bills/' . $filename;
      } else {
        var_dump("Not Upload");
      }
    }
    $insertquery = "INSERT INTO `system`( `hardware_type`, `model`, `vendor_name`, `price`, `buying_date`, `start_date`,`end_date`,`image`,`created_at`,`updated_at`) VALUES ('$hardware_type','$model','$vendor_name','$price','$buying_date','$start_date','$end_date','$fimagee','$created_time','$created_time')";
    // var_dump($insertquery);
    $iquery = mysqli_query($conn, $insertquery);
    if ($iquery) {
        $last_inserted_id = mysqli_insert_id($conn);
        $update = "UPDATE `system` SET system_no ='$last_inserted_id' WHERE id = $last_inserted_id";
        $update1 = mysqli_query($conn, $update);
?>
        <script>
            toastr.success('Added Successfully!');
			setTimeout(function() {
			window.location = "all-system.php";
			}, 1000);
        </script>
    <?php
    } else {
    ?><script>
           toastr.error('Error!');
			setTimeout(function() {
			window.location = "add-system.php";
			}, 1000);
        </script><?php
                };
            }
                    ?>