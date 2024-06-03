<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$hardware = getHardware();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<?php include './includes/connection.php';
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
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa-solid fa-plus"></i> Add Hardware</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th class="width-thirty">#</th>
											<th>Hardware Type</th>
                                            <th>Model</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
							<?php   
							   $i= 1;
								   foreach($hardware as $hard) { ?>
									<tr>
									<td><?php echo $i++; ?></td>
									 <td><?php echo $hard['name']; ?></td>
                                    <td><?php echo $hard['models']; ?></td>
									<td class='text-end'>
									<div class='dropdown dropdown-action'>
										<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
												<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_department<?php echo $hard['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>
												<a class='dropdown-item' href='hardware.php?deleteid=<?php echo $hard['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
				<div id="add_department" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Hardware</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Hardware Type <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="name" required>
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Model <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="models" required>
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
				foreach($hardware as $hardware1) { 
				?>
				<div id="edit_department<?php echo $hardware1['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Hardware</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Hardware Type <span class="text-danger">*</span></label>
										<input class="form-control" name="name" value="<?php echo $hardware1['name'];?>" type="text">
										<input type="hidden" name="id" id="textField" value="<?php echo $hardware1['id'];?>" required="required"><br><br>
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Model <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="models" value="<?php echo $hardware1['models'];?>">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="update">Save</button>
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
        </div>
		
		<?php include './includes/setting.php'?>

		<?php include './includes/footer.php'?>
<?php
if(isset($_POST['add'])){
$name = $_POST["name"];
$models = $_POST["models"];
$created_time = date('Y-m-d H:i:s');
$sql = "INSERT INTO `hardware`(`name`, `models`) VALUES ('$name','$models')";
	$iquery = mysqli_query($conn, $sql);
	if ($iquery) {
		?>
		<script>
		toastr.success('Added Successfully!');
		setTimeout(function() {
		  window.location = "hardware.php";
		}, 1000);
 </script>
 <?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		  window.location = "hardware.php";
		}, 1000);
 </script>
 <?php
	}
}

if(isset($_POST['update'])){
	$id =$_POST['id'];
	$name = $_POST["name"];
    $models = $_POST["models"];
	$update_time = date('Y-m-d H:i:s');
	$query = "UPDATE hardware  SET name = '$name', models ='$models' WHERE id = ".$id;
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		  window.location = "hardware.php";
		}, 1000);
 </script>
 <?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		  window.location = "hardware.php";
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
						window.location.href = "hardware.php?id=' . $id . '";
					} else {
						window.location.href = "hardware.php";
					}
				});';
			echo '</script>';
		}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `hardware` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'hardware.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}

?>	
 </body>
</html>