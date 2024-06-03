<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php'?>
<?php include './includes/connection.php';
$designation = getAllDesignation();
$department = getAllDepartment();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>	
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
		<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-auto float-end ms-auto">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_designation"><i class="fa-solid fa-plus"></i> Add Designation</a>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th class="width-thirty">#</th>
											<th>Designation </th>
											<th>Department </th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>

									<?php
							  		 $i=1;
								   foreach($designation as $des) {
									?>
										<tr>
										<td><?php echo $i++ ?></td>
										<td><?php echo $des['designation'] ?></td>
										<td><?php echo $des['department'][0]['department_name'] ?></td>
										<td class='text-end'>
										<div class='dropdown dropdown-action'>
												<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
												<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_designation<?php echo $des['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>
												<a class='dropdown-item' href='designations.php?deleteid=<?php echo $des['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
			
				<div id="add_designation" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Designation</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="./designations.php" method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Designation Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="designation" required>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Department <span class="text-danger">*</span></label>
										<select class="select" name="department" required>
											<option>Select Department</option>
										<?php foreach($department as $dept) { ?>
											<option value="<?php echo $dept['id'];?>"><?php echo $dept['department_name'];?></option>
                                        <?php } ?>											
										</select>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
				foreach($designation as $des1) {
				?>
				<div id="edit_designation<?php echo $des1['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Designation</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" enctype="multipart/form-data">
									<div class="input-block mb-3">
										<label class="col-form-label">Designation Name <span class="text-danger">*</span></label>
										<input class="form-control"  name="designation" value="<?php echo $des1['designation'];?>" type="text">
										<input type="hidden" name="id" id="textField" value="<?php echo $des1['id'];?>" required="required">
									</div>
								    <div class="input-block mb-3">
								     <label class="col-form-label">Department <span class="text-danger">*</span></label>
									 <select class="select" name="department_name">
										<option>Select Department</option>
										<?php foreach($department as $dept) { ?>
											<option value="<?php echo $dept['id']; ?>" <?php echo ($des1['department_name'] == $dept['id']) ? 'selected' : ''; ?>>
												<?php echo $dept['department_name']; ?>
											</option>
										<?php } ?>			
									</select>

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
        </div>
		<?php include './includes/footer.php'?> 
		<?php
		if(isset($_POST['add'])){
			$designation = $_POST["designation"];
			$department = $_POST["department"];
			$created_time = date('Y-m-d H:i:s');
			$sql = "INSERT INTO designations (department_name, designation, created_at, updated_at)
					VALUES ('$department', '$designation', '$created_time', '$created_time')";

			$iquery = mysqli_query($conn, $sql);
			if ($iquery) {
				?>
				<script>
				toastr.success('Added Successfully!');
				setTimeout(function() {
				window.location = "designations.php";
				}, 1000);
			</script>
			<?php
			} else {
				?>
				<script>
				toastr.error('Error!');
				setTimeout(function() {
				window.location = "designations.php";
				}, 1000);
			</script>
			<?php
			}
		}
		if(isset($_POST['update'])){
				$id =$_POST['id'];
				$designation =$_POST['designation'];
				$department =$_POST['department_name'];
				$update_time = date('Y-m-d H:i:s');
				$query = "UPDATE designations  SET department_name = '$department',designation='$designation', updated_at ='$update_time' WHERE id = ".$id;
				$iquery = mysqli_query($conn, $query);
				if ($iquery) {
					?>
					<script>
					toastr.success('Updated Successfully!');
					setTimeout(function() {
					window.location = "designations.php";
					}, 1000);
				</script>
				<?php
				} else {
					?>
					<script>
					toastr.error('Error!');
					setTimeout(function() {
					window.location = "designations.php";
					}, 1000);
				</script>
				<?php
				}
		}


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
									window.location.href = "designations.php?id=' . $id . '";
								} else {
									window.location.href = "designations.php";
								}
							});';
						echo '</script>';
					}
				}   

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "UPDATE `designations` SET `status`= 5 WHERE id=".$id;
		$result = mysqli_query($conn, $sql);

		if ($result) {
			echo "<script>window.location.href = 'designations.php'</script>";
		} else {
			die(mysqli_error($con));
		}
	}

?>
    </body>
</html>