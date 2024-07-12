<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php 
error_reporting(0);
include './includes/header.php';
$idd = $_GET['id'];
$career = getCareerDetailByID($idd);
?>
<style>
	.accordion{
		padding: 10px;
	}
</style>
<body>
    <div class="main-wrapper">
        <?php include './includes/navbar.php'?>
        <?php include './includes/sidebar.php'?>
        <div class="page-wrapper">
            <div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
						</div>
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-lg-8 col-xl-9">
						<div class="card">
							<div class="card-body">
								<div class="project-title">
									<h6 class="card-title">test</h6>
								</div>
									<p>test1</p>
							</div>
						</div>
						<div class="card">
						    <div class="card-body">
								<div class="row" style="padding: 10px;">
									<div class="col-md-3 col-sm-4 col-lg-4 col-xl-3">
										<div class="uploaded-box">
											<div class="uploaded-img">
													<img src="test" class="img-fluid" alt="Placeholder Image">
											</div>
										</div>
									</div>
								</div>
						    </div>
					    </div>
					</div> -->
					<div class="col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title m-b-15">User details</h6>
								<table class="table table-striped table-border">
									<tbody>
										<tr>
											<td>User Name :</td>
											<td class="text-end"><?php echo $career['name']?></td>
										</tr>
										<tr>
											<td>Mobile Number :</td>
											<td class="text-end"><?php echo $career['mobile_number']?></td>
										</tr>
										<tr>
											<td>Email:</td>
											<td class="text-end"><?php echo $career['email']?></td>
										</tr>
										<tr>
											<td>Message:</td>
											<td class="text-end"><?php echo $career['message']?></td>
										</tr>
										<tr>
											<td>Reference:</td>
											<td class="text-end"><?php echo $career['reference']?></td>
										</tr>
                                        <tr>
											<td>Address:</td>
											<td class="text-end"><?php echo $career['address']?></td>
										</tr>
                                        <tr>
											<td>Job Type:</td>
											<td class="text-end"><?php echo $career['jobtype']?></td>
										</tr>
                                        <tr>
											<td>Current/Previous Organisation Name:</td>
											<td class="text-end"><?php echo $career['organisation_name']?></td>
										</tr>
                                        <tr>
											<td>Current/Previous Job Title:</td>
											<td class="text-end"><?php echo $career['job_title']?></td>
										</tr>
										<tr>
											<td>Last Salary Received:</td>
											<td class="text-end"><?php echo $career['salary_received']?></td>
										</tr>
                                        <tr>
											<td>Reason to leave the current/previous organisation:</td>
											<td class="text-end"><?php echo $career['leave_reason']?></td>
										</tr>
                                        <tr>
											<td>When can you join(Number of days required to join after you receive offer letter from us):</td>
											<td class="text-end"><?php echo $career['join_day']?></td>
										</tr>
                                        <tr>
											<td>Expected Salary:</td>
											<td class="text-end"><?php echo $career['expected_salary']?></td>
										</tr>
                                        <tr>
											<td>One Reason Why Should We Hire You:</td>
											<td class="text-end"><?php echo $career['reason_forhiring']?></td>
										</tr>
                                        <tr>
											<td>Resume:</td>
                                            <td class="text-end"><a href="https://bigdreams.in/assets/img/Resume/<?php echo $career['image']; ?>" target="_blank"><i class="fa fa-eye"></i></a>View Resume</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
						
                    <div id="create_folder" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create Folder</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Folder Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="folder_name">
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