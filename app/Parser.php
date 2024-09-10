<?php 

namespace App;

/**
 * Parser class
 * @package 
 */

class Parser {

    /**
     * 
     * @var array
     */
    private array $supported_domains = [
        'www.nhl.com' => 'NHL',
        'www.thestar.com' => 'TheStar',
        'theleafsnation.com' => 'TheLeafsNation',
        'editorinleaf.com' => 'EditorInLeaf',
        'www.nhlpa.com' => 'NHLPA',
        'torontosun.com' => 'TorontoSun',
        'www.theglobeandmail.com' => 'TheGlobeAndMail',
        'nationalpost.com' => 'NationalPost',
        'www.sportsnet.ca' => 'SportsNet',
        'www.tsn.ca' => 'TSN',
        'www.cbc.ca' => 'CBC',
        'globalnews.ca' => 'GlobalNews',
        'www.ctvnews.ca' => 'CTVNews',
        'theathletic.com' => 'TheAthletic',
        'www.pensionplanpuppets.com' => 'PensionPlanPuppets',
        'mapleleafshotstove.com' => 'MapleLeafsHotStove',
        'betweentheposts.ca' => 'BetweenThePosts',
        'centreofleafsnation.com' => 'CentreOfLeafsNation',
    ];

    /**
     * 
     * @var string
     */
    private string $source;

    /**
     * 
     * @var string
     */
    private string $user_agent;


    /**
     * 
     * @var array
     */
    private array $response = [];

    /**
     * 
     * @param string $source 
     * @param string $user_agent 
     * @return void 
     */
    function __construct(string $source, string $user_agent) 
    {   
        // add /home to tsn.ca source
        if(\str_contains($source, 'tsn.ca') && !\str_ends_with($source, '/home')) {
            $source = $source . '/home';
        }

        $this->source = $source;

        $this->user_agent = $user_agent;
    }
    
    /**
     * 
     * @return self 
     */
    function parse() : self
    {

        $content = get_content($this->source, $this->user_agent);

        // if content is empty return empty array
        if(empty($content)) {
            return $this;
        }

        // get source domain
        $source_domain = parse_url($this->source, PHP_URL_HOST);
        
        
        // check if source domain is supported
        if(!array_key_exists($source_domain, $this->supported_domains)) {
            return $this;
        }
        
        // get source name
        $source_name = $this->supported_domains[$source_domain];

        // dynamically call the parse method    
        try{

            $this->response = call_user_func([__NAMESPACE__ . '\\Parser\\' . $source_name, 'parse'], $content);
            
        }catch(\Throwable $e) {
            // do nothing
        }

        return $this;

    }

    /**
     * 
     * @param array $search_terms 
     * @return void 
     */
    function filterResponse(array $search_terms) : void
    {
        $this->response = array_filter($this->response, function($item) use ($search_terms) {

            // sleep
            sleep(get_config('sleep_between_requests'));

            // url
            $article_url = $item['url'];

            $article_content = get_content($article_url, $this->user_agent);

            foreach($search_terms as $search_term) {

                if(stripos($article_content, $search_term) !== false) {
                    return true;
                }
            }

            return false;
        });
    }


    /**
     * 
     * @return array 
     */
    function getResponse() : array
    {
        if(empty($this->response)) {
            return [];
        }

        // loop the array and trim any spaces
        foreach($this->response as $key => $value) {
            foreach($value as $k => $v) {
                $this->response[$key][$k] = trim($v);
            }
        }

        // filter response
        $search_terms = get_config('search_terms');

        if(!empty($search_terms)) {
            $this->filterResponse($search_terms);
        }

        return $this->response;
    }

}