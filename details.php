<?php

session_start();

if(!isset($_GET['pid'])) {

    header('Location: products.php');
    exit;

}

include("includes/header.php"); 
include("classes/db_conn.php"); 
include("classes/product.php"); 

$db_conn = new DatabaseConn();

$product_obj = new Product($db_conn->get_db_conn()); 

$product_id = $_GET['pid'];

$product = $product_obj->get_product($product_id);


?>

<div class="container my-5">

       <div class="row">
        <div class="col-md-6">

            <!-- product image -->
                
            <div class="position-relative">
                
                <?php if($product[6] == true): ?>
                    <span class="badge bg-danger position-absolute top-0 start-0 p-2 lead" style="transform: translate(-10px, -10px);">SALE</span> 
                <?php endif; ?>

                <img src="<?php echo "images/$product[2]"; ?>" class="w-100 rounded mb-4 mb-lg-5" alt="<?php echo $product[1]; ?>">
            
            </div>


        </div>

        <div class="col-md-6">

            <!-- product info -->
            <h3 class="mb-2">
                <?php echo $product['title']; ?>

            </h3>
            
            <p class="badge bg-success mb-2"><?php echo $product[4]; ?></p>
            
            <p><?php echo $product[3]; ?></p>

            <p>
                <?php if($product[6] == true): ?>

                    <del class="small">$<?php echo number_format($product[5] + $product[5] * 0.25, 2); ?></del>

                <?php endif; ?>

                <span class="fw-bold fs-5">$<?php echo $product['price']; ?></span>
                
            </p>

            
            <!-- Add to Cart Form -->
            <form method="post" action="cart.php" class="d-flex">

                <input type="number" id="qty" name="qty" class="form-control" value="1" min="1" max="10">
                <input type="hidden" name="pid" value="<?php echo $product[0]; ?>">

                <button type="submit" name="add_to_cart" class="btn btn-dark ms-2" style="width: 160px;">Add to Cart</button>
            </form>


        </div>
    </div>

</div>
<?php


include 'includes/footer.php';

?>