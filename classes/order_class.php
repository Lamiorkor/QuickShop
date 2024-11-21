<?php
// Connect to database class
require_once("../settings/db_class.php");

/**
 * Orders class to handle order-related database functions.
 */
class Orders extends db_connection
{
    public function addOrder($userID, $orderDate, $amount)
    {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $order_date = mysqli_real_escape_string($ndb->db_conn(), $orderDate);
        $order_amount = mysqli_real_escape_string($ndb->db_conn(), $amount);

        // Prepare SQL statement
        $sql = "INSERT INTO `orders` (`user_id`, `date`, `total_amount`) 
                VALUES ('$user_id', '$order_date', '$order_amount')";

        if ($ndb->db_query($sql)) {
            $insert_id = $ndb->get_insert_id();
            if($insert_id > 0) {
                return $insert_id;
            } else {
                error_log("Insert ID not found. Check DB connection");
                return false;
            }
        } else {
            error_log("Error adding order: ". mysqli_error($ndb->db_conn()));
            return false;
        }
    }

    public function addOrderDetails($orderID, $productID, $quantity, $productPrice)
    {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);
        $price = mysqli_real_escape_string($ndb->db_conn(), $productPrice);
        
        // Prepare SQL statement
        $sql = "INSERT INTO `order_details` (`order_id`, `product_id`, `qty`, `price`) 
                VALUES ('$order_id', '$product_id', '$qty', '$price')";

        // Execute query and return result
        return $this->db_query($sql);    
    }


    public function deleteOrder($orderID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `orders` WHERE `order_id` = '$orderID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    function getOrders() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT * FROM `orders`";
        $result = mysqli_query($ndb->db_conn(), $sql);
    
        // Initialize an empty array
        $orders = array();
    
        // Fetch and store the categories in the array
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[] = $row;
            }
        }
    
        return $orders;
    }

    function getTotalOrders() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT COUNT(*) as total_orders FROM `orders`";

        $result = $this->db_fetch_one($sql);

        return $result['total_orders'];
    
        
    }

    function getTotalOrderAmounts() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT SUM(total_amount) as total_revenue FROM `orders`";

        $result = $this->db_fetch_one($sql);

        return $result['total_revenue'];
    
        
    }
    
}
?>
