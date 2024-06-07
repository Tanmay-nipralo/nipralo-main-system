<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
	data-sidebar-image="none">
<?php include './includes/header.php';
$idd = $_GET['idd'];
 $emp_sel = getEmpById($idd);
$designation = getAllDesignation();
$department = getAllDepartment();
$projects = getAllProject();
// echo "<pre>";
// print_r($emp_sel);
// echo "</pre>";
// exit;
?>
<body>
	<div class="main-wrapper">
		<?php include './includes/navbar.php' ?>
		<?php include './includes/sidebar.php' ?>
		<div class="page-wrapper">
			<div class="content container-fluid">
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

				<div class="card mb-0">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="profile-view">
									<div class="profile-img-wrap">
										<div class="profile-img">
											<a href="#"><img src="<?php echo $emp_sel['photo'] ?>" alt="User Image"></a>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-5">
												<div class="profile-info-left">
													<h3 class="user-name m-t-0 mb-0">
														<?php echo $emp_sel['first_name'] . " " . $emp_sel['last_name'] ?>
													</h3>
													<h6 class="text-muted">
														<?php echo $emp_sel['designation'][0]['designation'] ?>
													</h6>
													<small class="text-muted"><?php echo $emp_sel['department'][0]['department_name'] ?>
															</small>
													<div class="staff-id">Employee ID :
														<?php echo $emp_sel['id'] ?>
													</div>
													<div class="small doj text-muted">Date of Join :
														<?php echo $emp_sel['joining_date'] ?>
													</div>
												</div>
											</div>
											<div class="col-md-7">
												<ul class="personal-info">
													<li>
														<div class="title">Phone:</div>
														<div class="text"><a href=""><?php echo $emp_sel['phone'] ?></a></div>
													</li>
													<li>
														<div class="title">Email:</div>
														<div class="text"><a href=""><span class="__cf_email__"><?php echo $emp_sel['mail'] ?></span></a></div>
													</li>
													<li>
														<div class="title">Birthday:</div>
														<div class="text">
															<?php echo $emp_sel['birth_date'] ?>
														</div>
													</li>
													<li>
														<div class="title">Address:</div>
														<div class="text">
															<?php echo $emp_sel['address'] ?>
														</div>
													</li>
													<li>
														<div class="title">Gender:</div>
														<div class="text">
															<?php echo $emp_sel['gender'] ?>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="pro-edit"><a data-bs-target="#profile_info" data-bs-toggle="modal"
											class="edit-icon" href="#"><i class="fa-solid fa-pencil"></i></a>
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
								<li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a></li>
								<li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Projects</a></li>
								<li class="nav-item"><a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li>
								<li class="nav-item"><a href="#emp_assets" data-bs-toggle="tab" class="nav-link">Assets</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="tab-content">
					<div id="emp_profile" class="pro-overview tab-pane fade show active">
						<div class="row">
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Personal information</h3>
											<ul class="personal-info">
												<li>
													<div class="title">Full Name</div>
													<div class="text">
														<?php echo $emp_sel['first_name'] . " " . $emp_sel['last_name'] ?>
													</div>
												</li>
												<li>
													<div class="title">Email</div>
													<div class="text">
														<?php echo $emp_sel['mail'] ?>
													</div>
												</li>
												<li>
													<div class="title">Joining Date</div>
													<div class="text">
														<?php echo $emp_sel['joining_date'] ?>
													</div>
												</li>
												<li>
													<div class="title">Phone Number</div>
													<div class="text">
														<?php echo $emp_sel['phone'] ?>
													</div>
												</li>
												<li>
													<div class="title">Role</div>
													<div class="text">
														<?php echo $emp_sel['employee_type'] ?>
													</div>
												</li>
												<li>
													<div class="title">Department</div>
													<div class="text">
														<?php echo $emp_sel['department'][0]['department_name'] ?>
													</div>
												</li>
												<li>
													<div class="title">Designation</div>
													<div class="text">
														<?php echo $emp_sel['designation'][0]['designation'] ?>
													</div>
												</li>
												<li>
													<div class="title">Previous Organisation</div>
													<div class="text">
														<?php echo $emp_sel['previous_org'] ?>
													</div>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Reference</h3>
											<ul class="personal-info">
												<li>
													<div class="title">Hired From</div>
													<div class="text">
														<?php echo $emp_sel['reference'] ?>
													</div>
												</li>
												<li>
													<div class="title">Family Name</div>
													<div class="text">
														<?php echo $emp_sel['family_name'] ?>
													</div>
												</li>
												<li>
													<div class="title">Family Contact</div>
													<div class="text">
														<?php echo $emp_sel['family_contact'] ?>
													</div>
												</li>
												<li>
													<div class="title">Family Relation</div>
													<div class="text">
														<?php echo $emp_sel['family_relation'] ?>
													</div>
												</li>
												<h3 class="card-title">Verification</h3>
												<li>
													<div class="title">Name</div>
													<div class="text">
														<?php echo $emp_sel['verify_name'] ?>
													</div>
												</li>
												<li>
													<div class="title">Relation</div>
													<div class="text">
														<?php echo $emp_sel['verify_relation'] ?>
													</div>
												</li>
												<li>
													<div class="title">Contact</div>
													<div class="text">
														<?php echo $emp_sel['verify_contact'] ?>
													</div>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Bank information<a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#bank_details"><i class="fa-solid fa-pencil"></i></a></h3>
											<ul class="personal-info">
												<li>
													<div class="title">Bank name</div>
													<div class="text">
														<?php echo $emp_sel['bank_name'] ?>
													</div>
												</li>
												<li>
													<div class="title">Bank account No.</div>
													<div class="text">
														<?php echo $emp_sel['account_no'] ?>
													</div>
												</li>
												<li>
													<div class="title">IFSC Code</div>
													<div class="text">
														<?php echo $emp_sel['ifsc_code'] ?>
													</div>
												</li>
												<li>
													<div class="title">PAN No</div>
													<div class="text">
														<?php echo $emp_sel['pan_no'] ?>
													</div>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Uploaded Documents</h3>
											<ul class="personal-info">
												<div class="tab-content" style="padding-top: 0px!important;">
													<div id="emp_profile" class="pro-overview tab-pane fade show active">
														<div class="row">
															<div class="col-md-6 d-flex">
																<div class="card profile-box flex-fill">
																	<div class="card-body">
																		<li>
																			<div class="text">
																				<div class="title" style="width:100%!important">Aadhaar: </div><br>
																				<?php
																				$aadhaar = isset($emp_sel['aadhaar'])? $emp_sel['aadhaar']: '';
																				$extension1 = pathinfo($aadhaar, PATHINFO_EXTENSION);
																				if($extension1 == 'pdf'){
																					echo '<a href="' . $emp_sel['aadhaar'] . '" target="_blank"><i class="fa-solid fa-file-pdf" style="font-size: 20px"></i></a>';
																					echo '<iframe src="' . $emp_sel['aadhaar'] . '" width="100%" height="80px"></iframe>';
																				} elseif($extension1 == 'png'){
																					echo '<a href="' . $emp_sel['aadhaar'] . '" target="_blank"><img class="img" src="' . $emp_sel['aadhaar'] . '" style="height:50px;"></a>';
																				} else{
																					echo "No image found for ID ".$emp_sel['id'];
																				}
																				?>
																			</div>
																		</li>
																	</div>
																</div>
															</div>
															<div class="col-md-6 d-flex">
																<div class="card profile-box flex-fill">
																	<div class="card-body">
																		<li>
																			<div class="text">
																				<div class="title" style="width:100%!important">PAN: </div><br>
																				<?php
																				$pan = isset($emp_sel['pan'])? $emp_sel['pan']: '';
																				$extension1 = pathinfo($pan, PATHINFO_EXTENSION);
																				if($extension1 == 'pdf'){
																					echo '<a href="' . $emp_sel['pan'] . '" target="_blank"><i class="fa-solid fa-file-pdf" style="font-size: 20px"></i></a>';
																					echo '<iframe src="' . $emp_sel['pan'] . '" width="100%" height="80px"></iframe>';
																				} elseif($extension1 == 'png'){
																					echo '<a href="' . $emp_sel['pan'] . '" target="_blank"><img class="img" src="' . $emp_sel['pan'] . '" style="height:50px;"></a>';
																				} else{
																					echo "No image found for ID ".$emp_sel['id'];
																				}
																				?>
																			</div>
																		</li>
																	</div>
																</div>
															</div>
															<div class="col-md-6 d-flex">
																<div class="card profile-box flex-fill">
																	<div class="card-body">
																		<li>
																			<div class="text">
																				<div class="title" style="width:100%!important">Passing certificate: </div><br>
																				<?php
																				$pass_cert = isset($emp_sel['pass_cert'])? $emp_sel['pass_cert']: '';
																				$extension1 = pathinfo($pass_cert, PATHINFO_EXTENSION);
																				if($extension1 == 'pdf'){
																					echo '<a href="' . $emp_sel['pass_cert'] . '" target="_blank"><i class="fa-solid fa-file-pdf" style="font-size: 20px"></i></a>';
																					echo '<iframe src="' . $emp_sel['pass_cert'] . '" width="100%" height="80px"></iframe>';
																				} elseif($extension1 == 'png'){
																					echo '<a href="' . $emp_sel['pass_cert'] . '" target="_blank"><img class="img" src="' . $emp_sel['pass_cert'] . '" style="height:50px;"></a>';
																				} else{
																					echo "No image found for ID ".$emp_sel['id'];
																				}
																				?>
																			</div>
																		</li>
																	</div>
																</div>
															</div>
															<div class="col-md-6 d-flex">
																<div class="card profile-box flex-fill">
																	<div class="card-body">
																		<li>
																			<div class="text">
																				<div class="title" style="width:100%!important">Extra certificate: </div><br>
																				<?php
																				$extra_cert = isset($emp_sel['extra_cert'])? $emp_sel['extra_cert']: '';
																				$extension1 = pathinfo($extra_cert, PATHINFO_EXTENSION);
																				if($extension1 == 'pdf'){
																					echo '<a href="' . $emp_sel['extra_cert'] . '" target="_blank"><i class="fa-solid fa-file-pdf" style="font-size: 20px"></i></a>';
																					echo '<iframe src="' . $emp_sel['extra_cert'] . '" width="100%" height="80px"></iframe>';
																				} elseif($extension1 == 'png'){
																					echo '<a href="' . $emp_sel['extra_cert'] . '" target="_blank"><img class="img" src="' . $emp_sel['extra_cert'] . '" style="height:50px;"></a>';
																				} else{
																					echo "No image found for ID ".$emp_sel['id'];
																				}
																				?>
																			</div>
																		</li>
																	</div>
																</div>
															</div>
															<div class="col-md-6 d-flex">
																<div class="card profile-box flex-fill">
																	<div class="card-body">
																		<li>
																			<div class="text">
																				<div class="title" style="width:100%!important">Experience certificate: </div><br>
																				<?php 
																				$exp_certArray = $emp_sel['exp_cert']? json_decode($emp_sel['exp_cert'], true): array();
																				if(!empty($exp_certArray)){
																					foreach ($exp_certArray as $img) {

																						// echo $img.'<br>';
																						$extension4 = pathinfo($img, PATHINFO_EXTENSION);
																						if($extension4 == 'pdf'){
																							echo '<a href="' . $img . '" target="_blank"><i class="fa-solid fa-file-pdf" style="font-size: 20px"></i></a>';
																							echo '<iframe src="' . $img . '" width="100%" height="180px"></iframe>';
																						} elseif($extension4 == 'png'){
																							echo '<a href="' . $img . '" target="_blank"><img class="img" src="' . $img . '" style="height:50px;"></a>';
																						} else{
																							echo "No image found for ID ".$emp_sel['id'];
																						}
																					}
																				}
																				?>
																			</div>
																		</li>
																	</div>
																</div>
															</div>
															
														</div>
													</div>
												</div>
												<!-- <li>
													<div class="title">Bank account No.</div>
													<div class="text">
														<?php echo $emp_sel['account_no'] ?>
													</div>
												</li>
												<li>
													<div class="title">IFSC Code</div>
													<div class="text">
														<?php echo $emp_sel['ifsc_code'] ?>
													</div>
												</li>
												<li>
													<div class="title">PAN No</div>
													<div class="text">
														<?php echo $emp_sel['pan_no'] ?>
													</div>
												</li> -->
											</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="emp_projects">
						<div class="row">
							<?php
							foreach($projects as $project){
								$decodedLeaders = json_decode($project['project_leader'], true);
								$decodedMembers = json_decode($project['team_member'], true);

								if (is_array($decodedLeaders) && is_array($decodedMembers)) {
									foreach (array_merge($decodedLeaders, $decodedMembers) as $member) {
										if ($member['id'] == $idd) {
											?>
											<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3 d-flex">
												<div class="card w-100">
													<div class="card-body">
														<div class="dropdown dropdown-action profile-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
																aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#" data-bs-toggle="modal"
																	data-bs-target="#edit_project<?php echo $project['id']; ?>"><i
																		class="fa-solid fa-pencil m-r-5"></i> Edit</a>
																<a class='dropdown-item'
																	href='projects.php?deleteid=<?php echo $project['id']; ?>'><i
																		class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
															</div>
														</div>
														<h4 class="project-title"><a
																href="project-view.php?idd=<?php echo $project['id']; ?>">
																<?php echo $project['project_name']; ?>
															</a></h4>

														<p class="text-muted">
															<?php echo $project['description']; ?>
														</p>

														<div class="row">
															<div class="col-6">
																<div class="pro-deadline m-b-15">
																	<div class="sub-title">
																		Start Date:
																	</div>
																	<div class="text-muted">
																		<?php echo $project['start_date']; ?>
																	</div>
																</div>
															</div>
															<div class="col-6">
																<div class="pro-deadline m-b-15">
																	<div class="sub-title text-end">
																		Deadline:
																	</div>
																	<div class="text-muted text-end">
																		<?php echo $project['end_date']; ?>
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
																			if ($decodedLeaders !== null) {
																				foreach ($decodedLeaders as $teamLeader) {
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
																		<?php echo $project['priority']; ?>
																	</div>
																</div>
															</div>
														</div>
														<div class="project-members m-b-15">
															<div>Team :</div>
															<ul class="team-members">
																<li>
																	<?php
																	if ($decodedMembers !== null) {
																		foreach ($decodedMembers as $teamMember) {
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
											<?php	}}}}?>
						</div>
					</div>
					
					<?php
					$getCount1 = $getCount['id'];
					$query_salary = "SELECT * FROM emp_salary WHERE client_id =$getCount1";
					$result_salary = mysqli_query($conn, $query_salary);

					if ($result_salary->num_rows > 0) {
						while ($salary = mysqli_fetch_assoc($result_salary)) {
							?>
							<div class="tab-pane fade" id="bank_statutory">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"> Basic Salary Information</h3>
										<form method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">Salary amount <small
																class="text-muted">per month</small></label>
														<div class="input-group">
															<span class="input-group-text">₹</span>
															<input type="text" class="form-control"
																placeholder="Type your salary amount" name="salary_amount"
																value="<?php echo $salary['salary_amount'] ?>">
															<input type="hidden" class="form-control" name="client_id"
																value="<?php echo $idd ?>">
															<input type="hidden" class="form-control" name="salary_id"
																value="<?php echo $salary['id'] ?>">
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">Payment type</label>
														<select class="select" name="payment_type">
															<option <?php echo ($salary['payment_type'] == 'Select payment type') ? 'selected' : ''; ?>>Select payment type</option>
															<option <?php echo ($salary['payment_type'] == 'Bank transfer') ? 'selected' : ''; ?>>Bank transfer</option>
															<option <?php echo ($salary['payment_type'] == 'Check') ? 'selected' : ''; ?>>Check</option>
															<option <?php echo ($salary['payment_type'] == 'Cash') ? 'selected' : ''; ?>>Cash</option>
														</select>
													</div>
												</div>
											</div>
											<hr>
											<h3 class="card-title"> PF Information</h3>
											<div class="row">
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">PF contribution</label>
														<select class="select" name="pf_contribution">
															<option <?php echo ($salary['pf_contribution'] == 'Select PF contribution') ? 'selected' : ''; ?>>Select PF contribution
															</option>
															<option <?php echo ($salary['pf_contribution'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
															<option <?php echo ($salary['pf_contribution'] == 'No') ? 'selected' : ''; ?>>No</option>
														</select>
													</div>													
												</div>
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label" for="pfNoContribution">PF No.</label>
														<select class="form-control" id="pfNoContribution"
															onchange="togglePFNoField()" name="pfNoContribution">
															<option <?php echo ($salary['pf'] == 'Select PF contribution') ? 'selected' : ''; ?>>Select PF contribution</option>
															<option value="yes" <?php echo ($salary['pf'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
															<option value="no" <?php echo ($salary['pf'] == 'no') ? 'selected' : ''; ?>>No</option>
														</select>
													</div>
												</div>

												<div class="col-sm-4" id="pfNoField"
													style="display: <?php echo ($salary['pf'] == 'yes') ? 'block' : 'none'; ?>">
													<div class="input-block mb-3">
														<label class="col-form-label" for="pfNoInput">PF No.</label>
														<input type="text" class="form-control" id="pfNoInput" name="pfNoInput"
															value="<?php echo $salary['pf_no'] ?>" required>
													</div>
												</div>

												<script>
													function togglePFNoField() {
														var pfContributionSelect = document.getElementById("pfNoContribution");
														var pfNoField = document.getElementById("pfNoField");
														pfNoField.style.display = (pfContributionSelect.value === 'yes') ? 'block' : 'none';
													}
												</script>

												<div class="row">
													<div class="col-sm-4">
														<div class="input-block mb-3">
															<label class="col-form-label">Employee PF rate </label>
															<select class="select" name="employee_pf_rate">
																<option <?php echo ($salary['employee_pf_rate'] == 'Select PF rate') ? 'selected' : ''; ?>>Select PF rate</option>
																<option value="0%" <?php echo ($salary['employee_pf_rate'] == '0%') ? 'selected' : ''; ?>>0%
																</option>
																<option value="1%" <?php echo ($salary['employee_pf_rate'] == '1%') ? 'selected' : ''; ?>>1%
																</option>
																<option value="2%" <?php echo ($salary['employee_pf_rate'] == '2%') ? 'selected' : ''; ?>>2%
																</option>
																<option value="3%" <?php echo ($salary['employee_pf_rate'] == '3%') ? 'selected' : ''; ?>>3%
																</option>
																<option value="4%" <?php echo ($salary['employee_pf_rate'] == '4%') ? 'selected' : ''; ?>>4%
																</option>
																<option value="5%" <?php echo ($salary['employee_pf_rate'] == '5%') ? 'selected' : ''; ?>>5%
																</option>
																<option value="6%" <?php echo ($salary['employee_pf_rate'] == '6%') ? 'selected' : ''; ?>>6%
																</option>
																<option value="7%" <?php echo ($salary['employee_pf_rate'] == '7%') ? 'selected' : ''; ?>>7%
																</option>
																<option value="8%" <?php echo ($salary['employee_pf_rate'] == '8%') ? 'selected' : ''; ?>>8%
																</option>
																<option value="9%" <?php echo ($salary['employee_pf_rate'] == '9%') ? 'selected' : ''; ?>>9%
																</option>
																<option value="10%" <?php echo ($salary['employee_pf_rate'] == '10%') ? 'selected' : ''; ?>>
																	10%</option>
															</select>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="input-block mb-3">
															<label class="col-form-label">Employer PF rate </label>
															<select class="select" name="employer_pf_rate">
																<option <?php echo ($salary['employer_pf_rate'] == 'Select PF rate') ? 'selected' : ''; ?>>Select PF rate</option>
																<option value="0%" <?php echo ($salary['employer_pf_rate'] == '0%') ? 'selected' : ''; ?>>0%
																</option>
																<option value="1%" <?php echo ($salary['employer_pf_rate'] == '1%') ? 'selected' : ''; ?>>1%
																</option>
																<option value="2%" <?php echo ($salary['employer_pf_rate'] == '2%') ? 'selected' : ''; ?>>2%
																</option>
																<option value="3%" <?php echo ($salary['employer_pf_rate'] == '3%') ? 'selected' : ''; ?>>3%
																</option>
																<option value="4%" <?php echo ($salary['employer_pf_rate'] == '4%') ? 'selected' : ''; ?>>4%
																</option>
																<option value="5%" <?php echo ($salary['employer_pf_rate'] == '5%') ? 'selected' : ''; ?>>5%
																</option>
																<option value="6%" <?php echo ($salary['employer_pf_rate'] == '6%') ? 'selected' : ''; ?>>6%
																</option>
																<option value="7%" <?php echo ($salary['employer_pf_rate'] == '7%') ? 'selected' : ''; ?>>7%
																</option>
																<option value="8%" <?php echo ($salary['employer_pf_rate'] == '8%') ? 'selected' : ''; ?>>8%
																</option>
																<option value="9%" <?php echo ($salary['employer_pf_rate'] == '9%') ? 'selected' : ''; ?>>9%
																</option>
																<option value="10%" <?php echo ($salary['employer_pf_rate'] == '10%') ? 'selected' : ''; ?>>
																	10%</option>
															</select>
														</div>
													</div>
												</div>
												<hr>
												<h3 class="card-title"> ESI Information</h3>
												<div class="row">
													<div class="col-sm-4">
														<div class="input-block mb-3">
															<label class="col-form-label">ESI contribution</label>
															<select class="select" name="esi_contribution">
																<option <?php echo ($salary['esi_contribution'] == 'Select ESI contribution') ? 'selected' : ''; ?>>Select ESI contribution
																</option>
																<option value="Yes" <?php echo ($salary['esi_contribution'] == 'Yes') ? 'selected' : ''; ?>>
																	Yes</option>
																<option value="No" <?php echo ($salary['esi_contribution'] == 'No') ? 'selected' : ''; ?>>No
																</option>
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="input-block mb-3">
															<label class="col-form-label" for="esiNoContribution">ESI No. <span
																	class="text-danger">*</span></label>
															<select class="form-control" id="esiNoContribution"
																onchange="toggleESINoField()" name="esiNoContribution">
																<option <?php echo ($salary['esi'] == 'Select ESI contribution') ? 'selected' : ''; ?>>Select ESI contribution</option>
																<option value="yes" <?php echo ($salary['esi'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
																<option value="no" <?php echo ($salary['esi'] == 'no') ? 'selected' : ''; ?>>No</option>
															</select>
														</div>
													</div>

													<div class="col-sm-4" id="esiNoField"
														style="display: <?php echo ($salary['esi'] == 'yes') ? 'block' : 'none'; ?>">
														<div class="input-block mb-3">
															<label class="col-form-label" for="esiNoInput">ESI No.</label>
															<input type="text" class="form-control" id="esiNoInput"
																name="esiNoInput" value="<?php echo $salary['esi_no'] ?>">
														</div>
													</div>

													<script>
														function toggleESINoField() {
															var esiContributionSelect = document.getElementById("esiNoContribution");
															var esiNoField = document.getElementById("esiNoField");
															esiNoField.style.display = (esiContributionSelect.value === 'yes') ? 'block' : 'none';
														}
													</script>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<div class="input-block mb-3">
															<label class="col-form-label">Employee ESI rate</label>
															<select class="select" name="employee_esi_rate">
																<option <?php echo ($salary['employee_esi_rate'] == 'Select ESI rate') ? 'selected' : ''; ?>>Select ESI rate</option>
																<option <?php echo ($salary['employee_esi_rate'] == '0%') ? 'selected' : ''; ?>>0%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '1%') ? 'selected' : ''; ?>>1%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '2%') ? 'selected' : ''; ?>>2%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '3%') ? 'selected' : ''; ?>>3%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '4%') ? 'selected' : ''; ?>>4%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '5%') ? 'selected' : ''; ?>>5%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '6%') ? 'selected' : ''; ?>>6%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '7%') ? 'selected' : ''; ?>>7%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '8%') ? 'selected' : ''; ?>>8%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '9%') ? 'selected' : ''; ?>>9%</option>
																<option <?php echo ($salary['employee_esi_rate'] == '10%') ? 'selected' : ''; ?>>10%</option>
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="input-block mb-3">
															<label class="col-form-label">Employer ESI rate</label>
															<select class="select" name="employer_esi_rate">
																<option <?php echo ($salary['employer_esi_rate'] == 'Select ESI rate') ? 'selected' : ''; ?>>Select ESI rate</option>
																<option <?php echo ($salary['employer_esi_rate'] == '0%') ? 'selected' : ''; ?>>0%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '1%') ? 'selected' : ''; ?>>1%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '2%') ? 'selected' : ''; ?>>2%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '3%') ? 'selected' : ''; ?>>3%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '4%') ? 'selected' : ''; ?>>4%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '5%') ? 'selected' : ''; ?>>5%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '6%') ? 'selected' : ''; ?>>6%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '7%') ? 'selected' : ''; ?>>7%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '8%') ? 'selected' : ''; ?>>8%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '9%') ? 'selected' : ''; ?>>9%</option>
																<option <?php echo ($salary['employer_esi_rate'] == '10%') ? 'selected' : ''; ?>>10%</option>
															</select>
														</div>
													</div>
												</div>
												<div class="submit-section">
													<button class="btn btn-primary submit-btn" name="addSalary"
														type="submit">Save</button>
												</div>
										</form>
									</div>
								</div>
							</div>
							<?php }} else {?>
						<div class="tab-pane fade" id="bank_statutory">
							<div class="card">
								<div class="card-body">
									<h3 class="card-title"> Basic Salary Information</h3>
									<form method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-sm-4">
												<div class="input-block mb-3">
													<label class="col-form-label">Salary amount <small
															class="text-muted">per month</small></label>
													<div class="input-group">
														<span class="input-group-text">₹</span>
														<input type="text" class="form-control"
															placeholder="Type your salary amount" name="salary_amount">
														<input type="hidden" class="form-control" name="client_id"
															value="<?php echo $idd ?>">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="input-block mb-3">
													<label class="col-form-label">Payment type</label>
													<select class="select" name="payment_type">
														<option>Select payment type</option>
														<option>Bank transfer</option>
														<option>Check</option>
														<option>Cash</option>
													</select>
												</div>
											</div>

										</div>
										<hr>
										<h3 class="card-title"> PF Information</h3>
										<div class="row">
											<div class="col-sm-4">
												<div class="input-block mb-3">
													<label class="col-form-label">PF contribution</label>
													<select class="select" name="pf_contribution">
														<option>Select PF contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="input-block mb-3">
													<label class="col-form-label" for="pfNoContribution">PF No.</label>
													<select class="form-control" id="pfNoContribution"
														onchange="togglePFNoField()" name="pfNoContribution">
														<option>Select PF contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>

											<div class="col-sm-4" id="pfNoField" style="display:block">
												<div class="input-block mb-3">
													<label class="col-form-label" for="pfNoInput">PF No.</label>
													<input type="text" class="form-control" id="pfNoInput" name="pfNoInput">
												</div>
											</div>

											<script>
												function togglePFNoField() {
													var pfContributionSelect = document.getElementById("pfNoContribution");
													var pfNoField = document.getElementById("pfNoField");
													pfNoField.style.display = (pfContributionSelect.value === 'Yes') ? 'block' : 'none';
												}
											</script>
											<div class="row">
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">Employee PF rate </label>
														<select class="select" name="employee_pf_rate">
															<option>Select PF rate</option>
															<option>0%</option>
															<option>1%</option>
															<option>2%</option>
															<option>3%</option>
															<option>4%</option>
															<option>5%</option>
															<option>6%</option>
															<option>7%</option>
															<option>8%</option>
															<option>9%</option>
															<option>10%</option>
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">Employer PF rate </label>
														<select class="select" name="employer_pf_rate">
															<option>Select PF rate</option>
															<option>0%</option>
															<option>1%</option>
															<option>2%</option>
															<option>3%</option>
															<option>4%</option>
															<option>5%</option>
															<option>6%</option>
															<option>7%</option>
															<option>8%</option>
															<option>9%</option>
															<option>10%</option>
														</select>
													</div>
												</div>

											</div>
											<hr>
											<h3 class="card-title"> ESI Information</h3>
											<div class="row">
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">ESI contribution</label>
														<select class="select" name="esi_contribution">
															<option>Select ESI contribution</option>
															<option>Yes</option>
															<option>No</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label" for="esiNoContribution">ESI No. <span
																class="text-danger">*</span></label>
														<select class="form-control" id="esiNoContribution"
															onchange="toggleESINoField()" name="esiNoContribution">
															<option>Select ESI contribution</option>
															<option>Yes</option>
															<option>No</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4" id="esiNoField" style="display:none">
													<div class="input-block mb-3">
														<label class="col-form-label" for="esiNoInput">ESI No.</label>
														<input type="text" class="form-control" id="esiNoInput"
															name="esiNoInput">
													</div>
												</div>
												<script>
													function toggleESINoField() {
														var esiContributionSelect = document.getElementById("esiNoContribution");
														var esiNoField = document.getElementById("esiNoField");
														esiNoField.style.display = (esiContributionSelect.value.toLowerCase() === 'yes') ? 'block' : 'none';
													}
												</script>
											</div>
											<div class="row">
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">Employee ESI rate</label>
														<select class="select" name="employee_esi_rate">
															<option>Select ESI rate</option>
															<option>0%</option>
															<option>1%</option>
															<option>2%</option>
															<option>3%</option>
															<option>4%</option>
															<option>5%</option>
															<option>6%</option>
															<option>7%</option>
															<option>8%</option>
															<option>9%</option>
															<option>10%</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-block mb-3">
														<label class="col-form-label">Employer ESI rate</label>
														<select class="select" name="employer_esi_rate">
															<option>Select ESI rate</option>
															<option>0%</option>
															<option>1%</option>
															<option>2%</option>
															<option>3%</option>
															<option>4%</option>
															<option>5%</option>
															<option>6%</option>
															<option>7%</option>
															<option>8%</option>
															<option>9%</option>
															<option>10%</option>
														</select>
													</div>
												</div>
											</div>
											<div class="submit-section">
												<button class="btn btn-primary submit-btn" name="addSalary"
													type="submit">Save</button>
											</div>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
				</div>
			</div>
			<div class="tab-pane fade" id="emp_assets">
						<div class="table-responsive table-newdatatable">
							<table class="table table-new custom-table mb-0 datatable">
								<thead>
									<tr>
										<th>Name</th>
										<th>Model No</th>
										<th>Warranty</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM assets";
									$result = mysqli_query($conn, $sql);
									while ($assets = mysqli_fetch_assoc($result)) {
										if ($assets['asset_user'] == $idd && $assets['status'] != 0) {?>
											<tr>									
												<td>
													<a class="table-imgname"><span><?php echo $assets['asset_name'] ?></span></a>
												</td>
												<td>
													<a class="table-imgname"><span><?php echo $assets['model'] ?></span></a>
												</td>
												<td>
													<a class="table-imgname"><span><?php echo $assets['warrenty'] ?></span></a>
												</td>
											</tr>
										<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
					
			<div id="profile_info" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Profile Information</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12">
										<div class="profile-img-wrap edit-img">
											<img class="inline-block" src="<?php echo $emp_sel['photo'] ?>"
												alt="User Image">
											<div class="fileupload btn">
												<span class="btn-text">edit</span>
												<input class="upload" type="file" name="image">
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">First Name</label>
													<input type="text" class="form-control" name="first_name"
														value="<?php echo $emp_sel['first_name'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Last Name</label>
													<input type="text" class="form-control" name="last_name"
														value="<?php echo $emp_sel['last_name'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Birth Date</label>
													<div class="cal-icon">
														<input class="form-control datetimepicker"
															value="<?php echo $emp_sel['birth_date'] ?>"
															name="birth_date" type="text" />
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Gender</label>
													<select class="select form-control" name="gender">
														<option value="male" <?php echo ($emp_sel['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
														<option value="female" <?php echo ($emp_sel['gender'] === 'female') ? 'selected' : ''; ?>>Female
														</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="input-block mb-3">
											<label class="col-form-label">Address</label>
											<input type="text" class="form-control" name="address"
												value="<?php echo $emp_sel['address'] ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Phone Number</label>
											<input type="text" class="form-control" name="phone"
												value="<?php echo $emp_sel['phone'] ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Department <span
													class="text-danger">*</span></label>
											<select class="select" name="department">
												<?php foreach($department as $dept) { ?>
													<option value="<?php echo $dept['id'];?>" <?php echo ($emp_sel['department'][0]['id'] == $dept['id']) ? 'selected' : ''; ?>><?php echo $dept['department_name'];?></option>
												<?php } ?>	
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Designation <span
													class="text-danger">*</span></label>
											<select class="select" name="designation">			
												<?php foreach($designation as $des) { ?>
													<option value="<?php echo $des['id'];?>" <?php echo ($emp_sel['designation'][0]['id'] == $des['id']) ? 'selected' : ''; ?>><?php echo $des['designation'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" type="submit"
										name="updateProfile">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="bank_details" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Bank Information</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Bank Name</label>
											<input type="text" class="form-control"
												value="<?php echo $emp_sel['bank_name'] ?>" name="bank_name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Bank Account No</label>
											<input class="form-control" value="<?php echo $emp_sel['account_no'] ?>"
												type="text" name="account_no">
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">IFSC Code</label>
											<input class="form-control" value="<?php echo $emp_sel['ifsc_code'] ?>"
												type="text" name="ifsc">
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">PAN No</label>
											<input class="form-control" value="<?php echo $emp_sel['pan_no'] ?>"
												type="text" name="pan">
										</div>
									</div>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" name="updateBank"
										type="submit">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$query_project = "SELECT * FROM projects";
		$result_query = mysqli_query($conn, $query_project);
		while ($project = mysqli_fetch_assoc($result_query)) {
			?>
			<div id="edit_project<?php echo $project['id']; ?>" class="modal custom-modal fade" role="dialog">
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
											<input class="form-control" value="<?php echo $project['project_name']; ?>"
												type="text" name="project_name">
											<input class="form-control" value="<?php echo $project['id']; ?>" type="hidden"
												name="project_id">
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
												<input class="form-control datetimepicker"
													value="<?php echo $project['start_date']; ?>" type="text"
													name="start_date">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">End Date</label>
											<div class="cal-icon">
												<input class="form-control datetimepicker"
													value="<?php echo $project['end_date']; ?>" type="text" name="end_date">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="input-block mb-3">
											<label class="col-form-label">Rate</label>
											<input placeholder="$50" class="form-control" type="text"
												value="<?php echo $project['rate_value']; ?>" name="rate">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="input-block mb-3">
											<label class="col-form-label">&nbsp;</label>
											<select class="select" name="rate_type">
												<option <?php echo ($project['rate_type'] == 'Hourly') ? 'selected' : ''; ?>>
													Hourly</option>
												<option <?php echo ($project['rate_type'] == 'Fixed') ? 'selected' : ''; ?>>
													Fixed</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Priority</label>
											<select class="select" name="priority">
												<option <?php echo ($project['priority'] == 'High') ? 'selected' : ''; ?>>High
												</option>
												<option <?php echo ($project['priority'] == 'Medium') ? 'selected' : ''; ?>>
													Medium</option>
												<option <?php echo ($project['priority'] == 'Low') ? 'selected' : ''; ?>>Low
												</option>
											</select>
										</div>
									</div>

									<div class="col-sm-6">
										<label class="focus-label">Add Project Leader</label>
										<select class="choices-multiple-remove-button" name="team_leader[]"
											placeholder="--Select--" id="country" required multiple>
											<?php
											$query_emp = "SELECT * FROM employees";
											$result_emp = mysqli_query($conn, $query_emp);
											while ($emp = mysqli_fetch_assoc($result_emp)) {
												if ($emp['status'] != 0) {
													$emp_id = $emp['id'];
													$label_emp = $emp['first_name'];
													$isLeader = false;
													$decodedLeaders = json_decode($project['project_leader'], true);
													if (is_array($decodedLeaders)) {
														foreach ($decodedLeaders as $leader) {
															if ($leader['id'] == $emp_id) {
																$isLeader = true;
																break;
															}}}
													echo "<option value='$emp_id'";
													if ($isLeader) {
														echo " selected";
													}
													echo ">$label_emp</option>";
												}}?>
										</select>
									</div>
									<div class="col-sm-6">
										<label class="focus-label">Add team</label>
										<select class="choices-multiple-remove-button" name="team_member[]"
											placeholder="--Select--" id="country" required multiple>
											<?php
											$query_emp = "SELECT * FROM employees";
											$result_emp = mysqli_query($conn, $query_emp);
											while ($emp = mysqli_fetch_assoc($result_emp)) {
												if ($emp['status'] != 0) {
													$emp_id = $emp['id'];
													$label_emp = $emp['first_name'];	
													$isTeamMember = false;
													$decodedTeamMembers = json_decode($project['team_member'], true);
													if (is_array($decodedTeamMembers)) {
														foreach ($decodedTeamMembers as $teamMember) {
															if ($teamMember['id'] == $emp_id) {
																$isTeamMember = true;
																break;
															}}}
													echo "<option value='$emp_id'";
													if ($isTeamMember) {
														echo " selected";
													}
													echo ">$label_emp</option>";
												}}?>
										</select>
									</div>
								</div>
								<div class="row">
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
									<textarea rows="3" class="form-control" placeholder="Enter Project description"
										name="description"><?php echo $project['description']; ?></textarea>
								</div>
								<div class="input-block mb-3">
									<label class="col-form-label">Upload Files</label>
									<input class="form-control" type="file" name="image">
									<?php if (!empty($project['project_document'])): ?>
										<p>Previous File:
											<?php echo $project['project_document']; ?>
										</p>
									<?php endif; ?>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" type="submit"
										name="updateProject">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>

	<?php include './includes/footer.php' ?>
	<script>
		$(document).ready(function () {
			var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
				removeItemButton: true,
			});
		});
	</script>
	<?php
	if (isset($_POST['updateProject'])) {
		$projectId = $_POST['project_id'];
		$project_name = $_POST["project_name"];
		$client_name = $_POST["client"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$rate = $_POST["rate"];
		$rate_type = $_POST["rate_type"];
		$priority = $_POST["priority"];
		$categories = $_POST["categories"];
		$description = $_POST["description"];
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
		if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/';
			$filename = basename($_FILES['image']['name']);
			$destination = $uploadDir . $filename;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
				echo "Image uploaded successfully.";
				$filePath = mysqli_real_escape_string($conn, $destination);
				$updateQuery = "UPDATE projects SET project_name='$project_name',client_id='$client_name',start_date='$start_date',end_date='$end_date',rate_value='$rate',rate_type='$rate_type',priority='$priority',project_leader='$jsonLeaderMembers',team_member='$jsonTeamMembers',project_category='$categories',description='$description',project_document='$filePath',update_at='$update_time' WHERE id = '$projectId'";
				if (mysqli_query($conn, $updateQuery)) {
					?>
					<script>
						toastr.success('Project Update Successfully!');
						setTimeout(function () {
							<?php
							echo "window.location.href = 'profile.php?idd=" . $idd . "'";
							?>
						}, 1000);
					</script>
					<?php
				} else {
					?>
					<script>
						toastr.error('Error !');
						setTimeout(function () {
							<?php
							echo "window.location.href = 'profile.php?idd=" . $idd . "'";
							?>
						}, 1000);
					</script>
					<?php
				}
			}
		} else {
			$updateQuery = "UPDATE projects SET project_name='$project_name',client_id='$client_name',start_date='$start_date',end_date='$end_date',rate_value='$rate',rate_type='$rate_type',priority='$priority',project_leader='$jsonLeaderMembers',team_member='$jsonTeamMembers',project_category='$categories',description='$description',update_at='$update_time'WHERE id = " . $projectId;
			if (mysqli_query($conn, $updateQuery)) {
				?>
				<script>
					toastr.success('Project Update Successfully!');
					setTimeout(function () {
						<?php
						echo "window.location.href = 'profile.php?idd=" . $idd . "'";
						?>
					}, 1000);
				</script>
				<?php

			} else {
				?>
				<script>
					toastr.error('Error !');
					setTimeout(function () {
						<?php
						echo "window.location.href = 'profile.php?idd=" . $idd . "'";
						?>
					}, 1000);
				</script>
				<?php
			}
		}
	}

	if (isset($_GET['deleteid'])) {
		$id = $_GET['deleteid'];
		$delete_query = "SELECT COUNT(*) FROM projects WHERE id=" . $id;
		$deleteResult = mysqli_query($conn, $delete_query);

		if ($deleteResult) {
			$deleteCount = mysqli_fetch_assoc($deleteResult)['COUNT(*)'];
			var_dump($deleteCount);

			if ($deleteCount < 0) {
				// Project is booked, show a SweetAlert message
				echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
				echo '<script>';
				echo 'Swal.fire({
                title: "Cannot Delete",
                text: "This customer is token paid aginst project and cannot be deleted!",
                icon: "error",
                confirmButtonText: "OK",
            }).then(() => {
                
            });';
				echo '</script>';
				exit; // Stop further execution//window.location.href = "departments.php";
			} else {
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
						window.location.href = "profile.php?id=' . $id . '";
					} else {
						window.location.href = "profile.php";
					}
				});';
				echo '</script>';
			}
		}
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM projects WHERE id=" . $id;
		$result = mysqli_query($conn, $sql);

		if ($result) {
			echo "<script>window.location.href = 'profile.php" . $idd . "'</script>";
		} else {
			die(mysqli_error($con));
		}
	}

	if (isset($_POST['updateProfile'])) {
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$birthdate = $_POST["birth_date"];
		$gender = $_POST["gender"];
		$address =preg_replace("/'/", "\'", $_POST["address"]);
		$phone = $_POST["phone"];
		$department = $_POST["department"];
		$designation = $_POST["designation"];
		$update_time = date('Y-m-d H:i:s');
		if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/';
			$filename = basename($_FILES['image']['name']);
			$destination = $uploadDir . $filename;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
				echo "Image uploaded successfully.";
				$filePath = mysqli_real_escape_string($conn, $destination);
				$query = "UPDATE employees  SET first_name = '$first_name',last_name='$last_name',birth_date='$birthdate',gender='$gender',address='$address',phone='$phone',department='$department',designation='$designation',photo='$filePath',updated_at ='$update_time' WHERE id = " . $idd;
				if (mysqli_query($conn, $query)) {
					echo "<script>";
					echo "window.location.href = 'profile.php?idd=" . $idd . "'";
					echo "</script>";
				} else {
					die(mysqli_error($con));
				}
			}
		} else {
			$query = "UPDATE employees  SET first_name = '$first_name',last_name='$last_name',birth_date='$birthdate',gender='$gender',address='$address',phone='$phone',department='$department',designation='$designation',updated_at ='$update_time' WHERE id = " . $idd;
			if (mysqli_query($conn, $query)) {
				echo "<script>";
				echo "window.location.href = 'profile.php?idd=" . $idd . "'";
				echo "</script>";
			} else {
				die(mysqli_error($con));
			}
		}
	}

	if (isset($_POST['updateBank'])) {
		$bankName = $_POST["bank_name"];
		$accountNo = $_POST["account_no"];
		$ifsc_code = $_POST["ifsc"];
		$pan_no = $_POST["pan"];
		$update_time = date('Y-m-d H:i:s');
		$query = "UPDATE employees  SET bank_name = '$bankName',account_no='$accountNo',ifsc_code='$ifsc_code',pan_no='$pan_no',updated_at ='$update_time' WHERE id = " . $idd;
		if (mysqli_query($conn, $query)) {
			echo "<script>";
			echo "window.location.href = 'profile.php?idd=" . $idd . "'";
			echo "</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}
	}

	if (isset($_POST['addSalary'])) {
		$salary_id = $_POST['salary_id'];
		$salary_amount = $_POST["salary_amount"];
		$client_id = $_POST["client_id"];
		$payment_type = $_POST["payment_type"];
		$pf_contribution = $_POST["pf_contribution"];
		$pf = $_POST["pfNoContribution"];
		$pf_no = $_POST["pfNoInput"];
		$employee_pf_rate = $_POST["employee_pf_rate"];
		$employer_pf_rate = $_POST["employer_pf_rate"];
		$esi_contribution = $_POST["esi_contribution"];
		$esi = $_POST["esiNoContribution"];
		$esi_no = $_POST["esiNoInput"];
		$employee_esi_rate = $_POST["employee_esi_rate"];
		$employer_esi_rate = $_POST["employer_esi_rate"];
		$created_time = date('Y-m-d H:i:s');
	
		if (!empty($salary_id)) {
			$update_time = date('Y-m-d H:i:s');
			$sql = "UPDATE emp_salary SET client_id = '$client_id',salary_amount = '$salary_amount', payment_type = '$payment_type',pf_contribution = '$pf_contribution', pf = '$pf', pf_no = '$pf_no', employee_pf_rate = '$employee_pf_rate', employer_pf_rate = '$employer_pf_rate', esi_contribution = '$esi_contribution',esi = '$esi',esi_no = '$esi_no', employee_esi_rate = '$employee_esi_rate',employer_esi_rate = '$employer_esi_rate',update_at = '$update_time' WHERE id = '$salary_id'";

		} else {
			$sql = "INSERT INTO emp_salary (client_id, salary_amount, payment_type, pf_contribution, pf, pf_no, 
                    employee_pf_rate, employer_pf_rate, esi_contribution, esi, esi_no, 
                    employee_esi_rate, employer_esi_rate, created_at) 
                VALUES ('$client_id', '$salary_amount', '$payment_type', '$pf_contribution', '$pf', '$pf_no', 
                        '$employee_pf_rate', '$employer_pf_rate', '$esi_contribution', '$esi', '$esi_no', 
                        '$employee_esi_rate', '$employer_esi_rate', '$created_time')";
		}
		if ($conn->query($sql) === TRUE) {
			echo "<script>";
			echo "window.location.href = 'profile.php?idd=" . $idd . "'";
			echo "</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	?>
</body>

</html>