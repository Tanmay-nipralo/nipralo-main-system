<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$vendor = getVendorShop();

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
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa-solid fa-plus"></i> Add Vendor Shop</a>
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
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Email</th>
                                            <th>Address</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
							<?php   
							   $i= 1;
								   foreach($vendor as $vendor1) { ?>
									<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $vendor1['name']; ?></td>
                                    <td><?php echo $vendor1['number']; ?></td>
                                    <td><?php echo $vendor1['email']; ?></td>
                                    <td><?php echo $vendor1['address']; ?></td>	
									<td class='text-end'>
									<div class='dropdown dropdown-action'>
										<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
												<a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_department<?php echo $vendor1['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a>
												<a class='dropdown-item' href='vendor-shop.php?deleteid=<?php echo $vendor1['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
								<h5 class="modal-title">Add Vendor Shop</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Shop Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="name">
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Number <span class="text-danger">*</span></label>
										<input class="form-control" type="number" name="number">
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Email <span class="text-danger">*</span></label>
										<input class="form-control" type="email" name="email">
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Address <span class="text-danger">*</span></label>
										<textarea class="form-control" type="text" name="address"></textarea>
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
				foreach($vendor as $vendor2) { 
				?>
				<div id="edit_department<?php echo $vendor2['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Vendor Shop</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
                                    <div class="input-block mb-3">
										<label class="col-form-label">Shop Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="name" value="<?php echo $vendor2['name'];?>" >
                                        <input type="hidden" name="id" id="textField" value="<?php echo $vendor2['id'];?>" >
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Number <span class="text-danger">*</span></label>
										<input class="form-control" type="number" name="number" value="<?php echo $vendor2['number'];?>">
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Email <span class="text-danger">*</span></label>
										<input class="form-control" type="email" name="email" value="<?php echo $vendor2['email'];?>">
									</div>
                                    <div class="input-block mb-3">
										<label class="col-form-label">Address <span class="text-danger">*</span></label>
										<textarea class="form-control" type="text" name="address"><?php echo $vendor2['address'];?></textarea>
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

		<?php include './includes/footer.php'?>
<?php
if(isset($_POST['add'])){
    $name =$_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
$created_time = date('Y-m-d H:i:s');
$sql = "INSERT INTO `shop`( `name`, `number`, `email`, `address`) VALUES ('$name','$number','$email','$address')";
	$iquery = mysqli_query($conn, $sql);
	if ($iquery) {
		?>
		<script>
		toastr.success('Added Successfully!');
		setTimeout(function() {
		  window.location = "vendor-shop.php";
		}, 1000);
 </script>
 <?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		  window.location = "vendor-shop.php";
		}, 1000);
 </script>
 <?php
	}
}

if(isset($_POST['update'])){
	$id =$_POST['id'];
    $name =$_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
	$update_time = date('Y-m-d H:i:s');
	$query = "UPDATE `shop` SET `name`='$name',`number`='$number',`email`='$email',`address`='$address' WHERE id = ".$id;
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		  window.location = "vendor-shop.php";
		}, 1000);
 </script>
 <?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		  window.location = "vendor-shop.php";
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
						window.location.href = "vendor-shop.php?id=' . $id . '";
					} else {
						window.location.href = "vendor-shop.php";
					}
				});';
			echo '</script>';
		}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `shop` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'vendor-shop.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}

?>	
 </body>
</html>