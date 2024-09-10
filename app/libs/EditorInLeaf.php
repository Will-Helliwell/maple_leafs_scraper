<?php

namespace App\Parser;

class EditorInLeaf 
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
            '/<time\s*?datetime="([^"]+?)"[\w\W]+?<a\s*?href="([^"]+?)"\s*?rel="bookmark"[^>]+?>([^<]+?)<\/a>[\w\W]+?class="auth-name">([^<]+?)<\/a>/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[3][$key],
                'url' => $matches[2][$key],
                'author' => $matches[4][$key],
                'date' => Date('Y-m-d H:i:s', strtotime($matches[1][$key]))
            ];
        }
        
        return $response;
    }
}