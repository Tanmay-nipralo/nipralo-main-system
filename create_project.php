<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getclients = getAllClient();
$getemployee = getAllEmployee();

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
                                <form method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Project Name</label>
												<input class="form-control" type="text" name="project_name" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Client</label>
												<select class="select" name="client">
													<option value="" selected>Select Client</option>
													<?php foreach($getclients as $clients){ ?>
													<option value="<?php echo $clients['id'] ; ?>"><?php echo $clients['company_name'] ; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Start Date</label>
													<input class="form-control" type="date" name="start_date">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">End Date</label>
													<input class="form-control" type="date" name="end_date">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Rate</label>
												<input  class="form-control" type="text" name="rate">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">&nbsp;</label>
												<select class="select" name="rate_type">
													<option>Hourly</option>
													<option>Fixed</option>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Priority</label>
												<select class="select" name="priority">
													<option>Select Priority</option>
													<option>High</option>
													<option>Medium</option>
													<option>Low</option>
												</select>
											</div>
										</div>

										<div class="col-sm-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Total Days</label>
												<input class="form-control" type="text" name="total_days">
											</div>
										</div>
										
									
										<div class="col-sm-6">
											<label class="focus-label">Add Project Leader</label>
											<select class="choices-multiple-remove-button" name="team_leader[]" placeholder="--Select--" id="country" required multiple> 
											<?php foreach($getemployee as $employee){ ?>
											<option value="<?php echo $employee['id'] ?>"><?php echo $employee['first_name'] ?></option>
											<?php } ?>
											</select>
										</div>
										<div class="col-sm-6">
											<label class="focus-label">Add team</label>
											<select class="choices-multiple-remove-button" name="team_member[]" placeholder="--Select--" id="country" required multiple> 
											<?php foreach($getemployee as $employee){ ?>
											<option value="<?php echo $employee['id'] ?>"><?php echo $employee['first_name'] ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Categories</label>
												<select class="select" name="categories">
													<option>Select Categories</option>
													<option>BDS</option>
													<option>UI/UX</option>
													<option>Website</option>
													<option>App</option>
													<option>Dashboard</option>
													<option>CMS</option>
													<option>CRM</option>
													<option>Digital Marketing</option>
													<option>Social Media Post</option>
													<option>AMC</option>
													<option>Support</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Status</label>
												<select class="select" name="project_status">
													<option>Select Project Status</option>
													<option value="Ongoing Projects" >Ongoing Projects</option>
													<option value="Hold Projects" >Hold Projects</option>
													<option value="Completed Projects" >Completed Projects</option>
												</select>
											</div>
										</div>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
										<textarea rows="3" class="form-control" placeholder="Enter Project description" name="description"></textarea>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Quotation File</label>
										<input class="form-control" type="file" name="fimages">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="addProject">Submit</button>
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
		
    </body>
</html>


<?php
	if(isset($_POST['addProject'])){
        $project_name = $_POST["project_name"];
        $client_name = $_POST["client"];
        $start_date = date('Y-m-d', strtotime($_POST["start_date"]));
        $end_date = date('Y-m-d', strtotime($_POST["end_date"]));
        $rate = $_POST["rate"];
        $rate_type = $_POST["rate_type"];
        $priority = $_POST["priority"];
        $categories =$_POST["categories"];
        $project_status =$_POST["project_status"];
        $description =$_POST["description"];
        $total_days = $_POST['total_days'];
        $created_time = date('Y-m-d H:i:s');
        $selectedTeamLeader = isset($_POST['team_leader']) ? $_POST['team_leader'] : [];
         $teamLeaderArray = [];
    
         foreach ($selectedTeamLeader as $emp_id) {
            $query_emp_details = "SELECT * FROM employees WHERE id = '$emp_id'";
            $result_emp_details = mysqli_query($conn, $query_emp_details);
            $emp_details = mysqli_fetch_assoc($result_emp_details);
            $teamLeaderArray[] = [
                'id' => $emp_details['id'],
                'name' => $emp_details['first_name'],
                'status' => $emp_details['status'],
                'role' => $emp_details['employee_type']
            ];
         }
    
        $jsonLeaderMembers = json_encode($teamLeaderArray);
        $selectedTeamMembers = isset($_POST['team_member']) ? $_POST['team_member'] : [];
        $teamMembersArray = [];
    
        foreach ($selectedTeamMembers as $emp_id) {
            $query_emp_details = "SELECT * FROM employees WHERE id = '$emp_id'";
            $result_emp_details = mysqli_query($conn, $query_emp_details);
            $emp_details = mysqli_fetch_assoc($result_emp_details);
            $teamMembersArray[] = [
                'id' => $emp_details['id'],
                'name' => $emp_details['first_name'],
                'status' => $emp_details['status'],
                'role' => $emp_details['employee_type']
            ];
        }
        $jsonTeamMembers = json_encode($teamMembersArray);
    
        $fimage = $_FILES['fimages']['name'];
            if ($fimage) {
                $fimage_temp = $_FILES['fimages']['tmp_name'];
                $filename = $first_name . '_' . time();
                $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $filename);
				$extenction = pathinfo($fimage, PATHINFO_EXTENSION);
                $filename .= '.'.$extenction;
                    if (move_uploaded_file("$fimage_temp", "uploads/project/$filename")) {
                        $fimagee = 'uploads/project/' . $filename;
                    } else {
                        var_dump("Not Upload");
                    }
        }
    
        $sql = "INSERT INTO projects (project_name, client_id, start_date,end_date,rate_value,rate_type,priority,project_category,project_status,project_leader,team_member,description,project_document,created_at,total_days) VALUES ('$project_name', '$client_name', '$start_date', '$end_date', '$rate', '$rate_type', '$priority','$categories','$project_status','$jsonLeaderMembers','$jsonTeamMembers','$description','$fimagee','$created_time','$total_days')";
            if(mysqli_query($conn, $sql)){
                ?>
                <script>
                    toastr.success('Project Added Successfully!');
                      setTimeout(function() {
                        window.location = "projects.php";
                      }, 1000);
                      </script>
                      <?php
            } else {
                ?>
                <script>
                    toastr.error('Error !');
                      setTimeout(function() {
                        window.location = "projects.php";
                      }, 1000);
                      </script>
                      <?php
            }
    }
                    ?>