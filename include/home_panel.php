<?php 

require_once('include/db.php');
$current_month = date('m');


$select_income = "SELECT SUM(income_amt) FROM income WHERE income_month='$current_month' AND user_id='$user_id'";
$run_income = mysqli_query($conn, $select_income);
    $row_income = mysqli_fetch_array($run_income);

    $total_income = $row_income['SUM(income_amt)'];
    
$select_expense = "SELECT SUM(expense_amt) FROM expense WHERE expense_month='$current_month' AND user_id='$user_id'";
$run_expense = mysqli_query($conn, $select_expense);
    $row_expense = mysqli_fetch_array($run_expense);

    $total_expense = $row_expense['SUM(expense_amt)'];

$total_balance = $total_income - $total_expense;
?>


<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Income (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. <?php echo $total_income;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Expense (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. <?php echo $total_expense;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Balance
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rs. <?php echo $total_balance;?></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
