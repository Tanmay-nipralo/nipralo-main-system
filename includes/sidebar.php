<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
				<ul class="sidebar-vertical">
						<?php if ($getCount['employee_type'] == "Admin") {?>
								<li><a class="active" href="index.php"><i class="la la-user-shield"></i>
									<span>Admin Dashboard</span></a></li>
								<?php
							} else {
								?>
								<li><a href="employee-dashboard.php"><i class="la la-user"></i>
									<span>Employee Dashboard</span></a></li>
								<?php
							}
							?>
							<?php if ($getCount['employee_type'] == "Admin") {?>
							<li> 
								<a href="clients.php"><i class="la la-users"></i> <span>Clients</span></a>
							</li>
							

							<li class="submenu">
								<a href="#"><i class="la la-rocket"></i> <span> Projects </span> <span class="menu-arrow"></span></a>
								<ul>
								<li><a href="projects.php">All Projects</a></li>
								<li><a href="project-report.php">Projects Report</a></li>
								<li><a href="assignbyproject.php">Assigned By Project</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="la la-money"></i> <span> HR </span> <span class="menu-arrow"></span></a>
								<ul>
								<li><a href="attendance-employee.php">Attendance (Employee)</a></li>
								<li><a href="attendance.php">Attendance (Admin)</a></li>
								<li><a href="attendance-paidleave.php">Attendance (Paid Leave)</a></li>
								<li><a href="salary.php"> Employee Salary </a></li>
								<li><a href="career.php">Career</a></li>
								</ul>
							</li>
							
							
							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Candidates</span> <span class="menu-arrow"></span></a>
								<ul>
								<!-- <li><a href="add-candidates.php">Add Candidates</a></li>
									<li><a href="new-candidates.php">New Candidates</a></li> -->
									<li><a href="applied-candidates.php">Applied Candidates</a></li>	
									<li><a href="accurate-candidates.php">Acurate Fit Candidates</a></li>
									<li><a href="best-candidates.php">Best Fit Candidates</a></li>
									<li><a href="ok-candidates.php">Ok Fit Candidates</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> System</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="add-system.php">Add System</a></li>
									<li><a href="all-system.php">All System</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Masters</span> <span class="menu-arrow"></span></a>
								<ul>
								<li><a href="departments.php">Departments</a></li>
									<li><a href="designations.php">Designations</a></li>
									<li><a href="assets.php">Assets</a></li>	
									<li><a href="vendor-shop.php">Vendor Shop</a></li>
									<li><a href="hardware.php">Hardware</a></li>
								</ul>
							</li>

							<?php } ?>
							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
								<ul>
								<?php if ($getCount['employee_type'] == "Admin") {?>
									<li><a href="employees.php">All Employees</a></li>
									<!-- <li><a href="attendance.php">Attendance (Admin)</a></li> -->
								<?php } ?>
									<li><a href="holidays.php">Holidays</a></li>
									<?php if ($getCount['employee_type'] == "Employee") {?>
									<li><a href="daily_task.php">Daily Task</a></li>
									<li><a href="completed_task_report.php">Completed Task Report</a></li>
									<li><a href="Assigned_project.php">Assigned Project</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php if ($getCount['employee_type'] == "Admin") {?>
							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Website Bigdreams</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="contact.php">Contact</a></li>
									<li><a href="enquiry.php">Enquiry</a></li>
									<li><a href="website_enquiry.php">Website Enquiry</a></li>
								</ul>
							</li>

							
							<!-- <li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Website Enquiry Nipralo</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="departments.php"></a></li>
									<li><a href="designations.php">Nipralo</a></li>
								</ul>
							</li> -->
							<?php } ?>
							<li>
								<a href="change-password.php"><i class="la la-rocket"></i> <span> Change Password</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
           