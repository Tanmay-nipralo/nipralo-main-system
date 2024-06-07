<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$candidate = getAppliedCandidate();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}

?>
<style>
	.table td{
	max-width: 113px;
    white-space: normal;
    word-wrap: break-word;
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
							<div>
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th class="width-thirty">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Expected Salary</th>
                                            <th>CTC</th>
                                            <th>Technology</th>
                                            <th>Experience</th>
                                            <th>Notice Period</th>
											<th>Status</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
							<?php   
							   $i= 1;
								   foreach($candidate as $can) { ?>
									<tr>
									<td><?php echo $i++; ?></td>
                                    <td><?php echo $can['name']; ?></td>
                                    <td><?php echo $can['email']; ?></td>  
                                    <td><?php echo $can['number']; ?></td>
                                    <td><?php echo $can['address']; ?></td>
                                    <td><?php echo $can['expectedsalary']; ?></td>
                                    <td><?php echo $can['ctc']; ?></td>
                                    <td><?php echo $can['technology']; ?></td>
                                    <td><?php echo $can['experience']; ?></td> 
                                    <td><?php echo $can['noticeperiod']; ?></td> 
									<td><a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#edit_holiday<?php echo $can['id'] ?>"><i class="fa-solid fa-plus"></i>Add Note</a></td>    	
									<td class='text-end'>
									<div class='dropdown dropdown-action'>
										<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
												<!-- <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_department<?php //echo $can['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a> -->
												<a class='dropdown-item' href='applied-candidates.php?deleteid=<?php echo $can['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
											</div>
									</div>
									</td>
								    </tr>
									<?php  }  ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				
            </div>
        </div>

		<?php  foreach($candidate as $can1) {?>
				<div class="modal custom-modal fade" id="edit_holiday<?php echo $can1['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Status</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
								<div class="input-block mb-3">
                                   <label for="name-1" class="col-form-label"> Call Status :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
								   <select class="form-control" name="call_status" required>
										<option>Select Status</option>
										<option value="Call Back" <?php echo ($can1['call_status'] == 'Call Back') ? 'selected' : ''; ?>>Call Back</option>
										<option value="Ringing" <?php echo ($can1['call_status'] == 'Ringing') ? 'selected' : ''; ?>>Ringing</option>
										<option value="Interview Schedule" <?php echo ($can1['call_status'] == 'Interview Schedule') ? 'selected' : ''; ?>>Interview Schedule</option>
										<option value="Hired" <?php echo ($can1['call_status'] == 'Hired') ? 'selected' : ''; ?>>Hired</option>
										<option value="Not Interested" <?php echo ($can1['call_status'] == 'Not Interested') ? 'selected' : ''; ?>>Not Interested</option>
									</select>

                                </div>
								<div class="input-block mb-2">
                                   <label for="name-1" class="col-form-label">Date :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
                                   <input class="form-control" type="date" name="date" value="<?php echo $can1['date'];?>" required>
                                </div>
								<div class="input-block mb-2">
                                   <label for="name-1" class="col-form-label">Time :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
                                   <input class="form-control" type="time" name="time" value="<?php echo $can1['time'];?>" required>
                                </div>
                                <div class="input-block mb-3">
                                   <label for="name-1" class="col-form-label"> Comment :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
                                   <input type="hidden" name="idd" value="<?php echo $can1['id'];?>">
                                   <textarea class="form-control" type="text" name="comment" placeholder="Comment" required><?php echo $can1['comment'];?></textarea>
                                </div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="update">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
		
		<?php include './includes/setting.php'?>

		<?php include './includes/footer.php'?>
<?php
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
						window.location.href = "applied-candidates.php?id=' . $id . '";
					} else {
						window.location.href = "applied-candidates.php";
					}
				});';
			echo '</script>';
		}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `appliedcandidate` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'applied-candidates.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}

?>	
 </body>
</html>
<?php
	if (isset($_POST['update'])) {
		$idd = $_POST['idd'];
		$call_status = $_POST['call_status'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$comment = $_POST['comment'];
		$insertquery = "UPDATE `appliedcandidate` SET `call_status`='$call_status',`date`='$date',`time`='$time',`comment`='$comment' WHERE id= $idd";
		var_dump($insertquery);
		$iquery = mysqli_query($conn, $insertquery);
		if ($iquery) { ?>
			<script>
				toastr.success('Updated Successfully!');
				setTimeout(function() {
				window.location = "applied-candidates.php";
				}, 1000);
			</script>
		<?php
		} else {
		?><script>
			toastr.error('Error!');
				setTimeout(function() {
				window.location = "applied-candidates.php";
				}, 1000);
			</script><?php
		};
	}
?>