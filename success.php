<?php 

session_start();
include("includes/header.php"); 
include("classes/cart.php");

$cart = new Cart();

$cart->empty_cart();

?>

<div class="container mt-5 pt-lg-5 text-center" style="min-height: 70vh;">

      
     <span class="border-dark fw-bold my-4 d-inline-block border border-2 px-2 py-1 fs-6"
      style="letter-spacing: 0.1rem;">Suma Handmade Ceramics</span>
            

     <h1 class="mb-4 display-4">Order Placed Successfully!</h1>

     <p class="mb-4 lead text-muted">Thankyou for shopping with Us.</p>
     
     <a href="invoice.php?order_id=<?php echo $_SESSION['order_id'] ?? ''; ?>" target="_blank" class="btn btn-dark mb-5">Download Invoice</a>
     <a href="products.php" target="_blank" class="btn btn-success mb-5">Back to Shop</a>

</div>


<?php 

  unset($_SESSION["order_id"]);

  include("includes/footer.php"); 

?>
