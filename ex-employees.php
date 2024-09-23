<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getemployee = getAllExemployee();
// echo "<pre>";
// print_r($getemployee);
// echo "</pre>";
// exit;
$designation = getAllDesignation();
$department = getAllDepartment();
if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.img{
		margin: 5px;
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
						<div class="col-auto float-end ms-auto">
							<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table datatable">
								<thead>
									<tr>
										<th>Name</th>
										<th>Department</th>
										<th>Designation</th>
										<th>Join Date</th>
										<th>Role</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($getemployee as $employee) { ?>
										<tr>
											<td>
												<h2 class='table-avatar'>
													<a href='profile.php?idd=<?php echo $employee['id'] ?>' class='avatar'><img src='<?php echo $employee['photo'] ?>' alt='User Image'></a>
													<a href='profile.php?idd=<?php echo $employee['id'] ?>'><?php echo $employee['first_name'] ?></a>
												</h2>
											</td>
											<td><?php echo $employee['dep'][0]['department_name'] ?></td>
											<td><?php echo $employee['des'][0]['designation'] ?></td>
											<td><?php echo $employee['joining_date'] ?></td>
											<td><?php echo $employee['employee_type'] ?></td>
											<td class='text-end'>
												<div class='dropdown dropdown-action'>
													<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
													<div class='dropdown-menu dropdown-menu-right'>
														<a class='dropdown-item' href='profile.php?idd=<?php echo $employee['id'] ?>'><i class='fa-regular fa-eye m-r-5'></i> View</a>
														<!-- <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_employee<?php echo $employee['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a> -->
														<a class='dropdown-item' href='ex-employees.php?exemployee=<?php echo $employee['id'] ?>'><i class='fa-solid fa-arrow-right-from-bracket m-r-5'></i> Activate Employee</a>
														<a class='dropdown-item' href='ex-employees.php?deleteid=<?php echo $employee['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
									<?php }  ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="add_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Employee</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="first_name">First Name <span class="text-danger">*</span></label>
											<input class="form-control" name="first_name" type="text" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="last_name">Last Name</label>
											<input class="form-control" type="text" name="last_name">
										</div>
									</div>

									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="mail">Email <span class="text-danger">*</span></label>
											<input class="form-control" type="email" name="mail" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="password">Password</label>
											<input class="form-control" type="text" name="password" required>
										</div>
									</div>


									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="joining_date">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="joining_date"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="phone">Phone </label>
											<input class="form-control" type="text" name="phone" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="department">Department <span class="text-danger">*</span></label>
											<select class="select" name="department">
												<?php foreach ($department as $dep) { ?>
													<option value="<?php echo $dep['id'] ?>"><?php echo $dep['department_name'] ?></option>
												<?php  } ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="designation">Designation <span class="text-danger">*</span></label>
											<select class="select" name="designation">
												<?php foreach ($designation as $des) { ?>
													<option value="<?php echo $des['id'] ?>"><?php echo $des['designation'] ?></option>
												<?php  } ?>
											</select>
										</div>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Upload Photo</label>
										<input class="form-control" type="file" accept="image/*" name="fimages">
									</div>
									<div class="col-md-12">
										<div class="input-block mb-3">
											<label class="col-form-label" for="department">Role <span class="text-danger">*</span></label>
											<select class="select" name="employee_type">
												<option>Select Role</option>
												<option>Admin</option>
												<option>HR</option>
												<option>Employee</option>
											</select>
										</div>
									</div>

									<h4 class="mt-3">Reference</h4>
									<div class="row ps-4">
										<div class="col-md-6">
											<label class="col-form-label">Hired from</label>
											<select name="reference" class="select" id="">
												<option value="" selected disabled>Select Option</option>
												<option value="linkedin">linkedin</option>
												<option value="Naukri">Naukri</option>
												<option value="WebSites_Career">WebSites Career</option>
												<option value="Email">Email</option>
												<option value="Candidate_reference">Candidate reference</option>
												<option value="Employee_reference">Employee reference</option>
											</select>
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Family Name</label>
											<input class="form-control" type="text" name="family_name">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Family Contact</label>
											<input class="form-control" type="tel" name="family_contact">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Family Relation</label>
											<select name="family_relation" class="select" id="">
												<option value="" selected disabled>Select Option</option>
												<option value="father">Father</option>
												<option value="mother">Mother</option>
												<option value="brother">Brother</option>
												<option value="sister">Sister</option>
												<option value="spouse">Spouse</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 mt-4">
										<label class="col-form-label">Previous Organisation</label>
										<input class="form-control mb-3" type="text" name="previous_org">
									</div>

									<h4 class="mt-3">Background Verification</h4>
									<div class="row ps-4">
										<div class="col-md-6">
											<label class="col-form-label">Name</label>
											<input class="form-control" type="text" name="verify_name">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Contact Number</label>
											<input class="form-control" type="text" name="verify_contact">
										</div>
										<div class="col-md-6 mb-3">
											<label class="col-form-label">Relation</label>
											<select name="verify_relation" class="select" id="">
												<option value="" selected disabled>Select Option</option>
												<option value="teacher">Teacher</option>
												<option value="past_employer">Past Employer</option>
											</select>
										</div>
									</div>

									<h4 class="mt-3">Upload Document</h4>
									<div class="row ps-4">
										<div class="col-md-6">
											<label class="col-form-label">Aadhaar</label>
											<input class="form-control" accept="image/*,.pdf" type="file" name="aadhaar">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">PAN</label>
											<input class="form-control" accept="image/*,.pdf" type="file" name="pan">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Passing Certificate</label>
											<input class="form-control" accept="image/*,.pdf" type="file" name="pass_cert">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Experience Certificate</label>
											<input class="form-control" accept="image/*,.pdf" type="file" multiple name="exp_cert[]">
										</div>
										<div class="col-md-6">
											<label class="col-form-label">Extra Certificate</label>
											<input class="form-control" type="file" name="extra_cert">
										</div>
									</div>

									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php foreach ($getemployee as $row3) { ?>
			<div id="edit_employee<?php echo $row3['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Employee</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control" value="<?php echo $row3['first_name']; ?>" type="text" name="first_name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Last Name</label>
											<input class="form-control" value="<?php echo $row3['last_name']; ?>" type="text" name="last_name">
										</div>
									</div>

									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" value="<?php echo $row3['mail']; ?>" type="email" name="mail">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Password</label>
											<input class="form-control" value="<?php echo $row3['password']; ?>" type="text" name="password">
										</div>
									</div>


									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input class="form-control datetimepicker" name="joining_date" type="text" value="<?php echo $row3['joining_date']; ?>"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Phone </label>
											<input class="form-control" value="<?php echo $row3['phone']; ?>" type="text" name="phone">
										</div>
									</div>
									<input type="hidden" name="id" id="textField" value="<?php echo $row3['id']; ?>" required="required">

									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Department <span class="text-danger">*</span></label>
											<select class="select" name="department">
												<?php foreach ($department as $dept) { ?>
													<option value="<?php echo $dept['id']; ?>" <?php echo ($row3['department'] == $dept['id']) ? 'selected' : ''; ?>><?php echo $dept['department_name']; ?></option>
												<?php } ?>
											</select>

										</div>
									</div>

									<div class="col-md-6">
										<div class="input-block mb-3">
											<label class="col-form-label">Designation <span class="text-danger">*</span></label>
											<select class="select" name="designation">
												<?php foreach ($designation as $des) { ?>
													<option value="<?php echo $des['id']; ?>" <?php echo ($row3['designation'] == $des['id']) ? 'selected' : ''; ?>><?php echo $des['designation']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="input-block mb-3">
									<label class="col-form-label">Upload Photo</label>
									<input type="file" accept="image/*" class="form-control" name="fimages" />
									<input type="hidden" name="previous_image" value="<?php echo $row3['photo']; ?>">
									<?php if (!$row3) {
										echo "No image found for ID ".$row3['id'];
									} else {
										echo '<img src="' . $row3['photo'] . '" style="height:50px;">';
									} ?>
								</div>

								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label" for="department">Role <span class="text-danger">*</span></label>
										<select class="select" name="employee_type">
											<option <?php echo ($row3['employee_type'] == 'Select Role') ? 'selected' : ''; ?>>Select Role</option>
											<option <?php echo ($row3['employee_type'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
											<option <?php echo ($row3['employee_type'] == 'HR') ? 'selected' : ''; ?>>HR</option>
											<option <?php echo ($row3['employee_type'] == 'Employee') ? 'selected' : ''; ?>>Employee</option>
										</select>
									</div>
								</div>
<br>
								<h4 class="mt-3">Reference</h4>
								<div class="row ps-4">
									<div class="col-md-6">
										<label class="col-form-label">Hired from</label>
										<select name="reference" class="select" id="">
											<option value="" selected disabled>Select Option</option>
											<option <?= $row3['reference'] == 'linkedin'? 'Selected': ''; ?> value="linkedin">linkedin</option>
											<option <?= $row3['reference'] == 'Naukri'? 'Selected': ''; ?> value="Naukri">Naukri</option>
											<option <?= $row3['reference'] == 'WebSites_Career'? 'Selected': ''; ?> value="WebSites_Career">WebSites Career</option>
											<option <?= $row3['reference'] == 'Email'? 'Selected': ''; ?> value="Email">Email</option>
											<option <?= $row3['reference'] == 'Candidate_reference'? 'Selected': ''; ?> value="Candidate_reference">Candidate reference</option>
											<option <?= $row3['reference'] == 'Employee_reference'? 'Selected': ''; ?> value="Employee_reference">Employee reference</option>
										</select>
									</div>
									<div class="col-md-6">
										<label class="col-form-label">Family Name</label>
										<input class="form-control" type="text" value="<?php echo $row3['family_name']; ?>" name="family_name">
									</div>
									<div class="col-md-6">
										<label class="col-form-label">Family Contact</label>
										<input class="form-control" type="tel" value="<?php echo $row3['family_contact']; ?>" name="family_contact">
									</div>
									<div class="col-md-6">
										<label class="col-form-label">Family Relation</label>
										<select name="family_relation" class="select" id="">
											<option value="" selected disabled>Select Option</option>
											<option <?= $row3['family_relation'] == 'father'? 'Selected': ''; ?> value="father">Father</option>
											<option <?= $row3['family_relation'] == 'mother'? 'Selected': ''; ?> value="mother">Mother</option>
											<option <?= $row3['family_relation'] == 'brother'? 'Selected': ''; ?> value="brother">Brother</option>
											<option <?= $row3['family_relation'] == 'sister'? 'Selected': ''; ?> value="sister">Sister</option>
											<option <?= $row3['family_relation'] == 'spouse'? 'Selected': ''; ?> value="spouse">Spouse</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 mt-4">
									<label class="col-form-label">Previous Organisation</label>
									<input class="form-control mb-3" type="text" value="<?php echo $row3['previous_org']; ?>" name="previous_org">
								</div>

								<h4 class="mt-3">Background Verification</h4>
								<div class="row ps-4">
									<div class="col-md-6">
										<label class="col-form-label">Name</label>
										<input class="form-control" type="text" value="<?php echo $row3['verify_name']; ?>" name="verify_name">
									</div>
									<div class="col-md-6">
										<label class="col-form-label">Contact Number</label>
										<input class="form-control" type="text" value="<?php echo $row3['verify_contact']; ?>" name="verify_contact">
									</div>
									<div class="col-md-6 mb-3">
										<label class="col-form-label">Relation</label>
										<select name="verify_relation" class="select" id="">
											<option value="" selected disabled>Select Option</option>
											<option <?= $row3['verify_relation'] == 'teacher'? 'Selected': ''; ?> value="teacher">Teacher</option>
											<option <?= $row3['verify_relation'] == 'past_employer'? 'Selected': ''; ?> value="past_employer">Past Employer</option>
										</select>
									</div>
								</div>

								<h4 class="mt-3">Upload Document</h4>
								<div class="row ps-4">
									<div class="col-md-6">
										<label class="col-form-label">Aadhaar</label>
										<input class="form-control" accept="image/*,.pdf" type="file" name="aadhaar">
										<input type="hidden" name="previous_aadhaar" value="<?php echo $row3['aadhaar']; ?>">
										<?php 
										$aadhaar = isset($row3['aadhaar'])? $row3['aadhaar']: '';
										$extension1 = pathinfo($aadhaar, PATHINFO_EXTENSION);
										if($extension1 == 'pdf'){
											echo '<iframe src="' . $row3['aadhaar'] . '" width="100%" height="180px"></iframe>';
										} elseif($extension1 == 'png'){
											echo '<img class="img" src="' . $row3['aadhaar'] . '" style="height:50px;">';
										} else{
											echo "No image found for ID ".$row3['id'];
										}
										?>
									</div>

									<div class="col-md-6">
										<label class="col-form-label">PAN</label>
										<input class="form-control" accept="image/*,.pdf" type="file" name="pan">
										<input type="hidden" name="previous_pan" value="<?php echo $row3['pan']; ?>">
										<?php 
										$pan = isset($row3['pan'])? $row3['pan']: '';
										$extension2 = pathinfo($pan, PATHINFO_EXTENSION);
										if($extension2 == 'pdf'){
											echo '<iframe src="' . $row3['pan'] . '" width="100%" height="180px"></iframe>';
										} elseif($extension2 == 'png'){
											echo '<img class="img" src="' . $row3['pan'] . '" style="height:50px;">';
										} else{
											echo "No image found for ID ".$row3['id'];
										}
										?>
									</div>

									<div class="col-md-6">
										<label class="col-form-label">Passing Certificate</label>
										<input class="form-control" accept="image/*,.pdf" type="file" name="pass_cert">
										<input type="hidden" name="previous_pass_cert" value="<?php echo $row3['pass_cert']; ?>">
										<?php 
										$pass_cert = isset($row3['pass_cert'])? $row3['pass_cert']: '';
										$extension3 = pathinfo($pass_cert, PATHINFO_EXTENSION);
										if($extension3 == 'pdf'){
											echo '<iframe src="' . $row3['pass_cert'] . '" width="100%" height="180px"></iframe>';
										} elseif($extension3 == 'png'){
											echo '<img class="img" src="' . $row3['pass_cert'] . '" style="height:50px;">';
										} else{
											echo "No image found for ID ".$row3['id'];
										}
										?>
									</div>

									<div class="col-md-6">
										<label class="col-form-label">Experience Certificate</label>
										<input class="form-control" accept="image/*,.pdf" type="file" multiple name="exp_cert[]">
										<input type="hidden" name="previous_exp_cert" value="<?php echo htmlspecialchars($row3['exp_cert']); ?>">
										<?php 
										$exp_certArray = $row3['exp_cert']? json_decode($row3['exp_cert'], true): array();
										// echo "<pre>";
										// var_dump($exp_certArray);
										// echo "<br";
										if(!empty($exp_certArray)){
											foreach ($exp_certArray as $img) {

												// echo $img.'<br>';
												$extension4 = pathinfo($img, PATHINFO_EXTENSION);
												if($extension4 == 'pdf'){
													echo '<iframe src="' . $img . '" width="100%" height="180px"></iframe>';
												} elseif($extension4 == 'png'){
													echo '<img class="img" src="' . $img . '" style="height:50px;">';
												} else{
													echo "No image found for ID ".$row3['id'];
												}
											}
										}
										?>
									</div>

									<div class="col-md-6">
										<label class="col-form-label">Extra Certificate</label>
										<input class="form-control" type="file" name="extra_cert">
										<input type="hidden" name="previous_extra_cert" value="<?php echo $row3['extra_cert']; ?>">
										<?php 
										$extra_cert = isset($row3['extra_cert'])? $row3['extra_cert']: '';
										$extension = pathinfo($extra_cert, PATHINFO_EXTENSION);
										if($extension == 'pdf'){
											echo '<iframe src="' . $row3['extra_cert'] . '" width="100%" height="180px"></iframe>';
										} elseif($extension == 'png'){
											echo '<img class="img" src="' . $row3['extra_cert'] . '" style="height:50px;">';
										} else{
											echo "No image found for ID ".$row3['id'];
										}
										?>
									</div>
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
	</div>
	<?php include './includes/footer.php' ?>
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
						window.location.href = "ex-employees.php?id=' . $id . '";
					} else {
						window.location.href = "ex-employees.php";
					}
				});';
			echo '</script>';
		}
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "UPDATE `employees` SET `status`= 5 WHERE id=" . $id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>window.location.href = 'ex-employees.php'</script>";
		} else {
			die(mysqli_error($con));
		}
	}
	if (isset($_GET['exemployee'])) {
		$ex_emp_id = $_GET['exemployee'];
		if ($ex_emp_id) {
			echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
			echo '<script>';
			echo 'Swal.fire({
					title: "Are you sure?",
					html: "You want to mark this employee as <b>Active</b>?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "No, cancel",
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "ex-employees.php?ex_emp_id=' . $ex_emp_id . '";
					} else {
						window.location.href = "ex-employees.php";
					}
				});';
			echo '</script>';
		}
	}

	if (isset($_GET['ex_emp_id'])) {
		$ex_emp_id = $_GET['ex_emp_id'];
		$sql = "UPDATE `employees` SET `status`= 1 WHERE id=" . $ex_emp_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>window.location.href = 'ex-employees.php'</script>";
		} else {
			die(mysqli_error($con));
		}
	}
	?>
</body>

</html>
<?php
if (isset($_POST['add'])) {
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$mail = $_POST["mail"];
	$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$joining_date = $_POST["joining_date"];
	$phone = $_POST["phone"];
	$department = $_POST["department"];
	$designation = $_POST["designation"];
	$employee_type = $_POST["employee_type"];

	$reference = $_POST["reference"];
	$family_name = mysqli_real_escape_string($conn, $_POST["family_name"]);
	$family_contact = mysqli_real_escape_string($conn, $_POST["family_contact"]);
	$family_relation = $_POST["family_relation"];
	$previous_org = mysqli_real_escape_string($conn, $_POST["previous_org"]);
	$verify_name = mysqli_real_escape_string($conn, $_POST["verify_name"]);
	$verify_contact = mysqli_real_escape_string($conn, $_POST["verify_contact"]);
	$verify_relation = $_POST["verify_relation"];

	$created_time = date('Y-m-d H:i:s');
	$token = bin2hex(random_bytes(16));


	$fimage = $_FILES['fimages']['name'];
	if ($fimage) {
		$fimage_temp = $_FILES['fimages']['tmp_name'];
		$filename = $first_name . '_' . time();
		$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
		$extension = pathinfo($fimage, PATHINFO_EXTENSION);
		$filename .= '.'.$extension;
		if (move_uploaded_file("$fimage_temp", "uploads/$filename")) {
			$fimagee = 'uploads/' . $filename;
		} else {
			var_dump("Not Upload");
		}
	}

	$aadhaar = $_FILES['aadhaar']['name'];
	if ($aadhaar) {
		$aadhaar_temp = $_FILES['aadhaar']['tmp_name'];
		$filename1 = $first_name . 'aadhaar' . '_' . time();
		$filename1 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename1);
		$extension1 = pathinfo($aadhaar, PATHINFO_EXTENSION);
		$filename1 .= ($extension1 == 'pdf')? '.'.$extension1 : '.png';
		if (move_uploaded_file("$aadhaar_temp", "uploads/employee/$filename1")) {
			$aadhaars = 'uploads/employee/' . $filename1;
		} else {
			var_dump("Not Upload");
		}
	}

	$pan = $_FILES['pan']['name'];
	if ($pan) {
		$pan_temp = $_FILES['pan']['tmp_name'];
		$filename2 = $first_name . 'pan' . '_' . time();
		$filename2 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename2);
		$extension2 = pathinfo($pan, PATHINFO_EXTENSION);
		$filename2 .= ($extension2 == 'pdf')? '.'.$extension2 : '.png';
		if (move_uploaded_file("$pan_temp", "uploads/employee/$filename2")) {
			$pans = 'uploads/employee/' . $filename2;
		} else {
			var_dump("Not Upload");
		}
	}

	$pass_cert = $_FILES['pass_cert']['name'];
	if ($pass_cert) {
		$pass_cert_temp = $_FILES['pass_cert']['tmp_name'];
		$filename3 = $first_name . 'pass_cert' . '_' . time();
		$filename3 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename3);
		$extension3 = pathinfo($pass_cert, PATHINFO_EXTENSION);
		$filename3 .= ($extension3 == 'pdf')? '.'.$extension3 : '.png';
		if (move_uploaded_file("$pass_cert_temp", "uploads/employee/$filename3")) {
			$pass_certs = 'uploads/employee/' . $filename3;
		} else {
			var_dump("Not Upload");
		}
	}

	$exp_certs = [];
	$exp_cert = $_FILES['exp_cert']['name'];
	$exp_cert_temp = $_FILES['exp_cert']['tmp_name'];
	if (!empty($exp_cert[0])) {
		for ($i = 0; $i < count($exp_cert); $i++) {
			$filename4 = $first_name . 'exp_cert' . '_' . time().'_' . $i;
			$filename4 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename4);
			$extension4 = pathinfo($exp_cert[$i], PATHINFO_EXTENSION);
			$filename4 .= ($extension4 == 'pdf')? '.'.$extension4 : '.png';

			if (move_uploaded_file($exp_cert_temp[$i], "uploads/employee/$filename4")) {
				$exp_certs[] = 'uploads/employee/' . $filename4;
			} else {
				var_dump("Not Upload");
			}
		}
	}

	$exp_certs = json_encode($exp_certs);

	$extra_cert = $_FILES['extra_cert']['name'];
	if ($extra_cert) {
		$extra_cert_temp = $_FILES['extra_cert']['tmp_name'];
		$filename5 = $first_name . 'extra_cert' . '_' . time();
		$filename5 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename5);
		$extension5 = pathinfo($extra_cert, PATHINFO_EXTENSION);
		$filename5 .= '.'.$extension5;
		if (move_uploaded_file("$extra_cert_temp", "uploads/employee/$filename5")) {
			$extra_certs = 'uploads/employee/' . $filename5;
		} else {
			var_dump("Not Upload");
		}
	}

	$sql = "INSERT INTO employees (first_name, last_name, mail, password,emp_token,joining_date, phone, department, designation,photo,employee_type, reference, family_name, family_contact, family_relation, previous_org, verify_name, verify_contact, verify_relation, aadhaar, pan, pass_cert, exp_cert, extra_cert, created_at, updated_at) VALUES ('$first_name', '$last_name', '$mail', '$hashed_password','$token','$joining_date','$phone', '$department', '$designation', '$fimagee','$employee_type', '$reference', '$family_name', '$family_contact', '$family_relation', '$previous_org', '$verify_name', '$verify_contact', '$verify_relation', '$aadhaars', '$pans', '$pass_certs', '$exp_certs', '$extra_certs', '$created_time', '$created_time')";

	// var_dump($exp_certs);
	// echo '<br>';
	// var_dump($sql);
	// die();
	$iquery = mysqli_query($conn, $sql);
	if ($iquery) {
?>
		<script>
			toastr.success('Added Successfully!');
			setTimeout(function() {
				window.location = "ex-employees.php";
			}, 1000);
		</script>
	<?php
	} else {
	?>
		<script>
			toastr.error('Error!');
			setTimeout(function() {
				window.location = "ex-employees.php";
			}, 1000);
		</script>
	<?php
	}
}


if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$mail = $_POST["mail"];
	$password = $_POST["password"];
	$joining_date = $_POST["joining_date"];
	$phone = $_POST["phone"];
	$department = $_POST["department"];
	$designation = $_POST["designation"];
	$employee_type = $_POST["employee_type"];

	$reference = $_POST["reference"];
	$family_name = mysqli_real_escape_string($conn, $_POST["family_name"]);
	$family_contact = mysqli_real_escape_string($conn, $_POST["family_contact"]);
	$family_relation = $_POST["family_relation"];
	$previous_org = mysqli_real_escape_string($conn, $_POST["previous_org"]);
	$verify_name = mysqli_real_escape_string($conn, $_POST["verify_name"]);
	$verify_contact = mysqli_real_escape_string($conn, $_POST["verify_contact"]);
	$verify_relation = $_POST["verify_relation"];

	$update_time = date('Y-m-d H:i:s');

	$fimage = $_FILES['fimages']['name'];
	if ($fimage) {
		$fimage_temp = $_FILES['fimages']['tmp_name'];
		$filename = $first_name . '_' . time();
		$filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
		$filename .= '.png';

		if (move_uploaded_file("$fimage_temp", "uploads/$filename")) {
			$fimagee = 'uploads/' . $filename;
		} else {
			var_dump("Not Upload");
		}
	} else {
		$fimagee = $_POST['previous_image'];
	}

	
	$aadhaar = $_FILES['aadhaar']['name'];
	if ($aadhaar) {
		$aadhaar_temp = $_FILES['aadhaar']['tmp_name'];
		$filename1 = $first_name . 'aadhaar' . '_' . time();
		$filename1 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename1);
		$extension1 = pathinfo($aadhaar, PATHINFO_EXTENSION);
		($extension1 == 'pdf')? $filename1 .= '.'.$extension1 : $filename1 .= '.png';
		if (move_uploaded_file("$aadhaar_temp", "uploads/employee/$filename1")) {
			$aadhaars = 'uploads/employee/' . $filename1;
		} else {
			var_dump("Not Upload");
		}
	} else {
		$aadhaars = $_POST['previous_aadhaar'];
	}

	$pan = $_FILES['pan']['name'];
	if ($pan) {
		$pan_temp = $_FILES['pan']['tmp_name'];
		$filename2 = $first_name . 'pan' . '_' . time();
		$filename2 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename2);
		$extension2 = pathinfo($pan, PATHINFO_EXTENSION);
		($extension2 == 'pdf')? $filename2 .= '.'.$extension2 : $filename2 .= '.png';
		if (move_uploaded_file("$pan_temp", "uploads/employee/$filename2")) {
			$pans = 'uploads/employee/' . $filename2;
		} else {
			var_dump("Not Upload");
		}
	} else {
		$pans = $_POST['previous_pan'];
	}

	$pass_cert = $_FILES['pass_cert']['name'];
	if ($pass_cert) {
		$pass_cert_temp = $_FILES['pass_cert']['tmp_name'];
		$filename3 = $first_name . 'pass_cert' . '_' . time();
		$filename3 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename3);
		$extension3 = pathinfo($pass_cert, PATHINFO_EXTENSION);
		($extension3 == 'pdf')? $filename3 .= '.'.$extension3 : $filename3 .= '.png';
		if (move_uploaded_file("$pass_cert_temp", "uploads/employee/$filename3")) {
			$pass_certs = 'uploads/employee/' . $filename3;
		} else {
			var_dump("Not Upload");
		}
	} else {
		$pass_certs = $_POST['previous_pass_cert'];
	}

	$exp_certs = [];
	$exp_cert = $_FILES['exp_cert']['name'];
	$exp_cert_temp = $_FILES['exp_cert']['tmp_name'];
	if (!empty($exp_cert[0])) {
		for ($i = 0; $i < count($exp_cert); $i++) {
			$filename4 = $first_name . 'exp_cert' . '_' . time(). '_' . $i;
			$filename4 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename4);
			$extension4 = pathinfo($exp_cert[$i], PATHINFO_EXTENSION);
			$filename4 .= ($extension4 == 'pdf')? '.'.$extension4 : '.png';

			if (move_uploaded_file($exp_cert_temp[$i], "uploads/employee/$filename4")) {
				$exp_certs[] = 'uploads/employee/' . $filename4;
			} else {
				var_dump("Not Upload");
			}
		}
		if(isset($_POST['previous_exp_cert'])){
			$previmg = json_decode($_POST['previous_exp_cert'], true);
			$exp_certs = array_merge($previmg, $exp_certs);
		}
	} else {
		$exp_certs = json_decode($_POST['previous_exp_cert'], true);
	}

	$exp_certs = json_encode($exp_certs);

	$extra_cert = $_FILES['extra_cert']['name'];
	if ($extra_cert) {
		$extra_cert_temp = $_FILES['extra_cert']['tmp_name'];
		$filename5 = $first_name . 'extra_cert' . '_' . time();
		$filename5 = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename5);
		$extension5 = pathinfo($extra_cert, PATHINFO_EXTENSION);
		$filename5 .= '.'.$extension5;
		if (move_uploaded_file("$extra_cert_temp", "uploads/employee/$filename5")) {
			$extra_certs = 'uploads/employee/' . $filename5;
		} else {
			var_dump("Not Upload");
		}
	} else {
		$extra_certs = $_POST['previous_extra_cert'];
	}
	
	$query = "UPDATE employees  SET first_name = '$first_name',last_name='$last_name',mail='$mail',password='$password',joining_date='$joining_date',phone='$phone',department='$department',designation='$designation',photo='$fimagee',employee_type='$employee_type', reference = '$reference', family_name = '$family_name', family_contact = '$family_contact', family_relation = '$family_relation', previous_org = '$previous_org', verify_name = '$verify_name', verify_contact = '$verify_contact', verify_relation = '$verify_relation', aadhaar = '$aadhaars', pan = '$pans', pass_cert = '$pass_certs', exp_cert = '$exp_certs', extra_cert = '$extra_certs', updated_at ='$update_time' WHERE id = " . $id;
	// var_dump($exp_certs);
	// echo '<br>';
	// var_dump($query);
	// die();
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
	?>
		<script>
			toastr.success('Added Successfully!');
			setTimeout(function() {
				window.location = "ex-employees.php";
			}, 1000);
		</script>
	<?php
	} else {
	?>
		<script>
			toastr.error('Error!');
			setTimeout(function() {
				window.location = "ex-employees.php";
			}, 1000);
		</script>
<?php
	}
}
?>