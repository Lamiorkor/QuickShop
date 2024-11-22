<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Cart class to handle cart-related database functions.
 */
class Cart extends db_connection {
    // Add a new cart to the database
    public function addToCart($serviceID, $customerID, $quantity) {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";

            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, prepare SQL statement
            $sql = "INSERT INTO `cart` (`s_id`, `c_id`, `qty`) 
                    VALUES ('$service_id', '$customer_id', '$qty')";

            // Execute query and return result
            return $this->db_query($sql); 
        }   
    }

    public function getCartItems() {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "SELECT `cart`.`s_id`, `cart`.`qty`, `services`.`service_name` FROM `cart` 
                JOIN `services` ON `cart`.`s_id` = `services`.`service_id`";
    
        // Execute the query and fetch all results
        $cart_items = $ndb->db_fetch_all($sql); 
    
        // Check if the query was successful
        if ($cart_items != null) {
            // Return all services as an associative array
            return $cart_items;
        } else {
            // Return an empty array if no results
            return [];
        }
    }

    public function deleteCartItem($serviceID, $customerID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `cart` WHERE `s_id` = '$serviceID' AND `c_id` = '$customerID'";

        // Execute query and return result
        return $ndb->db_query($sql);
    }

    public function getOneCartItem($serviceID, $customerID) {
        $ndb = new db_connection();

        // Escape the service ID to prevent SQL injection attacks
        $service_id = $ndb->db_conn()->real_escape_string($serviceID);
        $customer_id = $ndb->db_conn()->real_escape_string($customerID);

        // Prepare SQL statement with a placeholder for the service ID
        $sql = "SELECT `cart`.*, `services`.`service_name` FROM `cart` 
                JOIN `services` ON `cart`.`s_id` = `services`.`service_id` 
                WHERE `cart`.`s_id` = '$service_id' AND `cart`.`c_id` = '$customer_id'";    

        // Execute the query using the db_query method and fetch the result
        if ($ndb->db_query($sql)) {
            return $ndb->db_fetch_one($sql); // Fetch and return the single record
        } else {
            return false; // Return false if the query fails
        }
    }
    
    function increaseCartItemQty($serviceID, $customerID, $quantity) {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            // Prepare SQL query
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, return false
            return false;
        }
    }

    function decreaseCartItemQty($serviceID, $customerID, $quantity) {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
        $result = $this->db_fetch_one($check);

        if($result && $result['qty'] > 0) {
            $newQty = $result['qty'] - $qty;
            // Prepare SQL query
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, return false
            return false;
        }
    }
}
?>
