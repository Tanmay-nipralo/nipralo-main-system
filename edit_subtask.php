<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$idd = $_GET['pid'];
$subtask_id = $_GET['sid'];

$task_select = "SELECT * from project_task WHERE id='$idd'";
$result_task = mysqli_query($conn, $task_select);
$task_sel = mysqli_fetch_assoc($result_task);

$query_project = "SELECT * FROM projects WHERE id = {$task_sel['project_id']}";
$result_project = mysqli_query($conn, $query_project);
$project_data = mysqli_fetch_assoc($result_project);

$query_Subtask = "SELECT * FROM project_subtask WHERE id = $subtask_id ";
$result_Subtask = mysqli_query($conn, $query_Subtask);
$project_subtask = mysqli_fetch_assoc($result_Subtask);



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
								<h3 class="page-title">Edit Subtask</h3>
							</div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Tittle</label>
												<input class="form-control" type="text" value="<?php echo $project_subtask['tittle']?>" name="tittle">
												<input class='form-control' type='hidden' value=<?php echo $idd ?>   name='projectID'>
												<input class="form-control" type="hidden" value="<?php echo $project_subtask['task_id'] ?>"  name="taskID">
												<input class="form-control" type="hidden" value="<?php echo $subtask_id ?>"  name="subtaskID">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">  
												<label class="col-form-label">Assign By</label>
                                                <select class="choices-multiple-remove-button" name="team_leader[]"    placeholder="--Select--" id="country" required multiple>
													<?php
													$projectLeaders =$project_data['project_leader'];
													$decodedTeamLeader = json_decode($task_sel['assign_by'], true);
													if (is_array($decodedTeamLeader)) {
														foreach ($decodedTeamLeader as $teamLeader) {
															$isSelected = ($teamLeader['id'] == $decodedTeamLeader[0]['id']);
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
														<input class="form-control datetimepicker" type="text" value="<?php echo $project_subtask['start_date']?>" name="start_date">
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="input-block mb-3">
													<label class="col-form-label">End Date</label>
													<div class="cal-icon">
														<input class="form-control datetimepicker" type="text" value="<?php echo $project_subtask['end_date']?>" name="end_date">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Priority</label>
													<select class="select" name="priority">
														<option <?php echo ($project_subtask['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
														<option <?php echo ($project_subtask['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
														<option <?php echo ($project_subtask['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
													</select>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Time Period</label>
													<input class="form-control" name="time_period" value="<?php echo $project_subtask['time_period']?>">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="input-block mb-3">
													<label class="col-form-label">Assign To</label>
													<select class="select" name="team_member[]" required >
													<?php
														$projectLeaders = json_decode($project_data['team_member'], true);
														$decodedTeamLeader = json_decode($task_sel['assign_to'], true);
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
											<textarea rows="4" class="form-control" name="desc"><?php echo $project_subtask['description'] ?></textarea>
										</div>
										<div class="submit-section">
											<button class="btn btn-primary submit-btn" type="submit" name="updateSubTask">Save</button>
										</div>
									</div>
								</form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
		
    </body>
</html>


<?php
    if (isset($_POST['updateSubTask'])) {
        $subtaskID = $_POST["subtaskID"];
        $projectID = $_POST["projectID"];
        $taskID = $_POST["taskID"];
        $tittle = mysqli_real_escape_string($conn, $_POST["tittle"]);
        $assign_by = $_POST["assign_by"];
        $assign_to = $_POST["assign_to"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $priority = $_POST["priority"];
        $time_period = $_POST["time_period"];
        // $subtask_status = $_POST['subtask_status'];
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
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
                'role' => $emp_details['employee_type'],
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
                'role' => $emp_details['employee_type'],
            ];
        }
        $jsonTeamMembers = json_encode($teamMembersArray);
    
        $query = "UPDATE project_subtask  SET tittle = '$tittle',assign_by='$jsonLeaderMembers',assign_to='$jsonTeamMembers',start_date='$start_date',end_date='$end_date',priority='$priority',time_period='$time_period',description='$desc',updated_at ='$update_time' WHERE id = " . $subtaskID;
        $iquery = mysqli_query($conn, $query);
       if ($iquery) {
          ?>
             <script>
             toastr.success('Updated Successfully!');
             setTimeout(function() {
             window.location = "task-view.php?idd=<?php echo $idd ?>";
             }, 1000);
          </script>
          <?php
       } else {
          ?>
             <script>
             toastr.error('Error!');
             setTimeout(function() {
             window.location = "task-view.php?idd=<?php echo $idd ?>";
             }, 1000);
          </script>
          <?php
       }
    }
                    ?>