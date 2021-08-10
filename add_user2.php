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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <section>
        <div class="container">

            <br><br>
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1> <b> Register User</b> </h1>
                            <p class="text-h3">Register to keep track of our hard <b>Earned Money <i class="fas fa-file-invoice-dollar"></i></b></p>
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="user_name" class="form-control" required />
                        </div>
                    </div>
                    <div class="row align-items-center ">
                        <div class="form-group ">
                            <label>E-mail</label>
                            <input type="email" name="user_email" class="form-control" required />
                        </div>
                    </div>
                    <div class="row align-items-center ">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="user_password" required />
                        </div>

                        <div class="form-group ">
                            <label>Image</label>
                            <input type="file" class="form-control" name="user_image">
                        </div>
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col mt-4">
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary" value="Create Account" name="insert_btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>


            <?php
        
                require_once('include/db.php');

                
                if(isset($_POST['insert_btn']))
                {
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $user_password = $_POST['user_password'];
                    $user_image = $_FILES['user_image']['name'];
                    $user_tmp_name = $_FILES['user_image']['tmp_name'];

                    $select_salt = "SELECT * FROM user ORDER BY user_id DESC LIMIT 1";
                    $run_salt = mysqli_query($conn, $select_salt);
                    $row_salt = mysqli_fetch_array($run_salt);

                    $salt = $row_salt['salt'];

                    $secure_password = crypt($user_password, $salt);

                    //check email

                    $check_email = "SELECT * FROM user WHERE user_email='$user_email'";
                    $run_check_email= mysqli_query($conn, $check_email);

                    if(mysqli_num_rows($run_check_email) > 0)
                    {
                        echo "<div class='alert alert-danger'>User already exists.</div>";
                        
                    }
                    else
                    {
                        $insert_user = "INSERT INTO user(user_name, user_email, user_password, user_image) VALUES('$user_name', '$user_email', '$secure_password', '$user_image')";

                        $run_insert = mysqli_query($conn, $insert_user);
                        
                        if($run_insert === true)
                        {
                            
                            echo "<div class='alert alert-success'>New user Added.</div>";
                            move_uploaded_file($user_tmp_name, "upload_user_image/$user_image");
                            echo "<script>window.open('login.php', '_self');</script>";
                            
                        }
                        else
                        {
                            echo "<div class='alert alert-danger'>Failed, try Again.</div>";
                        }
                    }
                    
                }

            ?>

        </div>
    </section>
</body>

</html>