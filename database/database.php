<?php
class Database
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
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


