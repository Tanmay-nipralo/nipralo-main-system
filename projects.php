<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"      data-sidebar-image="none">
<?php include './includes/header.php';
$getproject = getAllProjects();
$getclients = getAllClient();
$getemployee = getAllEmployee();

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
								<a href="create_project.php" class="btn add-btn"><i class="fa-solid fa-plus"></i> Create Project</a>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 d-flex">
							<div class="card w-100">
								<div class="card-body">
								<div class="table-responsive">
													<table class="table table-bordered custom-table datatable" >
															<thead class="thead-light">
																<tr>
																<th>Project</th>
																<th>Status</th>
																<th>Start Date</th>
																<th>Completion Date</th>
																<th>Position</th>
																<th>Project Manager</th>
																<th>Total Days</th>
																<th>Action</th>
																</tr>
															 </thead>
															 <tbody>
																<?php foreach($getproject as $project){ ?>
																<tr>
																	<td><?php echo $project['project_name'] ?></td>
																	<td><?php echo $project['project_status'] ?></td>
																	<td><?php echo $project['start_date'] ?></td>
																	<td><?php echo $project['end_date'] ?></td>
																	<td>
																		<select class="statusSelect select" >
																		<option value="On Track" <?php echo ($project['position'] == 'On Track') ? 'selected' : ''; ?>>On Track</option>
																		<option value="Delayed" <?php echo ($project['position'] == 'Delayed') ? 'selected' : ''; ?>>Delayed</option>
																		<option value="Completed" <?php echo ($project['position'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
																		</select>
																		<input type="hidden" class="subtaskId" name="sid" value="<?php echo $project['id'] ?>">
																	</td>
																	<?php 
																		$jsonTeamLeader = $project['project_leader'];
																		$teamLeaderArray = json_decode($jsonTeamLeader, true);
																		if ($teamLeaderArray !== null) {
																			$teamLeaderNames = "";
																			foreach ($teamLeaderArray as $teamLeader) {
																				$teamLeaderNames .= $teamLeader['name'] . ", "; 
																			}
																			$teamLeaderNames = rtrim($teamLeaderNames, ", ");
																	?>
																			<td><?php echo $teamLeaderNames; ?></td>
																	<?php } else {
																			echo "<td>Error decoding JSON data.</td>";
																		}
																	?>

																	<td><?php echo $project['total_days'] ?></td>
																	<td>
																		<div style="display: flex;justify-content: center;">
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_project<?php echo $project['id'];?>"><i class="fa-solid fa-pencil m-r-5"></i></a>
																<a class='dropdown-item' href='projects.php?deleteid=<?php echo $project['id'];?>'><i class='fa-regular fa-trash-can m-r-5'></i></a>
																<a class='dropdown-item' href="project-view.php?idd=<?php echo $project['id'];?>"><i class='fa-regular fa-eye m-r-5'></i></a>
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

				<?php foreach ($getproject as $project1) { ?>
				<div id="edit_project<?php echo $project1['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Project</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Project Name</label>
												<input class="form-control" value="<?php echo $project1['project_name'];?>" type="text" name="project_name">
												<input class="form-control" value="<?php echo $project1['id'];?>" type="hidden" name="project_id">	
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Client</label>
												<select class="select" name="client">
												<?php foreach($getclients as $clients){ ?>
													<option value="<?php echo $clients['id'] ; ?>" <?php echo ($clients['id'] == $project1['client_id']) ? 'selected' : ''; ?>><?php echo $clients['company_name'] ; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Start Date</label>
													<input class="form-control" value="<?php echo $project1['start_date'];?>" type="date" name="start_date">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">End Date</label>
													<input class="form-control" value="<?php echo $project1['end_date'];?>" type="date" name="end_date">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Rate</label>
												<input placeholder="$50" class="form-control" type="text"  value="<?php echo $project1['rate_value'];?>" name="rate">
											</div>
										</div>
										<div class="col-sm-3">
												
											<div class="input-block mb-3">
												<label class="col-form-label">&nbsp;</label>
												<select class="select" name="rate_type">
													<option <?php echo ($project1['rate_type'] == 'Hourly') ? 'selected' : ''; ?>>Hourly</option>
													<option <?php echo ($project1['rate_type'] == 'Fixed') ? 'selected' : ''; ?>>Fixed</option>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Priority</label>
												<select class="select" name="priority">
													<option <?php echo ($project1['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
													<option <?php echo ($project1['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
													<option <?php echo ($project1['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
												</select>
											</div>
										</div>

										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Total Days</label>
												<input class="form-control" type="text" name="total_days" value="<?php echo $project1['total_days'];?>">
											</div>
										</div>
								
										<div class="col-sm-6">
											<label class="focus-label">Add Project Leader</label>
											<select class="choices-multiple-remove-button" name="team_leader[]" placeholder="--Select--" id="country" required multiple>	
											<?php foreach($getemployee as $employee){ 
												  $leaderIds = array_map(function($leader) {
													return $leader['id'];
												}, json_decode($project1['project_leader'], true)); 
												$isSelected = in_array($employee['id'], $leaderIds); 
												?>
											<option value="<?php echo $employee['id'] ?>" <?php echo ($isSelected) ? 'selected' : ''; ?>><?php echo $employee['first_name'] ?></option>
											<?php } ?>
											</select>
										</div>
										<div class="col-sm-6">
											<label class="focus-label">Add team</label>
											<select class="choices-multiple-remove-button" name="team_member[]" placeholder="--Select--" id="country" required multiple>
											<?php foreach($getemployee as $employee){
												  $leaderIds1 = array_map(function($leader1) {
													return $leader1['id'];
												}, json_decode($project1['team_member'], true)); 
												$isSelected1 = in_array($employee['id'], $leaderIds1); 
												?>
											<option value="<?php echo $employee['id'] ?>" <?php echo ($isSelected1) ? 'selected' : ''; ?> ><?php echo $employee['first_name'] ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<div class="row">	
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Categories</label>
												<select class="select" name="categories">
												<option <?php echo ($project1['project_category'] == 'UI/UX') ? 'selected' : ''; ?>>UI/UX</option>
													<option <?php echo ($project1['project_category'] == 'Website') ? 'selected' : ''; ?>>Website</option>
													<option <?php echo ($project1['project_category'] == 'App') ? 'selected' : ''; ?>>App</option>
													<option <?php echo ($project1['project_category'] == 'Dashboard') ? 'selected' : ''; ?>>Dashboard</option>
													<option <?php echo ($project1['project_category'] == 'CMS') ? 'selected' : ''; ?>>CMS</option>
													<option <?php echo ($project1['project_category'] == 'CRM') ? 'selected' : ''; ?>>CRM</option>
													<option <?php echo ($project1['project_category'] == 'Digital Marketing') ? 'selected' : ''; ?>>Digital Marketing</option>
													<option <?php echo ($project1['project_category'] == 'Social Media Post') ? 'selected' : ''; ?>>Social Media Post</option>
													<option <?php echo ($project1['project_category'] == 'AMC') ? 'selected' : ''; ?>>AMC</option>
													<option <?php echo ($project1['project_category'] == 'Support') ? 'selected' : ''; ?>>Support</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Status</label>
												<select class="select" name="project_status">
													<option value="" <?php echo ($project1['project_status'] == '') ? 'selected' : ''; ?>>Select Project Status</option>
													<option value="Ongoing Projects" <?php echo ($project1['project_status'] == 'Ongoing Projects') ? 'selected' : ''; ?>>Ongoing Projects</option>
													<option value="Hold Projects" <?php echo ($project1['project_status'] == 'Hold Projects') ? 'selected' : ''; ?>>Hold Projects</option>
													<option value="Completed Projects" <?php echo ($project1['project_status'] == 'Completed Projects') ? 'selected' : ''; ?>>Completed Projects</option>
												</select>
											</div>
										</div>

									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
										<textarea rows="3" class="form-control" placeholder="Enter Project description" name="description"><?php echo $project1['description']; ?></textarea>
									</div>
									<div class="input-block mb-3">
											<label class="col-form-label">Quotation File</label>
											<input type="hidden" name="previous_image" value="<?php echo $project1['project_document']; ?>">
											<input type="file" accept="image/*" class="form-control" name="fimages" />
											<?php 
											$ext = pathinfo($project1['project_document'], PATHINFO_EXTENSION);
											if (!$project1['project_document']) {
												echo "No image found for ID ".$project1['id'];
											} else {
												echo "<a href='".$project1['project_document']."'>Quotation File</a><br>";
												if($project1['project_document'] == "pdf"){
													echo '<iframe src="'.$project1['project_document'].'" width="100%" height="100px"></iframe>';
												} else{
													echo '<a href="' . $project1['project_document'] . '" target="_blank"><img src="' . $project1['project_document'] . '" style="height:50px;"></a>';
												}
											} ?>
										</div>

									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="updateProject">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
            </div>
        </div>
<?php include './includes/footer.php'?>
	<script>
		$(document).ready(function () {
			$('.statusSelect').on('change', function () {
				var selectedValue = $(this).val();
				var subtaskId = $(this).siblings('.subtaskId').val();
					$.ajax({
						url: 'updatePositionStatus.php',
						method: 'POST',
						data: { status: selectedValue, sid: subtaskId },

						success: function (response) {
							console.log(response);
						},
						error: function (xhr, status, error) {
							console.error(error);
						}
					});
				});
			});
	</script>
    <script>
      $(document).ready(function() {
        var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
          removeItemButton: true,
        });
      });
	</script>
<?php
if (isset($_POST['updateProject'])) {
	$projectId=$_POST['project_id'];
    $project_name = $_POST["project_name"];
    $client_name = $_POST["client"];
    $start_date = date('Y-m-d', strtotime($_POST["start_date"]));
    $end_date = date('Y-m-d', strtotime($_POST["end_date"]));
	$rate = $_POST["rate"];
	$rate_type = $_POST["rate_type"];
	$priority = $_POST["priority"];
	$categories =$_POST["categories"];
	$project_status =$_POST["project_status"];
	$description =$_POST["description"];
	$total_days = $_POST['total_days'];
	$update_time = date('Y-m-d H:i:s');
	$selectedTeamLeader = isset($_POST['team_leader']) ? $_POST['team_leader'] : [];
 	$teamLeaderArray = [];

	foreach ($selectedTeamLeader as $emp_id) {
		$query_emp_details = "SELECT * FROM employees WHERE id = '$emp_id'";
		$result_emp_details = mysqli_query($conn, $query_emp_details);
		$emp_details = mysqli_fetch_assoc($result_emp_details);
		$teamLeaderArray[] = [
			'id' => $emp_details['id'],
			'name' => $emp_details['first_name'],
			'status' => $emp_details['status'],
			'role' => $emp_details['employee_type']
		];
	}
 	$jsonLeaderMembers = json_encode($teamLeaderArray);
 	$selectedTeamMembers = isset($_POST['team_member']) ? $_POST['team_member'] : [];
    $teamMembersArray = [];

	foreach ($selectedTeamMembers as $emp_id) {
		$query_emp_details = "SELECT * FROM employees WHERE id = '$emp_id'";
		$result_emp_details = mysqli_query($conn, $query_emp_details);
		$emp_details = mysqli_fetch_assoc($result_emp_details);
		$teamMembersArray[] = [
			'id' => $emp_details['id'],
			'name' => $emp_details['first_name'],
			'status' => $emp_details['status'],
			'role' => $emp_details['employee_type']
		];
	}
   $jsonTeamMembers = json_encode($teamMembersArray);

   $fimage = $_FILES['fimages']['name'];
			if ($fimage) {
				$fimage_temp = $_FILES['fimages']['tmp_name'];
				$filename = $first_name . '_' . time();
				$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
				$extenction = pathinfo($fimage, PATHINFO_EXTENSION);
                $filename .= '.'.$extenction;

				if (move_uploaded_file("$fimage_temp", "uploads/project/$filename")) {
					$fimagee = 'uploads/project/' . $filename;
				} else {
					var_dump("Not Upload");
				}
			} else {
				$fimagee = $_POST['previous_image'];
			}

 
	$updateQuery = "UPDATE projects SET project_name='$project_name',client_id='$client_name',start_date='$start_date',end_date='$end_date',rate_value='$rate',rate_type='$rate_type',priority='$priority',project_leader='$jsonLeaderMembers',team_member='$jsonTeamMembers',project_category='$categories',project_status='$project_status',description='$description',project_document='$fimagee',update_at='$update_time',total_days='$total_days' WHERE id = '$projectId'";
		if(mysqli_query($conn, $updateQuery)){
			?>
		<script>
			toastr.success('Project Update Successfully!');
              setTimeout(function() {
                window.location = "projects.php";
              }, 1000);
			  </script>
			  <?php
		} else {
			?>
			<script>
			toastr.error('Error !');
              setTimeout(function() {
                window.location = "projects.php";
              }, 1000);
			  </script>
			  <?php
		}	
}



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
						window.location.href = "projects.php?id=' . $id . '";
					} else {
						window.location.href = "projects.php";
					}
				});';
			echo '</script>';
		}
    }   

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `projects` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'projects.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}



// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//     $currentDate = date('Y-m-d');
//     $sql = "UPDATE projects SET position = 'Delayed' WHERE end_date < '$currentDate'";
//     $result = mysqli_query($conn, $sql);

//     if ($result) {
//         echo "Automatic status update to 'Delayed' completed successfully";
//     } else {
//         echo "Error updating status: " . mysqli_error($conn);
//     }

//     mysqli_close($conn);
// } else {
//     echo "Invalid request";
// }
?>
    </body>
</html>