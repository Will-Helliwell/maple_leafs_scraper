<?php
namespace App;

class SourceRepository
{
    private $db;

    public function __construct($dbDetails)
    {
        $this->db = new DatabaseConnection($dbDetails);
    }

    public function getAllSources()
    {
        return $this->db->fetchAll("SELECT id, url FROM sources;");
    }

    public function close()
    {
        $this->db->close();
    }
}