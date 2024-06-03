<?php
	include './includes/connection.php';

	if (isset($_COOKIE['access_token'])) {
		$query1 = "SELECT * FROM `employees` WHERE emp_token = '{$_COOKIE['access_token']}' AND status !=5";
		$result1 = mysqli_query($conn, $query1);
		$row1 = mysqli_fetch_assoc($result1);

		if ($row1['employee_type'] == 'Admin') {
			echo "<script>window.location = 'admin-dashboard.php';</script>";
		}else {
			echo "<script>window.location = 'employee-dashboard.php';</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<title>Nipralo Dashboard</title>
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		<!-- Lineawesome CSS -->
		<link rel="stylesheet" href="assets/css/line-awesome.min.css">
		<link rel="stylesheet" href="assets/css/material.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
		<style>
			.edit-button {
				display: flex;
				position: absolute;
				right: 52px;
				justify-content: space-around;

				width: 6%;
			}

			img {
				width: 250px !important;
			}
		</style>
	</head>

	<body class="account-page">
		<!-- Main Wrapper -->
		<div class="main-wrapper">
			<div class="account-content">
				<div class="container">
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.php"><img src="assets/img/nipralo_logo.png" alt="Nipralo"></a>
					</div>
					<!-- /Account Logo -->
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>

							<!-- Account Form -->
							<form method="POST">
								<div class="input-block mb-4">
									<label class="col-form-label">Email Address</label>
									<input class="form-control" type="email" name="mail">
								</div>
								<div class="input-block mb-4">
									<div class="row align-items-center">
										<div class="col">
											<label class="col-form-label">Password</label>
										</div>
									</div>
									<div class="position-relative">
										<input class="form-control" type="password" name="password">
										<span class="fa-solid fa-eye-slash" id="toggle-password"></span>
									</div>
								</div>

								<div class="input-block mb-4 text-center">
									<button class="btn btn-primary account-btn" type="submit" name="login">Login</button>
								</div>
							</form>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	</body>
</html>

<?php
	if (isset($_POST['login'])) {
		$user = mysqli_real_escape_string($conn, $_POST['mail']);
		$pass = mysqli_real_escape_string($conn, $_POST['password']);
		
		$query = "SELECT * FROM `employees` WHERE mail = '$user' AND status !=5";
		$result = mysqli_query($conn, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			$userrole = mysqli_fetch_assoc($result);
			$dbpas = $userrole['password'];
			if (password_verify($pass, $dbpas)) { ?>
				<script>
					var expirationDate = new Date();
					expirationDate.setHours(expirationDate.getHours() + 12);
					document.cookie = "access_token=" + '<?php echo $userrole['emp_token']; ?>' + "; expires=" + expirationDate.toUTCString() + "; path=/";
					<?php if ($userrole['employee_type'] == 'Admin') { ?>
						window.location.href = "admin-dashboard.php";
					<?php } else { ?>
						window.location.href = "index.php";
					<?php } ?>
					toastr.success('Login Successfully!');
				</script> <?php
			} else {
				?>
				<script>
					toastr.error('Incorrect password. Please try again.');
				</script>
				<?php
			}
		} else {?>
			<script>
				toastr.error('Username not found.');
			</script>
			<?php
		}
	}
?>