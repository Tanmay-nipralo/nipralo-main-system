<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$idd = $_GET['pid'];
$employee_id = $_GET['eid'];
?>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Add Document</h3>
							</div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Add Document</h4>
                                </div>
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                           <div class="mb-3">
                              <label for="documentName" class="form-label">Document Name:</label>
                              <input type="text" class="form-control" name="documentName" required>
                              <input type="hidden" value="<?php echo $idd ?>" class="form-control" name="project_id" >
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
                    </div>
                </div>
            </div>
        </div>

		<?php include './includes/footer.php'?>
		
    </body>
</html>


<?php
 if (isset($_POST['uploadDocument'])) {
    $project_id = $_POST['project_id'];
    $documentName = $_POST['documentName'];
    $documentlink = $_POST['documentlink'];
    $documentDescription = $_POST['documentDescription'];
    $created_time = date('Y-m-d H:i:s');
    $fimage = $_FILES['image']['name'];
      if ($fimage) {
         $fimage_temp = $_FILES['image']['tmp_name'];
         $filename = $first_name . '_' . time();
         $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
         $filename .= '.png';
            if (move_uploaded_file("$fimage_temp", "uploads/post/$filename")) {
               $fimagee = 'uploads/post/' . $filename;
            } else {
               var_dump("Not Upload");
            }
   } 
            $sql = "INSERT INTO documents (document_name,project_id,document_description, file_path,documentlink,created_at,updated_at) VALUES ('$documentName','$project_id','$documentDescription', '$fimagee','$documentlink','$created_time','$created_time')";
            $iquery = mysqli_query($conn, $sql);
            if ($iquery) {
             ?>
            <script>
               toastr.success('Added Successfully!');
               setTimeout(function() {
               window.location = "project-view-employee.php?idd=<?php echo $idd ?>&&employ_id=<?php echo $employee_id; ?>";
               }, 1000);
            </script>
            <?php
               } else {
              ?>
            <script>
               toastr.error('Error!');
               setTimeout(function() {
               window.location = "project-view-employee.php?idd=<?php echo $idd ?>&&employ_id=<?php echo $employee_id; ?>";
               }, 1000);
            </script>
            <?php
               }
                     }
                    ?>