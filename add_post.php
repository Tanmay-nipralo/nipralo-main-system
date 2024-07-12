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
								<h3 class="page-title">Add Post</h3>
							</div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Add Post</h4>
                                </div>
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                           <div class="mb-3">
                              <label for="documentName" class="form-label">Post Name:</label>
                              <input type="text" class="form-control" name="post_name" required>
                              <input type="hidden" value="<?php echo $idd ?>" class="form-control" name="project_id" >
                           </div>
                           <div class="mb-3">
                              <label for="documentlink" class="form-label">Link:</label>
                              <input type="text" class="form-control" name="link">
                           </div>
                           <div class="mb-3">
                              <label for="file" class="form-label">Select File:</label>
                              <!-- <input class="form-control" type="file" name="fimages" > -->
                              <input type="file" class="form-control" name="fimages[]" multiple id="upload-img" required />
                           </div>
                           <div class="mb-3">
                              <label for="documentDescription" class="form-label">Post Description:</label>
                              <textarea class="form-control" name="post_description" rows="4" required></textarea>
                           </div>
                           <button type="submit" name="uploadPost" class="btn btn-primary">Upload Post</button>
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
   if (isset($_POST['uploadPost'])) {
    $project_id = $_POST['project_id'];
    $post_name = $_POST['post_name'];
    $link = $_POST['link'];
    $post_description =preg_replace("/'/", "\'", $_POST['post_description']);
    $created_time = date('Y-m-d H:i:s');

          $fimages = $_FILES['fimages'];
          foreach ($fimages['name'] as $key => $value) {
             $fimage_temp = $fimages['tmp_name'][$key];
             $filename = $first_name . '_' . time() . '_' . $key;
             $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
             $file_type = $fimages['type'][$key];
             if (strpos($file_type, 'video') !== false) {
                $upload_dir = "uploads/video/";
                $filename .= '.mp4';
             } else {
                $upload_dir = "uploads/post/";
                $filename .= '.png';
             }

             $upload_path = $upload_dir . $filename;
             if (move_uploaded_file($fimage_temp, $upload_path)) {
                $fimagee[] = array("img" => $upload_path);
             } else {
                var_dump("Not Uploaded");
             }
          }

          $imagesArray = json_encode($fimagee);
            $sql = "INSERT INTO `post`(`project_id`, `post_name`, `post_description`, `image`, `link`, `created_at`, `updated_at`) VALUES ('$project_id','$post_name','$post_description','$imagesArray','$link','$created_time','$created_time')";
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