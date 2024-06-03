<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$date = date('Y-m-d');
$getclient = getTodayInterviewDetail($date);
$getallclient = getAllInterviewDetail();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.table td{
		max-width: 250px;
		white-space: normal;
	}

	.table-responsive {
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
}
.dataTables_length label{
	position: absolute;
    top: 80px;
    right: 198px;
}
</style>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
                        <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
					    	<li class="nav-item"><a class="nav-link active" href="#all_tasks" data-bs-toggle="tab" aria-expanded="true">Todays Interview Schedule</a></li>
							<li class="nav-item"><a class="nav-link" href="#all_meeting" data-bs-toggle="tab" aria-expanded="false">All Interview Schedule</a></li>
						</ul>
                        <div class="tab-content">
				            <div class="tab-pane show active" id="all_tasks">    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table datatable">
                                                <thead>
                                                    <tr>
                                                    <th>Sr No.</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Hiring Status</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($getclient as $client) {
                                                        ?>
                                                    <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $client['user_detail'][0]['name']; ?></td>
                                                    <td><?php echo $client['user_detail'][0]['mobile_number']; ?></td>
                                                    <td><?php echo $client['user_detail'][0]['email']; ?></td>
                                                    <td>
														<select class="statusSelect select" >
                                                            <option>Select</option>
															<option value="Done" <?php echo ($client['user_detail'][0]['hiring_status'] == 'Done') ? 'selected' : ''; ?>>Done</option>
															<option value="Reschedule" <?php echo ($client['user_detail'][0]['hiring_status'] == 'Reschedule') ? 'selected' : ''; ?>>Reschedule</option>
															<option value="Hired" <?php echo ($client['user_detail'][0]['hiring_status'] == 'Hired') ? 'selected' : ''; ?>>Hired</option>
															<option value="Cancel" <?php echo ($client['user_detail'][0]['hiring_status'] == 'Cancel') ? 'selected' : ''; ?>>Cancel</option>	
														</select>
														<input type="hidden" class="subtaskId" name="sid" value="<?php echo $client['user_detail'][0]['id'] ?>">
													</td>
                                                    <td>
                                                        <div style="display: flex;justify-content:space-between">
                                                            <a class='dropdown-item' href="edit_career.php?id=<?php echo $client['user_detail'][0]['id']?>&date=<?php echo $client['interview_scheduledate']?>"><i class='fa fa-edit'></i></a>
                                                            <a class='dropdown-item' href='view_career.php?id=<?php echo $client['user_detail'][0]['id']?>'><i class='fa fa-eye'></i></a>
                                                            <a class='dropdown-item' href='career_history.php?id=<?php echo $client['user_detail'][0]['id']?>'><i class='fa fa-history'></i></a>
                                                            <a class='dropdown-item' href="https://bigdreams.in/assets/img/Resume/<?php echo $client['user_detail'][0]['image']; ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                                        </div>
                                                    </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
				            <div class="tab-pane show" id="all_meeting">    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table datatable">
                                                <thead>
                                                    <tr>
                                                    <th>Sr No.</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Schedule Date</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($getallclient as $client1) {
                                                        ?>
                                                    <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $client1['user_detail'][0]['name']; ?></td>
                                                    <td><?php echo $client1['user_detail'][0]['mobile_number']; ?></td>
                                                    <td><?php echo $client1['user_detail'][0]['email']; ?></td>
                                                    <td><?php echo $client1['interview_scheduledate']; ?></td>
                                                    <td>
                                                        <div style="display: flex;justify-content:space-between">
                                                            <a class='dropdown-item' href="edit_career.php?id=<?php echo $client1['user_detail'][0]['id']?>&date=<?php echo $client1['interview_scheduledate']?>"><i class='fa fa-edit'></i></a>
                                                            <a class='dropdown-item' href='view_career.php?id=<?php echo $client1['user_detail'][0]['id']?>'><i class='fa fa-eye'></i></a>
                                                            
                                                            <a class='dropdown-item' href='career_history.php?id=<?php echo $client1['user_detail'][0]['id']?>'><i class='fa fa-history'></i></a>
                                                            <a class='dropdown-item' href="https://bigdreams.in/assets/img/Resume/<?php echo $client1['user_detail'][0]['image']; ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                                        </div>
                                                    </td>
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

		
		<?php include './includes/footer.php'?>
		<script>
            function toggleMessage(shortMessageId, fullMessageId) {
                var shortMessage = document.getElementById(shortMessageId);
                var fullMessage = document.getElementById(fullMessageId);
                var btnText = document.getElementById("message-btn");

                if (shortMessage.style.display === "none") {
                    shortMessage.style.display = "inline";
                    fullMessage.style.display = "none";
                    btnText.innerHTML = "...";
                } else {
                    shortMessage.style.display = "none";
                    fullMessage.style.display = "inline";
                    btnText.innerHTML = "...";
                }
            }
        </script>
        <script>
			$(document).ready(function () {
				$('.statusSelect').on('change', function () {
					var selectedValue = $(this).val();
                    console.log(selectedValue);
					var subtaskId = $(this).siblings('.subtaskId').val();
                    console.log(subtaskId);
					$.ajax({
						url: 'updateHiringStatus.php',
						method: 'POST',
						//  data: { status: selectedValue, sid: subtaskId},
						data: { status: selectedValue, sid: subtaskId },

						success: function (response) {
							console.log(response);
                            alert(response);
						},
						error: function (xhr, status, error) {
							console.error(error);
						}
					});
				});
			});
		</script>

    </body>
</html>
