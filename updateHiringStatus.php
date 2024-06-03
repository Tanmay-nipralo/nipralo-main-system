<?php
include './includes/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["status"])){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["sid"])) {
        $created_time = date('Y-m-d H:i:s');
        $selectedStatus = $_POST["status"];
        $subtaskId = $_POST["sid"];
        $sql = "UPDATE sale SET hiring_status = '$selectedStatus' WHERE id = $subtaskId";
        $iquery = mysqli_query($conn, $sql);

        if ($iquery) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    } else {
        echo "Invalid request";
    }
}

if(isset($_POST["shortlistStatus"])){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["shortlistStatus"]) && isset($_POST["sid"])) {
        $selectedStatus = $_POST["shortlistStatus"];
        $subtaskId = $_POST["sid"];
        $sql = "UPDATE sale SET shortlist = '$selectedStatus' WHERE id = $subtaskId";
        $iquery = mysqli_query($conn, $sql);

        if ($iquery) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    } else {
        echo "Invalid request";
    }
}
?>
