<?php
declare(strict_types=1);
session_start();
ob_start();

include(__DIR__ . "/../connect.php");
include(__DIR__ . "/../functions.php");
include(__DIR__ . "/../functions2.php");

//checking if session has expired
session_expire_function();
?>


<?php
//prevent other users(customers) from coming to admin page
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'Admin') {
        session_unset();
        session_destroy();
        redirect("../index.php?error=not_admin");
    }
}

//if no is logged in, then no one can access admin panel
if(!isset($_SESSION['role'])){
    redirect("../index.php?error=not_admin");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

     <!-- Styles CSS -->
     <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>