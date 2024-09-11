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

    public function getAllArticlesGroupedBySource() {
        $query = "SELECT id, source_id, url FROM articles";
        $articles = $this->database->fetchAll($query);

        $groupedArticles = [];
        foreach ($articles as $article) {
            $source_id = $article['source_id'];
            if (!isset($groupedArticles[$source_id])) {
                $groupedArticles[$source_id] = [];
            }
            $groupedArticles[$source_id][] = $article;
        }

        return $groupedArticles;
    }

    public function insertArticle($article) {
        $query = "INSERT INTO articles (source_id, title, url, author, date_published) VALUES (?, ?, ?, ?, ?)";
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


