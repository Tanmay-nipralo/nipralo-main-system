<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
include './includes/connection.php';?>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Add Candidates</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Add Candidates</li>
								</ul>
							</div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Add Candidates</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Number</label>
                                            <input type="number" name="number" class="form-control">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Email</label>
                                            <input  type="email" name="email" class="form-control">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Platform</label>
                                            <select class="form-control" name="ftype">
                                                <option value="linkedin">linkedin</option>
                                                <option value="Naukari.com">Naukari.com</option>
                                                <option value="Indeed">Indeed</option>
                                            </select>
                                        </div>
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Job Role</label>
                                            <select class="form-control" name="jtype">
                                                <option value="Backend Developer">Backend Developer</option>
                                                <option value="Fronted Developer">Frontend Developer</option>
                                                <option value="web designer">web designer</option>
                                            </select>
                                        </div>
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Link</label>
                                            <input type="text" name="link" class="form-control" value="https://vendormodule/addcan.php/" readonly>
                                        </div>
                                        <div class="text-end">
                                             <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- <?php include './includes/setting.php'?> -->

		<?php include './includes/footer.php'?>
		
    </body>
</html>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $ftype = $_POST['ftype'];
    $pos = $_POST['jtype'];
    $link = $_POST['link'];
    $created_time = date('Y-m-d H:i:s');
    $insertquery = "INSERT INTO `candidate`( `name`, `email`, `number`, `ftype`, `jtype`, `link`,`created_at`,`updated_at`) VALUES ('$name','$email','$number','$ftype','$pos','$link','$created_time','$created_time')";
    var_dump($insertquery);
    $iquery = mysqli_query($conn, $insertquery);
    $nameurl = urlencode("$name");
    $ftypeurl = urlencode("$ftype");
    $positionurl = urlencode("$pos");
    $linkurl = urlencode("$link");

    $url = "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number={$number}&message=Dear%20{$nameurl},%20We%20are%20glad%20that%20you%20have%20applied%20on%20{$ftypeurl}%20for%20the%20position%20of%20{$positionurl}.%20We%20would%20like%20to%20know%20a%20few%20more%20details%20about%20you.%20Kindly%20click%20on%20the%20below%20link%20to%20update:%20{$linkurl}%20Regards,%20Big%20Dreams%20Team&format=json";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);

    var_dump($url);


    if ($iquery) {
?>
        <script>
            toastr.success('Added Successfully!');
			setTimeout(function() {
			window.location = "add-candidates.php";
			}, 1000);
        </script>
    <?php
    } else {
    ?><script>
           toastr.error('Error!');
			setTimeout(function() {
			window.location = "add-candidates.php";
			}, 1000);
        </script><?php
                };
            }
                    ?>