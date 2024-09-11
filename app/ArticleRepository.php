<?php

namespace App;

/**
 * ArticleRepository class
 * Handles operations related to articles in the database.
 * 
 * @package App
 */

class ArticleRepository
{
    protected $database;

    public function __construct($database_connection_details)
    {
        $this->database = new DatabaseConnection($database_connection_details);
    }

    public function getAllArticlesGroupedBySourceAndUrl()
    {
        $query = "SELECT id, source_id, url, title FROM articles";
        $articles = $this->database->fetchAll($query);

        $groupedArticles = [];
        foreach ($articles as $article) {
            $source_id = $article['source_id'];
            $url = $article['url'];

            // Initialize the array for the source_id if it doesn't exist
            if (!isset($groupedArticles[$source_id])) {
                $groupedArticles[$source_id] = [];
            }

            // Add the article to the grouped array using URL as the key
            $groupedArticles[$source_id][$url] = $article;
        }

        return $groupedArticles;
    }


    public function insertArticle($article)
    {
        // Truncate the title to 255 characters (max that can be stored in db unless changing data type or hashing before storage)
        $title = $article['title'];
        $max_length = 255;
        if (strlen($title) > $max_length) {
            $title = substr($title, 0, $max_length);
        }

        $query = "INSERT INTO articles (source_id, title, url, author, date_published) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $article['source_id'],
            $title,
            $article['url'],
            $article['author'],
            $article['date'],
        ];
        return $this->database->insert($query, $params);
    }


    public function close()
    {
        $this->database->close();
    }
}
