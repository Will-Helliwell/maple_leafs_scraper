<?php

namespace App\Parser;

class TheStar 
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
            '/"url":"([^"]{100,}\.html)"[\w\W]+?"headline":"([^"]+?)",[\w\W]+?lastmodified":(\d+),[\w\W]+?"author":"([^"]+?)"/', $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[2][$key],
                'url' => 'https://www.thestar.com' . $matches[1][$key],
                'author' => $matches[4][$key],
                'date' => Date('Y-m-d H:i:s', $matches[3][$key])
            ];
        }

        return $response;
    }
}