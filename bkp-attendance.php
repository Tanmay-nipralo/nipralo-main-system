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
	</style>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Attendance</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Attendance</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row filter-row" style="justify-content: end;">
						<div class="col-sm-6 col-md-3">  
							<div class="input-block mb-3 form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<div class="d-grid">
								<a href="#" class="btn btn-success"> Search </a>  
							</div>
						</div>     
                    </div>	
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
													<option>Select Remark</option>
													<option value="present" <?php //if ($attendance) { echo isSelected($attendance, $emp['id'], 'present');} ?>>Present</option>
													<option value="absent" <?php //if ($attendance) { echo isSelected($attendance, $emp['id'], 'absent');}?>>Absent</option>
													<option value="half_day" <?php //if ($attendance) { echo isSelected($attendance, $emp['id'], 'half_day');}?>>Half Day</option>
												</select>

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
		<?php include './includes/setting.php';?>
		<?php include './includes/footer.php';?>	
		<script>
			$(document).ready(function () {
				$('.presentSelect').on('change', function () {
					var selectedValue = $(this).val();
					var empId = $(this).siblings('.empId').val();
					var dateclass = $(this).closest('td').prev('td').find('.dateclass').val();

					$.ajax({
						url: 'updateAttendance.php',
						method: 'POST',
						data: { status: selectedValue, eid: empId, date: dateclass},
						success: function (response) {
							var data = JSON.parse(response);
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

				});
			});
		</script>
    </body>
</html>