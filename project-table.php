<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$getStatus = getAllStatus();
$getclients = getAllClient();
$getemployee = getAllEmployee();
$getproject = getAllProjects();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.table td {
		max-width: 200px;
		white-space: normal;
	}

	.table-responsive {
		overflow-x: hidden;
		-webkit-overflow-scrolling: touch;
	}
</style>

<body>
	<div class="main-wrapper">
		<?php include './includes/navbar.php' ?>
		<?php include './includes/sidebar.php' ?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 d-flex">
						<div class="card w-100">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered custom-table datatable">
										<thead class="thead-light">
											<tr>
												
												<?php foreach ($getStatus as $status) { ?>
													<th><?= $status['status_name'] ?></th>
												<?php } ?>
											</tr>
										</thead>

<!-- <tbody>
    <?php 
    // Find the maximum number of projects for any status
    $maxProjectsPerStatus = [];
    foreach ($getStatus as $status) {
        $maxProjectsPerStatus[$status['id']] = 0;
        foreach ($getproject as $project) {
            if ($project['dynamic_status'] == $status['id']) {
                $maxProjectsPerStatus[$status['id']]++;
            }
        }
    }
    
    // Get the maximum number of projects across all statuses
    $maxRows = max($maxProjectsPerStatus); 
    
    // Iterate over each row until the maximum number of projects is reached
    for ($row = 0; $row < $maxRows; $row++) { ?>
        <tr>
            <?php foreach ($getStatus as $status) { ?>
                    <?php 
                    // Get all projects for this particular status
                    $projectsForStatus = [];
                    foreach ($getproject as $project) {
                        if ($project['dynamic_status'] == $status['id']) {
                            $projectsForStatus[] = $project['project_name'];
                        }
                    }

                    // Display project if it exists for the current row
                    if (isset($projectsForStatus[$row])) {
						echo "<td>";
                        echo $projectsForStatus[$row];
						echo "</td>";
                    } else {
						echo "<td>";
                        echo '-'; // Empty cell if no project for this row and status
						echo "</td>";
                    }
                    ?>
            <?php } ?>
        </tr>
    <?php } ?>
</tbody> -->

<!-- merge empty rows -->
<!-- <tbody>
    <?php 
    // Find the maximum number of projects for any status
    $maxProjectsPerStatus = [];
    foreach ($getStatus as $status) {
        $maxProjectsPerStatus[$status['id']] = 0;
        foreach ($getproject as $project) {
            if ($project['dynamic_status'] == $status['id']) {
                $maxProjectsPerStatus[$status['id']]++;
            }
        }
    }
    
    // Get the maximum number of projects across all statuses
    $maxRows = max($maxProjectsPerStatus); 
    
    // Iterate over each row until the maximum number of projects is reached
    for ($row = 0; $row < $maxRows; $row++) { ?>
        <tr>
            <?php foreach ($getStatus as $status) { ?>
                <?php 
                // Get all projects for this particular status
                $projectsForStatus = [];
                foreach ($getproject as $project) {
                    if ($project['dynamic_status'] == $status['id']) {
                        $projectsForStatus[] = $project['project_name'];
                    }
                }

                // Initialize rowspan tracking
                static $rowspanTracker = [];

                // Display project if it exists for the current row
                if (isset($projectsForStatus[$row])) {
                    echo "<td>";
                    echo $projectsForStatus[$row];
                    echo "</td>";
                    $rowspanTracker[$status['id']] = 0; // Reset tracker if a project is found
                } else {
                    // If no project for this row and status, merge rows with "-"
                    if (!isset($rowspanTracker[$status['id']]) || $rowspanTracker[$status['id']] == 0) {
                        $mergeCount = 0;
                        
                        // Count consecutive rows with "-"
                        for ($r = $row; $r < $maxRows; $r++) {
                            if (!isset($projectsForStatus[$r])) {
                                $mergeCount++;
                            } else {
                                break;
                            }
                        }
                        
                        // Set rowspan attribute if there are multiple "-"
                        echo "<td rowspan='{$mergeCount}'> </td>";
                        $rowspanTracker[$status['id']] = $mergeCount - 1;
                    } else {
                        // Skip the rows since they are already merged
                        $rowspanTracker[$status['id']]--;
                    }
                }
                ?>
            <?php } ?>
        </tr>
    <?php } ?>
</tbody> -->

<!-- merge empty rows & On Click -> Project Page -->
<tbody>
    <?php 
    $maxProjects = 0;
    foreach ($getStatus as $status) {
        $projectCount = 0;
        foreach ($getproject as $project) {
            if ($project['dynamic_status'] == $status['id']) {
                $projectCount++;
            }
        }
        if ($projectCount > $maxProjects) {
            $maxProjects = $projectCount;
        }
    }

    // Initialize a tracker for rowspan
    $rowspanTracker = array_fill(0, count($getStatus), 0);

    // Loop through each row
    for ($i = 0; $i < $maxProjects; $i++) { ?>
        <tr>
            <?php foreach ($getStatus as $statusIndex => $status) { ?>
                <?php 
                $projectsForStatus = [];
                $projectsForStatusId = [];
                foreach ($getproject as $project) {
                    if ($project['dynamic_status'] == $status['id']) {
                        $projectsForStatus[] = $project['project_name'];
                        $projectsForStatusId[] = $project['id'];
                    }
                }

                // Only output if rowspan tracker is 0
                if ($rowspanTracker[$statusIndex] == 0) {
                    if (isset($projectsForStatus[$i])) {
                        // Reset rowspan tracker when a project exists
                        echo "<td> 
						<a href=\"project-view.php?idd={$projectsForStatusId[$i]}\">
						{$projectsForStatus[$i]}
						</a>
						</td>";
                    } else {
                        // Count consecutive empty rows ("-")
                        $emptyCount = 0;
                        for ($j = $i; $j < $maxProjects; $j++) {
                            if (!isset($projectsForStatus[$j])) {
                                $emptyCount++;
                            } else {
                                break;
                            }
                        }

                        // Merge cells with rowspan if there are consecutive "-"
                        if ($emptyCount > 0) {
                            echo "<td rowspan='{$emptyCount}'> </td>";
                            $rowspanTracker[$statusIndex] = $emptyCount - 1;
                        }
                    }
                } else {
                    // Decrease rowspan tracker to skip rows
                    $rowspanTracker[$statusIndex]--;
                }
                ?>
            <?php } ?>
        </tr>
    <?php } ?>
</tbody>



									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
		<?php include './includes/footer.php' ?>
		<script>
			$(document).ready(function() {
				$('.statusSelect').on('change', function() {
					var selectedValue = $(this).val();
					var subtaskId = $(this).siblings('.subtaskId').val();
					$.ajax({
						url: 'updatePositionStatus.php',
						method: 'POST',
						data: {
							status: selectedValue,
							sid: subtaskId
						},

						success: function(response) {
							console.log(response);
						},
						error: function(xhr, status, error) {
							console.error(error);
						}
					});
				});
			});
		</script>
		<script>
			$(document).ready(function() {
				var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
					removeItemButton: true,
				});
			});
		</script>
		<?php
		if (isset($_POST['updateProject'])) {
			$projectId = $_POST['project_id'];
			$project_name = $_POST["project_name"];
			$client_name = $_POST["client"];
			$start_date = date('Y-m-d', strtotime($_POST["start_date"]));
			$end_date = date('Y-m-d', strtotime($_POST["end_date"]));
			$rate = $_POST["rate"];
			$rate_type = $_POST["rate_type"];
			$priority = $_POST["priority"];
			$categories = $_POST["categories"];
			$project_status = $_POST["project_status"];
			$description = $_POST["description"];
			$total_days = $_POST['total_days'];
			$update_time = date('Y-m-d H:i:s');
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
				$filename .= '.png';

				if (move_uploaded_file("$fimage_temp", "uploads/project/$filename")) {
					$fimagee = 'uploads/project/' . $filename;
				} else {
					var_dump("Not Upload");
				}
			} else {
				$fimagee = $_POST['previous_image'];
			}


			$updateQuery = "UPDATE projects SET project_name='$project_name',client_id='$client_name',start_date='$start_date',end_date='$end_date',rate_value='$rate',rate_type='$rate_type',priority='$priority',project_leader='$jsonLeaderMembers',team_member='$jsonTeamMembers',project_category='$categories',project_status='$project_status',description='$description',project_document='$fimagee',update_at='$update_time',total_days='$total_days' WHERE id = '$projectId'";
			if (mysqli_query($conn, $updateQuery)) {
		?>
				<script>
					toastr.success('Project Update Successfully!');
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



		if (isset($_GET['deleteid'])) {
			$id = $_GET['deleteid'];
			if ($id) {
				echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
				echo '<script>';
				echo 'Swal.fire({
					title: "Are you sure?",
					text: "You won\'t be able to revert this!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "No, cancel",
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "projects.php?id=' . $id . '";
					} else {
						window.location.href = "projects.php";
					}
				});';
				echo '</script>';
			}
		}

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$sql = "UPDATE `projects` SET `status`= 5 WHERE id=" . $id;
			$result = mysqli_query($conn, $sql);

			if ($result) {
				echo "<script>window.location.href = 'projects.php'</script>";
			} else {
				die(mysqli_error($con));
			}
		}



		// if ($_SERVER["REQUEST_METHOD"] == "GET") {
		//     $currentDate = date('Y-m-d');
		//     $sql = "UPDATE projects SET position = 'Delayed' WHERE end_date < '$currentDate'";
		//     $result = mysqli_query($conn, $sql);

		//     if ($result) {
		//         echo "Automatic status update to 'Delayed' completed successfully";
		//     } else {
		//         echo "Error updating status: " . mysqli_error($conn);
		//     }

		//     mysqli_close($conn);
		// } else {
		//     echo "Invalid request";
		// }
		?>
</body>

</html>