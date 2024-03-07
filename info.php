<?php

session_start();

if(!$_SESSION["user_data"]) {
    header("Location: login.php");
}

if(!$_GET["order_id"]) {
    header("Location: login.php");
}



// Show Order Info

include("includes/header.php");
include("classes/db_conn.php");
include("classes/order.php");

$db_conn = new DatabaseConn();

$order_obj = new Order($db_conn->get_db_conn());

$user_id = $_SESSION["user_data"]["id"];
$order_id = $_GET["order_id"];

$order = $order_obj->get_order($order_id);

$order_items = $order_obj->get_order_items($order_id);

?>


<div class="container py-5">

   <header class="d-flex align-items-center justify-content-between mb-4">
    
   <h4 class="mb-0">Order No. <?php echo $order["order_num"]; ?></h4>
   <a href="account.php" class="btn btn-success">My Account</a>
   </header>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>

            <?php foreach($order_items as $item){ ?>
                <tr>
                    <td>
                    <img src="<?php echo "images/".$item["img_url"]; ?>" class="rounded" style="width:100px;">

                    </td>
                    <td><?php echo $item["title"]; ?></td>
                    <td>$<?php echo $item["price"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td>$<?php echo $item["quantity"] * $item["price"].".00"; ?></td>
                </tr>
            <?php } ?>

            <tr class="fw-bold">
                <td colspan="3"></td>
                <td>Sub Total :</td>
                <td>$<?php echo number_format($order["subtotal"], 2) ?></td>
            </tr>

            <tr class="fw-bold">
            <td colspan="3"></td>
                <td>Tax (6%): </td>
                <td>$<?php echo number_format($order["tax"] * 0.06, 2) ?></td>
            </tr>


            <tr class="fw-bold">
            <td colspan="3"></td>
                <td>Total: </td>
                <td>$<?php echo number_format($order["tax"] + $order["subtotal"], 2) ?></td>
            </tr>


        </table>
    </div>

</div>


<?php include("includes/footer.php"); ?>