<?php

namespace App;

use Exception;
use mysqli;

/**
 * ArticleRepository class
 * Handles operations related to articles in the database.
 * 
 * @package App
 */
class DatabaseConnection
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($database_connection_details)
    {

        $required_keys = ['servername', 'username', 'password', 'database_name'];
        foreach ($required_keys as $key) {
            if (!array_key_exists($key, $database_connection_details)) {
                die("Missing database  configuration key: $key");
            }
        }
        $servername = $database_connection_details['servername'];
        $username = $database_connection_details['username'];
        $password = $database_connection_details['password'];
        $database_name = $database_connection_details['database_name'];

        try {
            $this->conn = new mysqli($servername, $username, $password, $database_name);
        } catch (Exception $e) {
            die("Database connection failed: " . $e);
        }
    }

    // Method to execute a query and return results
    public function query($sql)
    {
        $result = $this->conn->query($sql);
        if ($result === FALSE) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }

    // Method to fetch all results from a query
    public function fetchAll($sql)
    {
        $result = $this->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Method to insert data into the database
    public function insert($sql, $params)
    {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        // Bind parameters to the statement
        // Determine the types of the parameters
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i'; // Integer
            } elseif (is_double($param)) {
                $types .= 'd'; // Double
            } elseif (is_string($param)) {
                $types .= 's'; // String
            } else {
                $types .= 'b'; // Blob (for binary data)
            }
        }

        $stmt->bind_param($types, ...$params);

        // Execute the statement
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        // Get the ID of the inserted record
        $insert_id = $stmt->insert_id;

        // Close the statement
        $stmt->close();

        return $insert_id;
    }



    // Method to close the database connection
    public function close()
    {
        $this->conn->close();
    }
}
