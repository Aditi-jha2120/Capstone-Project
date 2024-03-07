<?php

session_start();

if(!$_SESSION["user_data"]) {
    header("Location: login.php");
}


include("includes/header.php");
include("classes/db_conn.php");
include("classes/product.php");
include("classes/order.php");

$db_conn = new DatabaseConn();

$product = new Product($db_conn->get_db_conn());

$order_obj = new Order($db_conn->get_db_conn());

$user_id = $_SESSION["user_data"]["id"];

$orders = $order_obj->get_user_orders($user_id);


?>


<!-- Main Content -->
<section class="container py-5">

    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Account</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"
                role="tab" aria-controls="order" aria-selected="false">Orders</button>
        </li>

    </ul>


    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active py-2" id="home" role="tabpanel" aria-labelledby="home-tab">

            <h4 class="mb-4">My Account</h4>

            <div class="alert alert-success">
                Hi,
                <?php echo $_SESSION["user_data"]["first_name"]; ?>,
                Welcome to Your account.
            </div>

            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="border p-3 rounded">

                        <svg width="50" class="mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                        <p><strong>Full Name:</strong>
                            <?php echo $_SESSION["user_data"]["first_name"] . " " . $_SESSION["user_data"]["last_name"]; ?>
                        </p>
                        <p><strong>Email Address:</strong>
                            <?php echo $_SESSION['user_data']['email']; ?>
                        </p>

                    </div>
                </div>


            </div>

        </div>
        <div class="tab-pane fade py-2" id="order" role="tabpanel" aria-labelledby="order-tab">

            <h4 class="mb-4">My Orders</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Order No.</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Total Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($orders as $order) { ?>

                    <tr>
                        <td><?php echo $order["order_num"]; ?></td>
                        <td><?php echo date('d M Y', strtotime($order["order_date"])); ?></td>
                        <td>$<?php echo $order["subtotal"]; ?></td>
                        <td>$<?php echo $order["tax"]; ?></td>
                        <td>$<?php echo $order["subtotal"] + $order["tax"] ; ?></td>
                        <th>
                            <a href="info.php?order_id=<?php echo $order["id"]; ?>" class="btn btn-success">More Info</a>
                            <a href="invoice.php?order_id=<?php echo $order["id"]; ?>" target="_blank" class="btn btn-dark">Download Invoice</a>
                        </th>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>

        </div>

    </div>




</section>




<?php include("includes/footer.php"); ?>