<?php
include './includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["eid"]) && isset($_POST["date"])) {

    $response = array();
    $selectedStatus = mysqli_real_escape_string($conn, $_POST["status"]);
    $employeeId = mysqli_real_escape_string($conn, $_POST["eid"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);

    $checkQuery = "SELECT * FROM `attendance` WHERE `date`='$date'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {

        $row = mysqli_fetch_assoc($checkResult);
        $presentIds = json_decode($row['present'], true);
        $absentIds = json_decode($row['absent'], true);
        $halfDayIds = json_decode($row['half_day'], true);

        if (in_array($employeeId, $presentIds) || in_array($employeeId, $absentIds) || in_array($employeeId, $halfDayIds)) {
            $response['status'] = 'error';
            $response['message'] = 'Employee is already marked for attendance';
            echo json_encode($response);
            exit;
        } else {
            $column = ($selectedStatus == 'present') ? 'present' : (($selectedStatus == 'absent') ? 'absent' : 'half_day');
            $ids = json_encode(array_merge(json_decode($row[$column], true), [$employeeId]));
            $updateQuery = "UPDATE `attendance` SET `$column`='$ids' WHERE `date`='$date'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                $response['status'] = 'success';
                $response['message'] = 'Attendance Added successfully';
                echo json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error updating attendance';
                echo json_encode($response);
            }
        }
    } else {
        $column = ($selectedStatus == 'present') ? 'present' : (($selectedStatus == 'absent') ? 'absent' : 'half_day');
        $jsonIds = json_encode([$employeeId]);
        $insertQuery = "INSERT INTO `attendance`(`date`, `$column`) VALUES ('$date', '$jsonIds')";
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