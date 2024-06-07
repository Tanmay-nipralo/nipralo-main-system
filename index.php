<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php';
	$project_count = ProjectCount();
	$client_count = ClientCount();
	$task_count = TaskCount();
	$employees_count = EmployeCount();
	$outgoingproject_count = OutProjectCount();
	$holdproject_count = HoldProjectCount();
	$completeproject_count = CompleteProjectCount();
	$delayedproject_count = DelayedProjectCount();
	$OnTrackproject_count = OnTrackProjectCount();
	$getclient = getClients();
	$getProject = getProjects();
	$date = date('Y-m-d');
	$todayinterview = InterviewCount($date);
	$todaymeeting = MeetingCount($date);
	// echo "<pre>";
	// print_r($todayinterview);
	// echo "</pre>";
	// exit();

	if ($getCount['employee_type'] == "Employee") {
		header("Location: employee-dashboard.php");
	}
	?>
	<?php include 'includes/connection.php'?>	
    <body>
        <div class="main-wrapper">
			<?php include './includes/navbar.php'?>
	<script>
        setPageTitle("Admin Dashboard");
    </script>
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome Admin!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
							<a href="todayinterview_schedule.php">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $todayinterview  ?></h3>
										<span>Today's Schedule Interview</span>
									</div>
								</div>
								</a>	
							</div>
						</div>	
							
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
							<a href="todaymeeting_schedule.php">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $todaymeeting  ?></h3>
										<span>Today's Schedule Meeting</span>
									</div>
								</div>
							</a>
							</div>
						</div>		
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $project_count  ?></h3>
										<span>Projects</span>
									</div>
								</div>
							</div>
						</div>
			
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $client_count ?></h3>
										<span>Clients	</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $task_count ?></h3>
										<span>Tasks</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $employees_count ?></h3>
										<span>Employees</span>
									</div>
								</div>
							</div>
						</div>
					
							<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
								<div class="card dash-widget">
									<div class="card-body">
										<span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
										<div class="dash-widget-info">
											<h3><?php echo $outgoingproject_count; ?></h3>
											<span>Outgoing Projects</span>
										</div>
									</div>
								</div>
							</div>
						
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $holdproject_count ?></h3>
										<span>Hold Projects</span>
									</div>
								</div>
							</div>
						</div>
				
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $completeproject_count ?></h3>
										<span>Completed Projects</span>
									</div>
								</div>
							</div>
						</div>
				
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $delayedproject_count ?></h3>
										<span>Delayed Projects</span>
									</div>
								</div>
							</div>
						</div>
				
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
									<div class="dash-widget-info">
										<h3><?php echo $OnTrackproject_count ?></h3>
										<span>On Trackd Projects</span>
									</div>
								</div>
							</div>
						</div>
					</div>	
                   
					<div class="row">
						<div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0">Clients</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table custom-table mb-0">
											<thead>
												<tr>
												<th>Company Logo</th>
													<th>Company Name</th>
													<th>Client Name</th>
													<th>Email</th>
													<th>Mobile</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($getclient as $client){ ?>
												<tr>
													<td><a href="client-profile.php?idd=<?php echo $client['id'] ?>"><img src="<?php echo $client['company_logo'] ?>" alt="User Image" style="height : 30px;"></a></td>
													<td><a href="client-profile.php?idd=<?php echo $client['id'] ?>"><?php echo $client['company_name'] ?></a></td>
													<td><a href="client-profile.php?idd=<?php echo $client['id'] ?>"><?php echo $client['client_name'] ?></a></td>
													<td><a href="client-profile.php?idd=<?php echo $client['id'] ?>"><?php echo $client['client_mail'] ?></a></td>
													<td><a href="client-profile.php?idd=<?php echo $client['id'] ?>"><?php echo $client['primary_phone'] ?></a></td>
												</tr>
														<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="clients.php">View all clients</a>
								</div>
							</div>
						</div>
						<div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0">Recent Projects</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table custom-table mb-0">
											<thead>
												<tr>
													<th>Project Name </th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Project Status</th>
												</tr>
											</thead>
											<tbody>  
											<?php foreach($getProject as $projects){ ?>
                                                <tr>
													<td><h2><a href="project-view.php?idd=<?php echo $projects['id'] ?>"><?php echo $projects['project_name'] ?></a></h2></td>	
													<td><h2><a href="project-view.php?idd=<?php echo $projects['id'] ?>"><?php echo $projects['start_date'] ?></a></h2></td>
													<td><h2><a href="project-view.php?idd=<?php echo $projects['id'] ?>"><?php echo $projects['end_date'] ?></a></h2></td>
													<td><h2><a href="project-view.php?idd=<?php echo $projects['id'] ?>"><?php echo $projects['project_status'] ?></a></h2></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="projects.php">View all projects</a>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>	
        </div>
		<div id="google_translate_element"></div>

		<?php include './includes/footer.php'?>
    </body>
</html>

