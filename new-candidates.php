<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$candidate = getNewCandidate();
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
							<div class="col">
								<h3 class="page-title">New Candidate</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">New Candidate</li>
								</ul>
							</div>
							<div class="col-auto float-end ms-auto">
								<a href="add-candidates.php" class="btn add-btn"><i class="fa-solid fa-plus"></i> Add Candidate</a>
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
                                            <th>Platform</th>
                                            <th>Job Role</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
							<?php   
							   $i= 1;
								   foreach($candidate as $can) { ?>
									<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $can['name']; ?></td>
                                    <td><?php echo $can['number']; ?></td>
                                    <td><?php echo $can['email']; ?></td> 
                                    <td><?php echo $can['ftype']; ?></td> 
                                    <td><?php echo $can['jtype']; ?></td>       	
									<td class='text-end'>
									<div class='dropdown dropdown-action'>
										<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
												<!-- <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_department<?php //echo $can['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a> -->
												<a class='dropdown-item' href='new-candidates.php?deleteid=<?php echo $can['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
				
            </div>
        </div>
		
		<?php include './includes/setting.php'?>

		<?php include './includes/footer.php'?>
<?php
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
						window.location.href = "new-candidates.php?id=' . $id . '";
					} else {
						window.location.href = "new-candidates.php";
					}
				});';
			echo '</script>';
		}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `candidate` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'new-candidates.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}

?>	
 </body>
</html>