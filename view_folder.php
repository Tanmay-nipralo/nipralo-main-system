<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$project_id = $_GET['pid'];
$folder_id = $_GET['fid'];
$folder = getFolderById($folder_id,$project_id);
$document = getDocumentById($project_id,$folder_id);
// echo "<pre>";
// print_r($document);
// echo "</pre>";
// exit;
?>
<style>
	.dash-section .dash-info-list .dash-card-container {
     flex-direction: column; 
    flex-grow: 1;
}
.topics .topics-list li:before {
    font-family: FontAwesome;
    content: none;
    color: #555;
    font-size: 15px;
    position: absolute;
    top: 0;
    left: 0;
}
</style>
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
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#create_folder"><i class="fa-solid fa-plus"></i> Upload Document</a>
							</div>
						</div>
					</div>

								<div class="row">
								<?php foreach ($document as $document1) { ?>
									<div class="col-xl-4 col-md-6 col-sm-6">
										<div class="topics">
										<h3 class="topic-title"><a href="#"><?php echo $document1['document_name']; ?> </a></h3>
										<div class="topics-list">
											<div class="row" >
												<div class="col-md-8">
												<span style="margin: 0 5px;"><a href="<?php echo $document1['file_path']; ?>" download> <span class="files-icon"><i class="fa-regular fa-file-pdf"></i></span>  <span>PDF</span></a>
												</span>
													<span style="margin: 0 5px;"><a href="<?php echo $document1['documentlink']; ?>" download> <span class="files-icon"><i class="fa-solid fa-link"></i></span><span>LINK</span> </a>
								</span>
												</div>
												<div class="col-md-4">
												<span style="margin: 0 5px;"><a href="<?php echo $document1['documentlink']; ?>" download> <span class="files-icon"><i class="fas fa-edit"></i></span></a>
												</span>
												<span style="margin: 0 5px;">
													<a href="<?php echo $document1['documentlink']; ?>" download> <span class="files-icon"><i class="fas fa-trash-alt"></i></span></a>
												</span>
													
												</div>
												
											</div>
											
									</div>
										</div>
									</div>
									<?php } ?>
								</div>

                </div>
        
				<div id="create_folder" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Document</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                           <div class="mb-3">
                              <label for="documentName" class="form-label">Document Name:</label>
                              <input type="text" class="form-control" name="documentName" required>
                              <input type="hidden" value="<?php echo $project_id ?>" class="form-control" name="project_id" >
                              <input type="hidden" value="<?php echo $folder['folder_name'] ?>" class="form-control" name="folder_name" >
                           </div>
                           <div class="mb-3">
                              <label for="documentlink" class="form-label">Document Link:</label>
                              <input type="text" class="form-control" name="documentlink">
                           </div>
                           <div class="mb-3">
                              <label for="file" class="form-label">Select File:</label>
                              <input type="file" class="form-control" name="image">
                           </div>
                           <div class="mb-3">
                              <label for="documentDescription" class="form-label">Document Description:</label>
                              <textarea class="form-control" name="documentDescription" rows="4"></textarea>
                           </div>
                           <button type="submit" name="uploadDocument" class="btn btn-primary">Upload Document</button>
                        </form>

							</div>
						</div>
					</div>
				</div>
                
				<?php
				//foreach($department as $dept1) { 
				?>
				<div id="edit_department<?php echo $dept1['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Department</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="input-block mb-3">
										<label class="col-form-label">Department Name <span class="text-danger">*</span></label>
										<input class="form-control" name="department" value="<?php echo $dept1['department_name'];?>" type="text">
										<input type="hidden" name="id" id="textField" value="<?php echo $dept1['id'];?>" required="required"><br><br>
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
				//}
				?>
				
            </div>
        </div>

		<?php include './includes/footer.php'?>
<?php
if (isset($_POST['uploadDocument'])) {
    $project_id = $_POST['project_id'];
    $folder_name = $_POST['folder_name'];
    $documentName = $_POST['documentName'];
    $documentlink = $_POST['documentlink'];
    $documentDescription = $_POST['documentDescription'];
    $created_time = date('Y-m-d H:i:s');
    $fimage = $_FILES['image']['name'];
      if ($fimage) {
         $fimage_temp = $_FILES['image']['tmp_name'];
         $filename = $folder_name . '_' . time();
         $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
         $filename .= '.png';
            if (move_uploaded_file("$fimage_temp", "tags/$folder_name/$filename")) {
               $fimagee = 'tags/'.$folder_name.'/' . $filename;
            } else {
               var_dump("Not Upload");
            }
   } 
            $sql = "INSERT INTO documents (document_name,project_id,folder_id,document_description, file_path,documentlink,created_at,updated_at) VALUES ('$documentName','$project_id','$folder_id','$documentDescription', '$fimagee','$documentlink','$created_time','$created_time')";
            $iquery = mysqli_query($conn, $sql);
            if ($iquery) {
             ?>
            <script>
               toastr.success('Added Successfully!');
               setTimeout(function() {
               window.location = "view_folder.php?pid=<?php echo $project_id ?>&&fid=<?php echo $folder_id; ?>";
               }, 1000);
            </script>
            <?php
               } else {
              ?>
            <script>
               toastr.error('Error!');
               setTimeout(function() {
               window.location = "view_folder.php?pid=<?php echo $project_id ?>&&fid=<?php echo $folder_id; ?>";
               }, 1000);
            </script>
            <?php
               }
                     }



if(isset($_POST['update'])){
	$id =$_POST['id'];
	$department =$_POST['department'];
	$update_time = date('Y-m-d H:i:s');
	$query = "UPDATE departments  SET department_name = '$department', updated_at ='$update_time' WHERE id = ".$id;
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		  window.location = "view_folder.php";
		}, 1000);
 </script>
 <?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		  window.location = "view_folder.php";
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
						window.location.href = "departments.php?id=' . $id . '";
					} else {
						window.location.href = "departments.php";
					}
				});';
			echo '</script>';
		}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `departments` SET `status`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'departments.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}

?>	
 </body>
</html>