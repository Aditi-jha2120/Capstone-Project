<?php

session_start();

include("classes/db_conn.php");
include("classes/product.php");
include("classes/cart.php");
include("classes/order.php");

$user_data = $_SESSION["user_data"];
$first_name = $user_data["first_name"];
$last_name = $user_data["last_name"];
$email = $user_data["email"];


$db_conn = new DatabaseConn();

$product_obj = new Product($db_conn->get_db_conn());

$products = $product_obj->get_all_products();

// Cart sub Total
$cart_obj = new Cart();

$cart_subtotal = $cart_obj->get_cart_subtotal($products);



// Validation Checkout Form

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Define an array to store validation errors
    $errors = [];

    if (empty($_POST["first_name"])) {
        $errors[] = "First name is required.";
    }

    if (empty($_POST["last_name"])) {
        $errors[] = "Last name is required.";
    }

    if (empty($_POST["email"])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($_POST["address"])) {
        $errors[] = "Shipping address is required.";
    }

    if (empty($_POST["card_number"])) {
        $errors[] = "Card number is required - 16 Digits";
    }

    if(strlen($_POST["card_number"]) != 16){
        $errors[] = "Card number should be 16 digits";
    
    }

    if (empty($_POST["expiry_date"])) {
        $errors[] = "Expiry date is required.";
    }

    if (empty($_POST["cvv"]) || strlen($_POST["cvv"]) != 3) {
        $errors[] = "CVV should be 3 digits.";
    }

    if(empty($errors)) {

        $_SESSION["customer_data"] = $_POST;


        $order = new Order($db_conn->get_db_conn());

        $order_items = [];

        foreach ($_SESSION["cart"] as $productId => $item) {
            $product_id = $products[$productId - 1]["id"];
            $quantity = $item["quantity"];
            $price = $products[$productId - 1]["price"];

            $order_items[] = array(
                "product_id" => $product_id,
                "quantity" => $quantity,
                "price" => $price
            );
        }

        $order_data = [
            "order_num" => "ORDER-" . random_int(0, 99999),
            "order_date" => date("Y-m-d"),
            "user_id" => $_SESSION["user_data"]["id"],
            "tax" => $cart_subtotal * 0.06,
            "subtotal" => $cart_subtotal,
            "order_items" => $order_items
        ];

        // Save Customer Order Details and Products

        $order_id = $order->create_order($order_data);

        $_SESSION['order_id'] = $order_id;

        header("Location: success.php");
    }

}


include("includes/header.php");


?>

<!-- Main Content -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div>

            <?php

                if (!empty($errors)) {
                    echo "<div class='alert alert-danger mt-3'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul></div>";
                }

            ?>

            <h2 class="text-center mb-3">Checkout</h2>
            <div class="row">

                <div class="col-md-8">

                    <form action="checkout.php" method="post" class="mb-4"
                        >

                        <!-- User Information Section -->
                        <h5 class="mt-4 text-muted">Customer Information</h5>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name bg-light" name="first_name"
                                    value="<?php echo $first_name; ?>"
                                    readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control bg-light" id="last_name" name="last_name"
                                    value="<?php echo $last_name; ?>"
                                    readonly>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-light" id="email" name="email"
                                value="<?php echo $email; ?>"
                                readonly>
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Phone No.</label>
                            <input type="text" class="form-control" id="phone" name="phone" 
                            value="<?php echo $_POST['phone'] ?? ''; ?>">
                        </div>


                        <!-- Shipping Address Section -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address</label>
                            <input class="form-control" id="address" name="address" value="<?php echo $_POST['address'] ?? ''; ?>">
                        </div>

                        <!-- Payment Information Section -->
                        <h5 class="mt-4 text-muted">Payment Information</h5>
                        <hr>

                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" value="<?php echo $_POST['card_number'] ?? ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="expiry_date" name="expiry_date"
                                placeholder="MM/YY" value="<?php echo $_POST['expiry_date'] ?? ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" value="<?php echo $_POST['cvv'] ?? ''; ?>">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-dark">Place Order</button>
                    </form>

                </div>


                <div class="col-md-4">
                    <table class="table table-bordered mt-4">

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
                                <td>$<?php echo $cart_subtotal; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tax (6%)</td>
                                <td>$<?php echo number_format($cart_subtotal * 0.06, 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>$<?php echo number_format($cart_subtotal + ($cart_subtotal * 0.06), 2); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>