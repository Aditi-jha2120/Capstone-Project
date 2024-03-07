<?php

class Product
{
    private $db;

    function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    function get_product($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
    
    function get_all_products($search = null, $category = null, $on_sale = null)
    {

        // Filter Products
        
        $sql = "SELECT * FROM products 
        WHERE ('$search' = '' OR title LIKE '%$search%')
        AND ('$category' = '' OR category = '$category')
        AND ('$on_sale' = '' OR on_sale = 1);";
       
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    function get_products_by_category($category)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category = :category");
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    function get_products_on_sale($limit = null)
    {

        $query = "SELECT * FROM products WHERE on_sale = 1";

        $query = $limit ? $query . "  LIMIT $limit" : $query;

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    function get_products_categories()
    {
        $stmt = $this->db->prepare("SELECT DISTINCT category FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>
