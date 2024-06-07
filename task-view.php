<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php'?>
	<?php include './includes/connection.php';
	$idd = $_GET['idd'];
	$task_select = "SELECT * from project_task WHERE id='$idd'";
	$result_task = mysqli_query($conn, $task_select);
	$task_sel = mysqli_fetch_assoc($result_task);
	?>

    <body>
        <div class="main-wrapper">	
		    <?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
							<div class="page-header">
								<div class="row">   
									<div class="col-sm-12">
										<h3 class="page-title">Task View Page</h3>
										<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
											<li class="breadcrumb-item active">Profile</li>
										</ul>
									</div>
								</div>
							</div>
					<div class="card mb-0">
						<div class="card-body">
                        <div class="pro-edit">
                            <a data-bs-target="#profile_info" data-bs-toggle="modal"
                             	class="edit-icon" href="#"><i class="fa-solid fa-pencil"></i></a>
                        </div>
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
									
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
                                                    <ul class="personal-info">
														<li>
															<span class="title">Tittle :</span>
															<span class="text"><a href=""><?php echo $task_sel['tittle'] ?></a></span>
														</li>
														<li>
															<span class="title">Priority :</span>
															<span class="text"><a href=""><?php echo $task_sel['priority'] ?></a></span>
														</li>

														<li>
                                                    <span class="title">Project Name :</span>
                                                    <?php
                                                    $query_project = "SELECT * FROM projects WHERE id = {$task_sel['project_id']}";
                                                    $result_project = mysqli_query($conn, $query_project);
                                                    $project_data = mysqli_fetch_assoc($result_project);
                                                    ?>
                                                        <span class="text"><a href=""><span class="__cf_email__"><?php echo $project_data['project_name'] ?></span></a></span>
                                                    <?php 
                                                    ?>
                                                    </li>
                                                    <li>
															<span class="title">Description :</span>
															<span class="text"><span href=""><?php echo $task_sel['description'] ?></span></span>
														</li>
													</div>
												</div>
                                                
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<span class="title">Start Date :</span>
															<span class="text"><a href=""><?php echo $task_sel['start_date'] ?></a></span>
														</li>
														<li>
															<span class="title">End Date :</span>
															<span class="text"><a href=""><?php echo $task_sel['end_date'] ?></a></span>
														</li>
                                                      <li>
                                                      <span class="title">Assign to :</span>
                                                    
                                                            <?php 
                                                            $jsonTeamMember = $task_sel['assign_to'];
                                                            $teamMemberArray = json_decode($jsonTeamMember, true);

                                                        if ($teamMemberArray !== null) {
                                                                foreach ($teamMemberArray as $teamMember) {
                                                                   
                                                                    echo "<span>" . $teamMember['name'] . "&nbsp;</span>";
                                                                }
                                                            } else {
                                                                echo "Error decoding JSON data.";
                                                            }
                                                            ?>
                                                </li>
                                                <li>
                                                    <span class="title">Assign By :</span>
                                                    <?php 
                                                            $jsonTeamLeader = $task_sel['assign_by'];
                                                            $teamLeaderArray = json_decode($jsonTeamLeader, true);

                                                        if ($teamLeaderArray !== null) {
                                                                foreach ($teamLeaderArray as $teamLeader) {
                                                                   
                                                                    echo "<span>" . $teamLeader['name'] . "</span>";

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
								</div>
							</div>
                            
						</div>
                        
					</div>
					<div>
						<div>
							<div>
                                <div class="card tab-box">
                                                            <div class="row user-tabs">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                                                                    <ul class="nav nav-tabs nav-tabs-bottom">
                                                                        <li class="nav-item col-sm-3"><a class="nav-link active" data-bs-toggle="tab" href="#myprojects">Sub Task</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                   
													     <table class="table table-bordered">
															 <thead class="thead-light">
																<tr>
																	<th>Sr No.</th>
																	<th>Title</th>
																	<th>Start Date</th>
																	<th>End Date</th>
																	<th>Assign By</th>
																	<th>Assign To</th>
																	<th>Priority</th>
																	<th>Description</th>
																	<th>Time Period</th>
																	<th>Status</th>
																	<th>Action</th>
																</tr>
															 </thead>
															 <tbody>
																	<?php 
																	$i = 1;
																	$query_Subtask = "SELECT * FROM project_subtask";
																	$result_Subtask = mysqli_query($conn, $query_Subtask);
																	while($project_subtask = mysqli_fetch_assoc($result_Subtask)){
																		
																	if($task_sel['id'] ==$project_subtask['task_id']){
																	?>
																<tr>
																		<td><?php echo $i++; ?></td>
																		<td><?php echo $project_subtask['tittle']?></td>
																		<td><?php echo $project_subtask['start_date']?></td>
																		<td><?php echo $project_subtask['end_date']?></td>
																		<td> <?php 
																			$jsonTeamLeader = $project_subtask['assign_by'];
																			$teamLeaderArray = json_decode($jsonTeamLeader, true);

																		if ($teamLeaderArray !== null) {
																				foreach ($teamLeaderArray as $teamLeader) {
																				
																					echo "<span>" . $teamLeader['name'] . "</span>";

																				}
																			} else {
																				echo "Error decoding JSON data.";
																			}
																			?> 
																	
																	
																	</td>
																		<td>  <?php 
																		$jsonTeamMember = $task_sel['assign_to'];
																		$teamMemberArray = json_decode($jsonTeamMember, true);

																	if ($teamMemberArray !== null) {
																			foreach ($teamMemberArray as $teamMember) {
																			
																				echo "<span>" . $teamMember['name'] . "&nbsp;</span>";
																			}
																		} else {
																			echo "Error decoding JSON data.";
																		}
																		?>
																	</td>
																		<td><?php echo  $project_subtask['priority']?></td>
																		<td><?php echo  $project_subtask['description']?></td>
																		<td><?php echo  $project_subtask['time_period']?></td>
																		<td>
																		<select class="statusSelect select" >
																		<option value="2" <?php echo ($project_subtask['subtask_status'] == 2) ? 'selected' : ''; ?>>New</option>
																		<option value="3" <?php echo ($project_subtask['subtask_status'] == 3) ? 'selected' : ''; ?>>Hold</option>
																		<option value="0" <?php echo ($project_subtask['subtask_status'] == 0) ? 'selected' : ''; ?>>Pending</option>
																		<option value="1" <?php echo ($project_subtask['subtask_status'] == 1) ? 'selected' : ''; ?>>Completed</option>
																		<option value="4" <?php echo ($project_subtask['subtask_status'] == 4) ? 'selected' : ''; ?>>TBD</option>
																		</select>
																		<input type="hidden" class="subtaskId" name="sid" value="<?php echo $project_subtask['id'] ?>">
																	</td>
																		<td><a class='dropdown-item' href='edit_subtask.php?pid=<?php echo $idd;?>&&sid=<?php echo $project_subtask['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i></a>
																		<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_subtask<?php echo $project_subtask['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i></a>
																			</td>
																</tr>
																		
																	<?php 
																		}
																	}
																	?>
																</tbody>
													    </table>        
				                </div>	
				
                        </div>
                    </div>

		<?php
				$querytask = "SELECT * FROM project_subtask";
				$resulttask = mysqli_query($conn, $querytask);
				while ($task = mysqli_fetch_assoc($resulttask)) {
				?>
				<div class="modal custom-modal fade" id="delete_subtask<?php echo $task['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Subtask</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<form method="post" enctype="multipart/form-data">
								<input class="form-control" type="hidden" value="<?php echo $task['id'] ?>"  name="subtaskID">
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<button  type="submit" name="delete" class="btn btn-primary continue-btn">Delete</button>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php 
				}
		?>
              
		  <div id="profile_info" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Task Information</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Tittle</label>
												<input class="form-control" type="text" value="<?php echo $task_sel['tittle'] ?>" name="tittle">
                                                <input class="form-control" type="hidden" value="<?php echo $task_sel['project_id'] ?>" name="project_id">
											
											</div>
										</div>

										<div class="col-sm-6">
											<div class="input-block mb-3">  
												<label class="col-form-label">Assign By</label>
                                                <select class="choices-multiple-remove-button" name="team_leader[]"    placeholder="--Select--" id="country" required multiple>
													<?php
													$projectLeaders =$project_data['project_leader'];
													var_dump($projectLeaders);

													$decodedTeamLeader = json_decode($task_sel['assign_by'], true);
													var_dump($teamLeader);

													if (is_array($decodedTeamLeader)) {
														foreach ($decodedTeamLeader as $teamLeader) {
															var_dump($teamLeader);

															// Set a variable to track if the current team leader should be selected
															$isSelected = ($teamLeader['id'] == $decodedTeamLeader[0]['id']); // Set the first team leader as default

															echo "<option value='" . $teamLeader['id'] . "'";
															if ($isSelected) {
																echo " selected";
															}
															echo ">" . $teamLeader['name'] . "</option>";
														}
													}
													?>
												</select>
                                       </div>
                                        
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" name="start_date" value="<?php echo $task_sel['start_date'] ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" name="end_date" value="<?php echo $task_sel['end_date'] ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Priority</label>
                                                <select class="select" name="priority">
                                                    <option <?php if ($task_sel['priority'] == 'High') echo 'selected'; ?>>High</option>
                                                    <option <?php if ($task_sel['priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                                                    <option <?php if ($task_sel['priority'] == 'Low') echo 'selected'; ?>>Low</option>
                                                </select>
                                                </option>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Assign To</label>
                                                <select class="choices-multiple-remove-button" name="team_member[]" placeholder="--Select--" id="country" required multiple>
                                                <?php
													$projectLeaders = json_decode($project_data['team_member'], true);
													$decodedTeamLeader = json_decode($task_sel['assign_to'], true);
													var_dump("this is Team", $decodedTeamLeader);

													if (is_array($projectLeaders)) {
														foreach ($projectLeaders as $teamLeader) {
															$isSelected = false;
															foreach ($decodedTeamLeader as $selectedLeader) {
																if ($teamLeader['id'] == $selectedLeader['id']) {
																	$isSelected = true;
																	break; 
																}
															}

															echo "<option value='" . $teamLeader['id'] . "'";
															if ($isSelected) {
																echo " selected";
															}
															echo ">" . $teamLeader['name'] . "</option>";
														}
													}
													?>

                                                </select>
											</div>
										</div>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
                                        <textarea rows="4" class="form-control" placeholder="Enter your message here" name="desc"><?php echo $task_sel['description']; ?></textarea>

									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="UpdateTask">Save</button>
									</div>
								</form>
						</div>
					</div>
				</div>
			</div>
<?php include './includes/footer.php'?>
 
<script>
      $(document).ready(function() {
        var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
          removeItemButton: true,
        });
      });
</script>
<script>
    $(document).ready(function () {
        $('.statusSelect').on('change', function () {
            var selectedValue = $(this).val();
            var subtaskId = $(this).siblings('.subtaskId').val();
            $.ajax({
                url: 'updateSubtaskStatus.php',
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
<?php
if (isset($_POST['UpdateTask'])) {
	var_dump("epl");
	$projectId=$_POST['project_id'];
    $tittle = $_POST["tittle"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
	$priority = $_POST["priority"];
	$description =$_POST["desc"];
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

	$updateQuery = "UPDATE project_task SET
		project_id='$projectId',
        tittle='$tittle',
		start_date='$start_date',
		end_date='$end_date',
		priority='$priority',
		assign_by='$jsonLeaderMembers',
		assign_to='$jsonTeamMembers',
		description='$description',
		updated_at='$update_time'
		WHERE id = ".$idd;
	if (mysqli_query($conn, $updateQuery)) {
		?>
		<script>
                toastr.success('Task Update Successfully!');
                setTimeout(function() {
                    window.location = "task-view.php?idd=" + <?php echo $idd; ?>;
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


	if(isset($_POST['delete'])){
		$subtaskID =$_POST["subtaskID"];
		$sql = "DELETE FROM project_subtask WHERE id=".$subtaskID;
		var_dump($sql);
		$result = mysqli_query($conn, $sql);
		if ($result) {
					 echo "deleted !";
					 echo "<script>window.location.href ='task-view.php?idd=".$idd."'</script>";
				} else {
					die(mysqli_error($conn));
				}


	}

?>


    </body>
</html>