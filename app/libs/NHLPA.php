<?php

namespace App\Parser;

class NHLPA 
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
            '/<a[^>]+?href="([^"]+?)"[\w\W]+?<h4>([^<]+?)<\/h4>[\w\W]+?author">\s*By:\s*?([^<]+?)<\/div>[\w\W]+?calendar"><\/i>\s*?([^<]+?)<\/span>/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $title = $matches[2][$key];

            if(\str_contains($title, '{{title}}')) {
                continue;
            }

            $response[] = [
                'title' => $matches[2][$key],
                'url' => 'https://www.nhlpa.com' . $matches[1][$key],
                'author' => $matches[3][$key],
                'date' => Date('Y-m-d H:i:s', strtotime($matches[4][$key]))
            ];
        }

        return $response;
    }
}