<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expense Tracker</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6"><br>
                                <div class="p-5" style="height: 610px;">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> <b>User Login</b> </h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="Password">
                                        </div>
                                        
                                        

                                        <!-- checkbox  -->
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->

                                        <input type="submit" name="login-btn" class="btn btn-primary btn-user btn-block" value="Login" />
                                        
                                        <br>
                                        <a href="add_user2.php" class="btn btn-google btn-user btn-block">
                                             Create a New Account
                                        </a>

                                
                                       
                                    </form>

                                    <?php 
                                    
                                    require_once('include/db.php');

                                    if(isset($_POST['login-btn']))
                                    {
                                        $email = $_POST['email'];
                                        $password = $_POST['password'];
                            

                                        $check_email = "SELECT * FROM user WHERE user_email='$email'";
                                        $run_check_email= mysqli_query($conn, $check_email);

                                        if(mysqli_num_rows($run_check_email) > 0)
                                        {
                                            //query run
                                            $row_email = mysqli_fetch_array($run_check_email);
                                                $db_email = $row_email['user_email'];
                                                $db_password = $row_email['user_password'];
                                                $db_user_id = $row_email['user_id'];

                                                $password = crypt($password, $db_password);
                                            
                                            if($email === $db_email && $password === $db_password)
                                            {
                                                echo "<script>window.open('index.php', '_self');</script>";
                                                $_SESSION['email'] = $db_email;
                                                $_SESSION['user_id'] = $db_user_id;
                                            }
                                            else
                                            {
                                                echo "<div class='alert alert-danger'>Username or Password Invalid.</div>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<div class='alert alert-danger'>No email found.</div>";
                                        }
                                    }

                                    ?>


                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>