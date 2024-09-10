<?php

namespace App\Parser;

class TheGlobeAndMail 
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
            '/canonical_url":"([^"]+?)"[\w\W]+?name":"([^"]+?)","type":"author"[\w\W]+?display_date":"([^"]+?)","headlines":\{"basic":"([^"]+?)"/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'url' => 'https://www.theglobeandmail.com' . $matches[1][$key] . '',
                'title' => $matches[4][$key],
                'author' => $matches[2][$key],
                'date' => Date('Y-m-d H:i:s', strtotime($matches[3][$key])),
            ];
        }
        
        return $response;
    }
}