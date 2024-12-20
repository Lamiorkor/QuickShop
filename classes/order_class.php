<?php
// Connect to database class
require_once ('../settings/db_class.php');
require_once ('../controllers/user_controller.php');


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


    public function getOrderDetailsByUser($userID) {
        $ndb = new db_connection();
        
        // Sanitize the userID using mysqli_real_escape_string
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
    
        // SQL query to select order details along with product names for all orders by the user
        $sql = "SELECT `orders`.`order_id`, `orders`.`date` AS order_date, `orders`.`total_amount`, `orders`.`status` AS order_status,
                       `order_details`.`qty`, `order_details`.`price`, `products`.`pname`
                FROM `order_details`
                JOIN `products` ON `order_details`.`product_id` = `products`.`product_id`
                JOIN `orders` ON `order_details`.`order_id` = `orders`.`order_id`
                WHERE `orders`.`user_id` = '$user_id'
                ORDER BY `orders`.`date` DESC";
        
        // Execute the query
        if ($ndb->db_query($sql)) {
            // Fetch all results as an associative array
            $order_details = $ndb->db_fetch_all();
            return $order_details ? $order_details : [];
        } else {
            error_log("Error retrieving order details: " . mysqli_error($ndb->db_conn()));
            return [];
        }
    }

    public function getAllOrderDetails() {
        $ndb = new db_connection();
            
        // SQL query to select order details along with product names for all orders by the user
        $sql = "SELECT `order_details`.`order_detail_id`, `orders`.`order_id`, `orders`.`status` AS order_status, 
                        `order_details`.`qty`, `order_details`.`price`, `products`.`pname`
                FROM `order_details`
                JOIN `products` ON `order_details`.`product_id` = `products`.`product_id`
                JOIN `orders` ON `order_details`.`order_id` = `orders`.`order_id`
                ORDER BY `orders`.`date` DESC";
        
        // Execute the query
        if ($ndb->db_query($sql)) {
            // Fetch all results as an associative array
            $order_details = $ndb->db_fetch_all();
            return $order_details ? $order_details : [];
        } else {
            error_log("Error retrieving order details: " . mysqli_error($ndb->db_conn()));
            return [];
        }
    }
    

    public function deleteOrder($orderID) {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);

        // Prepare SQL statement
        $sql = "DELETE FROM `orders` WHERE `order_id` = '$order_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function deleteOrderDetail($orderDetailID) {
        $ndb = new db_connection();

        $order_detail_id = mysqli_real_escape_string($ndb->db_conn(), $orderDetailID);

        // Prepare SQL statement
        $sql = "DELETE FROM `order_details` WHERE `order_detail_id` = '$order_detail_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    function getOrders() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT `orders`.*, `users`.`name` FROM `orders` 
                JOIN `users` ON `orders`.`user_id` = `users`.`user_id`";
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

    function getOneOrder($order_id) {
        // Create a new db_connection instance
        $ndb = new db_connection();
    
        // Sanitize the order_id to prevent SQL injection
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $order_id);
    
        // SQL query to fetch order details along with the user's name
        $sql = "SELECT `orders`.*, `users`.`name` 
                FROM `orders` 
                JOIN `users` ON `orders`.`user_id` = `users`.`user_id`
                WHERE `orders`.`order_id` = '$order_id'";
    
        // Use the db_fetch_one method to execute and fetch the result
        $result = $ndb->db_fetch_one($sql);
    
        // Return the fetched result
        return $result;
    }

    function editOrder($orderID, $totalAmount, $status) {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $total_amt = mysqli_real_escape_string($ndb->db_conn(), $totalAmount);
        $order_status = mysqli_real_escape_string($ndb->db_conn(), $status);

        // Prepare SQL query
        $sql = "UPDATE `orders` SET `total_amount` = '$total_amt', `status` = '$order_status'
                WHERE `order_id` = '$order_id'";

        // Execute the query
        return $this->db_query($sql);
    }
    
    function editOrderDetail($orderID, $productID, $qty) {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $product_id = mysqli_real_escape_string($ndb->db_conn(), $productID);
        $quantity = mysqli_real_escape_string($ndb->db_conn(), $qty);

        // Prepare SQL query
        $sql = "UPDATE `order_details` SET `qty` = '$quantity'
                WHERE `order_id` = '$order_id' AND `product_id` = '$product_id'";

        // Execute the query
        return $this->db_query($sql);
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

    public function calculateTotalAmount($orderID) {
        $ndb = new db_connection();
    
        // Secure the orderID using mysqli_real_escape_string through db_conn
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
    
        // Query to calculate the total amount for the specific order
        $sql = "SELECT SUM(`price` * `qty`) AS total FROM `order_details` WHERE `order_id` = '$order_id'";
    
        // Execute the query and fetch the result
        $result = $ndb->db_query($sql);
        
        if ($result) {
            $row = $ndb->db_fetch_one($sql);
            if ($row && isset($row['total'])) {
                return $row['total']; // Return the total amount
            } else {
                return 0; // Return 0 if no rows were found
            }
        } else {
            error_log("Error calculating total amount: " . mysqli_error($ndb->db_conn()));
            return 0; // Return 0 if there's an error
        }
    }
    
    
    
    public function updateTotalAmount($orderID) {
        $ndb = new db_connection();
    
        // Calculate the total amount for the order
        $totalAmount = $this->calculateTotalAmount($orderID);
    
        // Ensure we have a valid total amount before proceeding
        if ($totalAmount !== false) {
            // Secure the orderID and totalAmount
            $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
            $total_amount = mysqli_real_escape_string($ndb->db_conn(), $totalAmount);
    
            // Update the orders table with the calculated total amount
            $sql = "UPDATE `orders` SET `total_amount` = '$total_amount' WHERE `order_id` = '$order_id'";
    
            // Execute the update query
            if ($ndb->db_query($sql)) {
                return true;
            } else {
                error_log("Error updating total amount: " . mysqli_error($ndb->db_conn()));
                return false;
            }
        } else {
            error_log("Failed to calculate total amount for order ID: $orderID");
            return false;
        }
    }

    public function increaseQty($detailID, $quantity) {
        $ndb = new db_connection();

        $order_detail_id = mysqli_real_escape_string($ndb->db_conn(), $detailID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `order_details` WHERE `order_detail_id` = '$order_detail_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            // Prepare SQL query
            $update = "UPDATE `order_details` SET `qty` = '$newQty' WHERE `order_detail_id` = '$order_detail_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If item doesn't already exist, return false
            return false;
        }
    }

    public function decreaseQty($detailID, $quantity) {
        $ndb = new db_connection();
    
        $order_detail_id = mysqli_real_escape_string($ndb->db_conn(), $detailID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);
    
        $check = "SELECT * FROM `order_details` WHERE `order_detail_id` = '$order_detail_id'";
        $result = $ndb->db_fetch_one($check);
    
        if ($result) {
            if ($result['qty'] > 0) {
                $newQty = max($result['qty'] - $qty, 0); // Prevent going below zero
                $update = "UPDATE `order_details` SET `qty` = '$newQty' WHERE `order_detail_id` = '$order_detail_id'";
                return $ndb->db_query($update); // Execute the update
            } else {
                // Quantity is already zero
                return false;
            }
        }
        // Item not found
        return false;
    }
    
    
}
?>
