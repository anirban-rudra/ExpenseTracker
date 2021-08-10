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
                    <h1 class="h3 mb-4 text-gray-800">All Categories</h1>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Categories Record for Database</h6>
                                </div>

                                <?php

                                require_once('include/db.php');
                                if (isset($_GET['del'])) {
                                    $del_id = $_GET['del'];

                                    $delete_category = "DELETE FROM category WHERE category_id='$del_id'";
                                    $run_delete_category = mysqli_query($conn, $delete_category);

                                    if ($run_delete_category === true) {
                                        echo "<div class='alert alert-success'>Record has been Deleted</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Failed, Try again</div>";
                                    }
                                }

                                ?>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Purpose</th>
                                                    <th>Delete</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php

                                                require_once('include/db.php');

                                                $select_category = "SELECT * FROM category WHERE user_id='$user_id'";
                                                $run_category = mysqli_query($conn, $select_category);

                                                while ($row_category = mysqli_fetch_array($run_category)) {
                                                    $category_id = $row_category['category_id'];
                                                    $category_name = $row_category['category_name'];
                                                    $category_purpose = $row_category['category_purpose'];

                                                ?>
                                                    <tr>
                                                        <td><?php echo $category_id; ?></td>
                                                        <td><?php echo $category_name; ?></td>
                                                        <td><?php echo ucfirst($category_purpose); ?></td>
                                                        <td>
                                                            <!-- Button to Open the Modal -->
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $category_id; ?>">
                                                                Delete
                                                            </button>

                                                            <!-- The Modal -->
                                                            <div class="modal" id="myModal<?php echo $category_id; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <!-- Modal Header -->
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Delete Record ?</h4>

                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>

                                                                        <!-- Modal body -->
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete ?
                                                                        </div>

                                                                        <!-- Modal footer -->
                                                                        <div class="modal-footer">
                                                                            <a href="category.php?del=<?php echo $category_id; ?>" class="btn btn-danger">Delete</a>
                                                                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <a href="edit_category.php?edit=<?php echo $category_id; ?>" class="btn btn-success">Edit</a>
                                                        </td>

                                                    </tr>

                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
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