<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';

if (isset($_GET['id'])) {   
    $idd = $_GET['id'];
    $user = getCareerDetailByID($idd);
}
if (isset($_GET['date'])) {
    $idd = $_GET['id'];
    $date = $_GET['date'];
    $user = getCareerDetailByIDAndDate($idd, $date);
}
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
												<input class="form-control" name="name" type="text" value="<?php echo isset($idd)? $user['name'] : ''; ?>" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="last_name">Phone</label>
												<input class="form-control" type="text" name="mobile_number" value="<?php echo isset($idd)? $user['mobile_number'] : ''; ?>">
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="mail">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="email" value="<?php echo isset($idd)? $user['email'] : ''; ?>" required >
											</div>
										</div>	
									    <div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="department">Reference <span class="text-danger">*</span></label>
												<select class="select" name="reference">
													<option selected disabled >Select Reference</option>
													<option value ="select" <?php if(isset($idd)){ 
                                                                                        echo $user['reference'] == 'manual' ? "selected" : '' ;} ?> >Manual</option>
													<option value ="google" <?php if(isset($idd)){ 
                                                                                        echo $user['reference'] == 'google' ? "selected" : '' ;} ?> >Google</option>
													<option value ="website" <?php if(isset($idd)){ 
                                                                                        echo $user['reference'] == 'website' ? "selected" : '' ;} ?> >Website</option>
													<option value ="friendRelative" <?php if(isset($idd)){ 
                                                                                        echo $user['reference'] == 'friendRelative' ? "selected" : '' ;} ?> >Friend/Relative</option>
											</select>
									    </div>
									</div>
                                    <div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label" for="department">Position </label>
												<select class="select" name="position">
													<option selected disabled >Select Position</option>
													<option value ="Fronted Developer" <?php if(isset($idd)){ 
                                                                                        echo $user['position'] == 'Fronted Developer' ? "selected" : '' ;} ?> >Fronted Developer</option>
													<option value ="Backend Developer" <?php if(isset($idd)){ 
                                                                                        echo $user['position'] == 'Backend Developer' ? "selected" : '' ;} ?> >Backend Developer</option>
													<option value ="Admin" <?php if(isset($idd)){ 
                                                                                        echo $user['position'] == 'Admin' ? "selected" : '' ;} ?> >Admin</option>
													<option value ="UI/UX Designer" <?php if(isset($idd)){ 
                                                                                        echo $user['position'] == 'UI/UX Designer' ? "selected" : '' ;} ?> >UI/UX Designer</option>
                                                    <option value ="Graphic Designer" <?php if(isset($idd)){ 
                                                                                        echo $user['position'] == 'Graphic Designer' ? "selected" : '' ;} ?> >Graphic Designer</option>
											</select>
									    </div>
									</div>
									<div class="col-sm-6">
										<div class="input-block mb-3">
											<label class="col-form-label" for="mail">Address </label>
											<textarea class="form-control" name="address"><?php echo isset($idd)? $user['address'] : ''; ?></textarea>
										</div>
									</div>	
									<div class="col-sm-12">
										<div class="input-block mb-3">
											<label class="col-form-label" for="mail">Upload Resume <span class="text-danger">*</span></label>
                                            <input type="hidden" name="previous_image" value="<?php echo isset($idd)? $user['image'] : ''; ?>">
											<input type="file" accept=".pdf" class="form-control" name="fimages" />
											<?php 
                                            if(isset($idd)){
                                                if (!$user) {
                                                    echo "No image found for ID $id";
                                                } else {
                                                    echo '<a href="https://bigdreams.in/assets/img/Resume/' . $user['image'] . '" target="_blank"><i style="color:black" class="fa-regular fa-file-pdf"></i></a>';
                                                } 
                                            }?>
										</div>
									</div>	
                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="experience">Experience</label>
                                            <input type="radio" id="experience" name="jobtype" value="experience"
                                            <?php if (isset($user['jobtype']) && $user['jobtype'] == 'experience') echo 'checked'; ?> 
                                                onclick="toggleSalaryField()">

                                        <label class="col-form-label" for="fresher">Fresher</label>
                                            <input type="radio" id="fresher" name="jobtype" value="fresher"
                                            <?php if (isset($user['jobtype']) && $user['jobtype'] == 'fresher') echo 'checked'; ?> 
                                                onclick="toggleSalaryField()">
                                    </div>
									<div id="salaryField" style="display: none;">
										<div class="row">
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Current/Previous Organisation Name</label>
                                                    <input class="form-control" type="text" name="organisation_name" value="<?php echo isset($idd)? $user['organisation_name'] : ''; ?>" >
                                                </div>
                                            </div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Current/Previous Job Title</label>
                                                    <input class="form-control" type="text" name="job_title" value="<?php echo isset($idd)? $user['job_title'] : ''; ?>" >
                                                </div>
                                            </div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Last Salary Received</label>
                                                    <input class="form-control" type="text" name="salary_received" value="<?php echo isset($idd)? $user['salary_received'] : ''; ?>" >
                                                </div>
                                            </div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Reason to leave the current/previous organisation </label>
                                                    <input class="form-control" type="text" name="leave_reason" value="<?php echo isset($idd)? $user['leave_reason'] : ''; ?>" >
                                                </div>
                                            </div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">When can you join(Number of days required to join after you receive offer letter from us) </label>
                                                    <input class="form-control" type="text" name="join_day" value="<?php echo isset($idd)? $user['join_day'] : ''; ?>" >
                                                </div>
                                            </div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">Expected Salary</label>
                                                    <input class="form-control" type="text" name="expected_salary" value="<?php echo isset($idd)? $user['expected_salary'] : ''; ?>" >
                                                </div>
                                            </div>	
                                            <div class="col-sm-6">
                                                <div class="input-block mb-3">
                                                    <label class="col-form-label" for="mail">One Reason Why Should We Hire You</label>
                                                    <input class="form-control" type="text" name="reason_forhiring" value="<?php echo isset($idd)? $user['reason_forhiring'] : ''; ?>" >
                                                </div>
                                            </div>	
										</div>
									</div>
                                    <div class="row">
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
                                        <input type="radio" name="call_status" value="Received" <?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Received') echo 'checked'; ?>>
                                        <label class="col-form-label" for="fresher">Received</label>
                                        <input type="radio" name="call_status" value="Cancel" <?php if (isset($user['hist']['call_status']) && $user['hist']['call_status'] == 'Cancel') echo 'checked'; ?>>
                                        <label class="col-form-label" for="fresher">Cancel</label>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label" for="mail">Good Time To Talk</label>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="date" name="g_date" value="<?php echo isset($idd)? $user['hist']['g_date'] : ''; ?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="time" name="g_time" value="<?php echo isset($idd)? $user['hist']['g_time'] : ''; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label" for="mail">Interview Schedule Date</label>
                                            <input class="form-control" type="date" name="interview_scheduledate" value="<?php echo isset($idd)? $user['hist']['interview_scheduledate'] : ''; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label" for="mail">Comment</label>
                                            <textarea class="form-control" type="text" name="comment"  >
                                            <?php 
                                            if (isset($user['hist']['comment']) && !empty($user['hist']['comment'])) {
                                                echo $user['hist']['comment'];
                                            }
                                            ?>
                                            </textarea>
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
        <script>
      $(document).ready(function() {
        var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
          removeItemButton: true,
        });
      });
	</script>
    <script>

function toggleSalaryField() {
    const experienceRadio = document.getElementById('experience');
    const fresherRadio = document.getElementById('fresher');
    const salaryField = document.getElementById('salaryField');
    if (experienceRadio.checked) {
        salaryField.style.display = 'block';
    } else if (fresherRadio.checked) {
        salaryField.style.display = 'none';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    toggleSalaryField();
});
    </script>
    </body>
</html>

<?php
	if(isset($_POST['add'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $jobtype = mysqli_real_escape_string($conn, $_POST['jobtype']);
        $organisation_name = mysqli_real_escape_string($conn, $_POST['organisation_name']);
        $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
        $salary_received = mysqli_real_escape_string($conn, $_POST['salary_received']);
        $leave_reason = mysqli_real_escape_string($conn, $_POST['leave_reason']);
        $join_day = mysqli_real_escape_string($conn, $_POST['join_day']);
        $expected_salary = mysqli_real_escape_string($conn, $_POST['expected_salary']);
        $reason_forhiring = mysqli_real_escape_string($conn, $_POST['reason_forhiring']);
        $reference = mysqli_real_escape_string($conn, $_POST['reference']);
        $call_status = mysqli_real_escape_string($conn, $_POST['call_status']);
        $g_date = mysqli_real_escape_string($conn, $_POST['g_date']);
        $g_time = mysqli_real_escape_string($conn, $_POST['g_time']);
        $interview_scheduledate = mysqli_real_escape_string($conn, $_POST['interview_scheduledate']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $created_time = date('Y-m-d H:i:s');
    
        $fimage = $_FILES['fimages']['name'];
            if ($fimage) {
                $fimage_temp = $_FILES['fimages']['tmp_name'];
                $filename = $name . '_' . time();
                $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
                // $filename .= '.png';
                $extension = pathinfo($fimage, PATHINFO_EXTENSION);
			    $filename .= '.'.$extension;

                        $UploadURL = "../../bigdreams/assets/img/Resume";
                    if (move_uploaded_file("$fimage_temp", "$UploadURL/$filename")) {
                        $fimagee = $filename;
                    } else {
                        var_dump("Not Upload");
                    }
        }else{
            $fimagee = $_POST['previous_image'];
        }

        if(isset($idd)) {
            $sql = "UPDATE sale SET name='$name',mobile_number='$number',email='$email',image='$fimagee',reference='$reference',address='$address',jobtype='$jobtype',organisation_name='$organisation_name',job_title='$job_title',salary_received='$salary_received',leave_reason='$leave_reason',join_day='$join_day',expected_salary='$expected_salary',reason_forhiring='$reason_forhiring',updated_at='$created_time',position='$position' WHERE id = '$idd'";
            // var_dump($sql);
            // die();
            //this  query checks if the user is already added in interview_history table on the same Scheduled Date
            
            $return = chechUserInterviewHistory($idd, $interview_scheduledate);
            if($return) {
                $sql2 = "UPDATE interview_history SET call_status = '$call_status', g_date = '$g_date', g_time = '$g_time',interview_scheduledate = '$interview_scheduledate', comment = '$comment', created_at = '$created_time' WHERE user_id = '$idd' and interview_scheduledate = '$interview_scheduledate'";
            }
            else{
                $sql2 = "INSERT INTO interview_history (user_id, call_status, g_date, g_time,interview_scheduledate,comment,created_at) VALUES ('$idd', '$call_status', '$g_date', '$g_time','$interview_scheduledate','$comment', '$created_time')";
            }
        }
        else{
            //insert query in sale table
            $sql = "INSERT INTO sale (name, mobile_number, email, reference,address, image, jobtype, organisation_name, job_title, salary_received, leave_reason, join_day, expected_salary, reason_forhiring, created_at, updated_at,position) VALUES ('$name', '$number', '$email', '$reference','$address', '$fimagee', '$jobtype', '$organisation_name', '$job_title', '$salary_received', '$leave_reason', '$join_day', '$expected_salary', '$reason_forhiring', '$created_time', '$created_time','$position')";
            $query = mysqli_query($conn, $sql);
            
            $lastIdd = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO interview_history (user_id, call_status, g_date, g_time,interview_scheduledate,comment,created_at) VALUES ('$lastIdd', '$call_status', '$g_date', '$g_time','$interview_scheduledate','$comment', '$created_time')";
            $query2 = mysqli_query($conn, $sql2);
        }
        
        if(isset($idd)){
            $query = mysqli_query($conn, $sql);
            $query2 = mysqli_query($conn, $sql2);
        }
        // var_dump($sql);
        // echo "<br>";
        // var_dump($sql2);
        // echo "<br>";
        // var_dump($query);
        // echo "<br>";
        // var_dump($query2);
        // echo "<br>";

        if($query || $query2) {
            ?>
            <script>
                toastr.success('Updated Successfully!');
                    setTimeout(function() {
                    window.location = "<?php echo isset($idd)? "edit_career.php?id=$idd" : "career.php"; ?>";
                    }, 1000);
                    </script>
                    <?php
        } else {
            ?>
            <script>
                toastr.error('Error !');
                    setTimeout(function() {
                    window.location = "<?php echo isset($idd)? "edit_career.php?id=$idd" : "career.php"; ?>";
                    }, 1000);
                    </script>
                    <?php
        }
        
    }
                    ?>