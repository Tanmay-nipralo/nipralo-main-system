<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php'?>
<?php include './includes/connection.php';
$idd = $_GET['idd'];
$client_select = "SELECT * from clients WHERE id='$idd'";
 $result_client = mysqli_query($conn, $client_select);
 $client_sel = mysqli_fetch_assoc($result_client);
?>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
				
		<?php include './includes/navbar.php'?>	
			<!-- Sidebar -->
			<?php include './includes/sidebar.php'?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Profile</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Profile</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
												<a href="">
													<img src="<?php echo $client_sel['company_logo'] ?>" alt="User Image">
												</a>
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0"><?php echo $client_sel['company_name'] ?></h3>
														<h5 class="company-role m-t-0 mb-0"><?php echo $client_sel['client_name'] ?></h5>
														<small class="text-muted"><?php echo $client_sel['company_des'] ?></small>
														<div class="staff-id">Client ID : <?php echo $client_sel['id'] ?></div>
														
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<span class="title">Primary Phone:</span>
															<span class="text"><a href=""><?php echo $client_sel['primary_phone'] ?></a></span>
														</li>
														<li>
															<span class="title">Secondary Phone:</span>
															<span class="text"><a href=""><?php echo $client_sel['secondary_phone'] ?></a></span>
														</li>
														<li>
															<span class="title">Email:</span>
															<span class="text"><a href=""><span class="__cf_email__"><?php echo $client_sel['client_mail'] ?> </span></a></span>
														</li>
													
														<li>
															<span class="title">Address:</span>
															<span class="text"><?php echo $client_sel['company_address'] ?></span>
														</li>
														
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card tab-box">
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs nav-tabs-bottom">
									<li class="nav-item col-sm-3"><a class="nav-link active" data-bs-toggle="tab" href="#myprojects">Projects</a></li>
									<!-- <li class="nav-item col-sm-3"><a class="nav-link" data-bs-toggle="tab" href="#tasks">Tasks</a></li> -->
								</ul>
							</div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-lg-12"> 
							<div class="tab-content profile-tab-content">
								
								<!-- Projects Tab -->
								<div id="myprojects" class="tab-pane fade show active">
									<div class="row">
									<?php
							$query_project = "SELECT * FROM projects";
							$result_query = mysqli_query($conn, $query_project);
							while ($project = mysqli_fetch_assoc($result_query)) {
								if( $project["client_id"] == $client_sel["id"] ) {
									?>
										
                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3 d-flex">
							<div class="card w-100">
								<div class="card-body">
									<div class="dropdown dropdown-action profile-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_project<?php echo $project['id'];?>"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
											<!-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_project"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a> -->
											<a class='dropdown-item' href='projects.php?deleteid=<?php echo $project['id'];?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
										</div>
									</div>
									<h4 class="project-title"><a href="project-view.php?idd=<?php echo $project['id'];?>"><?php echo $project['project_name'];?></a></h4>
									
									<p class="text-muted"><?php echo $project['description'];?>
									</p>

									<div class="row">
											<div class="col-6">
												<div class="pro-deadline m-b-15">
													<div class="sub-title">
														Start Date:
													</div>
													<div class="text-muted">
														<?php echo $project['start_date'];?>
													</div>
												</div>
											</div>
											<div class="col-6">
												<div class="pro-deadline m-b-15">
													<div class="sub-title text-end">
														Deadline:
													</div>
													<div class="text-muted text-end">
														<?php echo $project['end_date'];?>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-6">
												<div class="pro-deadline m-b-15">
													<div class="sub-title">
														Project leader:
													</div>
												<ul class="team-members">
											<li>
											<?php 
											$jsonTeamLeader = $project['project_leader'];
											$teamLeaderArray = json_decode($jsonTeamLeader, true);

										   if ($teamLeaderArray !== null) {
												// Loop through the array and display each team member
												foreach ($teamLeaderArray as $teamLeader) {
													echo "" . $teamLeader['name'] . "<br>";
												}
											} else {
												echo "Error decoding JSON data.";
											}
											?>
											</li>
										</ul>
												</div>
											</div>
											<div class="col-6">
												<div class="pro-deadline m-b-15">
													<div class="sub-title text-end">
													Priority:
													</div>
													<div class="text-muted text-end">
														<?php echo $project['priority'];?>
													</div>
												</div>
											</div>
										</div>



										<!-- ***************** -->
							
									<div class="project-members m-b-15">
										<div>Team :</div>
										<ul class="team-members">
										<li>
											<?php 
											$jsonTeamMembers = $project['team_member'];
											$teamMembersArray = json_decode($jsonTeamMembers, true);

										   if ($teamMembersArray !== null) {
												// Loop through the array and display each team member
												foreach ($teamMembersArray as $teamMember) {
													echo "" . $teamMember['name'] . "<br>";
												
												}
											} else {
												echo "Error decoding JSON data.";
											}
											?>
											</li>
										
										</ul>
									</div>
								</div>
							</div>
						</div>

										<?php
		}
	}
		?>
									</div>
								</div>
								<!-- /Projects Tab -->
								
								<!-- Task Tab -->
								<div id="tasks" class="tab-pane fade">
									<div class="project-task">
										<ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
											<li class="nav-item"><a class="nav-link active" href="#all_tasks" data-bs-toggle="tab" aria-expanded="true">All Tasks</a></li>
											<li class="nav-item"><a class="nav-link" href="#pending_tasks" data-bs-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
											<li class="nav-item"><a class="nav-link" href="#completed_tasks" data-bs-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane show active" id="all_tasks">
												<div class="task-wrapper">
													<div class="task-list-container">
														<div class="task-list-body">
															<ul id="task-list">
																<li class="task">
																	<div class="task-container">
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn" title="Mark Complete">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<span class="task-label" contenteditable="true">Patient appointment booking</span>
																		<span class="task-action-btn task-btn-right">
																			<span class="action-circle large" title="Assign">
																				<i class="material-icons">person_add</i>
																			</span>
																			<span class="action-circle large delete-btn" title="Delete Task">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
																<li class="task">
																	<div class="task-container">
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn" title="Mark Complete">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
																		<span class="task-action-btn task-btn-right">
																			<span class="action-circle large" title="Assign">
																				<i class="material-icons">person_add</i>
																			</span>
																			<span class="action-circle large delete-btn" title="Delete Task">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
																<li class="completed task">
																	<div class="task-container">
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn" title="Mark Complete">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<span class="task-label">Doctor available module</span>
																		<span class="task-action-btn task-btn-right">
																			<span class="action-circle large" title="Assign">
																				<i class="material-icons">person_add</i>
																			</span>
																			<span class="action-circle large delete-btn" title="Delete Task">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
																<li class="task">
																	<div class="task-container">
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn" title="Mark Complete">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
																		<span class="task-action-btn task-btn-right">
																			<span class="action-circle large" title="Assign">
																				<i class="material-icons">person_add</i>
																			</span>
																			<span class="action-circle large delete-btn" title="Delete Task">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
																<li class="task">
																	<div class="task-container">
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn" title="Mark Complete">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<span class="task-label" contenteditable="true">Private chat module</span>
																		<span class="task-action-btn task-btn-right">
																			<span class="action-circle large" title="Assign">
																				<i class="material-icons">person_add</i>
																			</span>
																			<span class="action-circle large delete-btn" title="Delete Task">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
																<li class="task">
																	<div class="task-container">
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn" title="Mark Complete">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<span class="task-label" contenteditable="true">Patient Profile add</span>
																		<span class="task-action-btn task-btn-right">
																			<span class="action-circle large" title="Assign">
																				<i class="material-icons">person_add</i>
																			</span>
																			<span class="action-circle large delete-btn" title="Delete Task">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
															</ul>
														</div>
														<div class="task-list-footer">
															<div class="new-task-wrapper">
																<textarea id="new-task" placeholder="Enter new task here. . ."></textarea>
																<span class="error-message hidden">You need to enter a task first</span>
																<span class="add-new-task-btn btn" id="add-task">Add Task</span>
																<span class="btn" id="close-task-panel">Close</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="pending_tasks"></div>
											<div class="tab-pane" id="completed_tasks"></div>
										</div>
									</div>
								</div>
								<!-- /Task Tab -->
								
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->

				<!-- Project edit modal -->
		<?php
		$query_project = "SELECT * FROM projects";
		$result_query = mysqli_query($conn, $query_project);
		while ($project = mysqli_fetch_assoc($result_query)) {
				?>
				<div id="edit_project<?php echo $project['id'];?>" class="modal custom-modal fade" role="dialog">
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
												<input class="form-control" value="<?php echo $project['project_name'];?>" type="text" name="project_name">
												<input class="form-control" value="<?php echo $project['id'];?>" type="hidden" name="project_id">	
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Client</label>
												<select class="select" name="client">
													<?php
														$query2 = "SELECT * FROM clients";
														$result2 = mysqli_query($conn, $query2);
														
														while ($dept = mysqli_fetch_assoc($result2)) {
															$client_id = $dept['id'];
															$label = $dept['company_name'];
															$selected = ($client_id == $project['client_id']) ? 'selected' : '';
															
															if ($dept['status'] != 0) {
																echo "<option value='$client_id' $selected>$label</option>";
															}
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" value="<?php echo $project['start_date'];?>" type="text" name="start_date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" value="<?php echo $project['end_date'];?>" type="text" name="end_date">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Rate</label>
												<input placeholder="$50" class="form-control" type="text"  value="<?php echo $project['rate_value'];?>" name="rate">
											</div>
										</div>
										<div class="col-sm-3">
											<!-- <div class="input-block mb-3">
												<label class="col-form-label">&nbsp;</label>
												<select class="select" name="rate_type" value="<?php echo $project['rate_type'];?>">
													<option>Hourly</option>
													<option>Fixed</option>
												</select>
											</div> -->
											<div class="input-block mb-3">
												<label class="col-form-label">&nbsp;</label>
												<select class="select" name="rate_type">
													<option <?php echo ($project['rate_type'] == 'Hourly') ? 'selected' : ''; ?>>Hourly</option>
													<option <?php echo ($project['rate_type'] == 'Fixed') ? 'selected' : ''; ?>>Fixed</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Priority</label>
												<select class="select" name="priority">
													<option <?php echo ($project['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
													<option <?php echo ($project['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
													<option <?php echo ($project['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
												</select>
											</div>
										</div>
								
										<div class="col-sm-6">
											<label class="focus-label">Add Project Leader</label>
											<select class="choices-multiple-remove-button" name="team_leader[]" placeholder="--Select--" id="country" required multiple>
												<?php
												$query_emp = "SELECT * FROM employees";
												$result_emp = mysqli_query($conn, $query_emp);
												while ($emp = mysqli_fetch_assoc($result_emp)) {
													if ($emp['status'] != 0) {
														$emp_id = $emp['id'];
														$label_emp = $emp['first_name'];

														// Check if the employee is a project leader
														$isLeader = false;
														$decodedLeaders = json_decode($project['project_leader'], true);
														if (is_array($decodedLeaders)) {
															foreach ($decodedLeaders as $leader) {
																if ($leader['id'] == $emp_id) {
																	$isLeader = true;
																	break;
																}
															}
														}

														// If the employee is a project leader, mark them as selected
														echo "<option value='$emp_id'";
														if ($isLeader) {
															echo " selected";
														}
														echo ">$label_emp</option>";
													}
												}
												?>
											</select>
										</div>
										<div class="col-sm-6">
											<label class="focus-label">Add team</label>
											<select class="choices-multiple-remove-button" name="team_member[]" placeholder="--Select--" id="country" required multiple>
												<?php
												$query_emp = "SELECT * FROM employees";
												$result_emp = mysqli_query($conn, $query_emp);
												while ($emp = mysqli_fetch_assoc($result_emp)) {
													if ($emp['status'] != 0) {
														$emp_id = $emp['id'];
														$label_emp = $emp['first_name'];

														// Check if the employee is a team member
														$isTeamMember = false;
														$decodedTeamMembers = json_decode($project['team_member'], true);
														if (is_array($decodedTeamMembers)) {
															foreach ($decodedTeamMembers as $teamMember) {
																if ($teamMember['id'] == $emp_id) {
																	$isTeamMember = true;
																	break;
																}
															}
														}

														// If the employee is a team member, mark them as selected
														echo "<option value='$emp_id'";
														if ($isTeamMember) {
															echo " selected";
														}
														echo ">$label_emp</option>";
													}
												}
												?>
											</select>
										</div>

									</div>
									<div class="row">
										<!-- <div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Categories</label>
												<select class="select" name="categories" value="<?php echo $project['project_category'];?>">
													<option>Website</option>
													<option>App</option>
												</select>
											</div>
										</div> -->
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Categories</label>
												<select class="select" name="categories">
													<option <?php echo ($project['project_category'] == 'Website') ? 'selected' : ''; ?>>Website</option>
													<option <?php echo ($project['project_category'] == 'App') ? 'selected' : ''; ?>>App</option>
												</select>
											</div>
										</div>
									</div>
										
								
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
										<textarea rows="3" class="form-control" placeholder="Enter Project description" name="description"><?php echo $project['description']; ?></textarea>
										<!-- <div id="editor"></div> -->
									</div>

								
									<div class="input-block mb-3">
										<label class="col-form-label">Upload Files</label>
										<input class="form-control" type="file" name="image">
										<?php if (!empty($project['project_document'])): ?>
											<p>Previous File: <?php echo $project['project_document']; ?></p>
										<?php endif; ?>
									</div>

									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="updateProject">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Project Modal -->
				<?php 
		}
		?>
				
            </div>
        </div>
		<!-- /Main Wrapper -->
		

<?php include './includes/footer.php'?>
 
<script>
      $(document).ready(function() {
        var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
          removeItemButton: true,
        });
      });
</script>
<?php include './includes/connection.php'?>	
<?php 
// if(isset($_POST['addProject'])){
	if (isset($_POST['updateProject'])) {

		// var_dump("epl");
		$projectId=$_POST['project_id'];
		$project_name = $_POST["project_name"];
		$client_name = $_POST["client"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$rate = $_POST["rate"];
		$rate_type = $_POST["rate_type"];
		$priority = $_POST["priority"];
		$categories =$_POST["categories"];
		// $project_leader =$_POST["project_leader"];
		// $add_teams =$_POST["add_team"];
		$description =$_POST["description"];
		
		// $image =$_POST["image"];
		$update_time = date('Y-m-d H:i:s');
		// $update_time = null;
	
	
	// Assuming $_POST['team_member'] contains an array of selected team members
	$selectedTeamLeader = isset($_POST['team_leader']) ? $_POST['team_leader'] : [];
	// var_dump($selectedTeamLeader);
	 // Create an array of team member details
	 $teamLeaderArray = [];
	
	 foreach ($selectedTeamLeader as $emp_id) {
		 // Assuming you fetch employee details from your database
		 $query_emp_details = "SELECT * FROM employees WHERE id = '$emp_id'";
		//  var_dump($query_emp_details);
		 $result_emp_details = mysqli_query($conn, $query_emp_details);
		 $emp_details = mysqli_fetch_assoc($result_emp_details);
	
		 // Add employee details to the array
		 $teamLeaderArray[] = [
			 'id' => $emp_details['id'],
			 'name' => $emp_details['first_name'],
			 'status' => $emp_details['status'],
			 'role' => $emp_details['employee_type']
		 ];
	 }
	
	 // Encode the array as JSON
	 $jsonLeaderMembers = json_encode($teamLeaderArray);
	//******** */
	
	 // Assuming $_POST['team_member'] contains an array of selected team members
	 $selectedTeamMembers = isset($_POST['team_member']) ? $_POST['team_member'] : [];
	//   var_dump($selectedTeamMembers);
	 // Create an array of team member details
	 $teamMembersArray = [];
	
	 foreach ($selectedTeamMembers as $emp_id) {
		 // Assuming you fetch employee details from your database
		 $query_emp_details = "SELECT * FROM employees WHERE id = '$emp_id'";
		//  var_dump($query_emp_details);
		 $result_emp_details = mysqli_query($conn, $query_emp_details);
		 $emp_details = mysqli_fetch_assoc($result_emp_details);
	
		 // Add employee details to the array
		 $teamMembersArray[] = [
			 'id' => $emp_details['id'],
			 'name' => $emp_details['first_name'],
			 'status' => $emp_details['status'],
			 'role' => $emp_details['employee_type']
		 ];
	 }
	
	 // Encode the array as JSON
	 $jsonTeamMembers = json_encode($teamMembersArray);
	  if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
		// Define the upload directory
		$uploadDir = 'uploads/';
		$filename = basename($_FILES['image']['name']);
		$destination = $uploadDir . $filename;
		// Move the uploaded file to the specified directory
		  if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {	
			echo "Image uploaded successfully.";
			// Save the file path to the database (you'll need to modify this part based on your database connection)
			$filePath = mysqli_real_escape_string($conn, $destination);
			// $sql = "INSERT INTO images (file_path) VALUES ('$filePath')";
	
			// $sql = "INSERT INTO projects (project_name, client_id, start_date,end_date,rate_value,rate_type,priority,project_category,project_leader,team_member,description,project_document,status,created_at)
			// VALUES ('$project_name', '$client_name', '$start_date', '$end_date', '$rate', '$rate_type', '$priority','$categories','$jsonLeaderMembers','$jsonTeamMembers','$description','$filePath',1,'$created_time')";
			$updateQuery = "UPDATE projects SET
			project_name='$project_name',
			client_id='$client_name',
			start_date='$start_date',
			end_date='$end_date',
			rate_value='$rate',
			rate_type='$rate_type',
			priority='$priority',
			project_leader='$jsonLeaderMembers',
			team_member='$jsonTeamMembers',
			project_category='$categories',
			description='$description',
			project_document='$filePath',
			update_at='$update_time'
			WHERE id = '$projectId'";
	
			var_dump($updateQuery);
			if(mysqli_query($conn, $updateQuery)){
				echo "updated"
				?>
			<script>
				//  "Without image Project data updated successfully";
				toastr.success('Project Update Successfully !');
				  setTimeout(function() {
					// window.location = "projects.php";
					<?php
					 echo "window.location.href = 'client-profile.php?idd=".$idd."'";
					?>
					echo ""
				  }, 1000);
			</script>
				  <?php
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				?>
				<script>
				//  "Without image Project data updated successfully";
				toastr.error('Error !');
				  setTimeout(function() {
					<?php
					 echo "window.location.href = 'client-profile.php?idd=".$idd."'";
					?>
				  }, 1000);
				  </script>
				  <?php
			}	
		}
	}  else {
		$updateQuery = "UPDATE projects SET
			project_name='$project_name',
			client_id='$client_name',
			start_date='$start_date',
			end_date='$end_date',
			rate_value='$rate',
			rate_type='$rate_type',
			priority='$priority',
			project_leader='$jsonLeaderMembers',
			team_member='$jsonTeamMembers',
			project_category='$categories',
			description='$description',
			update_at='$update_time'
			WHERE id = ".$projectId;
		if (mysqli_query($conn, $updateQuery)) {
			// echo "updated"
			?>
			<script>
				//  "Without image Project data updated successfully";
				toastr.success('Project Update Successfully!');
				  setTimeout(function() {
					<?php
					 echo "window.location.href = 'client-profile.php?idd=".$idd."'";
					?>
				  }, 1000);
				  </script>
				  <?php
				  
			} else {
				// echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				?>
				<script>
				//  "Without image Project data updated successfully";
				toastr.error('Error !');
				  setTimeout(function() {
					<?php
					 echo "window.location.href = 'client-profile.php?idd=".$idd."'";
					?>
				  }, 1000);
				  </script>
				  <?php
			}
	}
	}



?>
    </body>
</html>