<?php

namespace App\Parser;

class TheAthletic 
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
            '/permalink":"([^"]+?)"[^}]+?published_at":(\d+),"title":"([^"]+?)","author"[^}]+?first_name":"([^"]+?)","last_name":"([^"]+)"/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[3][$key],
                'url' => $matches[1][$key],
                'date' => date('Y-m-d H:i:s', $matches[2][$key]),
                'author' => $matches[4][$key] . ' ' . $matches[5][$key],
            ];
        }

        return $response;
    }
}