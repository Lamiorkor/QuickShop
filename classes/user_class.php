<?php
// Connect to database class
require_once("../settings/db_class.php");

/**
 * User class to handle user-related database functions.
 */
class User extends db_connection
{
    // Add a new customer to the database
    public function addUser($name, $email, $password)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $user_name = mysqli_real_escape_string($ndb->db_conn(), $name);
        $user_email = mysqli_real_escape_string($ndb->db_conn(), $email);
        $user_password = mysqli_real_escape_string($ndb->db_conn(), $password);

        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // SQL query to insert a new customer
        $sql = "INSERT INTO `users` (`name`, `email`, `password`, `role`) 
                VALUES ('$user_name', '$user_email', '$hashed_password', 'customer')";

        // Execute query and return result
        return $ndb->db_query($sql);
    }

    // Check if an email already exists in the database
    public function emailExists($email)
    {
        $ndb = new db_connection();

        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $ndb->db_query($sql);
        return $ndb->db_count() > 0;
    }

    // Login function
    public function login($email, $password)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        
        // Prepare SQL statement
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $ndb->db_query($sql);
        
        if ($result) {
            // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($ndb->results);
            
            if ($row) {
                // Verify the password
                if (password_verify($password, $row['password'])) {
                    // Start a session and store user info
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_role'] = $row['role'];

                    // Return user data
                    return $row;
                } else {
                    // Incorrect password
                    return false;
                }
            } else {
                // User not found
                return false;
            }
        } else {
            return false; // Query failed
        }
    }

    public function getAllCustomers()
    {
        $ndb = new db_connection();
    
        // SQL query to select all customers
        $sql = "SELECT * FROM `users` WHERE `role` = 'customer'";
        
        // Execute the query
        if (!$ndb->db_query($sql)) {
            return false; // Return false if query fails
        }
    
        // Fetch all customers
        return $ndb->db_fetch_all();
    }

    public function getAllUsers() 
    {
        $ndb = new db_connection();

        // SQL query to select all users
        $sql = "SELECT * FROM `users`";
        
        // Execute the query
        if (!$ndb->db_query($sql)) {
            return false; // Return false if query fails
        }

        // Fetch all users
        return $ndb->db_fetch_all();
    }
    

    public function addRequest($userID, $role)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $role_requested = mysqli_real_escape_string($ndb->db_conn(), $role);

        // SQL query to insert a new customer
        $sql = "INSERT INTO `requests` (`user_id`, `role_requested`) 
                VALUES ('$user_id', '$role_requested')";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function changeRoleToAdmin($user_id) 
    {
        $ndb = new db_connection();

        // SQL query to change the role of a user
        $sql = "UPDATE `users` SET `role` = 'administrator' WHERE `user_id` = '$user_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function changeRoleToInvMan($user_id) 
    {
        $ndb = new db_connection();

        // SQL query to change the role of a user
        $sql = "UPDATE `users` SET `role` = 'inventory manager' WHERE `user_id` = '$user_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function changeRoleToSalesPrsnl($user_id) 
    {
        $ndb = new db_connection();

        // SQL query to change the role of a user
        $sql = "UPDATE `users` SET `role` = 'sales personnel' WHERE `user_id` = '$user_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function changeRoleToCustomer($user_id) 
    {
        $ndb = new db_connection();

        // SQL query to change the role of a user
        $sql = "UPDATE `users` SET `role` = 'customer' WHERE `user_id` = '$user_id'";

        // Execute query and return result
        return $this->db_query($sql);
    }

}

?>