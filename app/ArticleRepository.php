<?php

namespace App;

/**
 * ArticleRepository class
 * Handles operations related to articles in the database.
 * 
 * @package App
 */

class ArticleRepository {
    protected $database;

    public function __construct($database_connection_details) {
        $this->database = new DatabaseConnection($database_connection_details);
    }
    
    // public function articleExists($title) {
    //     $query = "SELECT COUNT(*) FROM articles WHERE title = :title";
    //     $params = [':title' => $title];
    //     return $this->database->fetchOne($query, $params)['COUNT(*)'] > 0;
    // }

    public function insertArticle($article) {
        $query = "INSERT INTO articles (website_id, title, url, author, date_published) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $article['source_id'],
            $article['title'],
            $article['url'],
            $article['author'],
            $article['date'],
        ];
        return $this->database->insert($query, $params);
    }
    

    public function close() {
        $this->database->close();
    }
}


