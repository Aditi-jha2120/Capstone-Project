<?php

session_start();


include("includes/header.php");
include("classes/db_conn.php");
include("classes/product.php");

$db_conn = new DatabaseConn();

$product = new Product($db_conn->get_db_conn());

// 3 products on sale
$products_on_sale = $product->get_products_on_sale(6);



?>

<!-- Banner -->
<section class="banner">
    <div class="container">
        <h1 class="mb-3 display-3">Welcome to <br> Suma Handmade Ceramics</h1>
        <p class="lead mb-4">Where Passion Meets Craftsmanship Shop, Explore,
            and Master the World of Handmade Potter.
        </p>
        <a href="products.php" class="btn btn-light btn-lg">Explore Products</a>
    </div>
</section>

<!-- Main Content -->
<section class="container py-5">
    <h2 class="mb-4 pb-2 text-center">Products On Sale</h2>


    <div class="row mb-5">

        <?php foreach($products_on_sale as $product) { ?>

            <div class="col-md-4 mb-4">
                
                <!-- Product Card  -->
            <?php include("includes/card.php"); ?>

        </div>

        <?php } ?>
    </div>

    <div class="text-center">

        <a href="products.php" class="btn btn-dark">More Products</a>

    </div>

</section>


<?php include("includes/footer.php"); ?>