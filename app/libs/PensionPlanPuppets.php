<?php

namespace App\Parser;

class PensionPlanPuppets 
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
            '/<h2\s*?class="title\s*?h5"><a\s*?href="([^"]+?)">([^<]+?)<\/a>[\w\W]+?author"><span>By<\/span>([^<]+?)<\/a>[\w\W]+?datetime="([^"]+?)"/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[2][$key],
                'url' => 'https://www.pensionplanpuppets.com' . $matches[1][$key], // add domain to link
                'date' => date('Y-m-d H:i:s', strtotime($matches[4][$key])),
                'author' => $matches[3][$key],
            ];
        }

        return $response;
    }
}