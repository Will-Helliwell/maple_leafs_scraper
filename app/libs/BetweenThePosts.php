<?php

namespace App\Parser;

class BetweenThePosts 
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
            '/<h2><a\s*?href="([^"]+?)"[^>]+?title="([^"]+?)"[\w\W]+?itemprop="articleBody">\s*?[^\(]+?\(([\w\d\s]+?)\)/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[2][$key],
                'url' => $matches[1][$key],
                'date' => date('Y-m-d H:i:s', strtotime($matches[3][$key])),
                'author' => 'Between The Posts',
            ];
        }

        return $response;
    }
}