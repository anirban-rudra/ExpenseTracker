<?php require_once('include/top.php');?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('include/sidebar.php');?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('include/navbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Profile</h1>
                    <div class="row">
                        <div class="col-md-3">
                            <img class="profile-img" src="upload_user_image/<?php echo $user_image;?>" style="width: 60%; border-radius: 50%">
                            <br><br>
                            <ul class="list-group">
                                <!-- <a href="profile.php" class="list-group-item">Profile</a>
                                <a href="report.php" class="list-group-item">Report</a>
                                <a href="budget.php" class="list-group-item">Budget</a> -->
                            </ul>
                        </div>

                        <div class="col-md-9">
                            <h2>Edit Profile</h2>

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name;?>" />
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;?>" required/>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="user_image"/>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Save Changes" name="insert_btn"/>
                                </div>

                            </form>

                            <?php
                            
                            require_once('include/db.php');

                            if(isset($_POST['insert_btn']))
                            {
                                $edituser_name = $_POST['user_name'];
                                $edituser_password = $_POST['user_password'];
                                $edituser_image = $_FILES['user_image']['name'];
                                $edituser_tmp_name = $_FILES['user_image']['tmp_name'];

                                $select_salt = "SELECT * FROM user ORDER BY user_id DESC LIMIT 1";
                                $run_salt = mysqli_query($conn, $select_salt);
                                $row_salt = mysqli_fetch_array($run_salt);

                                $salt = $row_salt['salt'];

                                $secure_password = crypt($edituser_password, $salt);

                                if(empty($edituser_image))
                                {
                                    $edituser_image = $user_image;
                                }

                                $update_user = "UPDATE user SET user_name='$edituser_name', user_password='$secure_password',user_image='$edituser_image' WHERE user_id='$user_id'"; 
                            
                                $run_update = mysqli_query($conn, $update_user);

                                if($run_update === true)
                                {
                                    echo "<script>window.open('profile.php', '_self');</script>";
                                    echo "Record Updated";
                                    move_uploaded_file($edituser_tmp_name,"upload_user_image/$edituser_image");

                                }
                                else
                                {
                                    echo "Failed, Try Again";
                                }

                            }

                            ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

<?php
require_once('include/footer.php');
?>