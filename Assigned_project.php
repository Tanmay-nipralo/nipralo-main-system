<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php';
    $projects = getAllProject();
    $idd = $getCount['id'];
	?>	
	<style>
		.table-responsive{
			overflow-x: hidden;
		}
	</style>								
    <body>
     <div class="main-wrapper">	
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Project Name</th>
											<th>Start Date</th>
											<th>Dead Line</th>
											<th>Priority</th>
											<th>Project Leader</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
								<?php foreach($projects as $project){ 
                                    $decodedLeaders = json_decode($project['project_leader'], true);
                                    $decodedMembers = json_decode($project['team_member'], true);
    
                                    if (is_array($decodedLeaders) && is_array($decodedMembers)) {
                                        foreach (array_merge($decodedLeaders, $decodedMembers) as $member) {
                                            if ($member['id'] == $idd) {?>
									<tr>
									    <td><?php echo $project['project_name'] ?></td>
									    <td><?php echo $project['start_date'] ?></td>
									    <td><?php echo $project['end_date'] ?></td>
                                        <td><?php echo $project['priority']?></td>
										<td>
                                        <?php
										if ($decodedLeaders !== null) {
											foreach ($decodedLeaders as $teamLeader) {
												echo "" . $teamLeader['name'] . "<br>";
											}
										} else {
									    	echo "Error decoding JSON data.";
										}
										?>   
                                        </td>
                                        
										<td class='text-end'>
											<a href="project-view-employee.php?idd=<?php echo $project['id'];?>&&employ_id=<?php echo $idd;?>"><i class='fa-regular fa-eye m-r-5'></i></a>
										</td>
								      </tr>
								<?php } }}} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				
            </div>
		
        </div>
		<?php include './includes/footer.php'?>

    </body>
</html>
