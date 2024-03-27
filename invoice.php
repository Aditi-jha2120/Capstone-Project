<?php

session_start();


if(!$_SESSION["user_data"]) {
    header("Location: login.php");
}


if(!$_GET["order_id"]) {
    header("Location: login.php");
}

include("classes/fpdf/fpdf.php");

include("classes/db_conn.php");
include("classes/order.php");
include("classes/cart.php");


$db_conn = new DatabaseConn();

$customer_data = $_SESSION["customer_data"];

$order_obj = new Order($db_conn->get_db_conn());

$user_id = $_SESSION["user_data"]["id"];
$order_id = $_GET["order_id"];

$order = $order_obj->get_order($order_id);

$order_items = $order_obj->get_order_items($order_id);


class Invoice extends FPDF
{
    function Header()
    {
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, "Invoice", 0, 1, "C");
        $this->Ln(2);

        $this->SetFont("Arial", "B", 14);
        $this->Cell(0, 10, "Suma Handmade Ceramics", 0, 1, "C");
        $this->Ln(10);
    }


    function addCustomerDetails($customer)
    {
        $this->SetFont("Arial","B", 12);

        $this->Cell(0, 10, "Customer Details", 0, 1);

        $this->SetFont("Arial", "", 10);

        $this->Cell(0, 10, "Name: " . $customer["first_name"] ." ".$customer["last_name"], 0, 1);
        $this->Cell(0, 10, "Email: " . $customer["email"], 0, 1);
        $this->Cell(0, 10, "Phone No.: " . $customer["phone"], 0, 1);
        $this->Cell(0, 10, "Shipping Address: " . $customer["address"], 0, 1);
        $this->Ln(5);
    }

    function addItemsTable($order, $order_items)
    {
        $this->SetFont("Arial", "B", 10);
        $this->Cell(60, 10, "Product", 1);
        $this->Cell(40, 10, "Quantity", 1);
        $this->Cell(40, 10, "Price", 1);
        $this->Cell(40, 10, "Total", 1);
        $this->Ln();

        $this->SetFont("Arial", "", 10);


        foreach($order_items as $item) {
        
            
            $this->Cell(60, 10, $item["title"], 1, 0);
            $this->Cell(40, 10, $item["quantity"], 1, 0);
            $this->Cell(40, 10, "$" . $item["price"], 1, 0);
            $this->Cell(40, 10, "$" . $item["price"] * $item["quantity"].".00", 1, 0);
            
            $this->Ln();
           
        }


        // Total
        $this->Ln(5);

        $this->SetFont("Arial","B", 12);
        $this->Cell(60, 10, "Sub Total : $" . number_format($order["subtotal"], 2) , 1);

        $this->Ln();
        
        $this->SetFont("Arial","B", 12);
        $this->Cell(60, 10, "Tax (6%) : $" . number_format($order["subtotal"] * 0.06, 2) , 1) ;

        $this->Ln();
        
        $this->SetFont("Arial","B", 12);
        $this->Cell(60, 10, "Total : $" . number_format($order["tax"] + $order["subtotal"], 2) , 1);
        
    }
}



// Create instance of Invoice class
$pdf = new Invoice();
$pdf->AddPage();
$pdf->addCustomerDetails($customer_data);
$pdf->addItemsTable($order, $order_items);
$pdf->SetTitle('INVOICE');

$cart = new Cart();
$cart->empty_cart();


// Output PDF
$pdf->Output();



?>
