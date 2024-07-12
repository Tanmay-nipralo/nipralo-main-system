<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php
include './includes/header.php';
if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	table td:not(:first-child) a {
		color: #333333;
    /* border: 1px solid gray; */
    border-radius: 20px;
    padding: 4px 10px;
    font-size: 10px;
    font-weight: 50;
    text-align: center;
    max-width: 400px;
    background-color: #e7fbff;
    box-shadow: 1px 1px 1px 1px #80808078;
}
table{
	position: relative;
}
table td{
	white-space: nowrap !important;
}
table th:nth-child(1){
	position: sticky;
	left: 0;
}
table td:nth-child(1){
	position: sticky;
	left: 0;
}
table thead tr{
	position: sticky;
	top: 0;
}
/*.top-wrapper{
	position: fixed;
	top: 0;
	width: 100%;
	height: 100%;
	z-index: 2;
}*/
</style>
<body>
	<div class="main-wrapper">
		<?php include './includes/navbar.php' ?>
		<?php include './includes/sidebar.php' ?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="top-wrapper">
					<div class="row filter-row" style="justify-content: end;">
						<div class="col-sm-3">
							<div class="input-block mb-3 form-focus select-focus">
								<select class="select floating" id="month-select">
									<option>Select Month</option>
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="d-grid">
								<a href="#" class="btn btn-success" id="search-btn"> Search </a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table table-nowrap mb-0" id="attendance-table">
								<thead>
									<tr>
										<th>Employee</th>
										<?php
										$numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
										for ($day = 1; $day <= $numDaysInMonth; $day++) {
											echo "<th>$day</th>";
										}
										?>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

		</div>
		<!-- Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<?php include './includes/footer.php' ?>

	<script>
		$(document).ready(function() {
			function fetchAttendance(selectedMonth) {
				$.ajax({
					url: 'project_script.php',
					method: 'GET',
					data: { month: selectedMonth },
					success: function(response) {
						// console.log("Res==>",response)
						$('#attendance-table tbody').html(response);
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			}

			var currentMonth = ('0' + (new Date().getMonth() + 1)).slice(-2);
			
			fetchAttendance(currentMonth);

			$('#search-btn').click(function(e) {
				e.preventDefault();
				var selectedMonth = $('#month-select').val();
				// console.log("Month Selected==>",selectedMonth)
				if (selectedMonth !== '') {
					fetchAttendance(selectedMonth);
				}
			});
		});
	</script>
</body>
</html>