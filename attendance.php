<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php';
		$employee = getAllEmployee();
		$attendance = getAttendenceByDate(date('Y-m-d'));

		if ($getCount['employee_type'] != "Admin") {
			header("Location: error-404.php");
		}
	?>
	<style>
		.custom_date_style{
			border-radius: 6px;
			padding: 10px;
			border: 1px solid grey;
			width: 100%;
		}
		.modal-content{
			top: -80px;
			border: 1px solid black;
			box-shadow: 0 0 10px 0 rgba(0,0,0,0.5);
		}
	</style>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table table-nowrap mb-0">
									<thead>
										<tr>
											<th>Employee Id</th>
											<th>Employee Name</th>
											<th>Date</th>
											<th>Remark</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($employee as $emp){?>
										<tr>
											<td>
												<?php echo $emp['id'];?>
											</td>
											<td>
												<h2 class="table-avatar">
													<a class="avatar avatar-xs" href="#"><img src="<?php echo $emp['photo'];?>" alt="User Image"></a>
													<a href="#"><?php echo $emp['first_name'];?></a>
												</h2>
											</td>
											<td>
											<input type="date" class="dateclass custom_date_style" name="selected_date" max="<?php echo date('Y-m-d'); ?>">
											<!-- <select class="dateclass select" name="selected_date">
												<?php 
													// $currentDate = date('Y-m-d');
													
													// for ($i = 0; $i <= 3; $i++) {
													// 	$date = date('Y-m-d', strtotime("-$i days"));
													// 	echo "<option value=\"$date\">$date</option>";
													// }
												?>
											</select> -->
											</td>
											<td>
												<select class="presentSelect select" <?php 
													// if ($attendance) {
													// 	$isPresent = isEmployeePresent($attendance, $emp['id'], 'present');
													// 	$isAbsent = isEmployeePresent($attendance, $emp['id'], 'absent');
													// 	$isHalfDay = isEmployeePresent($attendance, $emp['id'], 'half_day');
													// 	echo ($isPresent || $isAbsent || $isHalfDay) ? 'disabled' : '';
													// }
												?>>
													<option selected disabled>Select Remark</option>
													<option value="present" <?php //if ($attendance) { echo isSelected($attendance, $emp['id'], 'present');} ?>>Present</option>
													<option value="absent" <?php //if ($attendance) { echo isSelected($attendance, $emp['id'], 'absent');}?>> Absent </option>
													<option value="half_day" <?php //if ($attendance) { echo isSelected($attendance, $emp['id'], 'half_day');}?>>Half Day</option>
												</select>

													<div class="modal custom-modal" role="dialog" id="paidLeave<?= $emp['id']?>" style="display: none;">
														<div class="modal-dialog modal-dialog-centered" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title">Type of leave</h4>
																	<button type="button" onclick="closee()" class="btn-close" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<h5>Paid Leaves Left: <?= $emp['paid_leave']?></h5>
																	<select class="paidSelect select">
																		<option>Select Paid/Unpaid Leave</option>
																		<option value="paidLeave" > Paid Leave </option>
																		<option value="unpaidLeave" > Unpaid Leave </option>
																	</select>
																</div>
															</div>
														</div>
													</div>	
												
												<input type="hidden" class="empId" name="eid" value="<?php echo $emp['id']; ?>">
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
		<?php include './includes/footer.php';?>

								<!-- <div class="modal custom-modal" role="dialog" id="paidLeave" style="display: none;">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Type of leave</h4>
												<button type="button" onclick="closee()" class="btn-close" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<select class="paidSelect select">
													<option>Paid / Unpaid Leave</option>
													<option value="paidLeave" > Paid Leave </option>
													<option value="unpaidLeave" > Unpaid Leave </option>
												</select>
											</div>
										</div>
									</div>
								</div>	 -->
		
		<script>
			// function closee() {
			// 	var paidLeaveDiv = document.getElementById('paidLeave');
			// 	paidLeaveDiv.style.display = 'none';
			// }
			
			var empId;
			$(document).ready(function () {
					var selectedValue;
					var dateclass;				
				$('.presentSelect').on('change', function () {
					selectedValue = $(this).val();
					empId = $(this).siblings('.empId').val();
					dateclass = $(this).closest('td').prev('td').find('.dateclass').val();

					var paidLeaveDiv = document.getElementById('paidLeave'.concat(empId));
					
					if (selectedValue === 'absent') {
						paidLeaveDiv.style.display = 'block';
					} else {
						paidLeaveDiv.style.display = 'none';
					}

					console.log(selectedValue, empId, dateclass);

					if(selectedValue !== 'absent') {
						$.ajax({
							url: 'updateAttendance.php',
							method: 'POST',
							data: { status: selectedValue, eid: empId, date: dateclass},
							success: function (response) {
								var data = JSON.parse(response);
								console.log(data);
								if (data.status === 'success') {
									toastr.success(data.message);
									$('.presentSelect').val('');
								} else {
									toastr.error(data.message);
									$('.presentSelect').val('');
								}
							},
							error: function (xhr, status, error) {
								console.error(error);
							}
						});
					}
				});
				
				var paidValue;
				$('.paidSelect').on('change', function () {
					paidValue = $(this).val(); 
					// console.log(paidValue);
					var paidLeaveDiv2 = document.getElementById('paidLeave'.concat(empId));
					if (paidValue === 'unpaidLeave' || paidValue === 'paidLeave') {
						paidLeaveDiv2.style.display = 'none';
					}
					console.log(selectedValue, empId, dateclass, paidValue);
					$.ajax({
						url: 'updateAttendance.php',
						method: 'POST',
						data: { status: selectedValue, eid: empId, date: dateclass, paidLeave: paidValue },
						success: function (response) {
							var data = JSON.parse(response);
							console.log(data);
							if (data.status === 'success') {
								toastr.success(data.message);
								$('.paidSelect').val('');
							} else {
								toastr.error(data.message);
								$('.paidSelect').val('');
							}
						},
						error: function (xhr, status, error) {
							console.error(error);
						}
					});
				});
			});
			function closee() {
				var paidLeaveDiv = document.getElementById('paidLeave'+empId);
				paidLeaveDiv.style.display = 'none';
			}
		</script>
    </body>
</html>