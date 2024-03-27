<?php

session_start();

include("classes/db_conn.php");
include("classes/product.php");
include("classes/cart.php");

$db_conn = new DatabaseConn();

$product_obj = new Product($db_conn->get_db_conn());

$products = $product_obj->get_all_products();

$cart = new Cart();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

if (isset($_POST["empty_cart"])) {
    $cart->empty_cart();
    header("Location: ".$_SERVER["PHP_SELF"]);
}


if (isset($_POST["remove_item"])) {
    
    $product_id = $_POST["pid"];
    $cart->remove_cart_item($product_id);
    header("Location: ".$_SERVER["PHP_SELF"]);
}


if (isset($_POST["add_to_cart"])) {

    $product_id = $_POST["pid"];
    $quantity = $_POST["qty"];
    
    $cart->add_to_cart_item($product_id, $quantity);
    header("Location: products.php?msg=success");

}

// Cart sub Total
$cart_obj = new Cart();

$cart_subtotal = $cart_obj->get_cart_subtotal($products);


include("includes/header.php");

?>

<!-- Main Content -->
<div class="container mt-5">

    <div class="text-center mb-4">
            
        <h2 class="mb-4">Shopping Cart</h2>

        <form method="post">
            <button type="submit" name="empty_cart" class="btn btn-danger">Empty Cart</button>
        </form>

    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION["cart"] as $productId => $item): ?>
                <tr>
                    <td>
                    <img src="<?php echo "images/".$products[$productId - 1]["img_url"]; ?>"  class="rounded" style="width:100px;">
                    </td>
                    <td><?php echo $products[$productId - 1]["title"]; ?></td>
                    <td>$<?php echo $products[$productId - 1]["price"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td><?php echo "$".$item["quantity"] * $products[$productId - 1]["price"]; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="pid" value="<?php echo $products[$productId - 1]["id"]; ?>">
                            <button type="submit" name="remove_item" class="btn btn-danger">&times;</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="my-5">

        <div class="row justify-content-end">
        <div class="col-md-6">
            <table class="table table-bordered">
                
                <thead>
                    <tr>
                        <td colspan="2">
                            <h4 class="mb-0">Cart Totals</h4>
                        </td>
                    </tr>
                </thead>

                <tbody class="fw-bold">
                    <tr>
                        <td>Sub Total</td>
                        <td>$<?php echo $cart_subtotal; ?></td>
                    </tr>
                    <tr>
                        <td>Tax (6%)</td>
                        <td>$<?php echo number_format($cart_subtotal * 0.06, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>$<?php echo number_format($cart_subtotal + ($cart_subtotal * 0.06), 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


        <?php // Allow Checkout if User is LoggedIn ?>

        <div class="d-flex justify-content-end">

            <?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"])){ ?>
                
                <?php if(isset($_SESSION["user_data"])){ ?>
            
                <a href="checkout.php" class="btn btn-dark">Checkout</a>

                <?php } else { ?>
                    
                <p>Please <a href="login.php">Login</a> to Complete Checkout.</p>
                    
                <?php } ?>
                
            <?php } ?>
        </div>

    </div>


</div>

<?php include("includes/footer.php"); ?>