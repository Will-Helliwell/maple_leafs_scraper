<?php

namespace App\Parser;

class NHL 
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
            '/data-title="([^"]+?)"\s*?data-author="([^"]+?)"\s*?data-url="([^"]+?)"[^>]+?data-pub-date="([^"]+?)"/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[1][$key],
                'url' => 'https://www.nhl.com' . $matches[3][$key],
                'author' => $matches[2][$key],
                'date' => Date('Y-m-d H:i:s', strtotime($matches[4][$key]))
            ];
        }

        return $response;
    }
}