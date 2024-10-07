<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php
error_reporting(0);
include './includes/header.php';
$getalldocument = getAllDocuments();
$idd = $_GET['idd'];

// $query_select = "SELECT * from projects WHERE id='$idd'";
// $result_select = mysqli_query($conn, $query_select);
// $project_sel = mysqli_fetch_assoc($result_select);
$project_sel = getProjecById($idd);
$project_sel = $project_sel[0];
$pid = $project_sel['id'];
$project_task1 = getAllProjecttask($pid);
$folders = getFolders();
?>
<style>
	.accordion {
		padding: 10px;
	}
</style>

<body>
	<div class="main-wrapper">
		<?php include './includes/navbar.php' ?>
		<?php include './includes/sidebar.php' ?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 col-xl-9">
						<div class="card">
							<div class="card-body">
								<div class="project-title">
									<h6 class="card-title"><?php echo $project_sel['project_name'] ?></h6>
								</div>
								<p><?php echo $project_sel['description'] ?></p>

							</div>
						</div>

						<div class="card">
							<div class="col-auto float-end ms-auto" style="padding: 10px;">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#create_folder"><i class="fa-solid fa-plus"></i> Create Folder</a>
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#upload"><i class="fa-solid fa-plus"></i>documents</a>
							</div>
							<div class="card-body">
								<!-- <h5 class="card-title m-b-20">Uploaded Image files</h5>
									<div class="row" style="padding: 10px;">
										<div class="col-md-3 col-sm-4 col-lg-4 col-xl-3">
											<div class="uploaded-box">
												<div class="uploaded-img">
													<img src="<?php echo $project_sel['project_document'] ?>" class="img-fluid" alt="Placeholder Image">
												</div>
											</div>
										</div>
									</div> -->
								<div class="card">
									<div class="card-body">
										<section class="dash-section">
											<div class="dash-sec-content">
												<div class="row">
													<?php
													$sql = "SELECT * FROM folder";
													$result = mysqli_query($conn, $sql);
													if ($result && mysqli_num_rows($result) > 0) {
														while ($row = mysqli_fetch_assoc($result)) {
															$folder_name = $row['folder_name'];
															$path = $row['path'];
													?>
															<div class="col-md-2">
																<div class="dash-info-list">
																	<a href="view_folder.php?pid=<?php echo $idd; ?>&&fid=<?php echo $row['id']; ?>" class="dash-card">
																		<div class="dash-card-container">
																			<div class="dash-card-icon1">
																				<i class="fa-solid fa-suitcase"></i>
																			</div>
																			<div class="dash-card-content1">
																				<p><?php echo htmlspecialchars($folder_name); ?></p>
																			</div>
																		</div>
																	</a>
																</div>
															</div>
													<?php }
													} else {
														echo 'No folders found.';
													} ?>
												</div>
											</div>
										</section>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-lg-4 col-xl-3">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title m-b-15">Project details</h6>
								<table class="table table-striped table-border">
									<tbody>
										<tr>
											<td>Rate :</td>
											<td class="text-end"><?php echo $project_sel['rate_value'] ?></td>
										</tr>
										<tr>
											<td>Rate Type :</td>
											<td class="text-end"><?php echo $project_sel['rate_type'] ?></td>
										</tr>
										<tr>
											<td>Start Date:</td>
											<td class="text-end"><?php echo $project_sel['start_date'] ?></td>
										</tr>
										<tr>
											<td>Deadline:</td>
											<td class="text-end"><?php echo $project_sel['end_date'] ?></td>
										</tr>
										<tr>
											<td>Priority:</td>
											<td class="text-end">
												<div class="btn-group">
													<a href="#" class="badge badge-danger" data-bs-toggle="dropdown"><?php echo $project_sel['priority'] ?> </a>
												</div>
											</td>
										</tr>

										<tr>
											<td>Status:</td>
											<td class="text-end">Working</td>
										</tr>
									</tbody>
								</table>

							</div>
						</div>
						<div class="card project-user">
							<div class="card-body">
								<h6 class="card-title m-b-20">Team Leader </h6>
								<ul class="list-box">
									<li>
										<?php
										$jsonTeamLeader = $project_sel['project_leader'];
										$teamLeaderArray = json_decode($jsonTeamLeader, true);

										if ($teamLeaderArray !== null) {
											foreach ($teamLeaderArray as $teamLeader) {
												echo "<a href='profile.php'>";
												echo "<div class='list-item'>";

												echo "<div class='list-body'>";
												echo "<span class='message-author'>" . $teamLeader['name'] . "</span>";

												echo "</div>";
												echo "</a>";
											}
										} else {
											echo "Error decoding JSON data.";
										}
										?>
									</li>

								</ul>
							</div>
						</div>
						<div class="card project-user">
							<div class="card-body">
								<h6 class="card-title m-b-20">Team Members</h6>
								<ul class="list-box">
									<table class="table">
										<tbody>
											<?php
											$jsonTeamLeader = $project_sel['team_member'];
											$teamLeaderArray = json_decode($jsonTeamLeader, true);
											if ($teamLeaderArray !== null) {
												foreach ($teamLeaderArray as $teamLeader) {
													$team_id = $teamLeader['id'];
													$getemp = getEmployeeById($team_id);
													foreach ($getemp as $getemp1) { ?>
														<tr>
															<td><a href='profile.php'><?php echo $teamLeader['name'] ?></a></td>
															<td style="max-width: 200px;white-space: normal;">
																<?php
																if (isset($getemp1['des'][0]['designation'])) {
																	echo $getemp1['des'][0]['designation'];
																} else {
																	echo "-";
																} ?></td>
															<td><?php if (isset($teamLeader['days'])) {
																	echo $teamLeader['days'];
																} else {
																	echo "-";
																} ?></td>
															<td><a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#add_days<?php echo $teamLeader['id'] ?>"><i class="fa-solid fa-plus"></i></a></td>
														</tr>
											<?php }
												}
											} else {
												echo "<tr><td colspan='2'>Error decoding JSON data.</td></tr>";
											}
											?>
										</tbody>
									</table>


								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card" style="padding: 10px;">
							<div class="col-auto float-end ms-auto">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_task"><i class="fa-solid fa-plus"></i> Add Task</a>
							</div>
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
													<div class="tabsearch"><a href="export.php?table=project_task&&project_id=<?php echo $idd; ?>" class="btn btn-outline-primary" type="button"><i class="icon icon-download"></i> Excel</a></div>
													<?php $tempx = 0;
													foreach ($project_task1 as $project_task) {
														$tempx++;
														if ($tempx > 1) {
													?>
															<div class="accordion" id="accordionExample">
																<div class="accordion-item">
																	<h2 class="accordion-header">
																		<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $project_task['id'] ?>" aria-expanded="true" aria-controls="collapseOne"><?php echo $project_task['tittle'] ?> </button>
																	</h2>
																	<div id="collapse<?php echo $project_task['id'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
																		<div class="accordion-body">
																			<span class="action-circle small" title="Assign">
																				<i class="material-icons add-new-task-btn btn" data-bs-toggle="modal" data-bs-target="#add_subtask<?php echo $project_task['id'] ?>">person_add</i>
																			</span>
																			<span class="material-icons small delete-btn btn" id="delete-task" title="Delete Task" data-bs-toggle='modal' data-bs-target='#delete_task<?php echo $project_task['id'] ?>'><i class="material-icons">delete</i></span>
																			<a href="task-view.php?idd=<?php echo $project_task['id'] ?>" class="material-icons small view-btn btn" title="View Task"><i class="material-icons">visibility</i></a>
																			<table class="table table-bordered">
																				<thead class="thead-light">
																					<tr>
																						<th>Tittle</th>
																						<th>Start Date</th>
																						<th>End Date</th>
																						<th>Assign By</th>
																						<th>Assign To</th>
																						<th>Priority</th>
																						<th>Time Period</th>
																						<th>Status</th>
																						<th>Action</th>
																					</tr>
																				</thead>
																				<tbody>
																					<?php
																					$tid = $project_task['id'];
																					$result_Subtask = getAllProjectsubtask($tid);
																					foreach ($result_Subtask as $project_subtask) {
																					?>
																						<tr>
																							<td><?php echo $project_subtask['tittle'] ?></td>
																							<td><?php echo $project_subtask['start_date'] ?></td>
																							<td><?php echo $project_subtask['end_date'] ?></td>
																							<td>
																								<?php
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
																							<td>
																								<?php
																								$jsonTeamMember = $project_subtask['assign_to'];
																								$teamMemberArray = json_decode($jsonTeamMember, true);

																								if ($teamMemberArray !== null) {
																									foreach ($teamMemberArray as $teamMember) { ?>
																										<span><?php echo $teamMember['name'] ?>&nbsp;</span>
																										<input class="empid" type="hidden" name="emp_id" value="<?php echo $teamMember['id'] ?>">
																								<?php }
																								} else {
																									echo "Error decoding JSON data.";
																								}
																								?>

																							</td>
																							<td><?php echo $project_subtask['priority'] ?></td>
																							<td><?php echo $project_subtask['time_period'] ?></td>
																							<td>
																								<select class="statusSelect select">
																									<option value="2" <?php echo ($project_subtask['subtask_status'] == 2) ? 'selected' : ''; ?>>New</option>
																									<option value="3" <?php echo ($project_subtask['subtask_status'] == 3) ? 'selected' : ''; ?>>Hold</option>
																									<option value="0" <?php echo ($project_subtask['subtask_status'] == 0) ? 'selected' : ''; ?>>Pending</option>
																									<option value="1" <?php echo ($project_subtask['subtask_status'] == 1) ? 'selected' : ''; ?>>Completed</option>
																									<option value="4" <?php echo ($project_subtask['subtask_status'] == 4) ? 'selected' : ''; ?>>TBD</option>
																								</select>
																								<input type="hidden" class="subtaskId" name="sid" value="<?php echo $project_subtask['id'] ?>">
																								<input type="hidden" class="taskId" name="taskid" value="<?php echo $project_subtask['task_id'] ?>">
																								<input type="hidden" class="projectId" name="projectid" value="<?php echo $project_subtask['project_id'] ?>">
																								<input class="subtaskTitle" type="hidden" name="subtitle" value="<?php echo $project_subtask['tittle'] ?>">
																							</td>
																							<td>
																								<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_subtask<?php echo $project_subtask['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i></a>
																								<!-- <a class='dropdown-item' href='edit_subtask.php?pid=<?php echo $tid; ?>&&sid=<?php echo $project_subtask['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i></a> -->
																								<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_subtask<?php echo $project_subtask['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i></a>
																							</td>
																						</tr>
																					<?php } ?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
													<?php
														}
													} ?>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="pending_tasks">
										<div class="tabsearch"><a href="export.php?table=pending_task&&project_id=<?php echo $idd; ?>" class="btn btn-outline-primary" type="button"><i class="icon icon-download"></i> Excel</a></div>
										<?php
										// $query_task = "SELECT * FROM project_task where project_id = " . $project_sel['id'] . "";
										// $result_task = mysqli_query($conn, $query_task);
										// while ($project_task = mysqli_fetch_assoc($result_task)) {
										$tempx = 0;
										foreach ($project_task1 as $project_task) {
											$tempx++;
											if ($tempx <= 1) continue;
											if ($project_sel['id'] == $project_task['project_id']) {

												$query_check_subtask = "SELECT COUNT(*) AS subtask_count FROM project_subtask WHERE task_id = " . $project_task['id'] . " AND subtask_status = 0";
												$result_check_subtask = mysqli_query($conn, $query_check_subtask);
												$row_check_subtask = mysqli_fetch_assoc($result_check_subtask);

												if ($row_check_subtask['subtask_count'] > 0) {
										?>
													<div class="accordion" id="accordionExample">
														<div class="accordion-item">
															<h2 class="accordion-header">
																<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $project_task['id'] ?>" aria-expanded="true" aria-controls="collapseOne">
																	<?php echo $project_task['tittle'] ?>
																</button>
															</h2>
															<div id="collapse<?php echo $project_task['id'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
																<div class="accordion-body">
																	<span class="action-circle small" title="Assign">
																		<i class="material-icons add-new-task-btn btn" data-bs-toggle="modal" data-bs-target="#add_subtask<?php echo $project_task['id'] ?>">person_add</i>
																	</span>
																	<span class="material-icons small delete-btn btn" id="delete-task" title="Delete Task" data-bs-toggle='modal' data-bs-target='#delete_task<?php echo $project_task['id'] ?>'>
																		<i class="material-icons">delete</i>
																	</span>
																	<a href="task-view.php?idd=<?php echo $project_task['id'] ?>" class="material-icons small view-btn btn" title="View Task">
																		<i class="material-icons">visibility</i>
																	</a>
																	<table class="table table-bordered">
																		<thead class="thead-light">
																			<tr>
																				<th>Tittle</th>
																				<th>Start Date</th>
																				<th>End Date</th>
																				<th>Assign By</th>
																				<th>Assign To</th>
																				<th>Priority</th>
																				<th>Status</th>
																				<th>Time Period</th>
																				<th>Action</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																			$query_Subtask = "SELECT * FROM project_subtask";
																			$result_Subtask = mysqli_query($conn, $query_Subtask);
																			while ($project_subtask = mysqli_fetch_assoc($result_Subtask)) {

																				if ($project_task['id'] == $project_subtask['task_id']) {
																			?>
																					<tr>
																						<td><?php echo $project_subtask['tittle'] ?></td>
																						<td><?php echo $project_subtask['start_date'] ?></td>
																						<td><?php echo $project_subtask['end_date'] ?></td>
																						<td>
																							<?php
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
																						<td>
																							<?php
																							$jsonTeamMember = $project_subtask['assign_to'];
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
																						<td><?php echo $project_subtask['priority'] ?></td>
																						<td><?php $subtask_status = $project_subtask['subtask_status'];
																							$status_text = ($subtask_status == 1) ? 'Completed' : 'Pending';
																							echo $status_text; ?></td>
																						<td><?php echo $project_subtask['time_period'] ?></td>
																						<td><a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_subtask<?php echo $project_subtask['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i></a>
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
													</div>

										<?php
												}
											}
										}
										?>
									</div>
									<div class="tab-pane" id="completed_tasks">
										<div class="tabsearch"><a href="export.php?table=completed_task&&project_id=<?php echo $idd; ?>" class="btn btn-outline-primary" type="button"><i class="icon icon-download"></i> Excel</a></div>
										<?php
										// $query_task = "SELECT * FROM project_task";
										// $result_task = mysqli_query($conn, $query_task);
										// while ($project_task = mysqli_fetch_assoc($result_task)) {
										$tempx = 0;
										foreach ($project_task1 as $project_task) {
											$tempx++;
											if ($tempx <= 1) continue;
											if ($project_sel['id'] == $project_task['project_id']) {

												$query_check_subtask = "SELECT COUNT(*) AS subtask_count FROM project_subtask WHERE task_id = " . $project_task['id'] . " AND subtask_status = 0";
												$result_check_subtask = mysqli_query($conn, $query_check_subtask);
												$row_check_subtask = mysqli_fetch_assoc($result_check_subtask);
												if ($row_check_subtask['subtask_count'] == 0) {
										?>
													<div class="accordion" id="accordionExample">
														<div class="accordion-item">
															<h2 class="accordion-header">
																<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $project_task['id'] ?>" aria-expanded="true" aria-controls="collapseOne">
																	<?php echo $project_task['tittle'] ?>
																</button>
															</h2>
															<div id="collapse<?php echo $project_task['id'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
																<div class="accordion-body">
																	<span class="action-circle small" title="Assign">
																		<i class="material-icons add-new-task-btn btn" data-bs-toggle="modal" data-bs-target="#add_subtask<?php echo $project_task['id'] ?>">person_add</i>
																	</span>

																	<span class="material-icons small delete-btn btn" id="delete-task" title="Delete Task" data-bs-toggle='modal' data-bs-target='#delete_task<?php echo $project_task['id'] ?>'>
																		<i class="material-icons">delete</i>
																	</span>
																	<a href="task-view.php?idd=<?php echo $project_task['id'] ?>" class="material-icons small view-btn btn" title="View Task">
																		<i class="material-icons">visibility</i></a>
																	<table class="table table-bordered">
																		<thead class="thead-light">
																			<tr>
																				<th>Tittle</th>
																				<th>Start Date</th>
																				<th>End Date</th>
																				<th>Assign By</th>
																				<th>Assign To</th>
																				<th>Priority</th>
																				<th>Status</th>
																				<th>Time Period</th>
																				<th>Action</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																			$query_Subtask = "SELECT * FROM project_subtask";
																			$result_Subtask = mysqli_query($conn, $query_Subtask);
																			while ($project_subtask = mysqli_fetch_assoc($result_Subtask)) {
																				if ($project_task['id'] == $project_subtask['task_id']) {
																			?>
																					<tr>
																						<td><?php echo $project_subtask['tittle'] ?></td>
																						<td><?php echo $project_subtask['start_date'] ?></td>
																						<td><?php echo $project_subtask['end_date'] ?></td>
																						<td>
																							<?php
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
																						<td>
																							<?php
																							$jsonTeamMember = $project_subtask['assign_to'];
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
																						<td><?php echo $project_subtask['priority'] ?></td>
																						<td><?php $subtask_status = $project_subtask['subtask_status'];
																							$status_text = ($subtask_status == 1) ? 'Completed' : 'Pending';
																							echo $status_text; ?></td>
																						<td><?php echo $project_subtask['time_period'] ?></td>
																						<td><a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_subtask<?php echo $project_subtask['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i></a>
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
													</div>

										<?php
												}
											}
										}
										?>


									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="add_task" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Task</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="row">
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Tittle</label>
											<input class="form-control" type="text" name="tittle">
											<input class="form-control" type="hidden" value="<?php echo $project_sel['id'] ?>" name="projectID">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Assign By</label>
											<select class="choices-multiple-remove-button" name="team_leader[]" placeholder="--Select--" id="country" required multiple>
												<?php
												$decodedTeamLeader = json_decode($project_sel['project_leader'], true);
												if (is_array($decodedTeamLeader)) {
													foreach ($decodedTeamLeader as $teamLeader) { ?>
														<option value='<?php echo $teamLeader['id'] ?>'><?php echo $teamLeader['name'] ?></option>
												<?php }
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Start Date</label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" type="text" name="start_date">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">End Date</label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" type="text" name="end_date">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Priority</label>
											<select class="select" name="priority">
												<option selected>High</option>
												<option>Medium</option>
												<option>Low</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Assign To</label>
											<select class="choices-multiple-remove-button" name="team_member[]" placeholder="--Select--" id="country" required multiple>
												<?php
												$decodedTeamMember = json_decode($project_sel['team_member'], true);
												if (is_array($decodedTeamMember)) {
													foreach ($decodedTeamMember as $teamMember) { ?>
														<option value='<?php echo $teamMember['id'] ?>'><?php echo $teamMember['name'] ?></option>
												<?php }
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="input-block mb-3">
									<label class="col-form-label">Description</label>
									<textarea rows="4" class="form-control" placeholder="Enter your message here" name="desc"></textarea>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" type="submit" name="addTask">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div id="upload" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Upload Document</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data">
								<div class="mb-3">
									<label for="documentName" class="form-label">Select Folder:</label>
									<select class="form-control" name="documentName" required>
										<?php foreach ($folders as $folder) { ?>
											<option value="<?php echo $folder['id'] ?>"><?php echo $folder['folder_name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="mb-3">
									<label for="documentName" class="form-label">Document Name:</label>
									<input type="text" class="form-control" name="documentName" required>
									<input type="hidden" value="<?php echo $idd ?>" class="form-control" name="project_id">
								</div>
								<div class="mb-3">
									<label for="documentlink" class="form-label">Document Link:</label>
									<input type="text" class="form-control" name="documentlink">
								</div>
								<div class="mb-3">
									<label for="file" class="form-label">Select File:</label>
									<input type="file" class="form-control" name="image" accept=".pdf, .doc, .docx">
								</div>
								<div class="mb-3">
									<label for="documentDescription" class="form-label">Document Description:</label>
									<textarea class="form-control" name="documentDescription" rows="4" required></textarea>
								</div>
								<button type="submit" name="uploadDocument" class="btn btn-primary">Upload Document</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php
			$jsonTeamLeader1 = $project_sel['team_member'];
			$teamLeaderArray1 = json_decode($jsonTeamLeader1, true);
			if ($teamLeaderArray1 !== null) {
				foreach ($teamLeaderArray1 as $teamLeader1) { ?>
					<div id="add_days<?php echo $teamLeader1['id'] ?>" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 30%;">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Project Completion Days</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form method="post" enctype="multipart/form-data">
										<div class="mb-3">
											<label for="documentName" class="form-label">No of Days:</label>
											<input type="text" class="form-control" name="days" required>
											<input type="hidden" value="<?php echo $idd ?>" class="form-control" name="project_id">
											<input type="hidden" value="<?php echo $teamLeader1['id'] ?>" class="form-control" name="team_id">
										</div>
										<button type="submit" name="add_days" class="btn btn-primary">Add</button>
									</form>
								</div>
							</div>
						</div>
					</div>
			<?php }
			} ?>

			<?php foreach ($project_task1 as $task) { ?>
				<div id="add_subtask<?php echo $task['id'] ?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add SubTask</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Title</label>
												<input class="form-control" type="text" name="tittle">

												<input class='form-control' type='hidden' value=<?php echo $idd; ?> name='projectID'>
												<input class="form-control" type="hidden" value="<?php echo $task['id'] ?>" name="taskID">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Assign By</label>
												<select class="choices-multiple-remove-button" name="team_leader[]" placeholder="--Select--" id="country" required multiple>
													<?php
													$decodedTeamLeader = json_decode($project_sel['project_leader'], true);
													if (is_array($decodedTeamLeader)) {
														foreach ($decodedTeamLeader as $teamLeader) { ?>
															<option value='<?php echo $teamLeader['id'] ?>'><?php echo $teamLeader['name'] ?></option>
													<?php  }
													} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" name="start_date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" name="end_date">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Priority</label>
												<select class="select" name="priority">
													<option selected>High</option>
													<option>Medium</option>
													<option>Low</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Time Period(In Minutes)</label>
												<input class="form-control" name="time_period">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Assign To</label>
												<select class="select" name="team_member[]">
													<?php
													$decodedTeamMember = json_decode($project_sel['team_member'], true);
													if (is_array($decodedTeamMember)) {
														foreach ($decodedTeamMember as $teamMember) { ?>
															<option value='<?php echo $teamMember['id'] ?>'><?php echo $teamMember['name'] ?></option>
													<?php  }
													} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
										<textarea rows="4" class="form-control" placeholder="Enter your message here" name="desc"></textarea>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="addSubTask">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php
			// $querytask = "SELECT * FROM project_task";
			// $resulttask = mysqli_query($conn, $querytask);
			// while ($task = mysqli_fetch_assoc($resulttask)) {
			$tempx = 0;
			foreach ($project_task1 as $project_task) {
				$tempx++;
				if ($tempx <= 1) continue;
			?>
				<div class="modal custom-modal fade" id="delete_task<?php echo $task['id']; ?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Task</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<form method="post" enctype="multipart/form-data">
									<input class="form-control" placeholder="" type="hidden" value="<?php echo $task['id'] ?>" name="taskID">
									<?php echo $task['id'] ?>
									<div class="modal-btn delete-action">
										<div class="row">
											<div class="col-6">
												<button type="submit" name="deleteTask" class="btn btn-primary continue-btn">Delete</button>
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

			<?php
			// $query_Subtask = "SELECT * FROM project_subtask";
			// $result_Subtask = mysqli_query($conn, $query_Subtask);
			// while ($project_subtask = mysqli_fetch_assoc($result_Subtask)) {
			$project_subtask1 =	getAllSubtaskByProjectId($project_sel['id']);
			foreach ($project_subtask1 as $project_subtask) {
			?>
				<div id="edit_subtask<?php echo $project_subtask['id']; ?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Sub Task</h5>
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
												<input class="form-control" type="text" value="<?php echo $project_subtask['tittle'] ?>" name="tittle">
												<?php $idd = $_GET['idd'];
												echo "<input class='form-control' type='hidden' value=$idd   name='projectID'>";
												?>
												<input class="form-control" type="hidden" value="<?php echo $project_subtask['task_id'] ?>"  name="taskID">
												<input class="form-control" type="hidden" value="<?php echo $project_subtask['id'] ?>"  name="subtaskID">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Assign By</label>
                                                <select class="choices-multiple-remove-button" name="team_leader[]"    placeholder="--Select--" id="country" required multiple>
													<?php
													$projectLeaders = $project_sel['project_leader'];
													var_dump($projectLeaders);

													$decodedTeamLeader = json_decode($project_subtask['assign_by'], true);
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


									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" value="<?php echo $project_subtask['start_date'] ?>" name="start_date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" value="<?php echo $project_subtask['end_date'] ?>" name="end_date">
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
											<input class="form-control" name="time_period" value="<?php echo $project_subtask['time_period'] ?>">
										</div>
									</div>

										<div class="col-sm-12">
											<div class="input-block mb-3">
												<label class="col-form-label">Assign To</label>
                                                <select class="select" name="team_member[]" required>
                                                <?php
												$projectLeaders = json_decode($project_sel['team_member'], true);
												$decodedTeamLeader = json_decode($project_subtask['assign_to'], true);
												var_dump("this is Team", $decodedTeamLeader);

												if (is_array($projectLeaders)) {
													foreach ($projectLeaders as $teamLeader) {
														// Check if the current teamLeader is in the decodedTeamLeader array
														$isSelected = false;
														foreach ($decodedTeamLeader as $selectedLeader) {
															if ($teamLeader['id'] == $selectedLeader['id']) {
																$isSelected = true;
																break; // Break the loop once a match is found
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
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>

			<?php
			$querytask = "SELECT * FROM project_subtask";
			$resulttask = mysqli_query($conn, $querytask);
			while ($task = mysqli_fetch_assoc($resulttask)) {
			?>
				<!-- Delete subtask Modal -->
				<div class="modal custom-modal fade" id="delete_subtask<?php echo $task['id']; ?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Subtask</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<form method="post" enctype="multipart/form-data">
									<input class="form-control" type="hidden" value="<?php echo $task['id'] ?>" name="subtaskID">
									<div class="modal-btn delete-action">
										<div class="row">
											<div class="col-6">
												<button type="submit" name="delete" class="btn btn-primary continue-btn">Delete</button>
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

			<?php
			$querytask = "SELECT * FROM documents";
			$resulttask = mysqli_query($conn, $querytask);
			while ($document = mysqli_fetch_assoc($resulttask)) {
			?>
				<div class="modal custom-modal fade" id="delete_task<?php echo $document['id']; ?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Document</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<form method="post" enctype="multipart/form-data">
									<input class="form-control" type="hidden" value="<?php echo $document['id'] ?>" name="docID">
									<div class="modal-btn delete-action">
										<div class="row">
											<div class="col-6">
												<button type="submit" name="deletedoc" class="btn btn-primary continue-btn">Delete</button>
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


			<!-- create folder -->
			<div id="create_folder" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Create Folder</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="input-block mb-3">
									<label class="col-form-label">Folder Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="folder_name">
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

	</div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-dJqAdU2x01F7T1C+5/RAF3dHJt8KJ23pb4h5j5Zlp4ahf9+iCD5uLeJ2QFpxl5VJ" crossorigin="anonymous"></script>
	<script>
		document.getElementById('view-task').addEventListener('click', function() {
			var viewTaskModal = new bootstrap.Modal(document.getElementById('viewTaskModal'));
			viewTaskModal.show();
		});
	</script>

	<script>
		$(document).ready(function() {
			$('.statusSelect').on('change', function() {
				var selectedValue = $(this).val();
				var subtaskId = $(this).siblings('.subtaskId').val();
				var taskId = $(this).siblings('.taskId').val();
				var projectId = $(this).siblings('.projectId').val();
				var subtaskTitle = $(this).siblings('.subtaskTitle').val();
				var empId = $(this).closest('tr').find('.empid').val();
				$.ajax({
					url: 'updateSubtaskStatus.php',
					method: 'POST',
					//  data: { status: selectedValue, sid: subtaskId},
					data: {
						status: selectedValue,
						sid: subtaskId,
						taskid: taskId,
						projectid: projectId,
						subtaskTitle: subtaskTitle,
						empId: empId
					},

					success: function(response) {
						console.log(response);
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			});
		});
	</script>

	<?php include './includes/footer.php' ?>
	<script>
		$(document).ready(function() {
			var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
				removeItemButton: true,
			});
		});
	</script>
	<?php
	if (isset($_POST['add'])) {
		$folder_name = $_POST['folder_name'];
		$base_dir = 'tags/';
		$folder_name = htmlspecialchars(strip_tags($folder_name));
		$folder_path = $base_dir . $folder_name;
		$permissions = 0755;
		if (is_dir($folder_path)) {
	?>
			<script>
				toastr.error('Folder already exists!');
				setTimeout(function() {
					window.location.href = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
			<?php
			exit;
		}
		if (mkdir($folder_path, $permissions)) {
			$created_time = date('Y-m-d H:i:s');
			$stmt = $conn->prepare("INSERT INTO folder (project_id,folder_name, path, created_at, updated_at) VALUES (?,?, ?, ?, ?)");
			$stmt->bind_param("sssss", $idd, $folder_name, $folder_path, $created_time, $created_time);

			if ($stmt->execute()) {
			?>
				<script>
					toastr.success('Folder created and path stored successfully!');
					setTimeout(function() {
						window.location.href = "project-view.php?idd=<?php echo $idd ?>";
					}, 1000);
				</script>
			<?php
			} else {
			?>
				<script>
					toastr.error('Error storing path in database!');
					setTimeout(function() {
						window.location.href = "project-view.php?idd=<?php echo $idd ?>";
					}, 1000);
				</script>
			<?php
			}
			$stmt->close();
		} else {
			?>
			<script>
				toastr.error('Error creating folder!');
				setTimeout(function() {
					window.location.href = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
		<?php
		}
	}





	if (isset($_POST['addTask'])) {
		$projectID = $_POST['projectID'];
		$tittle = $_POST["tittle"];
		$assign_by = $_POST["assign_by"];
		$assign_to = $_POST["assign_to"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$priority = $_POST["priority"];
		$desc = $_POST["desc"];
		$created_time = date('Y-m-d H:i:s');
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

		$jsonAssignBy = json_encode($teamLeaderArray);
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
		$jsonAssignTo = json_encode($teamMembersArray);

		$sql = "INSERT INTO project_task (tittle, priority,description,assign_by,assign_to,start_date,end_date,created_at, updated_at,project_id)
		VALUES ( '$tittle','$priority','$desc','$jsonAssignBy','$jsonAssignTo','$start_date','$end_date','$created_time', '$created_time','$projectID')";
		$iquery = mysqli_query($conn, $sql);
		if ($iquery) {
		?>
			<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
					window.location = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
		<?php
		} else {
		?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
					window.location = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
		<?php
		}
	}

	if (isset($_POST['addSubTask'])) {
		$projectID = $_POST["projectID"];
		$taskID = $_POST["taskID"];
		$tittle = $_POST["tittle"];
		$assign_by = $_POST["assign_by"];
		$assign_to = $_POST["assign_to"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$priority = $_POST["priority"];
		$time_period = $_POST["time_period"];
		$desc = $_POST["desc"];
		$created_time = date('Y-m-d H:i:s');
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

		$jsonAssignBy = json_encode($teamLeaderArray);
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

		$jsonAssignTo = json_encode($teamMembersArray);

		$sql = "INSERT INTO project_subtask (tittle, priority,description,assign_by,assign_to,start_date,end_date,created_at, updated_at,project_id,task_id,time_period)
		VALUES ( '$tittle','$priority','$desc','$jsonAssignBy','$jsonAssignTo','$start_date','$end_date','$created_time', '$created_time','$projectID','$taskID','$time_period')";
		$iquery = mysqli_query($conn, $sql);
		if ($iquery) {
		?>
			<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
					window.location = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
		<?php
		} else {
		?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
					window.location = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
			<?php
		}
	}

	if (isset($_POST['updateSubTask'])) {
		$subtaskID = $_POST["subtaskID"];
		$projectID = $_POST["projectID"];
		$taskID = $_POST["taskID"];
		$tittle = $_POST["tittle"];
		$assign_by = $_POST["assign_by"];
		$assign_to = $_POST["assign_to"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$priority = $_POST["priority"];
		$time_period = $_POST["time_period"];
		// $subtask_status = $_POST['subtask_status'];
		$desc = $_POST["desc"];
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
		if (mysqli_query($conn, $query)) {
			echo "<script>";
			echo "window.location.href = 'project-view.php?idd=" . $idd . "'";
			echo "</script>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	if (isset($_POST['delete'])) {
		$subtaskID = $_POST["subtaskID"];
		$sql = "DELETE FROM project_subtask WHERE id=" . $subtaskID;
		var_dump($sql);
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "deleted !";
			echo "<script>window.location.href ='project-view.php?idd=" . $idd . "'</script>";
		} else {
			die(mysqli_error($conn));
		}
	}

	if (isset($_POST['deleteTask'])) {
		$taskID = $_POST["taskID"];
		$sql = "DELETE FROM project_task WHERE id=" . $taskID;
		var_dump($sql);
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>window.location.href ='project-view.php?idd=" . $idd . "'</script>";
		} else {
			die(mysqli_error($conn));
		}
	}

	if (isset($_POST['uploadDocument'])) {
		$project_id = $_POST['project_id'];
		$documentName = $_POST['documentName'];
		$documentlink = $_POST['documentlink'];
		$documentDescription = $_POST['documentDescription'];
		$created_time = date('Y-m-d H:i:s');
		$update_time = null;

		if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/';
			$filename = basename($_FILES['image']['name']);
			$destination = $uploadDir . $filename;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
				echo "Image uploaded successfully.";
				$filePath = mysqli_real_escape_string($conn, $destination);
				$sql = "INSERT INTO documents (document_name,project_id,document_description, file_path,documentlink,created_at,updated_at) VALUES ('$documentName','$project_id','$documentDescription', '$filePath','$documentlink','$created_time','$update_time')";
				var_dump($sql);
				$iquery = mysqli_query($conn, $sql);
				if ($iquery) {
			?>
					<script>
						toastr.success('Added Successfully!');
						setTimeout(function() {
							window.location = "project-view.php?idd=<?php echo $idd ?>";
						}, 1000);
					</script>
				<?php
				} else {
				?>
					<script>
						toastr.error('Error!');
						setTimeout(function() {
							window.location = "project-view.php?idd=<?php echo $idd ?>";
						}, 1000);
					</script>
			<?php
				}
			}
		}
	}

	if (isset($_POST['add_days'])) {
		$project_id = $_POST['project_id'];
		$team_id = $_POST['team_id'];
		$days = $_POST['days'];

		$jsonTeamMember = $project_sel['team_member'];
		$teamMemberArray = json_decode($jsonTeamMember, true);

		foreach ($teamMemberArray as &$teamMember) {
			if ($teamMember['id'] == $team_id) {
				$teamMember['days'] = $days;
				break;
			}
		}
		$updatedJsonTeamMember = json_encode($teamMemberArray);
		$updateQuery = "UPDATE projects SET team_member = '$updatedJsonTeamMember' WHERE id = $project_id";
		var_dump($updateQuery);
		$iquery = mysqli_query($conn, $updateQuery);
		if ($iquery) {
			?>
			<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
					window.location = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
		<?php
		} else {
		?>
			<script>
				toastr.error('Error!');
				setTimeout(function() {
					window.location = "project-view.php?idd=<?php echo $idd ?>";
				}, 1000);
			</script>
	<?php
		}
	}



	if (isset($_GET['deleteid']) && isset($_GET['idd'])) {
		$id = $_GET['deleteid'];
		$idds = $_GET['idd'];
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
								window.location.href = "project-view.php?idd=' . $idds . '&&id=' . $id . '";
							} else {
								window.location.href = "project-view.php?idd=' . $idds . '&&id=' . $id . '";
							}
						});';
			echo '</script>';
		}
	}

	if (isset($_GET['id']) && isset($_GET['idd'])) {
		$id = $_GET['id'];
		$iddss = $_GET['idd'];
		$sql = "UPDATE `documents` SET `status`= 5 WHERE id=" . $id;
		$result = mysqli_query($conn, $sql);

		if ($result) {
			echo "<script>window.location.href = 'project-view.php?idd=" . $iddss . "'</script>";
		} else {
			die(mysqli_error($con));
		}
	}

	if (isset($_POST['deletedoc'])) {
		$docID = $_POST["docID"];
		$sql = "DELETE FROM documents WHERE id=" . $docID;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "deleted !";
			echo "<script>window.location.href ='project-view.php?idd=" . $idd . "'</script>";
		} else {
			die(mysqli_error($conn));
		}
	}
	?>
</body>

</html>