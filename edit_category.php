<?php require_once('include/top.php'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('include/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('include/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Category Record</h1>

                    <?php

                    require_once('include/db.php');

                    if (isset($_GET['edit'])) {
                        $edit_id = $_GET['edit'];

                        $select_category = "SELECT * FROM category WHERE category_id='$edit_id'";
                        $run_category = mysqli_query($conn, $select_category);

                        $row_category = mysqli_fetch_array($run_category);

                        $category_name = $row_category['category_name'];
                        $category_purpose = $row_category['category_purpose'];
                    }

                    ?>

                    <div class="row">
                        <div class="col">
                            <form action="" method="post">

                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" name="category_name" value="<?php echo $category_name; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Category Purpose</label>
                                    <select name="category_purpose" class="form-control">
                                        <option selected value="<?php echo $category_purpose; ?>"><?php echo $category_purpose; ?></option>
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="insert-btn" value="Update Category" class="btn btn-success">
                                </div>

                            </form>

                            <?php

                            require_once('include/db.php');

                            // if(mysqli_connect_errno())       //check if connected to db 
                            // {
                            //     echo "fail";
                            // }
                            // else
                            // {
                            //     echo "Connected Successfully";
                            // }

                            if (isset($_POST['insert-btn'])) {
                                $ecategory_name = $_POST['category_name'];
                                $ecategory_purpose = $_POST['category_purpose'];

                                $insert_category = "UPDATE category SET category_name='$ecategory_name', category_purpose='$ecategory_purpose' WHERE category_id='$edit_id'";

                                $run_category = mysqli_query($conn, $insert_category);

                                if ($run_category === true) {
                                    echo "<div class='alert alert-success'>Data has been Updated successfully</div>";
                                    echo "<script>window.open('category.php','_self')</script>";
                                } else {
                                    echo "<div class='alert alert-danger'>Failed, try AGAIN</div>";
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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