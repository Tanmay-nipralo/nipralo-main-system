<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
	?>
	
	<?php include './includes/connection.php'?>	
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
								if(isset($getCount['id'])) {
									$assignToId = $getCount['id'];
									$query_task = "SELECT ps.*, p.project_name 
												   FROM project_subtask ps
												   JOIN projects p ON ps.project_id = p.id
												   WHERE JSON_EXTRACT(assign_to, '$[0].id') = $assignToId
												   AND ps.subtask_status = 0";
									
									// Execute the query and handle the results
								}

									var_dump($query_task);		

								$result_task = mysqli_query($conn, $query_task);

								while ($task = mysqli_fetch_assoc($result_task)) {
									?>
									<div class="dash-info-list">
									<a href="project-view-employee.php?idd=<?php echo $task['project_id'];?>&&employ_id=<?php echo $assignToId;?>"  class="dash-card">
										
											<div class="dash-card-container">
												<div class="dash-card-icon">
													<i class="fa-solid fa-suitcase"></i>
												</div>
												
												<div class="dash-card-content">
													<p><?php echo $task['project_name'] . ' - ' . $task['tittle'] ?></p>
												
												</div>												
											</div>
										</a>
									</div>
									<?php
								}
								?>
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
												<?php 
												$assignToId = $getCount['id'];
													$query_client = "SELECT COUNT(*) AS task_count FROM project_subtask WHERE JSON_EXTRACT(assign_to, '$[0].id') = ".$assignToId;
													$result_client = mysqli_query($conn, $query_client);

													if ($result_client) {
														$row = mysqli_fetch_assoc($result_client);
														$task_count = $row['task_count'];

														?>
													<h4><?php echo $task_count ?></h4>
													<p>Total Tasks</p>

													<?php
													}
													 ?>
												</div>
												<div class="dash-stats-list">
													<h4>14</h4>
													<p>Pending Tasks</p>
												</div>
												
												
											</div>
											<?php 
													$query_project = "SELECT COUNT(*) AS project_count FROM projects WHERE status = 1";
													$result_project = mysqli_query($conn, $query_project);

													if ($result_project) {
														$row = mysqli_fetch_assoc($result_project);
														$project_count = $row['project_count'];

														?>

											<div class="request-btn">
												<div class="dash-stats-list">
													<h4><?php echo $project_count ?></h4>
													<p>Total Projects</p>
												</div>
											</div>
											<?php
													}
													 ?>
										</div>
									</div>
								</section>
								<section>
										<h5 class="dash-title">Completed Task</h5>
										<div class="card">
									      <div class="card-body">
										<?php
									        $assignToId = $getCount['id'];
									        $query_task = "SELECT ps.*, p.project_name 
												FROM project_subtask ps
												JOIN projects p ON ps.project_id = p.id
												WHERE JSON_EXTRACT(assign_to, '$[0].id') = $assignToId
												AND ps.subtask_status = 1";
												$result_task = mysqli_query($conn, $query_task);
												while ($task = mysqli_fetch_assoc($result_task)) {
												?>
													<p><?php echo $task['project_name'] . ' - ' . $task['tittle'] ?></p>
													<?php
												}
											?>
											</div>
										</div>
								</section>
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