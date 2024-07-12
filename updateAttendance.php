<?php
include './includes/connection.php';
include './includes/function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["eid"]) && isset($_POST["date"]) || isset($_POST["paidLeave"])) {

    $response = array();
    $selectedStatus = mysqli_real_escape_string($conn, $_POST["status"]);
    $employeeId = mysqli_real_escape_string($conn, $_POST["eid"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    if(isset($_POST["paidLeave"])){
        $paidLeave =  $_POST["paidLeave"];
        $employee = getEmpById($employeeId);
    }


    $checkQuery = "SELECT * FROM `attendance` WHERE `date`='$date'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {

        $row = mysqli_fetch_assoc($checkResult);
        $presentIds = json_decode($row['present'], true);
        $absentIds = json_decode($row['absent'], true);
        $halfDayIds = json_decode($row['half_day'], true);
        
        $paidLeaveids = json_decode($row['paid_leave'], true);

        // Remove employee ID from any column if it exists
        if (($key = array_search($employeeId, $presentIds)) !== false) {
            unset($presentIds[$key]);
            $presentIds = array_values($presentIds); // Reindex the array
        }
        if (($key = array_search($employeeId, $absentIds)) !== false) {
            unset($absentIds[$key]);
            $absentIds = array_values($absentIds); // Reindex the array
        }
        if (($key = array_search($employeeId, $halfDayIds)) !== false) {
            unset($halfDayIds[$key]);
            $halfDayIds = array_values($halfDayIds); // Reindex the array
        }
        function unsetPaidLeave($employeeId, $paidLeaveids){
            if  (($key = array_search($employeeId, $paidLeaveids)) !== false) {
                unset($paidLeaveids[$key]);
                $paidLeaveids = array_values($paidLeaveids); // Reindex the array
            }
            return $paidLeaveids;
        }

        if(isset($_POST["paidLeave"])){
            $paidLeaveids = unsetPaidLeave($employeeId, $paidLeaveids);
        }

        // Update the appropriate column
        if ($selectedStatus == 'present') {
            $presentIds[] = $employeeId;
            $paidLeaveids = unsetPaidLeave($employeeId, $paidLeaveids);
        } elseif ($selectedStatus == 'absent') {
            $absentIds[] = $employeeId;

            if($paidLeave == 'paidLeave'){
                $paidLeaveids[] = $employeeId;
                $paidleave_left = $employee['paid_leave'] - 1;
                $updateQueryEmp = "UPDATE `employees` SET `paid_leave` = '$paidleave_left' WHERE `id` = '$employeeId'";
                $updateResultEmp = mysqli_query($conn, $updateQueryEmp);
            }
            if($paidLeave == 'unpaidLeave'){
                $paidLeaveids = unsetPaidLeave($employeeId, $paidLeaveids);
            }
        } elseif ($selectedStatus == 'half_day') {
            $halfDayIds[] = $employeeId;
            $paidLeaveids = unsetPaidLeave($employeeId, $paidLeaveids);
        }

        // Encode the arrays and update the database
        $presentIdsEncoded = json_encode($presentIds);
        $absentIdsEncoded = json_encode($absentIds);
        $halfDayIdsEncoded = json_encode($halfDayIds);
        $paidLeaveIdsEncoded = json_encode($paidLeaveids);

        $updateQuery = "UPDATE `attendance` SET `present`='$presentIdsEncoded', `absent`='$absentIdsEncoded', `half_day`='$halfDayIdsEncoded', `paid_leave` = '$paidLeaveIdsEncoded' WHERE `date`='$date'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            $response['status'] = 'success';
            $response['message'] = 'Attendance updated successfully';
            echo json_encode($response);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error updating attendance';
            echo json_encode($response);
        }
    } else {
        // If no record for the date exists, insert a new one
        $column = ($selectedStatus == 'present') ? 'present' : (($selectedStatus == 'absent') ? 'absent' : 'half_day');
        $jsonIds = json_encode([$employeeId]);
        if(isset($paidLeave)){
            $paidLeaveid =  json_encode(($paidLeave == 'paidLeave') ? [$employeeId] : []);
            if($paidLeave == 'paidLeave'){
                // $paidLeaveid =  json_encode([$employeeId]);
                $paidleave_left = $employee['paid_leave'] - 1;
                $updateQueryEmp = "UPDATE `employees` SET `paid_leave` = '$paidleave_left' WHERE `id` = '$employeeId'";
                $updateResultEmp = mysqli_query($conn, $updateQueryEmp);
            }
        } else{
            $paidLeaveid = json_encode([]);
        }
        $insertQuery = "INSERT INTO `attendance`(`date`, `$column`, `paid_leave`) VALUES ('$date', '$jsonIds', '$paidLeaveid')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            $response['status'] = 'success';
            $response['message'] = 'Attendance Added successfully';
            echo json_encode($response);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error adding new attendance entry';
            echo json_encode($response);
        }
    }

    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
    echo json_encode($response);
}
?>
