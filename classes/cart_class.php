<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Cart class to handle cart-related database functions.
 */
class Cart extends db_connection {
    // Add a new cart to the database
    public function addToCart($userID, $productID, $quantity) {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";

            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, prepare SQL statement
            $sql = "INSERT INTO `cart` (`user_id`, `product_id`, `qty`) 
                    VALUES ('$user_id', '$product_id', '$qty')";

            // Execute query and return result
            return $this->db_query($sql); 
        }   
    }

    public function getCartItems($userID) {
        $ndb = new db_connection();
    
        // Sanitize input to prevent SQL injection
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
    
        // Prepare SQL statement
        $sql = "SELECT `cart`.`qty`, `cart`.`product_id`, `products`.`pname`, `products`.`price` 
                FROM `cart` 
                JOIN `products` ON `products`.`product_id` = `cart`.`product_id`
                WHERE `cart`.`user_id` = '$user_id'";
    
        // Execute the query
        if ($ndb->db_query($sql)) {
            // Fetch all results
            $cart_items = $ndb->db_fetch_all();
    
            // Check if there are any results
            if ($cart_items) {
                return $cart_items; // Return the results as an associative array
            } else {
                return []; // Return an empty array if no results are found
            }
        } else {
            // Return empty array if query execution failed
            return [];
        }
    }

    public function deleteCartItem($productID, $userID) {
        $ndb = new db_connection();

        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);

        // Prepare SQL statement
        $sql = "DELETE FROM `cart` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";

        // Execute query and return result
        return $ndb->db_query($sql);
    }

    public function getOneCartItem($productID, $userID) {
        $ndb = new db_connection();

        // Escape the service ID to prevent SQL injection attacks
        $product_id = $ndb->db_conn()->real_escape_string($productID);
        $user_id = $ndb->db_conn()->real_escape_string($userID);

        // Prepare SQL statement with a placeholder for the service ID
        $sql = "SELECT `cart`.*, `products`.`pname` FROM `cart` 
                JOIN `products` ON `cart`.`product_id` = `products`.`product_id` 
                WHERE `cart`.`product_id` = '$product_id' AND `cart`.`user_id` = '$user_id'";    

        // Execute the query using the db_query method and fetch the result
        if ($ndb->db_query($sql)) {
            return $ndb->db_fetch_one($sql); // Fetch and return the single record
        } else {
            return false; // Return false if the query fails
        }
    }
    
    public function increaseCartItemQty($productID, $userID, $quantity) {
        $ndb = new db_connection();

        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            // Prepare SQL query
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, return false
            return false;
        }
    }

    public function decreaseCartItemQty($productID, $userID, $quantity) {
        $ndb = new db_connection();

        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
        $result = $this->db_fetch_one($check);

        if($result && $result['qty'] > 0) {
            $newQty = $result['qty'] - $qty;
            // Prepare SQL query
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, return false
            return false;
        }
    }

    public function getCartItemsCost($userID) {
        $ndb = new db_connection();
    
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
    
        // Prepare SQL statement to get price, quantity, and product name
        $sql = "SELECT `cart`.`qty`, `products`.`price` 
                FROM `cart` 
                JOIN `products` ON `products`.`product_id` = `cart`.`product_id`
                WHERE `cart`.`user_id` = '$user_id'";
        
         // Execute the query
         if ($ndb->db_query($sql)) {
            // Fetch all results
            $cart_items = $ndb->db_fetch_all();

            // Calculate total cost
            $total_cost = 0;
            if ($cart_items) {
                foreach ($cart_items as $item) {
                    $total_cost += $item['qty'] * $item['price']; // Multiply quantity by price
                }
            }

            // Return the total cost
            return $total_cost;
        } else {
            // Return 0 if query execution failed
            return 0;
        }
    }

    public function clearCart($user_id) {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);

        // Prepare SQL statement to delete all cart items for a specific user
        $sql = "DELETE FROM `cart` WHERE `user_id` = '$user_id'";

        // Execute query and return result
        return $ndb->db_query($sql);
    }
    
}

?>
