<?php
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
    public function insert($sql)
    {
        $this->query($sql);
        return $this->conn->insert_id;
    }

    // Method to close the database connection
    public function close()
    {
        $this->conn->close();
    }
}
