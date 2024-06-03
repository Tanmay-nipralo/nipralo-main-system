<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php'?>
<?php include './includes/connection.php';
$getholiday = getAllHoliday();
?>
    <body>
        <div class="main-wrapper">	
		<?php include './includes/navbar.php'?>		
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
							<?php if ($getCount['employee_type'] == "Admin") {?>
							<div class="col-auto float-end ms-auto">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_holiday"><i class="fa-solid fa-plus"></i> Add Holiday</a>
							</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Title </th>
											<th>Holiday Date</th>
											<?php if ($getCount['employee_type'] == "Admin") {?>
											<th class="text-end">Action</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>

									<?php
							  		 $i=1;
								   foreach($getholiday as $holiday) { ?>
										<tr class='holiday-upcoming'>
										 <td><?php echo $i++ ?></td>
											<td><?php echo $holiday['holiday_name'] ?></td>
											<td><?php echo $holiday['holiday_date'] ?></td>
											<?php if ($getCount['employee_type'] == "Admin") {?>
										 <td class='text-end'>
											<div class='dropdown dropdown-action'>
												<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
												<div class='dropdown-menu dropdown-menu-right'>
														<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_holiday<?php echo $holiday['id'] ?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>
														<a class='dropdown-item' href='holidays.php?deleteid=<?php echo $holiday['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
												</div>
												</div>
											</td>
											<?php } ?>
										</tr>
								<?php	} ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>

				<div class="modal custom-modal fade" id="add_holiday" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Holiday</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Holiday Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="holiday_name" required>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Holiday Date <span class="text-danger">*</span></label>
										<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="holiday_date" required></div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="addholiday">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
				foreach($getholiday as $holiday1) {
				?>
				<div class="modal custom-modal fade" id="edit_holiday<?php echo $holiday1['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Holiday</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Holiday Name <span class="text-danger">*</span></label>
										<input class="form-control" value="<?php echo $holiday1['holiday_name'];?>" type="text" name="holiday_name" >
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Holiday Date <span class="text-danger">*</span></label>
										<div class="cal-icon"><input class="form-control datetimepicker" value="<?php echo $holiday1['holiday_date'];?>" type="text" name="holiday_date"></div>
										<input type="hidden" name="id" id="textField" value="<?php echo $holiday1['id'];?>" required="required"><br>
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
if(isset($_POST['addholiday'])){
$holidayName = $_POST["holiday_name"];
$holiday_date =$_POST["holiday_date"];
$created_time = date('Y-m-d H:i:s');
$sql = "INSERT INTO holiday (holiday_name,holiday_date,created_at, updated_at)
	VALUES ( '$holidayName','$holiday_date','$created_time', '$created_time')";
$iquery = mysqli_query($conn, $sql);
if ($iquery) {
	?>
	<script>
	toastr.success('Added Successfully!');
	setTimeout(function() {
	window.location = "holidays.php";
	}, 1000);
</script>
<?php
} else {
	?>
	<script>
	toastr.error('Error!');
	setTimeout(function() {
	window.location = "holidays.php";
	}, 1000);
</script>
<?php
}
}

if(isset($_POST['update'])){
	$id =$_POST['id'];
	$holidayName = $_POST["holiday_name"];
    $holiday_date =$_POST["holiday_date"];
     $update_time = date('Y-m-d H:i:s');
	$query = "UPDATE holiday  SET holiday_name = '$holidayName', holiday_date='$holiday_date',updated_at ='$update_time' WHERE id = ".$id;
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		window.location = "holidays.php";
		}, 1000);
	</script>
	<?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		window.location = "holidays.php";
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
						window.location.href = "holidays.php?id=' . $id . '";
					} else {
						window.location.href = "holidays.php";
					}
				});';
			echo '</script>';
		}
    }   


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `holiday` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'holidays.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}
?>		
    </body>
</html>