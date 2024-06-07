<?php
$table 				= $_GET["table"];
if ($table == "bigd_model") {
	include_once('includes/connection.php');
} elseif ($table == "hardware") {
	include_once('includes/connection.php');
} elseif ($table == "shop") {
	include_once('includes/connection.php');
} elseif ($table == "selection") {
	include_once('includes/connection.php');
} elseif ($table == "sale") {
	include_once('includes/connection.php');
} elseif ($table == "contact_us") {
	include_once('includes/connection.php');
} elseif ($table == "expo_register") {
	include_once('includes/connection.php');
} elseif ($table == "joyfarm_contact") {
	include_once('includes/connection.php');
}


$flag 				= 0;
$count				= 1;
$setData = '';
if ($table == "bigd_model") {

	$sql 	= "SELECT `name`,`number`,`email` FROM `bigd_model` ORDER BY `id` DESC";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Number" . "\t" . "Email" . "\t";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "hardware") {

	$sql 	= "SELECT `name`,`models` FROM `hardware`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Hardware Type" . "\t" . "Model" . "\t";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "shop") {

	$sql 	= "SELECT `name`,`number`,`email`,`address` FROM `shop`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Number" . "\t" . "Email" . "\t" . "Address" . "\t";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "selection") {

	$sql 	= "SELECT `htype`,`model`,`vname`,`price`,`bdate`,`sdate`,`edate` FROM `selection`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Hardware Type" . "\t" . "Model" . "\t" . "Vendor Name" . "\t" . "Price" . "\t" . "Buying Date" . "\t" . "Start Date" . "\t" . "End Date" . "\t";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "sale") {

	$sql 	= "SELECT `name`,`mobile_number`,`email`,`message`,`position`,`shortlist`,`reference`, `address`,`jobtype`,`organisation_name`,`job_title`,`salary_received`,`leave_reason`,`join_day`,`expected_salary`,`reason_forhiring`,`hiring_status`,`created_at` FROM `sale`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Phone" . "\t" . "Email" . "\t" . "Message" . "\t" . "Applying for the Position" . "\t" . "Shortlist Status" . "\t" . "Reference" . "\t" . "Address" . "\t" . "Job Type" . "\t" . "Current/Previous Organisation Name" . "\t" . "Current/Previous Job Title" . "\t" . "Salary Received" . "\t" . "Reason to leave the current/previous organisation" . "\t" . "When can you join" . "\t" . "Expected Salary" . "\t" . "Reason for hiring" . "\t" . "Hiring Status" . "\t" . "Date & Time" . "\t";

	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "contact_us") {

	$sql 	= "SELECT `first_name`,`email`,`phone`,`message`,`created_at` FROM `contact_us`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Message" . "\t" . "Date & Time" . "\t";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "register") {
	$sql 	= "SELECT `name`,`email`,`phone`,`res_location`,`requirement`,`location`,`budget` FROM `register`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Residence Location" . "\t" . "Requirement" . "\t" . "Location" . "\t" . "Budget";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "expo_register") {
	$sql 	= "SELECT `name`,`email`,`phone`,`res_location`,`requirement`,`location`,`budget`,`source` FROM `expo_register`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Residence Location" . "\t" . "Requirement" . "\t" . "Location" . "\t" . "Budget" . "\t" . "Source";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
} elseif ($table == "joyfarm_contact") {
	$sql 	= "SELECT `name`,`number`,`email`,`message` FROM `joyfarm_contact`";
	$setRec = mysqli_query($conn, $sql);

	$filename 			=	$table;
	$columnHeader 		= "Name" . "\t" . "Number" . "\t" . "Email" . "\t" . "Message" . "\t";



	if (mysqli_num_rows($setRec) > 0) {
		$flag = 1;
		while ($rec = mysqli_fetch_row($setRec)) {
			$rowData = '';
			foreach ($rec as $value) {
				$value = '"' . $value . '"' . "\t";
				$rowData .= $value;
			}
			$setData .= trim($rowData) . "\n";
		}
	}
}




if ($flag == 1) {
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=User_Detail.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo ucwords($columnHeader) . "\n" . $setData . "\n";
} else {
	if ($table == "bigd_model") {
		header("Location:https://nipralo.com/sys/enquiry.php");
	} elseif ($table == "hardware") {
		header("Location:https://https://bigdreams.in//admin/hardware.php");
	} elseif ($table == "shop") {
		header("Location:https://https://bigdreams.in//admin/hardware.php");
	} elseif ($table == "selection") {
		header("Location:https://https://bigdreams.in//admin/selection.php");
	} elseif ($table == "sale") {
		header("Location:https://nipralo.com/sys/career.php");
	} elseif ($table == "contact_us") {
		header("Location:https://nipralo.com/sys/contact.php");
	} elseif ($table == "register") {
		header("Location:https://https://bigdreams.in//admin/hardware.php");
	} elseif ($table == "expo_register") {
		header("Location:https://https://bigdreams.in//admin/hardware.php");
	} elseif ($table == "joyfarm_contact") {
		header("Location:https://https://bigdreams.in//admin/hardware.php");
	}
}
