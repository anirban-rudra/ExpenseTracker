<div class="row">

    <!-- Month income Record section  -->
        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4 pre-scrollable">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Income Record</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Amont</th>
                                    <th>Category</th>
                                    <th>Details</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                        
                            <tbody>

                                <?php

                                require_once('include/db.php');

                                $select_income = "SELECT * FROM income WHERE income_month='$month' AND income_year='$year' AND user_id='$user_id'";
                                $run_income = mysqli_query($conn, $select_income);

                                while($row_income = mysqli_fetch_array($run_income))
                                {
                                    $income_id = $row_income['income_id'];
                                    $category_id = $row_income['category_id'];
                                    $income_amount = $row_income['income_amt'];
                                    $income_details = $row_income['income_details'];
                                    $income_receipt = $row_income['income_receipt'];
                                    $income_date = $row_income['income_date'];
                                    $income_month = $row_income['income_month'];
                                    $income_year = $row_income['income_year'];

                                    $select_category = "SELECT * FROM category WHERE category_id='$category_id'";
                                    $run_category = mysqli_query($conn, $select_category);

                                        $row_category = mysqli_fetch_array($run_category);
                                        $category_name = $row_category['category_name'];
                                    
                                
                                ?>
                                <tr>
                                    
                                    <td><?php echo $income_amount;?></td>
                                    <td><?php echo $category_name;?></td>
                                    <td><?php echo $income_details;?></td>
                                    
                                    <td><?php echo $income_date?></td>
                                    

                                </tr>

                                    <?php } ?>
                            </tbody>
                                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- Month income Record section  -->

    <!-- Month expense Record section  -->
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4 pre-scrollable">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expense Record</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>Amont</th>
                                    <th>Category</th>
                                    <th>Details</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                            <?php

                            require_once('include/db.php');

                            $select_expense = "SELECT * FROM expense WHERE expense_month='$month' AND expense_year='$year' AND user_id='$user_id'";
                            $run_expense = mysqli_query($conn, $select_expense);

                            while($row_expense = mysqli_fetch_array($run_expense))
                            {
                                $expense_id = $row_expense['expense_id'];
                                $category_id = $row_expense['category_id'];
                                $expense_amount = $row_expense['expense_amt'];
                                $expense_details = $row_expense['expense_details'];
                                $expense_receipt = $row_expense['expense_receipt'];
                                $expense_date = $row_expense['expense_date'];
                                $expense_month = $row_expense['expense_month'];
                                $expense_year = $row_expense['expense_year'];

                                $select_category = "SELECT * FROM category WHERE category_id='$category_id'";
                                $run_category = mysqli_query($conn, $select_category);

                                    $row_category = mysqli_fetch_array($run_category);
                                    $category_name = $row_category['category_name'];
                                
                            
                            ?>
                                <tr>
                                    
                                    <td><?php echo $expense_amount;?></td>
                                    <td><?php echo $category_name;?></td>
                                    <td><?php echo $expense_details;?></td>
                                    
                                    <td><?php echo $expense_date?></td>

                                </tr>

                            <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- Month income Record section  -->
</div>