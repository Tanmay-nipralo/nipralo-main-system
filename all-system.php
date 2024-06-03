<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclient = getAllSystem();
$gethardware=getHardware();
$vendor=getVendorShop();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.table td{
		max-width: 200px;
		white-space: normal;
	}

	.table-responsive {
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
}
.dataTables_length label{
	position: absolute;
    top: 80px;
    right: 198px;
}
</style>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
                                        <th>Sr No</th>
                                        <th>System No</th>
											<th>Hardware Type</th>
											<th>Model</th>
											<th>Vendor Name</th>
											<th>Price</th>
                                            <th>Buying Date</th>
                                            <th>Warrenty</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($getclient as $client) { ?>
										<tr>
											<td><?php echo $i++; ?></td>	
                                            <td><?php echo $client['system_no'] ?></td>	
											<td><?php echo $client['hardware_type'] ?></td>
											<td><?php echo $client['model'] ?></td>
											<td><?php echo $client['vendor_name'] ?></td>
                                            <td><?php echo $client['price'] ?></td>
                                            <td><?php echo $client['buying_date'] ?></td>
                                            <td><?php echo $client['start_date'] ?> to <?php echo $client['end_date'] ?></td>
											<td class='text-end'>
												<div class='dropdown dropdown-action'>
													<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
													<div class='dropdown-menu dropdown-menu-right'>
														<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_client<?php echo $client['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>
														<a class='dropdown-item' href='all-system.php?deleteid=<?php echo $client['id']?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
	
				<?php foreach ($getclient as $row2) { ?>
				<div id="edit_client<?php echo $row2['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Client</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post"  enctype="multipart/form-data">
									<div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">System No</label>
                                            <input type="text" name="system_no" class="form-control" value="<?php echo $row2['system_no'] ?>" readonly>
                                        </div>
                                        </div>
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Hardware Type</label>
                                          <select class="form-control" name="hardware_type">
                                            <?php foreach ($gethardware as $hardware) { ?>
                                                <option value="<?php echo $hardware['name'] ?>" <?php if ($hardware['name'] == $row2['hardware_type']) echo "selected" ?>><?php echo $hardware['name'] ?></option>
                                            <?php } ?>
                                        </select>

                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Model</label>
                                            <select class="form-control" name="model">
                                                <?php foreach ($gethardware as $hardware) { ?>
                                                    <option value="<?php echo $hardware['models'] ?>" <?php if ($hardware['models'] == $row2['model']) echo "selected" ?>> <?php echo $hardware['models'] ?> </option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Vendor Name</label>
                                            <select class="form-control" name="vendor_name">
                                                <?php foreach ($vendor as $vendor1) { ?>
                                                    <option value="<?php echo $vendor1['name'] ?>" <?php if ($vendor1['name'] == $row2['vendor_name']) echo "selected" ?>> <?php echo $vendor1['name'] ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Price</label>
                                            <input type="text" name="price" class="form-control" value="<?php echo $row2['price'] ?>">
                                            <input type="hidden" name="id" class="form-control" value="<?php echo $row2['id'] ?>">
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Buying Date</label>
                                            <input type="date" name="buying_date" class="form-control" value="<?php echo $row2['buying_date'] ?>">
                                        </div>
                                        </div>
                                        <h5>Warrenty</h5>
                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Start Date</label>
                                            <input type="date" name="start_date" class="form-control" value="<?php echo $row2['start_date'] ?>">
                                        </div>
                                        </div>

                                        <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">End Date</label>
                                            <input type="date" name="end_date" class="form-control" value="<?php echo $row2['end_date'] ?>">
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="input-block mb-3">
											<label class="col-form-label">Upload Bill</label>
											<input type="hidden" name="previous_image" value="<?php echo $row2['image']; ?>">
											<input type="file" accept="image/*" class="form-control" name="fimages" />
											<?php if (!$row2) {
												echo "No image found for ID $id";
											} else {
												echo '<img src="' . $row2['image'] . '" style="height:50px;">';
											} ?>
										</div>
                                        </div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="updateClient">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
            </div>
        </div>
		<?php include './includes/footer.php'?>

        <?php
if (isset($_GET['deleteid'])) {
	$id = $_GET['deleteid'];
	if ($id) {
			echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
			echo '<script>';
			echo 'Swal.fire({
					title: "Are you sure?",
					text: "You won\'t be able to revert this!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "No, cancel",
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "all-system.php?id=' . $id . '";
					} else {
						window.location.href = "all-system.php";
					}
				});';
			echo '</script>';
		}
	}   

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `system` SET `status`= 5 WHERE id=".$id;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>window.location.href = 'all-system.php'</script>";
	} else {
		die(mysqli_error($conn));
	}
}
?>
    </body>
</html>
<?php 	
	if(isset($_POST['updateClient'])){
		$id =$_POST['id'];
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
				$filename = $first_name . '_' . time();
				$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
				$filename .= '.png';

				if (move_uploaded_file("$fimage_temp", "uploads/bills/$filename")) {
					$fimagee = 'uploads/bills/' . $filename;
				} else {
					var_dump("Not Upload");
				}
			} else {
				$fimagee = $_POST['previous_image'];
			}

            $query = "UPDATE `system` SET hardware_type = '$hardware_type', model = '$model', vendor_name = '$vendor_name', price = '$price', buying_date = '$buying_date', start_date = '$start_date', end_date = '$end_date', image = '$fimagee', updated_at = '$created_time' WHERE id = $id";
			$iquery = mysqli_query($conn, $query);
		if ($iquery) {
			?>
			<script>
				toastr.success('Updated Successfully!');
				setTimeout(function() {
				window.location = "all-system.php";
				}, 1000);
			</script>
		<?php
			} else {
				?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
				window.location = "all-system.php";
				}, 1000);
			</script>
		<?php
			}
		}
?>