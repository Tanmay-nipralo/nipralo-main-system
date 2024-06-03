<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclient = getAllEnquiry();

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
					<div class="page-header">
						<div class="row align-items-center">
						<div class="col-auto float-end ms-auto">
							<a style="margin-left: 5px;" href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Enquiry</a>
                            <a href="excel.php?table=bigd_model" class="btn btn-outline-success" type="button"><i class="icon icon-download"></i> Excel</a>
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Date & Time</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($getclient as $client) { ?>
										<tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $client['name']; ?></td>
                                        <td><?php echo $client['number']; ?></td>
                                        <td><?php echo $client['email']; ?></td>
                                        <td><?php echo $client['created_at']; ?></td>
											<td class='text-end'>
												<div class='dropdown dropdown-action'>
													<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
													<div class='dropdown-menu dropdown-menu-right'>
														<a class='dropdown-item' href='enquiry.php?deleteid=<?php echo $client['id']?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
            </div>
        </div>

		<div id="add_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Enquiry</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="first_name">Name <span class="text-danger">*</span></label>
												<input class="form-control" name="name" type="text" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="last_name">Phone</label>
												<input class="form-control" type="text" name="number">
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="email" required >
											</div>
										</div>	
									<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="department">Reference <span class="text-danger">*</span></label>
												<select class="select" name="reference">
													<option>Select Reference</option>
													<option>Website</option>
													<option>Google</option>
											</select>
									 </div>
									</div>
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
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
						window.location.href = "enquiry.php?id=' . $id . '";
					} else {
						window.location.href = "enquiry.php";
					}
				});';
			echo '</script>';
		}
	}   

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `bigd_model` SET `status`= 5 WHERE id=".$id;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>window.location.href = 'enquiry.php'</script>";
	} else {
		die(mysqli_error($conn));
	}
}
?>
    </body>
</html>
<?php 
if(isset($_POST['add'])){
	$name = $_POST["name"];
	$number = $_POST["number"];
	$email = $_POST["email"];
	$reference = $_POST["reference"];
	$created_time = date('Y-m-d H:i:s');
 
	$sql = "INSERT INTO bigd_model (name, number, email, reference,created_at, updated_at) VALUES ('$name', '$number', '$email', '$reference','$created_time', '$created_time')";
		
		$iquery = mysqli_query($conn, $sql);
		if ($iquery) {
			?>
			<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
				window.location = "enquiry.php";
				}, 1000);
			</script>
		<?php
			} else {
				?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
				window.location = "enquiry.php";
				}, 1000);
			</script>
		<?php
			}
}
?>
