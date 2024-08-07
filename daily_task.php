<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php'?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<?php include './includes/connection.php';
$date = date('Y-m-d');
$employee_id = $getCount['id'];
$getdailytask = getDailyTask($employee_id,$date);
$getextratask = getExtraTaskById($employee_id,$date);
$viewextratask = viewExtraTaskById($employee_id,$date);
//   echo "<prev>";
//       print_r($getextratask);
//       "</prev>";
//       exit;
?>
    <body>
        <div class="main-wrapper">	
		<?php include './includes/navbar.php'?>		
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
                            <?php if (empty($viewextratask)) {?>
                            <div class="col-auto float-end">
                                <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_task"><i class="fa-solid fa-plus"></i>Add Extra Task</a>
							</div>
                            <?php } ?>
                            <?php if (!empty($viewextratask)) {?>
                            <div class="col-auto float-end">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#view_task<?php echo $viewextratask['id']?>"><i class="fa-solid fa-plus"></i>View Extra Task</a>
							</div>
                            <?php } ?>
							<div class="col-auto float-end ms-auto">
                                <form method="post" onsubmit="return confirmSendMail();">
								<button type="submit" name="send" class="btn add-btn"><i class="fa-solid fa-plus"></i> Send Mail</button>
                                </form>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Employee Name</th>
                                            <th>Project Name</th>
                                            <th>Main Task</th>
                                            <th>Sub Task</th>
											<th>Status</th>
                                            <th>Date</th>
                                            <th>Note</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									<?php
							  		 $i=1;
								   foreach($getdailytask as $dailytask) { ?>
										<tr class='holiday-upcoming'>
										 <td><?php echo $i++ ?></td>
											<td><?php echo $dailytask['employee'][0]['first_name'] ?></td>
											<td><?php echo $dailytask['project'][0]['project_name'] ?></td>
                                            <td><?php echo $dailytask['main_task'][0]['tittle'] ?></td>
                                            <td><?php echo $dailytask['subtask'][0]['tittle'] ?></td>
                                            <td><?php
                                             $status = $dailytask['status'];
                                             switch ($status) {
                                                 case 1:
                                                     echo 'Completed';
                                                     break;
                                                 case 0:
                                                     echo 'Pending';
                                                     break;
                                                 case 2:
                                                     echo 'New';
                                                     break;
                                                 case 3:
                                                     echo 'Hold';
                                                     break;
                                                 case 4:
                                                     echo 'TBD';
                                                     break;
                                                 default:
                                                     echo 'Unknown Status';
                                                     break;
                                             }
                                              ?></td>
                                            <td><?php echo $dailytask['created_at'] ?></td>
                                            <td><a href="#" style="color:white;" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#edit_holiday<?php echo $dailytask['id'] ?>"><i class="fa-solid fa-plus"></i>Add Note</a></td>
										 <td>
												<a class='dropdown-item' href='daily_task.php?deleteid=<?php echo $dailytask['id'] ?>'><i class='fa-regular fa-trash-can m-r-5'></i></a>
										</td>
										</tr>
								        <?php } ?>		
									</tbody>
								</table>
							</div>
						</div>
					</div>

                    <?php if (!empty($viewextratask)) {?>
                    <div class="row">
						<div class="col-md-12">
							<div class="card" style="padding: 20px;margin-top: 30px;">
                            <h4 class="modal-title"> Extra Task</h4>
                            <?php echo $viewextratask['description']?>
							</div>
						</div>
					</div>
                        <?php } ?>
                </div>

                <div class="modal custom-modal fade" id="add_task" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Extra Task</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
                                <div class="input-block mb-3">
                                   <label for="name-1" class="col-form-label"> Description :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
                                   <textarea id="description1" class="form-control" type="text" name="description" placeholder="Description" required></textarea>
                                   <input name="empid" type="hidden" value="<?php echo $employee_id;?>">
                                </div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="sub">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

                <div class="modal custom-modal fade" id="view_task<?php echo $viewextratask['id']?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Extra Task</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
                                <div class="input-block mb-3">
                                   <label for="name-1" class="col-form-label"> Description :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
                                   <textarea id="description2" class="form-control" type="text" name="description" placeholder="Description" required><?php echo $viewextratask['description']?></textarea>
                                   <input name="extra_id" type="hidden" value="<?php echo $viewextratask['id']?>">
                                </div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="edit">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<?php foreach($getdailytask as $holiday1) {?>
				<div class="modal custom-modal fade" id="edit_holiday<?php echo $holiday1['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Note</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post">
                                <div class="input-block mb-3">
                                   <label for="name-1" class="col-form-label"> Description :<sup><i class=" icon icon-asterisk star-req"></i></sup> </label>
                                   <input type="hidden" name="idd" value="<?php echo $holiday1['id'];?>">
                                   <textarea id="description" class="form-control" type="text" name="description" placeholder="Description" value="" required><?php echo $holiday1['description'];?></textarea>
                                </div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="update">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
            </div>
        </div>
	<?php include './includes/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
   $(document).ready(function() {
      $('#description').summernote({
         toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']], // This line removes the font style option
          ['para', ['ul', 'ol']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
      });   
      $('#description1').summernote({
         toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']], // This line removes the font style option
          ['para', ['ul', 'ol']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
      });   
      $('#description2').summernote({
         toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']], // This line removes the font style option
          ['para', ['ul', 'ol']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
      });  
   });
</script>

<script>
    function confirmSendMail() {
        return confirm("Are you sure you want to send the mail?");
    }
</script>
<?php 
date_default_timezone_set('Asia/Kolkata');
require 'vendor/vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['update'])){
	$id =$_POST['idd'];
    $description = preg_replace("/'/", "\'", $_POST['description']);
     $update_time = date('Y-m-d H:i:s');
	$query = "UPDATE daily_task  SET description = '$description',update_at ='$update_time' WHERE id = ".$id;
    var_dump($query);
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		window.location = "daily_task.php";
		}, 1000);
	</script>
	<?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		window.location = "daily_task.php";
		}, 1000);
	</script>
	<?php
	}
}

if(isset($_POST['sub'])){
    $employee_id = $_POST['empid'];
    $description = preg_replace("/'/", "\'", $_POST['description']);
     $update_time = date('Y-m-d H:i:s');
	$query = "INSERT INTO `extra_task`(`emp_id`, `description`, `created_at`) VALUES ('$employee_id','$description','$update_time')";
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Added Successfully!');
		setTimeout(function() {
		window.location = "daily_task.php";
		}, 1000);
	</script>
	<?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		window.location = "daily_task.php";
		}, 1000);
	</script>
	<?php
	}
}

if(isset($_POST['edit'])){
    $task_id = $_POST['extra_id'];
    $description = preg_replace("/'/", "\'", $_POST['description']);
     $update_time = date('Y-m-d H:i:s');
	$query = "UPDATE `extra_task` SET `description`='$description',`created_at`='$update_time' WHERE `id`='$task_id'";
	$iquery = mysqli_query($conn, $query);
	if ($iquery) {
		?>
		<script>
		toastr.success('Updated Successfully!');
		setTimeout(function() {
		window.location = "daily_task.php";
		}, 1000);
	</script>
	<?php
	} else {
		?>
		<script>
		toastr.error('Error!');
		setTimeout(function() {
		window.location = "daily_task.php";
		}, 1000);
	</script>
	<?php
	}
}

//mail send

if (isset($_POST['send'])) {
    if(!empty($getdailytask) || !empty($getextratask)){
        $sql= "SELECT * FROM employees WHERE id = $employee_id";
        $sql1 = mysqli_query($conn ,$sql);
        $sql2 = mysqli_fetch_assoc($sql1);
        require 'vendor/vendor/phpmailer/phpmailer/src/Exception.php';
        require 'vendor/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'vendor/vendor/phpmailer/phpmailer/src/SMTP.php';
    
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'systems.bigdreams@gmail.com';
            $mail->Password = 'bffm iuoi zgnh cwcn';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->setFrom($sql2['mail']);
             $mail->addAddress('nishant@nipralo.com','', 'Nishant');
              $mail->addAddress('vinita@nipralo.com', 'Vinita');
            //   $mail->addAddress('pooja.d@nipraalo.com', 'Nipralo');
    
            $mail->isHTML(true);
            $dates = date('d-m-Y h:i A');
            // $dates = date('Y-m-d H:i:s');
            // $mail->Subject = 'Daily Task Report ' . $dates . ',' . $sql2['first_name'] . ' '.$sql2['last_name'].'';
            $mail->Subject = '' . $sql2['first_name'] . ' '.$sql2['last_name'].' - Daily Task Report,' . $dates . ' ';
           
           
                $mailBody = '<b>Dear Sir/ Madam ,</b><br>';
                $mailBody .= '<b>Please find the task done today by ' . $sql2['first_name'] . ' '.$sql2['last_name'].':' . $dates . '</b><br>';

                if(!empty($getdailytask)){

                $mailBody .= '<b>Assigned Task :</b><br>';
                $mailBody .= '<table style="border-collapse: collapse;" border="1" cellpadding="10">';
                $mailBody .= '<tr><th style="border: 1px solid black;">Employee Name</th><th style="border: 1px solid black;">Project Name</th><th style="border: 1px solid black;">Task Name</th><th style="border: 1px solid black;">Sub Task Name</th><th style="border: 1px solid black;">Status</th><th style="border: 1px solid black;">Description sub-task</th></tr>';
    
                
                    foreach($getdailytask as $row){
                    $mailBody .= '<tr>';
                    $mailBody .= '<td style="border: 1px solid black;">' . $row['employee'][0]['first_name'] . '</td>';
                    $mailBody .= '<td style="border: 1px solid black;">' . $row['project'][0]['project_name'] . '</td>';
                    $mailBody .= '<td style="border: 1px solid black;">' . $row['main_task'][0]['tittle'] . '</td>';
                    $mailBody .= '<td style="border: 1px solid black;">' . $row['subtask'][0]['tittle'] . '</td>';
                    $mailBody .= '<td style="border: 1px solid black;">';
    
                    $status = $row['status'];
                    
                    switch ($status) {
                        case 1:
                            $mailBody .= 'Completed';
                            break;
                        case 0:
                            $mailBody .= 'Pending';
                            break;
                        case 2:
                            $mailBody .= 'New';
                            break;
                        case 3:
                            $mailBody .= 'Hold';
                            break;
                        case 4:
                            $mailBody .= 'TBD';
                            break;
                        default:
                            $mailBody .= 'Unknown Status';
                            break;
                    }
                    
                    $mailBody .= '</td>';
                    $mailBody .= '<td style="border: 1px solid black;">' . $row['subtask'][0]['description'] . '</td>';
                    $mailBody .= '</tr>';
                   
                }
    
                $mailBody .= '</table><br>';
            }
            if(!empty($viewextratask)){
                $mailBody .= '<b>Extra Task</b><br>';
                $mailBody .= '<p>'. $viewextratask['description'] .'</p><br>';
            }
                $mailBody .= '<b>Regards,</b><br>' . $sql2['first_name'] . ' '.$sql2['last_name'].'';
            
    
                $mail->Body = $mailBody;
    
                if($mail->send()){
                    echo '<script>';
                    echo 'alert("Todays Mail Send Successfully");';
                    echo 'window.location.href = "daily_task.php";';
                    echo '</script>';
                }
                
            
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }else{
        echo '<script>';
        echo 'alert("Please add task!!");';
        echo 'window.location.href = "daily_task.php";';
        echo '</script>';
        
    }
}

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
  if($id){
			echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
			echo '<script>';
			echo 'Swal.fire({
					title: "Are you sure?",
					text: "You won\'t be able to revert this!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "No, cancel",
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "daily_task.php?id=' . $id . '";
					} else {
						window.location.href = "daily_task.php";
					}
				});';
			echo '</script>';
		}
    }   


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `daily_task` SET `status1`= 5 WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>window.location.href = 'daily_task.php'</script>";
    } else {
        die(mysqli_error($con));
    }
}
?>		
    </body>
</html>