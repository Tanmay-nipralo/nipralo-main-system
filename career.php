<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclient = getAllCareerDetail();
// echo "<pre>";
// print_r($getclient);
// echo"</pre>";
// exit();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.dataTables_wrapper {
		top: 0px!important;
	}
	.table td{
		max-width: 250px;
		white-space: normal;
	}

	.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
	}
	.dataTables_length{
		position: absolute;
		top: 80px;
		right: 198px;
	}
	.dataTables_filter {
		position: fixed;
		top: 75px;
        float: left!important;
    }
	td{
		border-bottom: none!important;
	}
	@media screen and (max-width: 768px) {
		.page-header{
			flex-direction: column;
		}
		.dataTables_filter{
			margin-top: 25px!important;	
		}

	}
</style>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header" >
						<div class="row align-items-center">
							<div id="headingg" class="col-auto float-end ms-auto">
								<!-- <a style="margin-left: 5px;" href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Career Enquiry</a> -->
								<a style="margin-left: 5px;" href="edit_career.php" class="btn add-btn"><i class="fa-solid fa-plus"></i> Add Career Enquiry</a>
								<a href="excel.php?table=sale" class="btn btn-outline-success" type="button"><i class="icon icon-download"></i> Excel</a>
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<!-- <table id="myTable" class="table table-striped table-nowrap custom-table datatable"> -->
								<table id="myTable" class="table table-striped table-nowrap dataTable">
									<thead>
										<tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Job Type</th>
                                        <th>Status</th>
										<th>Calling Status</th>
										<th>Position</th>
										<th>Hiring Status</th>
                                        <th>Date & Time</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($getclient as $client) {
											?>
											
										<tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $client['name']; ?></td>
                                        <td><?php echo $client['mobile_number']; ?></td>
                                        <td><?php echo $client['email']; ?></td>
                                        <td><?php echo $client['jobtype']; ?></td>
										<td>
											<select class="statusSelect select">
												<option selected disabled>Select Status</option>
												<option id="shortlist<?= $client['id'] ?>" value="shortlisted" <?php echo ($client['shortlist'] == 'shortlisted') ? 'selected' : ''; ?>>
													<?php echo ($client['shortlist'] == 'shortlisted') ? 'Shortlisted' : 'Shortlist'; ?>
												</option>
												<option id="shortlist1<?= $client['id'] ?>" value="rejected" <?php echo ($client['shortlist'] == 'rejected') ? 'selected' : ''; ?>>
													<?php echo ($client['shortlist'] == 'rejected') ? 'Rejected' : 'Reject'; ?>
												</option>
											</select>
											<input type="hidden" class="shortlistId" name="sid" value="<?php echo $client['id'] ?>">
										</td>
										<td><?php
											if (isset($client['user_detail']['call_status']) && !empty($client['user_detail']['call_status'])) {
												echo $client['user_detail']['call_status'];
											} else {
												echo "-";
											}
										?>
										</td>
										<td><?php echo $client['position']; ?></td>
										<td><?php echo $client['created_at']; ?></td>
                                        <td><?php echo $client['created_at']; ?></td>
										<td>
											<div style="display: flex;justify-content:space-between">
												<a class='dropdown-item' href="edit_career.php?id=<?php echo $client['id']?>"><i class='fa fa-edit'></i></a>
												<a class='dropdown-item' href='view_career.php?id=<?php echo $client['id']?>'><i class='fa fa-eye'></i></a>
											</div>
											<div style="display: flex;justify-content:space-between">
												<a class='dropdown-item' href='career_history.php?id=<?php echo $client['id']?>'><i class='fa fa-history'></i></a>
												<a class='dropdown-item' href="https://bigdreams.in/assets/img/Resume/<?php echo $client['image']; ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
												<a class='dropdown-item' href='career.php?deleteid=<?php echo $client['id']?>'><i class='fa-regular fa-trash-can m-r-5'></i></a>
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

	<script type="text/javascript" charset="utf8" src="assets/js/jquery-3.7.0.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	
	<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function() {
			$j('#myTable').DataTable({
				// paging: false,
        		// lengthChange: false,
				// info: false
			});
		});
	</script>
	
	<script>
   $(document).ready(function () {
    // Attach change event to the document, delegating to '.statusSelect' elements
    $(document).on('change', '.statusSelect', function () {
        var shortlistValue = $(this).val();
        var shortlistId = $(this).siblings('.shortlistId').val();
        console.log(shortlistValue, shortlistId); // Debugging output

        $.ajax({
            url: 'updateHiringStatus.php',
            method: 'POST',
            data: { shortlistStatus: shortlistValue, sid: shortlistId },
            success: function (response) {
                console.log(response); // Debugging output
                alert(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
</script>

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
<script>
        function toggleSalaryField() {
    const experienceRadio = document.getElementById('experience');
    const salaryField = document.getElementById('salaryField');

    // If "experience" is selected, show the salary field; otherwise, hide it
    if (experienceRadio.checked) {
        salaryField.style.display = 'block';
    } else {
        salaryField.style.display = 'none';
    }
}
</script>
<script>
	
	function handleScroll() {
		var myDiv = document.getElementById("myTable_filter");
		if (window.scrollY > 30) {
			myDiv.style.visibility = "hidden";
			console.log(window.scrollY);
		} else {
			myDiv.style.visibility = "visible";
		}
	}

window.addEventListener("scroll", handleScroll);
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
						window.location.href = "career.php?id=' . $id . '";
					} else {
						window.location.href = "career.php";
					}
				});';
			echo '</script>';
		}
	}   

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `sale` SET `status`= 5 WHERE id=".$id;
	$result = mysqli_query($conn, $sql);
	// $sql = "UPDATE `interview_history` SET `status`= 5 WHERE user_id=".$id;
	// $result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>window.location.href = 'career.php'</script>";
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
			$filename = $name . '_' . time();
			$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
			$extension = pathinfo($fimage, PATHINFO_EXTENSION);
			$filename .= '.'.$extension;
				// $UploadURL = "https://bigdreams.in/assets/img/Resume";
				$UploadURL = "../../bigdreams/assets/img/Resume";
				if (move_uploaded_file("$fimage_temp", "$UploadURL/$filename")) {
					$fimagee = $filename;
				} else {
					var_dump("Not Upload");
				}
	}
 
	$sql = "INSERT INTO sale (name, mobile_number, email, reference,message, image, created_at, updated_at) VALUES ('$name', '$mobile_number', '$email', '$reference','$message', '$fimagee', '$created_time', '$created_time')";
		
		$iquery = mysqli_query($conn, $sql);
		var_dump($iquery);
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

