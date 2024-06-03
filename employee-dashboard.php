<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php';
	$id = $getCount['id'];
	$projectcount = ProjectCountById($id);
	$taskcount = ProjectCountTaskById($id);
	$pendingtaskcount = PendingCountTaskById($id);
	// echo "<pre>";
	// print_r($pendingtaskcount);
	// echo "</pre>";
	// exit;
	$completedtask = CompletedCountTaskById($id);
	$projects = getAllProject();
	?>
    <body>
        <div class="main-wrapper">
			<div id="loader-wrapper">
				<div id="loader">
					<div class="loader-ellips">
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					</div>
				</div>
			</div>
			<?php include './includes/navbar.php'?>
			<script>
        setPageTitle("Employee Dashboard");
    </script>
				<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="welcome-box">
								<div class="welcome-img">
									<img src="<?= $getCount['photo']?>" alt="User Image">
								</div>
								<div class="welcome-det">
								<h3>Welcome, <?= $getCount['first_name']?></h3>	
									<p><?= $getCount['mail']?></p>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<section class="dash-section">
								<h1 class="dash-sec-title">Task List</h1>
								<div class="dash-sec-content">
								<?php 
								$sql = "SELECT DISTINCT projects.project_name, projects.id AS projectid
								FROM projects 
								JOIN project_subtask ON projects.id = project_subtask.project_id 
								WHERE (projects.end_date >= CURDATE() AND JSON_CONTAINS(projects.team_member, '{\"id\":\"$id\"}', '$'))
								OR (project_subtask.subtask_status != 1 AND JSON_CONTAINS(project_subtask.assign_to, '{\"id\":\"$id\"}', '$'))";						

								$sql1 = mysqli_query($conn,$sql);
								while($sql2 = mysqli_fetch_assoc($sql1)) {?>
									<div class="dash-info-list">
									<a href="project-view-employee.php?idd=<?php echo $sql2['projectid'];?>&&employ_id=<?php echo $id;?>"  class="dash-card">	
											<div class="dash-card-container">
												<div class="dash-card-icon">
													<i class="fa-solid fa-suitcase"></i>
												</div>	
												<div class="dash-card-content">
													<p><?php echo $sql2['project_name']; ?></p>
												</div>												
											</div>
										</a>
									</div>
									<?php } ?>
								</div>
							</section>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="dash-sidebar">
								<section>
									<h5 class="dash-title">Projects</h5>
									<div class="card">
										<div class="card-body">
											<div class="time-list">
												<div class="dash-stats-list">
													<h4><?php echo $taskcount ?></h4>
													<p>Total Tasks</p>
												</div>
												<div class="dash-stats-list">
													<h4><?php echo $pendingtaskcount; ?></h4>
													<p>Pending Tasks</p>
												</div>
											</div>
											
											<div class="time-list">
												<div class="dash-stats-list">
													<h4><?php echo $completedtask ?></h4>
													<p>Completed Task</p>
												</div>
												<div class="dash-stats-list">
													<h4><?php echo $projectcount ?></h4>
													<p>Total Projects</p>
												</div>
											</div>
										</div>
									</div>
								</section>
								<!-- <section>
										<h5 class="dash-title">Completed Task</h5>
										<div class="card">
									      <div class="card-body">
										<?php
									        // $assignToId = $getCount['id'];
									        // $query_task = "SELECT ps.*, p.project_name 
											// 	FROM project_subtask ps
											// 	JOIN projects p ON ps.project_id = p.id
											// 	WHERE JSON_EXTRACT(assign_to, '$[0].id') = '$assignToId'
											// 	AND ps.subtask_status = 1";
											// 	$result_task = mysqli_query($conn, $query_task);
											// 	while ($task = mysqli_fetch_assoc($result_task)) {
												?>
													<p><?php //echo $task['project_name'] . ' - ' . $task['tittle'] ?></p>
													<?php
												//}
											?>
											</div>
										</div>
								</section> -->
							</div>
						</div>
					</div>

				</div>
            </div>
        </div>
		<?php include './includes/connection.php'?>		
		<?php include './includes/footer.php'?>	
    </body>
</html>