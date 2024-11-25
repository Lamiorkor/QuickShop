<?php

// Connect to database class
require_once("../settings/db_class.php");

/**
 * Product class to handle product-related database functions.
 */
class Product extends db_connection
{
    // Add a new product to the database
    public function addProduct($pname, $description, $price, $stock_qty)
    {
        $ndb = new db_connection();

        $product_name = mysqli_real_escape_string($ndb->db_conn(), $pname);
        $product_description = mysqli_real_escape_string($ndb->db_conn(), $description);
        $product_price = mysqli_real_escape_string($ndb->db_conn(), $price);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $stock_qty);

        
        // Prepare SQL statement
        $sql = "INSERT INTO `products` (`pname`, `description`, `price`, `stock_qty`) 
                VALUES ('$product_name', '$product_description', '$product_price', '$qty')";

        // Execute query and return result
        return $this->db_query($sql);    
    }

    public function deleteProduct($productID) {
        $ndb = new db_connection();

        // Escape the product ID to prevent SQL injection attacks
        $product_id = $ndb->db_conn()->real_escape_string($productID);

        // Prepare SQL statement
        $sql = "DELETE FROM `products` WHERE `product_id` = '$product_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function getProducts() {
        // Initialize a new database connection
        $ndb = new db_connection();
        
        // Prepare SQL statement
        $sql = "SELECT * FROM `products`";
        
        // Execute the query using the db_query method, which assigns the result to $ndb->results
        if ($ndb->db_query($sql)) {
            // Fetch all results from the query
            $products = $ndb->db_fetch_all();
            
            // Check if any products were retrieved
            if ($products) {
                return $products; // Return the array of products
            }
        }
        
        // Return an empty array if no products found or query failed
        return [];
    }
    

    public function getOneProduct($productID) {
        $ndb = new db_connection();

        // Escape the product ID to prevent SQL injection attacks
        $product_id = $ndb->db_conn()->real_escape_string($productID);

        // Prepare SQL statement with a placeholder for the product ID
        $sql = "SELECT * FROM `products` 
                WHERE `product_id` = '$product_id'";    

        // Execute the query using the db_query method and fetch the result
        if ($ndb->db_query($sql)) {
            return $ndb->db_fetch_one($sql); // Fetch and return the single record
        } else {
            return false; // Return false if the query fails
        }
    }
    
    function editProduct($productID, $pname, $description, $price, $stock_qty) {
        $ndb = new db_connection();

        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $product_name = mysqli_real_escape_string($ndb->db_conn(), $pname);
        $product_description = mysqli_real_escape_string($ndb->db_conn(), $description);
        $product_price = mysqli_real_escape_string($ndb->db_conn(), $price);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $stock_qty);

        // Prepare SQL query
        $sql = "UPDATE `products` SET `pname` = '$product_name', `description` = '$product_description', 
                `price` = '$product_price', `stock_qty` = '$qty'
                WHERE `product_id` = '$product_id'";

        // Execute the query
        return $this->db_query($sql);
    }

    function getTotalProducts(){
        $sql = "SELECT COUNT(*) AS total_products FROM `products`";
        $result = $this->db_fetch_one($sql);
        $total_products = $result;
        return $total_products['total_products'];
        
    }
    
}

?>
