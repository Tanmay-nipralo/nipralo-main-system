<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php'?>
<?php include './includes/connection.php';
$getassets = getAllAssets();
$getemployee = getAllEmployee();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
    <body>
        <div class="main-wrapper">	
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-auto float-end ms-auto">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_asset"><i class="fa-solid fa-plus"></i> Add Asset</a>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
										<th>Sr No</th>
											<th>Asset User</th>
											<th>Asset Name</th>
											<th>Purchase Date</th>
											<th>Warrenty</th>
											<th>Model</th>
											<th>Amount</th>
											<th class="text-center">Status</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$i =1;
									foreach($getassets as $assets) { ?>
											<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo !empty($assets['employee'][0]['first_name']) ? $assets['employee'][0]['first_name'] : ''; ?></td>
											<td><strong><?php echo !empty($assets['asset_name']) ? $assets['asset_name'] : ''; ?></strong></td>
											<td><?php echo !empty($assets['purchase_date']) ? $assets['purchase_date'] : ''; ?></td>
											<td><?php echo !empty($assets['warrenty']) ? $assets['warrenty'] : ''; ?></td> 
											<td><?php echo !empty($assets['model']) ? $assets['model'] : ''; ?></td>
											<td><?php echo !empty($assets['value']) ? $assets['value'] : ''; ?></td>
											<td><?php echo !empty($assets['machine_status']) ? $assets['machine_status'] : ''; ?></td>

											<td class='text-end'>
											<div class='dropdown dropdown-action'>
											<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
											<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_asset<?php echo $assets['id']; ?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>							
											<a class='dropdown-item' href='assets.php?deleteid=<?php echo $assets['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
				
				<div id="add_asset" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Asset</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Asset Name</label>
												<input class="form-control" type="text" name="asset_name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Value</label>
												<input placeholder="$1800" class="form-control" type="text" name="value">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Purchase Date</label>
												<input class="form-control datetimepicker" type="text"name="purchase_date">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Warranty</label>
												<input class="form-control" type="text" placeholder="In Months" name="warrenty">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Model</label>
												<input class="form-control" type="text" name="model">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Asset User</label>
												<select class="select" name="asset_user">
													<option value="">Select Asset User</option>
													<?php
													foreach($getemployee as $employee) { ?>
														<option value="<?php echo $employee['id'];?>"><?php echo $employee['first_name'];?></option>
													<?php } ?>
												</select>
											</div>
                                        </div>	
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Machine Status</label>
												<select class="select" name="machine_status">
													<option value="">Select Machine Status</option>
													<option value="Working">Working</option>
													<option value="Repair">Repair</option>
													<option value="Discontinuation">Discontinuation</option>
												</select>
											</div>
                                        </div>																		
										<div class="submit-section">
											<button class="btn btn-primary submit-btn" type="submit" name="add">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>

			<?php foreach($getassets as $assets1) { ?>
				<div id="edit_asset<?php echo $assets1['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Asset</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Asset Name</label>
												<input class="form-control" type="text" name="asset_name" value="<?php echo $assets1['asset_name'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Value</label>
												<input value="<?php echo $assets1['value'];?>" class="form-control" type="text" name="value">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Purchase Date</label>
												<input class="form-control datetimepicker" type="text" name="purchase_date" value="<?php echo $assets1['purchase_date'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Warranty</label>
												<input class="form-control" value="<?php echo $assets1['warrenty'];?>" name="warrenty" type="text" placeholder="In Months">
											</div>
										</div>	
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Model</label>
												<input class="form-control" type="text" name="model" value="<?php echo $assets1['model'];?>">
											</div>
										</div>
											<div class="col-sm-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Asset User</label>
													<select class="select" name="asset_user">
														<option value="">Select Asset User</option>
														<?php foreach($getemployee as $employee) { ?>
															<option value="<?php echo $employee['id']; ?>" <?php echo ($assets1['asset_user'] == $employee['id']) ? 'selected' : ''; ?>>
																<?php echo $employee['first_name']; ?>
															</option>
														<?php } ?>
													</select>

												</div>
											</div>

											<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Machine Status</label>
												<select class="select" name="machine_status">
													<option value="">Select Machine Status</option>
													<option value="Working" <?php echo ($assets1['machine_status'] == 'Working') ? 'selected' : ''; ?>>Working</option>
													<option value="Repair" <?php echo ($assets1['machine_status'] == 'Repair') ? 'selected' : ''; ?>>Repair</option>
													<option value="Discontinuation" <?php echo ($assets1['machine_status'] == 'Discontinuation') ? 'selected' : ''; ?>>Discontinuation</option>
												</select>
											</div>
                                        </div>		
										<input type="hidden" name="id" id="textField" value="<?php echo $assets1['id'];?>" required="required">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="update">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php 
				}
				?>
        </div>
		

<?php include './includes/footer.php'?>	
<?php
		if(isset($_POST['add'])){
		$asset_name = $_POST["asset_name"];
		$purchase_date = $_POST["purchase_date"];
		$model = $_POST["model"];
		$warrenty = $_POST["warrenty"];
		$value = $_POST["value"];
		$asset_user = $_POST["asset_user"];
		$machine_status = $_POST["machine_status"];
		$created_time = date('Y-m-d H:i:s');

       $sql = "INSERT INTO assets (asset_name, purchase_date, model, warrenty, value, asset_user, created_at, updated_at,machine_status)
        VALUES ('$asset_name', '$purchase_date','$model','$warrenty', '$value', '$asset_user', '$created_time', '$created_time','$machine_status')";

		$iquery = mysqli_query($conn, $sql);
		if ($iquery) {
			?>
			<script>
			toastr.success('Added Successfully!');
			setTimeout(function() {
			window.location = "assets.php";
			}, 1000);
		</script>
		<?php
		} else {
			?>
			<script>
			toastr.error('Error!');
			setTimeout(function() {
			window.location = "assets.php";
			}, 1000);
		</script>
		<?php
		}
	}
	if(isset($_POST['update'])){
		$id =$_POST['id'];
		$asset_name = $_POST["asset_name"];
		$purchase_date = $_POST["purchase_date"];
		$model = $_POST["model"];
		$warrenty = $_POST["warrenty"];
		$value = $_POST["value"];
		$asset_user = $_POST["asset_user"];
		$machine_status = $_POST["machine_status"];
		$update_time = date('Y-m-d H:i:s');
		$query = "UPDATE assets  SET asset_name = '$asset_name',purchase_date='$purchase_date',model='$model',warrenty='$warrenty',value='$value',asset_user='$asset_user', updated_at ='$update_time', machine_status ='$machine_status' WHERE id = ".$id;
		$iquery = mysqli_query($conn, $query);
		if ($iquery) {
			?>
			<script>
			toastr.success('Updated Successfully!');
			setTimeout(function() {
			  window.location = "assets.php";
			}, 1000);
	 </script>
	 <?php
		} else {
			?>
			<script>
			toastr.error('Error!');
			setTimeout(function() {
			  window.location = "assets.php";
			}, 1000);
	 </script>
	 <?php
		}
	}

	if (isset($_GET['deleteid'])) {
		$id = $_GET['deleteid'];
		if($id){
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
							window.location.href = "assets.php?id=' . $id . '";
						} else {
							window.location.href = "assets.php";
						}
					});';
				echo '</script>';
			}
		}   
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "UPDATE `assets` SET `status`= 5 WHERE id=".$id;
		$result = mysqli_query($conn, $sql);
	
		if ($result) {
			echo "<script>window.location.href = 'assets.php'</script>";
		} else {
			die(mysqli_error($con));
		}
	}
?>
	
    </body>
</html>