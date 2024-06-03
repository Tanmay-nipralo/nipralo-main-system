<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php include './includes/header.php';
$id = $_GET['id'];
$getclient = getCareerHistoryById($id);

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
					<!-- <div class="page-header">
						<div class="row align-items-center">
						<div class="col-auto float-end ms-auto">
                            <a href="excel.php?table=sale" class="btn btn-outline-success" type="button"><i class="icon icon-download"></i> Excel</a>
                            </div>
						</div>
					</div> -->
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
                                        <th>Sr No.</th>
                                        <th>Call Status</th>
                                        <th>Good Time To Talk</th>
                                        <th>Comment</th>
                                        <th>Interview Schedule Date</th>
                                        <th>Date</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($getclient as $client) {
											?>
										<tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $client['call_status']; ?></td>
                                        <td><?php echo $client['g_date']; ?> <?php echo $client['g_time']; ?></td>
                                        <td><?php echo $client['comment']; ?></td>
                                        <td><?php echo $client['interview_scheduledate']; ?></td>
                                        <td><?php echo $client['created_at']; ?></td>
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
	<?php include './includes/footer.php'?>

    </body>
</html>


