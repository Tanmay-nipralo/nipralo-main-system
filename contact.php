<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclient = getAllContactDetail();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.table td{
		max-width: 250px;
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
								<!-- <a style="margin-left: 5px;" href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Contact Enquiry</a> -->
								<a href="excel.php?table=contact_us" class="btn btn-outline-success" type="button"><i class="icon icon-download"></i> Excel</a>
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
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Date & Time</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($getclient as $client) {
											$shortMessageId = 'short-message-' . $i;
											$fullMessageId = 'full-message-' . $i;
											?>
										<tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $client['first_name']; ?></td>
                                        <td><?php echo $client['email']; ?></td>
                                        <td><?php echo $client['phone']; ?></td>
										<td>
											<?php 
											$message = $client['message'];
											$maxLength = 30; 
											if(strlen($message) > $maxLength) {
												$shortMessage = substr($message, 0, $maxLength) ; 
												echo "<span id='$shortMessageId'>$shortMessage</span>"; 
												echo "<span id='$fullMessageId' style='display: none;'>$message</span>"; 
												echo "<button onclick='toggleMessage(\"$shortMessageId\", \"$fullMessageId\")' id='message-btn' style='border: none; background: none;'>...</button>"; 
											} else {
												echo $message; 
											}
											?>
										</td>
                                        <td><?php echo $client['created_at']; ?></td>
											<td class='text-end'>
												<div class='dropdown dropdown-action'>
													<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
													<div class='dropdown-menu dropdown-menu-right'>
														<a class='dropdown-item' href='contact.php?deleteid=<?php echo $client['id']?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
								<h5 class="modal-title">Add Contact Enquiry</h5>
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
												<input class="form-control" name="first_name" type="text" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="last_name">Phone</label>
												<input class="form-control" type="text" name="last_name">
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="mail" required >
											</div>
										</div>	
									<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="department">Reference <span class="text-danger">*</span></label>
												<select class="select" name="employee_type">
													<option>Select Reference</option>
													<option>Admin</option>
													<option>HR</option>
													<option>Employee</option>
											</select>
									 </div>
									</div>
									<div class="col-sm-12">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Message <span class="text-danger">*</span></label>
												<textarea class="form-control" type="email" name="mail" required ></textarea>
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
		<script>
			function toggleMessage(shortMessageId, fullMessageId) {
				var shortMessage = document.getElementById(shortMessageId);
				var fullMessage = document.getElementById(fullMessageId);
				var btnText = document.getElementById("message-btn");

				if (shortMessage.style.display === "none") {
					shortMessage.style.display = "inline";
					fullMessage.style.display = "none";
					btnText.innerHTML = "...";
				} else {
					shortMessage.style.display = "none";
					fullMessage.style.display = "inline";
					btnText.innerHTML = "...";
				}
			}
		</script>

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
						window.location.href = "contact.php?id=' . $id . '";
					} else {
						window.location.href = "contact.php";
					}
				});';
			echo '</script>';
		}
	}   

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `contact_us` SET `status`= 5 WHERE id=".$id;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>window.location.href = 'contact.php'</script>";
	} else {
		die(mysqli_error($conn));
	}
}
?>
    </body>
</html>
