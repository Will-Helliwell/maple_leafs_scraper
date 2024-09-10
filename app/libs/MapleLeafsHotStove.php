<?php

namespace App\Parser;

class MapleLeafsHotStove 
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
            '/entry-title[^"]+?"><a\s*?href="(http[^"]+?)"[^>]+?title="([^"]+?)">[\w\W]+?author-name"><a[^>]+?>([^<]+?)<\/a>[\w\W]+?datetime="([^"]+?)"/',
            $content, $matches)) {
            return [];
        }

        // loop through matches and add to response
        foreach($matches[0] as $key => $match) {

            $response[] = [
                'title' => $matches[2][$key],
                'url' => $matches[1][$key],
                'date' => date('Y-m-d H:i:s', strtotime($matches[4][$key])),
                'author' => $matches[3][$key],
            ];
        }

        return $response;
    }
}