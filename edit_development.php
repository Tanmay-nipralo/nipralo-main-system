<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$idd = $_GET['id'];
$user = getDevelopmentDetailByID($idd);
// echo "<pre>";
// print_r($user);
// echo "</pre>";
// exit;
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
                            <div class="card">
                                <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="first_name">Name <span class="text-danger">*</span></label>
												<input class="form-control" name="name" type="text" value="<?php echo $user['name'] ?>" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="last_name">Phone</label>
												<input class="form-control" type="text" name="mobile_number" value="<?php echo $user['number'] ?>">
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="email" value="<?php echo $user['email'] ?>" required >
											</div>
										</div>	
									    
									
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Type<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="type" value="<?php echo $user['type'] ?>" required >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="department">Reference <span class="text-danger">*</span></label>
												<select class="select" name="reference">
													<option>Select Reference</option>
													<option>manual</option>
													<option>google</option>
													<option>website</option>
											</select>
									    </div>
									</div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Message<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" type="text" name="message" required ><?php echo $user['message'] ?></textarea>
                                                </div>
                                            </div>	
                                            
										
                                   
                                    <h4>Calling Status</h4>
                                    <div class="col-sm-6">
                                        <input type="radio" name="call_status" value="Ringing"<?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Ringing') echo 'checked'; ?>>
                                        <label class="col-form-label" for="experience">Ringing</label>
                                        <input type="radio" name="call_status" value="Out of Service" <?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Out of Service') echo 'checked'; ?>>
                                        <label class="col-form-label" for="fresher">Out of Service</label>
                                        <input type="radio" name="call_status" value="Not Reachable" <?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Not Reachable') echo 'checked'; ?>>
                                        <label class="col-form-label" for="fresher">Not Reachable</label>
                                        <input type="radio" name="call_status" value="Call Back" <?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Call Back') echo 'checked'; ?>>
                                        <label class="col-form-label" for="fresher">Call Back</label>
                                        <input type="radio" name="call_status" value="Cancel" <?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Cancel') echo 'checked'; ?>>
                                        <label class="col-form-label" for="fresher">Cancel</label>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label" for="mail">Good Time To Talk<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="date" name="g_date" value="<?php echo $user['hist']['g_date'] ?>" required >
                                                </div>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="time" name="g_time" value="<?php echo $user['hist']['g_time'] ?>" required >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label" for="mail">Meeting Schedule Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" name="meeting_scheduledate" value="<?php echo $user['hist']['meeting_scheduledate'] ?>" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label" for="mail">Comment<span class="text-danger">*</span></label>
                                            <textarea class="form-control" type="text" name="comment"  required >
                                            <?php
                                            if (isset($user['hist']['comment']) && !empty($user['hist']['comment'])) {
                                                echo $user['hist']['comment'];
                                            }
                                            ?></textarea>
                                        </div>
                                    </div>
                                    
                                    </div>
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add">Submit</button>
									</div>
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
	if(isset($_POST['add'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $reference = mysqli_real_escape_string($conn, $_POST['reference']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $call_status = mysqli_real_escape_string($conn, $_POST['call_status']);
        $g_date = mysqli_real_escape_string($conn, $_POST['g_date']);
        $g_time = mysqli_real_escape_string($conn, $_POST['g_time']);
        $meeting_scheduledate = mysqli_real_escape_string($conn, $_POST['meeting_scheduledate']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $created_time = date('Y-m-d H:i:s');

        $sql = "UPDATE website_enquiry SET name='$name',number='$number',email='$email',message='$message',type='$type',reference='$reference',updated_at='$created_time' WHERE id = '$idd'";

        $sql = "INSERT INTO meeting_history (user_id, call_status, g_date, g_time,meeting_scheduledate,comment,created_at) VALUES ('$idd', '$call_status', '$g_date', '$g_time','$meeting_scheduledate','$comment', '$created_time')";
        var_dump($sql);
            if(mysqli_query($conn, $sql)){
                ?>
                <script>
                    toastr.success('Updated Successfully!');
                      setTimeout(function() {
                        window.location = "edit_development.php?id=<?php echo $idd; ?>";
                      }, 1000);
                      </script>
                      <?php
            } else {
                ?>
                <script>
                    toastr.error('Error !');
                      setTimeout(function() {
                        window.location = "edit_development.php?id=<?php echo $idd; ?>";
                      }, 1000);
                      </script>
                      <?php
            }
    }
                    ?>