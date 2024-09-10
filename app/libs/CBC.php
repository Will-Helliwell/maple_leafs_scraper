<?php

namespace App\Parser;

class CBC 
{

    /**
     * 
     * @param string $content 
     * @return array 
     */
    public static function parse(string $content) : array
    {
        $response = [];

        if(!preg_match_all(
            '/itemURL":"([^"]+?)"[\w\W]+?publishTime":(\d+),[^\}]+?"title":"([^"]+?)"[^}]+?author":\{"name":"([^"]+?)"/', $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $article_url = \str_replace('\u002F', '/', $matches[1][$key]);

            $response[] = [
                'title' => $matches[3][$key],
                'url' => $article_url,
                'author' => $matches[4][$key],
                'published_at' => date('Y-m-d H:i:s', $matches[2][$key]),
            ];
        }

        return $response;
    }
}