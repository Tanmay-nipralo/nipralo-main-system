<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclient = getAllWebsiteDetail();

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
						<!-- <div class="col-auto float-end ms-auto">
							<a style="margin-left: 5px;" href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Career Enquiry</a>
                            <a href="excel.php?table=sale" class="btn btn-outline-success" type="button"><i class="icon icon-download"></i> Excel</a>
                            </div> -->
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
                                        <th>Type</th>
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
                                        <td><?php echo $client['name']; ?></td>
                                        <td><?php echo $client['number']; ?></td>
                                        <td><?php echo $client['email']; ?></td>
                                        <td><?php echo $client['type']; ?></td>
                                        <td>
											<?php 
											$message = $client['message'];
											$maxLength = 30; // Maximum length of the message to display initially
											if(strlen($message) > $maxLength) {
												$shortMessage = substr($message, 0, $maxLength) ; // Truncate the message
												echo "<span id='$shortMessageId'>$shortMessage</span>"; // Display truncated message
												echo "<span id='$fullMessageId' style='display: none;'>$message</span>"; // Hidden full message
												echo "<button onclick='toggleMessage(\"$shortMessageId\", \"$fullMessageId\")' id='message-btn' style='border: none; background: none;'>...</button>"; // Button to toggle message
											} else {
												echo $message; // Display full message if length is within maximum limit
											}
											?>
										</td>

                                        <td><?php echo $client['created_at']; ?></td>
											<td class='text-end'>
												<div class='dropdown dropdown-action'>
													<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
													<div class='dropdown-menu dropdown-menu-right'>
													<a class='dropdown-item' href="edit_development.php?id=<?php echo $client['id']?>"><i class='fa fa-edit'></i> Edit</a>
														<a class='dropdown-item' href='website_enquiry.php?deleteid=<?php echo $client['id']?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
														<a class='dropdown-item' href='development_history.php?id=<?php echo $client['id']?>'><i class='fa fa-history'></i> History</a>
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
								<h5 class="modal-title">Add Career Enquiry</h5>
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
												<input class="form-control" type="text" name="mobile_number">
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
													<option>Admin</option>
													<option>HR</option>
													<option>Employee</option>
											</select>
									 </div>
									</div>
									<div class="col-sm-12">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Message <span class="text-danger">*</span></label>
												<textarea class="form-control" name="message" required ></textarea>
											</div>
										</div>	
										<div class="col-sm-12">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Upload Resume <span class="text-danger">*</span></label>
												<input class="form-control" type="file" name="fimages" required >
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
						window.location.href = "website_enquiry.php?id=' . $id . '";
					} else {
						window.location.href = "website_enquiry.php";
					}
				});';
			echo '</script>';
		}
	}   

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `website_enquiry` SET `status`= 5 WHERE id=".$id;
	$result = mysqli_query($conn, $sql);
	$sql = "UPDATE `meeting_history` SET `status`= 5 WHERE user_id=".$id;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>window.location.href = 'website_enquiry.php'</script>";
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
	$mobile_number = $_POST["mobile_number"];
	$email = $_POST["email"];
	$reference = $_POST["reference"];
	$message = $_POST["message"];
	$created_time = date('Y-m-d H:i:s');

	$fimage = $_FILES['fimages']['name'];
		if ($fimage) {
			$fimage_temp = $_FILES['fimages']['tmp_name'];
			$filename = $first_name . '_' . time();
			$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
			$filename .= '.png';
				if (move_uploaded_file("$fimage_temp", "https://bigdreams.in/assets/img/Resume/$filename")) {
					$fimagee = 'https://bigdreams.in/assets/img/Resume/' . $filename;
				} else {
					var_dump("Not Upload");
				}
	}
 
	$sql = "INSERT INTO sale (name, mobile_number, email, reference,message,created_at, updated_at) VALUES ('$name', '$mobile_number', '$email', '$reference',$message,'$created_time', '$created_time')";
		
		$iquery = mysqli_query($conn, $sql);
		if ($iquery) {
			?>
			<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
				window.location = "career.php";
				}, 1000);
			</script>
		<?php
			} else {
				?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
				window.location = "career.php";
				}, 1000);
			</script>
		<?php
			}
}
?>

