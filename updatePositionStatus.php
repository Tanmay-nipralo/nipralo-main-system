<?php
include './includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["sid"])) {
    $created_time = date('Y-m-d H:i:s');
    $selectedStatus = $_POST["status"];
    $subtaskId = $_POST["sid"];
    $sql = "UPDATE projects SET position = '$selectedStatus' WHERE id = $subtaskId";
    $iquery = mysqli_query($conn, $sql);

    if ($iquery) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} 
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dynamic_status"]) && isset($_POST["pid"])) {
    $created_time = date('Y-m-d H:i:s');
    $selectedStatus = $_POST["dynamic_status"];
    $subtaskId = $_POST["pid"];
    $sql = "UPDATE projects SET dynamic_status = '$selectedStatus' WHERE id = $subtaskId";
    $iquery = mysqli_query($conn, $sql);

    if ($iquery) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} 
else {
    echo "Invalid request";
}
?>
