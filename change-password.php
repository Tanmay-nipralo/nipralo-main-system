<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
	<?php include './includes/header.php';
	$getemployee = getAllEmployee();
	// echo "<pre>";
	// print_r($getemployee);
	// echo "</pre>";
	// exit;
	$designation = getAllDesignation();
	$department = getAllDepartment();
	?>									
    <body>
     <div class="main-wrapper">	
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row" style="padding: 20px;">
                    <div class="card">
                    <div class="main-wrapper">
				<div class="account-content">
					<div class="account-box">
						<div class="account-wrapper">
                            
							<form method="post">
								<div class="input-block mb-3">
									<label class="col-form-label">Old password</label>
									<input type="password" name="currpass" class="form-control" required>
								</div>
								<div class="input-block mb-3">
									<label class="col-form-label">New password</label>
									<input type="password" name="newpass" class="form-control" required>
								</div>
								<div class="input-block mb-3">
									<label class="col-form-label">Confirm password</label>
									<input type="password" name="confpass" class="form-control" required>
								</div>
								<div class="submit-section mb-4">
									<button class="btn btn-primary submit-btn" type="submit" name="sub">Update Password</button>
								</div>
							</form>
                            </div>
						</div>
					</div>
				</div>
			</div>	
					</div>
                </div>
				
               
			
        </div>
		<?php include './includes/footer.php'?>
    </body>
</html>

<?php
    $userId =$getCount['id']; 
    $var="select * from employees where id = $userId";

    $query=mysqli_query($conn,$var);
    $result=mysqli_fetch_array($query);    
    $pre_pass=$result['password'];

    if(isset($_POST['sub'])){
        $currpass=$_POST['currpass'];
        if(password_verify($currpass, $pre_pass)){

            if($_POST['newpass'] == $_POST['confpass']){

                $newpass=password_hash($_POST['newpass'], PASSWORD_DEFAULT);
                
                $pass="UPDATE `employees` SET `password`='$newpass' WHERE id = $userId";
                var_dump($pass);

                $relt = mysqli_query($conn, $pass);

                if($relt){
                ?>
                <script>
                   
                    toastr.success('Password Changed Successfully!');
              setTimeout(function() {
               window.location = "change-password.php";
              }, 1000);
                </script>
                <?php
                }
                else{
                ?>
                <script>
                    
                    toastr.error('Password Not Changed!');
              setTimeout(function() {
               window.location = "change-password.php";
              }, 1000);
                </script>
                <?php
                }                
            }
            else{
            ?>
            <script>
               
                toastr.error('Please Check Confirm password!');
              setTimeout(function() {
               window.location = "change-password.php";
              }, 1000);
            </script>
            <?php
            }    
        }
        else{
            ?>
            <script>
               
                toastr.error('Check Your old password!');
              setTimeout(function() {
               window.location = "change-password.php";
              }, 1000);
            </script>
            <?php
        }     
    }
?>
