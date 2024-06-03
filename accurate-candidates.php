<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$candidate = getAccurateFitCandidate();
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
					<div class="row">
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th class="width-thirty">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Expected Salary</th>
                                            <th>CTC</th>
                                            <th>Technology</th>
                                            <th>Experience</th>
                                            <th>Notice Period</th>
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
                                    <td><?php echo $can['email']; ?></td>  
                                    <td><?php echo $can['number']; ?></td>
                                    <td><?php echo $can['address']; ?></td>
                                    <td><?php echo $can['expectedsalary']; ?></td>
                                    <td><?php echo $can['ctc']; ?></td>
                                    <td><?php echo $can['technology']; ?></td>
                                    <td><?php echo $can['experience']; ?></td> 
                                    <td><?php echo $can['noticeperiod']; ?></td>     	
									<td class='text-end'>
									<div class='dropdown dropdown-action'>
										<a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
											<div class='dropdown-menu dropdown-menu-right'>
												<!-- <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#edit_department<?php //echo $can['id']?>'><i class='fa-solid fa-pencil m-r-5'></i> Edit</a> -->
												<a class='dropdown-item' href='applied-candidates.php?deleteid=<?php echo $can['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i> Delete</a>
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
						window.location.href = "applied-candidates.php?id=' . $id . '";
					} else {
						window.location.href = "applied-candidates.php";
					}
				});';
			echo '</script>';
		}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `appliedcandidate` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'applied-candidates.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}

?>	
 </body>
</html>