<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Expense Breakdown</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <script>
                        window.onload = function() {

                            var chart = new CanvasJS.Chart("chartContainer", {
                                theme: "light2", // "light1", "light2", "dark1", "dark2"
                                exportEnabled: true,
                                animationEnabled: true,
                                title: {
                                    text: ""
                                },
                                data: [{
                                    type: "pie",
                                    startAngle: 25,
                                    toolTipContent: "<b>{label}</b>: {y}%",
                                    showInLegend: "true",
                                    legendText: "{}",
                                    indexLabelFontSize: 14,
                                    indexLabel: "{label} - {y}%",
                                    dataPoints: [

                                        <?php

                                        require_once('include/db.php');

                                        //select categories
                                        $select_category = "SELECT * FROM category WHERE user_id='$user_id'";
                                        $run_category = mysqli_query($conn, $select_category);

                                        while ($row_category = mysqli_fetch_array($run_category)) {
                                            $category_id = $row_category['category_id'];
                                            $category_name = $row_category['category_name'];

                                            //select total Expense
                                            $select_total_expense = "SELECT SUM(expense_amt) FROM expense WHERE expense_month='$month' AND expense_year='$year'";
                                            $run_total_expense = mysqli_query($conn, $select_total_expense);
                                            $row_total_expense = mysqli_fetch_array($run_total_expense);

                                            $total_expense = $row_total_expense['SUM(expense_amt)'];

                                            //select expense for current month
                                            $current_month = date('m');

                                            $select_expense = "SELECT * FROM expense WHERE category_id='$category_id' AND expense_month='$month' AND expense_year='$year'";

                                            $run_expense = mysqli_query($conn, $select_expense);
                                            while ($row_expense = mysqli_fetch_array($run_expense)) {

                                                $expense_id = $row_expense['expense_id'];
                                                $expense_amount = $row_expense['expense_amt'];

                                                $percentage = $expense_amount * 100 / $total_expense;
                                                $round_off_percentage = number_format($percentage, 2);

                                        ?> {
                                                    y: <?php echo $round_off_percentage; ?>,
                                                    label: "<?php echo $category_name; ?>"
                                                },

                                        <?php }
                                        } ?>
                                    ]
                                }]
                            });
                            chart.render();

                        }
                    </script>
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4 pre-scrollable">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Budget</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php

                require_once('include/db.php');

                //select Categories
                $select_category = "SELECT * FROM category WHERE category_purpose='expense' AND user_id='$user_id'";
                $run_category = mysqli_query($conn, $select_category);

                while ($row_category = mysqli_fetch_array($run_category)) {

                    $category_id = $row_category['category_id'];
                    $category_name = $row_category['category_name'];

                    //Calculate total expense spent
                    $select_total_expense = "SELECT SUM(expense_amt) FROM expense WHERE expense_month='$current_month' AND category_id='$category_id'";

                    $run_total_expense = mysqli_query($conn, $select_total_expense);
                    $row_total_expense = mysqli_fetch_array($run_total_expense);

                    $total_expense = $row_total_expense['SUM(expense_amt)'];

                    //Select Budget
                    $select_budget = "SELECT SUM(budget_amount) FROM budget WHERE category_id='$category_id' ";

                    $run_budget = mysqli_query($conn, $select_budget);
                    $row_budget = mysqli_fetch_array($run_budget);

                    $total_budget = $row_budget['SUM(budget_amount)'];

                    if ($total_expense > 0 && $total_budget > 0) {

                        $percentage = $total_expense / $total_budget * 100;
                        $roundoff_percentage_progress = number_format($percentage, 2);
                ?>

                        <h4 class="small font-weight-bold">
                            <?php echo $category_name; ?>
                            <span class="float-right">
                                <span class="text-danger">
                                    Spent : <?php echo "$total_expense"; ?> |
                                    <span class="text-success">
                                        Budget : <?php echo "$total_budget"; ?>
                                    </span>
                                </span>
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $roundoff_percentage_progress ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <?php

                                if ($roundoff_percentage_progress > 100) {
                                    echo "Out of Budget";
                                } else {
                                    echo $roundoff_percentage_progress . "%";
                                }
                                ?>

                            </div>
                        </div>

                <?php }
                } ?>

            </div>
        </div>
    </div>
</div>