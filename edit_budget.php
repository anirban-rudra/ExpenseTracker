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
                    <h1 class="h3 mb-4 text-gray-800">Edit Budget</h1>

                    <?php
                    
                    require_once('include/db.php');

                    if(isset($_GET['edit']))
                    {
                        $edit_id = $_GET['edit'];

                        $select_budget = "SELECT * FROM budget WHERE budget_id='$edit_id'";
                        $run_budget = mysqli_query($conn, $select_budget);

                            $row_budget = mysqli_fetch_array($run_budget);

                            $budget_amount = $row_budget['budget_amount'];
                            $dbcategory_id = $row_budget['category_id'];


                    }
                    
                    ?>

                    <div class="row">
                        <div class="col">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="budget_amount" value="<?php echo $budget_amount;?>" class="form-control" required />
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category_id" required>
                                                <option disabled>Select Category</option>

                                                <?php
                                                require_once('include/db.php');
                                                $select_category = "SELECT * FROM category WHERE category_purpose ='expense' AND user_id='$user_id'";
                                                $run_category = mysqli_query($conn, $select_category);

                                                while($row_category = mysqli_fetch_array($run_category))
                                                {
                                                    $category_id = $row_category['category_id'];
                                                    $category_name = $row_category['category_name'];
                                                

                                                ?>
                                                <option <?php if($dbcategory_id === $category_id){ echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_name?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                
                                
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Update Budget" name="insert_btn">
                                </div>
                                
                            </form>

                            <?php
                            
                                require_once('include/db.php');

                                
                                if(isset($_POST['insert_btn']))
                                {
                                    $new_budget_amount = $_POST['budget_amount'];
                                    $new_category_id = $_POST['category_id'];
                                   
                                    $update_budget = "UPDATE budget SET budget_amount='$new_budget_amount', category_id='$new_category_id' WHERE budget_id='$edit_id'";

                                    $run_edit_budget = mysqli_query($conn, $update_budget);

                                    if($run_edit_budget === true)
                                    {
                                        echo "<div class='alert alert-success'>Budget Updated Successfully</div>";
                                        echo "<script>window.open('budget.php','_self')</script>";
                                        
                                    }
                                    else
                                    {
                                        echo "<div class='alert alert-danger'>Failed, Try again</div>";
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