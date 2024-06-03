<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<?php include './includes/header.php';
		include './includes/connection.php';
	$employee = getAllEmployee();
	$attendance = getAllAttendence();
	// $attendancem = getAttendenceByMonth(05);
	// $attendance = getAttendenceByDate(date('Y-m-d'));

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
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table table-nowrap mb-0" id="attendance-table">
									<thead>
										<tr>
											<th>Employee Id</th>
											<th>Employee Name</th>
											<th>Present</th>
											<th>Absent</th>
											<th>Paid Leave</th>
											<th>total Paid Leave</th>
											<th>Paid Leaves Left</th>
											<th>Total days(Present + Absent)</th>
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
        </div>
		<?php include './includes/footer.php';?>

	<script>
		$(document).ready(function() {
			function fetchAttendance(selectedMonth) {
				$.ajax({
					url: 'paidleave.php',
					method: 'GET',
					data: { month: selectedMonth },
					success: function(response) {
						// console.log("selectedMonth==>",selectedMonth)
						console.log("Res==>",response)
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
				console.log("Month Selected==>",selectedMonth)
				if (selectedMonth !== '') {
					fetchAttendance(selectedMonth);
				}
			});
		});
	</script>
	
    </body>
</html>