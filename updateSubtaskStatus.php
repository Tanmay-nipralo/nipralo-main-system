<?php
include './includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["sid"]) && isset($_POST["taskid"]) && isset($_POST["projectid"]) && isset($_POST["subtaskTitle"]) && isset($_POST["empId"])) {
    $created_time = date('Y-m-d H:i:s');
    $selectedStatus = $_POST["status"];
    $subtaskId = $_POST["sid"];
    $taskId = $_POST["taskid"];
    $projectId = $_POST["projectid"];
    $subtaskTitle = $_POST["subtaskTitle"]; 
    $empId = $_POST["empId"];
    $sql = "UPDATE project_subtask SET subtask_status = $selectedStatus WHERE id = $subtaskId";
    $iquery = mysqli_query($conn, $sql);

    if ($iquery) {
        $sql1 = "INSERT INTO `daily_task`(`emp_id`,`project_name`, `main_task`, `subtask`,`status`,`created_at`) VALUES ('$empId','$projectId','$taskId','$subtaskId','$selectedStatus','$created_time')";
        echo "$sql1";
        $iquery1 = mysqli_query($conn, $sql1);
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request";
}
?>
