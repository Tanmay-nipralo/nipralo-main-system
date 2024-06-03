<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
include './includes/connection.php';

$getsalary = getAllSalaryInfo();
$employee = getAllEmployee();
if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
 <style>   
 .ui-datepicker-calendar {
        display: none;
    }
    </style>
    <body>
        <div class="main-wrapper">		
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-auto float-end ms-auto">
								<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_salary"><i class="fa-solid fa-plus"></i>Generate Salary</a>
							</div>
						</div>
					</div>
					<div class="row filter-row">
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="input-block mb-3 form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="input-block mb-3 form-focus select-focus">
								<select class="select floating"> 
									<option value=""> -- Select -- </option>
									<option value="">Employee</option>
									<option value="1">Manager</option>
								</select>
								<label class="focus-label">Role</label>
							</div>
					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
							<div class="input-block mb-3 form-focus select-focus">
								<select class="select floating"> 
									<option> -- Select -- </option>
									<option> Pending </option>
									<option> Approved </option>
									<option> Rejected </option>
								</select>
								<label class="focus-label">Leave Status</label>
							</div>
					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="input-block mb-3 form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" type="text">
								</div>
								<label class="focus-label">From</label>
							</div>
						</div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="input-block mb-3 form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" type="text">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<a href="#" class="btn btn-success w-100"> Search </a>  
						</div>     
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Employee</th>
											<th>Employee ID</th>
											<th>Email</th>
											<th>Join Date</th>
											<th>Role</th>
											<th>Salary</th>
											<th>Payslip</th>
											<th class="text-end">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($getsalary as $salary){ ?>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="profile.php" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt="User Image"></a>
													<a href="profile.php"><?php echo $salary['employee'][0]['first_name'] ?> <?php echo $salary['employee'][0]['last_name'] ?></a>
												</h2>
											</td>
											<td><?php echo $salary['employee'][0]['id'] ?></td>
											<td><a href="profile.php"><?php echo $salary['employee'][0]['mail'] ?></a></td>
											<td><?php echo $salary['employee'][0]['joining_date'] ?></td>
											<td>
											<?php echo $salary['designation'][0]['designation'] ?>
											</td>
											<td><?php echo $salary['salary_amount'] ?></td>
											<td><a class="btn btn-sm btn-primary generate-slip-btn" data-bs-toggle="modal" data-bs-target="#generate_slip<?php echo $salary['employee'][0]['id'] ?>" data-employee-id="<?php echo $salary['employee'][0]['id'] ?>">Generate Slip</a></td>
											<td class="text-end">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_salary"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_salary"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
													</div>
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
			
				<div id="add_salary" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Staff Salary</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="salary.php">
									<div class="row"> 
										<div class="col-sm-6"> 
											<div class="input-block mb-3">
												<label class="col-form-label">Select Staff</label>
												<select class="select"> 
													<option>John Doe</option>
													<option>Richard Miles</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">Net Salary</label>
											<input class="form-control" type="text">
										</div>
									</div>
									<div class="row"> 
										<div class="col-sm-6"> 
											<h4 class="text-primary">Earnings</h4>
											<div class="input-block mb-3">
												<label class="col-form-label">Basic</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">DA(40%)</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">HRA(15%)</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Conveyance</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Allowance</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Medical  Allowance</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Others</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">  
											<h4 class="text-primary">Deductions</h4>
											<div class="input-block mb-3">
												<label class="col-form-label">TDS</label>
												<input class="form-control" type="text">
											</div> 
											<div class="input-block mb-3">
												<label class="col-form-label">ESI</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">PF</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Leave</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Prof. Tax</label>
												<input class="form-control" type="text">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Labour Welfare</label>
												<input class="form-control" type="text">
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<?php foreach($getsalary as $salary1){ ?>
				<div id="generate_slip<?php echo $salary1['employee'][0]['id']?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Staff Salary</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="row"> 
									<div class="col-sm-6"> 
									<div class="input-block mb-3">
											<label class="col-form-label">Employee Name</label>
											<input class="form-control" type="text" name="emp_name" value="<?php echo $salary1['employee'][0]['first_name'] ?> <?php echo $salary1['employee'][0]['last_name'] ?>">
										</div>
									</div>
										<div class="col-sm-6"> 
										<div class="input-block mb-3">
											<label class="col-form-label">Net Salary</label>
											<input class="form-control net-salary" type="text" name="net_salary" id="net_salary" required value="<?php echo $salary1['salary_amount'] ?>">

										</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
											<label class="col-form-label">Year</label>
											<input class="form-control yearpicker" name="year">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-block mb-3">
											<label class="col-form-label">Month</label>
											<input class="form-control monthpicker" name="month">
											</div>
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">No of Days in Month</label>
											<input class="form-control month_day" type="text" name="month_day">
										</div>

										<div class="col-sm-6"> 
											<div class="input-block mb-3">
												<label class="col-form-label">Leaves Status</label>
												<select class="select" name="leave_status"> 
												<option value="">Select</option>
													<option value="Paid">Paid</option>
													<option value="Unpaid">Unpaid</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">No of Leaves</label>
											<input class="form-control" type="text" name="no_leaves">
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">Basic(50%)</label>
											<input class="form-control basic" id="basic" type="text" name="basic">
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">House Rent Allowence(40%)</label>
											<input class="form-control hr_allowance" type="text" name="hr_allowance">
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">Conveyance Allownce(10%)</label>
											<input class="form-control convey" type="text" name="convey">
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">Total</label>
											<input class="form-control total" type="text" name="total">
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">Incentive</label>
											<input class="form-control" type="text" name="incentive">
										</div>
										<div class="col-sm-12"> 
											<label class="col-form-label">Net Payable Rs.</label>
											<input class="form-control netpayable" type="text" name="net_payable">
										</div>
									</div>
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" name="submit" type="submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div id="edit_salary" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Staff Salary</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="salary.php">
									<div class="row"> 
										<div class="col-sm-6"> 
											<div class="input-block mb-3">
												<label class="col-form-label">Select Staff</label>
												<select class="select"> 
													<option>John Doe</option>
													<option>Richard Miles</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6"> 
											<label class="col-form-label">Net Salary</label>
											<input class="form-control" type="text" value="$4000">
										</div>
									</div>
									<div class="row"> 
										<div class="col-sm-6"> 
											<h4 class="text-primary">Earnings</h4>
											<div class="input-block mb-3">
												<label class="col-form-label">Basic</label>
												<input class="form-control" type="text" value="$6500">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">DA(40%)</label>
												<input class="form-control" type="text" value="$2000">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">HRA(15%)</label>
												<input class="form-control" type="text" value="$700">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Conveyance</label>
												<input class="form-control" type="text" value="$70">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Allowance</label>
												<input class="form-control" type="text" value="$30">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Medical  Allowance</label>
												<input class="form-control" type="text" value="$20">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Others</label>
												<input class="form-control" type="text">
											</div>  
										</div>
										<div class="col-sm-6">  
											<h4 class="text-primary">Deductions</h4>
											<div class="input-block mb-3">
												<label class="col-form-label">TDS</label>
												<input class="form-control" type="text" value="$300">
											</div> 
											<div class="input-block mb-3">
												<label class="col-form-label">ESI</label>
												<input class="form-control" type="text" value="$20">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">PF</label>
												<input class="form-control" type="text" value="$20">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Leave</label>
												<input class="form-control" type="text" value="$250">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Prof. Tax</label>
												<input class="form-control" type="text" value="$110">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Labour Welfare</label>
												<input class="form-control" type="text" value="$10">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Fund</label>
												<input class="form-control" type="text" value="$40">
											</div>
											<div class="input-block mb-3">
												<label class="col-form-label">Others</label>
												<input class="form-control" type="text" value="$15">
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
<?php include './includes/footer.php'?>
  <script>
    // $(document).ready(function () {
	// 	$('.generate-slip-btn').on('click', function() {
	// 		var employeeId = $(this).data('employee-id');

	// 		var modal = $('#generate_slip' + employeeId);

	// 		modal.find('.yearpicker').datetimepicker({
	// 			viewMode: 'years',
	// 			format: 'YYYY',
	// 		}).on('dp.change', function (e) {
	// 			updateDaysInMonth(modal.find('.monthpicker').data('DateTimePicker').date(), e.date, employeeId);
	// 		});

	// 		modal.find('.monthpicker').datetimepicker({
	// 			viewMode: 'months',
	// 			format: 'MMMM',
	// 		}).on('dp.change', function (e) {
	// 			updateDaysInMonth(e.date, modal.find('.yearpicker').data('DateTimePicker').date(), employeeId);
	// 		});
	// 	});

	// 	$(document).on('shown.bs.modal', '.modal', function () {
	// 		var modal = this;
	// 		calculateAllowances(modal);
	// 	});


	// 	function updateDaysInMonth(selectedMonth, selectedYear, employeeId) {
	// 		if (selectedMonth && selectedYear) {
	// 			var daysInMonth = moment(selectedYear).month(selectedMonth.month()).daysInMonth();
	// 			console.log("day===>", daysInMonth);
	// 			$('#generate_slip' + employeeId).find('.month_day').val(daysInMonth);
	// 		}
	// 	}


    //     function calculateAllowances(modal) {
    //         var netSalary = parseFloat(modal.querySelector('.net-salary').value);
    //         var basic = (50 / 100) * netSalary;
    //         modal.querySelector('.basic').value = basic.toFixed(2);

    //         var hra = (40 / 100) * netSalary;
    //         modal.querySelector('.hr_allowance').value = hra.toFixed(2);

    //         var conveyance = (10 / 100) * netSalary;
    //         modal.querySelector('.convey').value = conveyance.toFixed(2);

	// 		var leaveStatus = modal.find('select[name="leave_status"]').val();
    //     if (leaveStatus === 'Unpaid') {
    //         var noLeaves = parseFloat(modal.find('input[name="no_leaves"]').val());
    //         var total = (netSalary / modal.find('.month_day').val()) * noLeaves;
    //         modal.find('.total').val(total.toFixed(2));
    //     } else {
    //         var total = netSalary;
    //         modal.find('.total').val(total.toFixed(2));
    //     }

    //     }
    // });


	$(document).ready(function () {
    $('.generate-slip-btn').on('click', function () {
        var employeeId = $(this).data('employee-id');
        var modal = $('#generate_slip' + employeeId);

        modal.find('.yearpicker').datetimepicker({
            viewMode: 'years',
            format: 'YYYY',
        }).on('dp.change', function (e) {
            updateDaysInMonth(modal.find('.monthpicker').data('DateTimePicker').date(), e.date, employeeId);
        });

        modal.find('.monthpicker').datetimepicker({
            viewMode: 'months',
            format: 'MMMM',
        }).on('dp.change', function (e) {
            updateDaysInMonth(e.date, modal.find('.yearpicker').data('DateTimePicker').date(), employeeId);
        });

        modal.find('select[name="leave_status"]').on('change', function () {
            calculateTotal(modal);
        });

        // Listen for input event on no_leaves field
        modal.find('input[name="no_leaves"]').on('input', function () {
            calculateTotal(modal);
        });

		modal.find('input[name="incentive"]').on('change', function () {
            calculateNetPayable(modal);
        });

		// modal.find('input[name="total"]').on('change', function () {
		// 	console.log('ffff');
        //     calculateNetPayable(modal);
        // });
    });

    $(document).on('shown.bs.modal', '.modal', function () {
        var modal = $(this);
        calculateAllowances(modal);
    });

    function updateDaysInMonth(selectedMonth, selectedYear, employeeId) {
        if (selectedMonth && selectedYear) {
            var daysInMonth = moment(selectedYear).month(selectedMonth.month()).daysInMonth();
            console.log("day===>", daysInMonth);
            $('#generate_slip' + employeeId).find('.month_day').val(daysInMonth);
        }
    }

    function calculateAllowances(modal) {
        var netSalary = parseFloat(modal.find('.net-salary').val());
        var basic = (50 / 100) * netSalary;
        modal.find('.basic').val(basic.toFixed(2));

        var hra = (40 / 100) * netSalary;
        modal.find('.hr_allowance').val(hra.toFixed(2));

        var conveyance = (10 / 100) * netSalary;
        modal.find('.convey').val(conveyance.toFixed(2));
    }

    function calculateTotal(modal) {
        var netSalary = parseFloat(modal.find('.net-salary').val());
        var leaveStatus = modal.find('select[name="leave_status"]').val();
       
        if (leaveStatus === 'Unpaid') {
            var noLeaves = parseFloat(modal.find('input[name="no_leaves"]').val());
            var daysInMonth = parseFloat(modal.find('.month_day').val());
            var total1 = (netSalary / daysInMonth) * noLeaves;
            var total = netSalary - total1;
            modal.find('.total').val(total.toFixed(2));
        } else {
            var total = netSalary;
            modal.find('.total').val(total.toFixed(2));
        }
    }



		function calculateNetPayable(modal) {
			var totalamount = parseFloat(modal.find('input[name="total"]').val());
			console.log(totalamount);
			var incentive = parseFloat(modal.find('input[name="incentive"]').val());
			console.log(incentive);
			var netPayable = totalamount + incentive;
			console.log(netPayable);
			modal.find('.netpayable').val(netPayable.toFixed(2));
		}

});
</script>
 </body>	
</html>
<?php
if(isset($_POST['submit'])){
	$emp_name =$_POST['emp_name'];
	$net_salary =$_POST['net_salary'];
	$year =$_POST['year'];
	$month =$_POST['month'];
	$month_day =$_POST['month_day'];
	$leave_status =$_POST['leave_status'];
	$no_leaves =$_POST['no_leaves'];
	$basic =$_POST['basic'];
	$hr_allowance =$_POST['hr_allowance'];
	$convey =$_POST['convey'];
	$total =$_POST['total'];
	$incentive =$_POST['incentive'];
	$net_payable =$_POST['net_payable'];
     $update_time = date('Y-m-d H:i:s');
	$query = "INSERT INTO `salary_slip`(`emp_id`, `employee_name`, `net_salary`, `year`, `month`, `month_days`, `leave_status`, `no_leaves`, `basic`, `house_eallowance`, `convry_allowance`, `total`, `incentive`, `net_payable_amount`, `created_at`) VALUES (1,'$emp_name','$net_salary','$year','$month','$month_day','$leave_status','$no_leaves','$basic','$hr_allowance','$convey','$total','$incentive','$net_payable','$update_time')";
    var_dump($query);
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		$lastInsertedID = mysqli_insert_id($conn);
		$pdf = generatePDF($lastInsertedID);
		$update ="UPDATE `salary_slip` SET `pdf`='$pdf' WHERE id=$lastInsertedID";
		$update1 = mysqli_query($conn, $update);
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		window.location = "salary.php";
		}, 1000);
	</script>
	<?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		window.location = "salary.php";
		}, 1000);
	</script>
	<?php
	}
}
?>

