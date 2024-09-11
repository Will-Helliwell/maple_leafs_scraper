<?php

return array(

    // user agent used in parse request
    'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',

    // sleep between requests in seconds
    'sleep_between_requests' => 0,

    // select output type
    // 'output_type' => 'json',
    'output_type' => 'database',

    // sources to parse seperated by comma
    'sources' => [

        //  'https://www.nhl.com/mapleleafs/news/',
        //  'https://www.nhl.com/news',
        //  'https://www.thestar.com/sports/leafs.html',
        //  'https://theleafsnation.com/category/news',
        //  'https://theathletic.com/nhl/',
        //  'https://www.pensionplanpuppets.com/',
        //  'https://mapleleafshotstove.com/leafs-news/',
        //  'https://betweentheposts.ca/',
        //  'https://centreofleafsnation.com/',
        //  'https://www.nhlpa.com/news',
        //  'https://torontosun.com/category/sports/hockey/nhl/toronto-maple-leafs/',
        //  'https://www.theglobeandmail.com/sports/hockey/',
        //  'https://nationalpost.com/category/sports/hockey/nhl/',
        //  'https://www.sportsnet.ca/hockey/nhl/',
        //  'https://www.tsn.ca/nhl/team-page/toronto-maple-leafs/166',
        //  'https://www.cbc.ca/sports/hockey/nhl',
         'https://globalnews.ca/tag/nhl/',
        //  'https://www.ctvnews.ca/sports',
        //  'https://editorinleaf.com/toronto-maple-leafs-news/',
        
    ],

    // search terms to include in the article seperated by comma
    'search_terms' => [
         "leafs",
    ],

    // MySQL database connection details
    'database_connection_details' => [
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database_name' => 'maple_leafs_scraper_will_test'
    ]
);