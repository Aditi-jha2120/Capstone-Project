<?php

class Order
{
    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }


    // All User Orders
    public function get_user_orders($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_order($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function get_order_items($order_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM order_items JOIN products ON order_items.product_id = products.id WHERE order_id = :order_id");
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }



    // Create Order
    public function create_order($data)
    {
        $order_num = $data["order_num"];
        $order_date = $data["order_date"];
        $user_id = $data["user_id"];
        $tax = $data["tax"];
        $subtotal = $data["subtotal"];
        $order_items = $data["order_items"];

        // Insert the order into the orders table
        $stmt = $this->db->prepare("INSERT INTO orders (order_num, order_date, user_id, tax, subtotal) VALUES (:order_num, :order_date, :user_id, :tax, :subtotal)");
        $stmt->bindParam(':order_num', $order_num);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':tax', $tax);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->execute();

        // Get the ID of the inserted order
        $order_id = $this->db->lastInsertId();

        // Insert the order items into the order_items table
        foreach ($order_items as $item) {

            $product_id = $item["product_id"];
            $quantity = $item["quantity"];
            $price = $item["price"];

            $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
        }

        return $order_id;

    }



}
