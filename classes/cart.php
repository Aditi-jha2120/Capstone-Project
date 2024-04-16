<?php


class Cart
{
    public function empty_cart()
    {

        $_SESSION["cart"] = array();

    }


    public function remove_cart_item($product_id)
    {

        unset($_SESSION["cart"][$product_id]);

    }


    public function add_to_cart_item($product_id, $quantity)
    {


        if (isset($_SESSION["cart"][$product_id])) {
            $_SESSION["cart"][$product_id]["quantity"] = $_SESSION["cart"][$product_id]["quantity"] + $quantity;
        } else {
            $_SESSION["cart"][$product_id] = array("quantity" => $quantity);
        }


    }

    public function get_cart_subtotal($products)
    {

        $cart = $_SESSION["cart"];
        $total = 0;

        foreach ($cart as $productId => $item) {
            foreach ($products as $product) {
                if ($product["id"] == $productId) {
                    $total += $product["price"] * $item["quantity"];
                }
            }
        }

        return $total;


    }



}
