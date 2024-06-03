<?php 
    date_default_timezone_set('Asia/Kolkata');

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include 'connection.php';
    include 'function.php';

    $Financial_NewYear = date('m-d');
    if($Financial_NewYear == "04-01"){
        $sql = "UPDATE employees SET paid_leave = 12 WHERE status = 1";
        $result = mysqli_query($conn, $sql);
    }
    
  if(isset($_COOKIE['access_token'])){
    $access_token = mysqli_real_escape_string($conn, $_COOKIE['access_token']);
    $get_query = "SELECT * FROM employees WHERE emp_token='$access_token'";
        $getResult = mysqli_query($conn, $get_query);
        $getCount = mysqli_fetch_assoc($getResult);
       
    }else{
        echo "<script>window.location = 'login.php';</script>";
    }

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <title>Dashboard - Nipralo</title>
		
	<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        
	<!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<!-- Lineawesome CSS -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
	<link rel="stylesheet" href="assets/css/material.css">
		
	<!-- Chart CSS -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">

    <!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
	<!-- Calendar CSS -->
	<link rel="stylesheet" href="assets/css/fullcalendar.min.css">
		
    <!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/css/select2.min.css">

	<!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<style>
.edit-button{
	display: flex;
    position: absolute;
    right: 52px;
    justify-content: space-around;
	
    width: 6%;
}
</style>
</head>
