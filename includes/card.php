<div class="card text-body position-relative">


    <?php if($product[6] == true): ?>
    <span class="badge bg-danger position-absolute top-0 start-0 p-2"
        style="transform: translate(4px, -6px);">SALE</span>
    <?php endif; ?>

    <a href="details.php?pid=<?php echo $product[0]; ?>">
        <img src="<?php echo "images/$product[2]"; ?>"
            class="card-img-top" alt="<?php echo $product[1]; ?>">
    </a>

    <div class="card-body pb-0">
        <h5 class="card-title"><?php echo $product[1]; ?></h5>
        <p class="card-text badge bg-success">
            <?php echo $product[4]; ?>
        </p>

        <p class="card-text">

            <?php if($product[6] == true): ?>

            <del
                class="small">$<?php echo number_format($product[5] + $product[5] * 0.25, 2); ?></del>

            <?php endif; ?>


            <span
                class="fw-bold"><?php echo "$" . $product[5]; ?></span>



            <!-- Add to Cart Form -->
        <form method="post" action="cart.php" class="d-inline-block w-100 ">


            <input type="hidden" id="qty" name="qty" class="form-control" value="1" min="1" max="10">
            <input type="hidden" name="pid"
                value="<?php echo $product[0]; ?>">

            <button type="submit" name="add_to_cart" class="btn btn-dark w-100 d-flex align-items-center justify-content-center">
                <svg width="20" class="me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>

                Add to Cart</button>
        </form>

        </p>

    </div>
</div>