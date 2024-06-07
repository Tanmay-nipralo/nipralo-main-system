<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclient = getAllClient();

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

</style>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-auto float-end ms-auto">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_client"><i class="fa-solid fa-plus"></i> Add Client</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Sr No</th>
											<th>Name</th>
											<th>Client Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($getclient as $client) { ?>
										<tr>
											<td><?php echo $i++; ?></td>	
											<td><h2 class='table-avatar'>	
												<a href='client-profile.php?idd=<?php echo $client['id']?>' class='avatar'><img src='<?php echo $client['company_logo']?>' alt='User Image'></a>
												<a href='client-profile.php?idd=<?php echo $client['id'] ?>'><?php echo $client['company_name'] ?></a></h2>
											</td>
											<td><?php echo $client['client_name'] ?></td>
											<td><?php echo $client['client_mail'] ?></td>
											<td><?php echo $client['primary_phone'] ?></td>
											<td class='text-end'>
												<div class='dropdown dropdown-action'>
													<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
													<div class='dropdown-menu dropdown-menu-right'>
														<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_client<?php echo $client['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>
														<a class='dropdown-item' href='clients.php?deleteid=<?php echo $client['id']?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
	
				<div id="add_client" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Client</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post"  enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Client Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="client_name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label"> Email <span class="text-danger">*</span></label>
												<input class="form-control floating" type="email" name="mail_id">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Primary Phone <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="primary_phone">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Secondary Phone </label>
												<input class="form-control" type="text" name="secondary_phone">
											</div>
										</div>
										<div class="col-md-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Company Name</label>
												<input class="form-control" type="text" name="company_name">
											</div>
										</div>
										<div class="col-md-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Company description</label>
												<textarea class="form-control" type="text" name="company_description"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Company Address</label>
												<textarea class="form-control" type="text" name="company_address"></textarea>
											</div>
										</div>	
										<div class="input-block mb-3">
										<label class="col-form-label">Company logo</label>
										<input class="form-control" type="file" name="fimages" >
									    </div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="addClient">Submit</button>
									</div>
								</form>
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
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Client Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="client_name" value="<?php echo $row2['client_name'];?>" >
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label"> Email <span class="text-danger">*</span></label>
												<input class="form-control floating" type="email" name="mail_id" value="<?php echo $row2['client_mail'];?>" >
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Primary Phone <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="primary_phone" value="<?php echo $row2['primary_phone'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Secondary Phone </label>
												<input class="form-control" type="text" name="secondary_phone" value="<?php echo $row2['secondary_phone'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Company Name</label>
												<input class="form-control" type="text" name="company_name" value="<?php echo $row2['company_name'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Company description</label>
												<input class="form-control" type="text" name="company_description" value="<?php echo $row2['company_des'];?>">
											</div>
										</div>
										<div class="input-block mb-3">
												<label class="col-form-label">Company Address</label>
												<input class="form-control" type="text" value="<?php echo $row2['company_address'];?>" name="company_address">
											</div>
										<input type="hidden" name="id" id="textField" value="<?php echo $row2['id'];?>" required="required">
										
										<div class="input-block mb-3">
											<label class="col-form-label">Company logo</label>
											<input type="hidden" name="previous_image" value="<?php echo $row2['company_logo']; ?>">
											<input type="file" accept="image/*" class="form-control" name="fimages" />
											<?php if (!$row2) {
												echo "No image found for ID $id";
											} else {
												echo '<img src="' . $row2['company_logo'] . '" style="height:50px;">';
											} ?>
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
						window.location.href = "clients.php?id=' . $id . '";
					} else {
						window.location.href = "clients.php";
					}
				});';
			echo '</script>';
		}
	}   

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `clients` SET `status`= 5 WHERE id=".$id;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>window.location.href = 'clients.php'</script>";
	} else {
		die(mysqli_error($conn));
	}
}
?>
    </body>
</html>
<?php 
if(isset($_POST['addClient'])){
	$client_name = $_POST["client_name"];
	$mail_id = $_POST["mail_id"];
	$primary_phone = $_POST["primary_phone"];
	$secondary_phone = $_POST["secondary_phone"];
	$company_name = $_POST["company_name"];
	$company_description = preg_replace("/'/", "\'",$_POST["company_description"]);
	$company_address =preg_replace("/'/", "\'",$_POST["company_address"]);
	$created_time = date('Y-m-d H:i:s');
	
	$fimage = $_FILES['fimages']['name'];
		if ($fimage) {
			$fimage_temp = $_FILES['fimages']['tmp_name'];
			$filename = $first_name . '_' . time();
			$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
			$filename .= '.png';
				if (move_uploaded_file("$fimage_temp", "uploads/$filename")) {
					$fimagee = 'uploads/' . $filename;
				} else {
					var_dump("Not Upload");
				}
	}

	$sql = "INSERT INTO clients (client_name, client_mail, primary_phone, secondary_phone, company_name, company_des,company_address, company_logo,created_at, updated_at) VALUES ('$client_name', '$mail_id', '$primary_phone', '$secondary_phone', '$company_name','$company_description','$company_address','$fimagee','$created_time', '$update_time')";
	$iquery = mysqli_query($conn, $sql);
		if ($iquery) {
			?>
			<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
				window.location = "clients.php";
				}, 1000);
			</script>
		<?php
			} else {
				?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
				window.location = "clients.php";
				}, 1000);
			</script>
		<?php
			}
}
	
	if(isset($_POST['updateClient'])){
		$id =$_POST['id'];
		$client_name = $_POST["client_name"];
		$mail_id = $_POST["mail_id"];
		$primary_phone = $_POST["primary_phone"];
		$secondary_phone = $_POST["secondary_phone"];
		$company_name = $_POST["company_name"];
		$company_description =preg_replace("/'/", "\'", $_POST["company_description"]);
		$company_address =preg_replace("/'/", "\'", $_POST["company_address"]);
		$update_time = date('Y-m-d H:i:s');
		
		$fimage = $_FILES['fimages']['name'];
			if ($fimage) {
				$fimage_temp = $_FILES['fimages']['tmp_name'];
				$filename = $first_name . '_' . time();
				$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
				$filename .= '.png';

				if (move_uploaded_file("$fimage_temp", "uploads/$filename")) {
					$fimagee = 'uploads/' . $filename;
				} else {
					var_dump("Not Upload");
				}
			} else {
				$fimagee = $_POST['previous_image'];
			}

			$query = "UPDATE clients  SET client_name = '$client_name',client_mail='$mail_id',primary_phone='$primary_phone',secondary_phone='$secondary_phone',company_name='$company_name',company_des='$company_description',company_address='$company_address',company_logo='$fimagee',updated_at ='$update_time' WHERE id = ".$id;
			$iquery = mysqli_query($conn, $query);
		if ($iquery) {
			?>
			<script>
				toastr.success('Updated Successfully!');
				setTimeout(function() {
				window.location = "clients.php";
				}, 1000);
			</script>
		<?php
			} else {
				?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
				window.location = "clients.php";
				}, 1000);
			</script>
		<?php
			}
		}
?>