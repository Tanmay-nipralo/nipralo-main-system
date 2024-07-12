<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php'?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<?php include './includes/connection.php';
$employee_id = $getCount['id'];
$getdailytask = getDailyTaskReport($employee_id);
?>
<style>
    .table-responsive{
        overflow-x: hidden;
    }
</style>
    <body>
        <div class="main-wrapper">	
		<?php include './includes/navbar.php'?>		
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">	
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Employee Name</th>
                                            <th>Project Name</th>
                                            <th>Main Task</th>
                                            <th>Sub Task</th>
											<th>Status</th>
                                            <th>Date</th>
                                            <th>Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									<?php
							  		 $i=1;
								   foreach($getdailytask as $dailytask) { ?>
										<tr class='holiday-upcoming'>
										 <td><?php echo $i++ ?></td>
											<td><?php echo $dailytask['employee'][0]['first_name'] ?></td>
											<td><?php echo $dailytask['project'][0]['project_name'] ?></td>
                                            <td><?php echo $dailytask['main_task'][0]['tittle'] ?></td>
                                            <td><?php echo $dailytask['subtask'][0]['tittle'] ?></td>
                                            <td><?php
                                             $status = $dailytask['status'];
                                             switch ($status) {
                                                 case 1:
                                                     echo 'Completed';
                                                     break;
                                                 case 0:
                                                     echo 'Pending';
                                                     break;
                                                 case 2:
                                                     echo 'New';
                                                     break;
                                                 case 3:
                                                     echo 'Hold';
                                                     break;
                                                 case 4:
                                                     echo 'TBD';
                                                     break;
                                                 default:
                                                     echo 'Unknown Status';
                                                     break;
                                             }
                                              ?></td>
                                            <td><?php echo $dailytask['created_at'] ?></td>
                                            <td><?php echo $dailytask['description'] ?></td>
										 <td>
												<a class='dropdown-item' href='daily_task.php?deleteid=<?php echo $dailytask['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i></a>
										</td>
										</tr>
								        <?php } ?>		
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>

               
            </div>
        </div>
	<?php include './includes/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
   $(document).ready(function() {
      $('#description').summernote({
         toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']], // This line removes the font style option
          ['para', ['ul', 'ol']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
      });   
      $('#description1').summernote({
         toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']], // This line removes the font style option
          ['para', ['ul', 'ol']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
      });   
   });
</script>
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
						window.location.href = "daily_task.php?id=' . $id . '";
					} else {
						window.location.href = "daily_task.php";
					}
				});';
			echo '</script>';
		}
    }   


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `daily_task` SET `status1`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'daily_task.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}
?>		
    </body>
</html>