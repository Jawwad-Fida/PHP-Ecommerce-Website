<?php
declare(strict_types=1);
session_start();
ob_start();

include(__DIR__ . "/../connect.php");
include(__DIR__ . "/../functions.php");
include(__DIR__ ."/../functions2.php");

//checking if session has expired
session_expire_function();
?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Homepage</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/shop-homepage.css" rel="stylesheet">
        
        <!-- MY CSS -->
        <link href="css/my_style.css" rel="stylesheet">

    </head>
    

    <body>

