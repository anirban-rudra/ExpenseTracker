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

                    <?php
                    
                    require_once('include/db.php');

                    if(isset($_GET['edit']))
                    {
                        $edit_id = $_GET['edit'];

                        $select_income = "SELECT * FROM income WHERE income_id='$edit_id'";
                        $run_income = mysqli_query($conn, $select_income);

                            $row_income = mysqli_fetch_array($run_income);

                            $dbincome_amount = $row_income['income_amt'];
                            $dbcategory_id = $row_income['category_id'];
                            $dbincome_details = $row_income['income_details'];
                            $dbincome_receipt = $row_income['income_receipt'];
                            $dbincome_date = $row_income['income_date'];
                    }
                    
                    ?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Income Record</h1>
                    <div class="row">
                        <div class="col">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="income_amount" value="<?php echo $dbincome_amount;?>" class="form-control" required />
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category_id" required>
                                                <option disabled>Select Category</option>

                                                <?php
                                                require_once('include/db.php');
                                                $select_category = "SELECT * FROM category WHERE category_purpose ='income' AND user_id='$user_id'";
                                                $run_category = mysqli_query($conn, $select_category);

                                                while($row_category = mysqli_fetch_array($run_category))
                                                {
                                                    $category_id = $row_category['category_id'];
                                                    $category_name = $row_category['category_name'];
                                                

                                                ?>
                                                <option <?php if($dbcategory_id == $category_id) { echo "selected"; }?>value="<?php echo $category_id;?>"><?php echo $category_name?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Receipt</label>
                                            <input type="file" class="form-control" name="income_receipt"/>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" value="<?php echo $dbincome_date;?>" name="income_date">
                                </div>

                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" name="income_details"><?php echo $dbincome_details;?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Update Income" name="insert_btn">
                                </div>
                                
                            </form>

                            <?php
                            
                                require_once('include/db.php');

                                
                                if(isset($_POST['insert_btn']))
                                {
                                    $income_amount = $_POST['income_amount'];
                                    $newcategory_id = $_POST['category_id'];
                                    $income_details = $_POST['income_details'];
                                    $income_date = $_POST['income_date'];
                                    $income_receipt_name = $_FILES['income_receipt']['name'];
                                    $income_receipt_tmp_name = $_FILES['income_receipt']['tmp_name'];

                                    if(empty($income_receipt_name))
                                    {
                                        $income_receipt_name = $dbincome_receipt; 
                                    }

                                    $month = date('M');
                                    $year = date('Y');

                                    $update_income = "UPDATE income SET income_amt='$income_amount', category_id='$newcategory_id', income_details='$income_details', income_receipt='$income_receipt_name', income_date='$income_date', income_month='$month', income_year='$year' WHERE income_id='$edit_id'";

                                    $run_update = mysqli_query($conn, $update_income);

                                    if($run_update === true)
                                    {
                                        echo "<div class='alert alert-success'>Income Record Updated</div>";
                                        move_uploaded_file($income_receipt_tmp_name, "upload_income_receipt/$income_receipt_name");
                                        echo "<script>window.open('income.php','_self')</script>";
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