<?php

    require_once('include/db.php');
    session_start();

    if(!isset($_SESSION['email']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        $user_email = $_SESSION['email'];
        $select_user = "SELECT * FROM user WHERE user_email='$user_email'";
        $run_user = mysqli_query($conn, $select_user);
        $row_user = mysqli_fetch_array($run_user);

        
        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $user_password = $row_user['user_password'];
        $user_image = $row_user['user_image'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
