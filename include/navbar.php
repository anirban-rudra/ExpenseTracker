<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a> -->
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><i class="fas fa-exclamation"></i></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                
                <?php
                
                $current_month = date('m');
                require_once('include/db.php');
                
                //select Categories
                $select_category = "SELECT * FROM category WHERE category_purpose='expense' AND user_id='$user_id'";
                $run_category = mysqli_query($conn, $select_category);

                while($row_category = mysqli_fetch_array($run_category))
                {

                    $category_id = $row_category['category_id'];
                    $category_name = $row_category['category_name'];

                    //Calculate total expense spent
                    $select_total_expense = "SELECT SUM(expense_amt) FROM expense WHERE expense_month='$current_month' AND category_id='$category_id'";

                    $run_total_expense = mysqli_query($conn, $select_total_expense);
                    $row_total_expense = mysqli_fetch_array($run_total_expense);

                        $total_expense = $row_total_expense['SUM(expense_amt)'];

                    //Select Budget
                    $select_budget = "SELECT SUM(budget_amount) FROM budget WHERE category_id='$category_id'";

                    $run_budget = mysqli_query($conn, $select_budget);
                    $row_budget = mysqli_fetch_array($run_budget);

                        $total_budget = $row_budget['SUM(budget_amount)'];

                    if($total_expense > 0 && $total_budget > 0)
                    {

                        $percentage = $total_expense / $total_budget * 100;
                        $roundoff_percentage_progress = number_format($percentage, 2);

                    if($roundoff_percentage_progress > 100)
                    {
                ?>

                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        Spending Alert: You are out of Budget in <b><?php echo $category_name;?></b>
                    </div>
                </a>
                        
                <?php } } } ?>

                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user_name;?></span>
                <img class="img-profile rounded-circle"
                    src="upload_user_image/<?php echo $user_image;?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a> -->
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>