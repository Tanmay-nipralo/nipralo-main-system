<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$date = date('Y-m-d');
$getclient = getTodayMeetingDetail($date);
$getallclient = getAllMeetingDetail();

if ($getCount['employee_type'] != "Admin") {
	header("Location: error-404.php");
}
?>
<style>
	.table td{
		max-width: 250px;
		white-space: normal;
	}

	.table-responsive {
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
}
.dataTables_length label{
	position: absolute;
    top: 80px;
    right: 198px;
}
</style>
    <body>
        <div class="main-wrapper">
		<?php include './includes/navbar.php'?>	
			<?php include './includes/sidebar.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
						<li class="nav-item"><a class="nav-link active" href="#all_tasks" data-bs-toggle="tab" aria-expanded="true">Todays Meeting Schedule</a></li>
						<li class="nav-item"><a class="nav-link" href="#all_meeting" data-bs-toggle="tab" aria-expanded="false">All Meeting Schedule</a></li>
					</ul>
                <div class="tab-content">
				    <div class="tab-pane show active" id="all_tasks">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                            <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach ($getclient as $client) {
                                                $shortMessageId = 'short-message-' . $i;
                                                $fullMessageId = 'full-message-' . $i;
                                                ?>
                                            <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $client['user_detail'][0]['name']; ?></td>
                                            <td><?php echo $client['user_detail'][0]['number']; ?></td>
                                            <td><?php echo $client['user_detail'][0]['email']; ?></td>
                                            <td><?php echo $client['user_detail'][0]['type']; ?></td>
                                            <td>
                                                <?php 
                                                $message = $client['user_detail'][0]['message'];
                                                $maxLength = 30; 
                                                if(strlen($message) > $maxLength) {
                                                    $shortMessage = substr($message, 0, $maxLength) ; 
                                                    echo "<span id='$shortMessageId'>$shortMessage</span>"; 
                                                    echo "<span id='$fullMessageId' style='display: none;'>$message</span>"; 
                                                    echo "<button onclick='toggleMessage(\"$shortMessageId\", \"$fullMessageId\")' id='message-btn' style='border: none; background: none;'>...</button>"; 
                                                } else {
                                                    echo $message; 
                                                }
                                                ?>
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

                <div class="tab-content">
				    <div class="tab-pane show" id="all_meeting">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                            <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Message</th>
                                            <th>Schedule Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach ($getallclient as $client1) {
                                                $shortMessageId = 'short-message-' . $i;
                                                $fullMessageId = 'full-message-' . $i;
                                                ?>
                                            <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $client1['user_detail'][0]['name']; ?></td>
                                            <td><?php echo $client1['user_detail'][0]['number']; ?></td>
                                            <td><?php echo $client1['user_detail'][0]['email']; ?></td>
                                            <td><?php echo $client1['user_detail'][0]['type']; ?></td>
                                            <td>
                                                <?php 
                                                $message = $client1['user_detail'][0]['message'];
                                                $maxLength = 30; 
                                                if(strlen($message) > $maxLength) {
                                                    $shortMessage = substr($message, 0, $maxLength) ; 
                                                    echo "<span id='$shortMessageId'>$shortMessage</span>"; 
                                                    echo "<span id='$fullMessageId' style='display: none;'>$message</span>"; 
                                                    echo "<button onclick='toggleMessage(\"$shortMessageId\", \"$fullMessageId\")' id='message-btn' style='border: none; background: none;'>...</button>"; 
                                                } else {
                                                    echo $message; 
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $client1['meeting_scheduledate']; ?></td>
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
            </div>
        </div>
		<?php include './includes/footer.php'?>
		<script>
            function toggleMessage(shortMessageId, fullMessageId) {
                var shortMessage = document.getElementById(shortMessageId);
                var fullMessage = document.getElementById(fullMessageId);
                var btnText = document.getElementById("message-btn");

                if (shortMessage.style.display === "none") {
                    shortMessage.style.display = "inline";
                    fullMessage.style.display = "none";
                    btnText.innerHTML = "...";
                } else {
                    shortMessage.style.display = "none";
                    fullMessage.style.display = "inline";
                    btnText.innerHTML = "...";
                }
            }
        </script>

    </body>
</html>


