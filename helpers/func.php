<?php


/**
 * 
 * @param string $url 
 * @param string|null $ua 
 * @return string|false 
 */
function get_content(string $url, string $ua = null) : string | false
{
    $ch = curl_init($url);

    // add header to request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // add user agent to request
    if($ua !== null) {
        
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    }

    $result = curl_exec($ch);

    // get http code
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);


    // check if http code is between 200 and 300
    if ($httpcode >= 200 && $httpcode < 300) {
        return $result;
    }

    return false;
}

/**
 * 
 * @param string $key 
 * @return mixed 
 */
function get_config(string $key) : array|string|int|null
{
    return CONFIG[$key] ?? null;
}

/**
 * Debugging function, simply a var_dump wrapper
 * @example pp($something, $another);
 * @param mixed
 */
function pp($data, $type = null)
{
    echo '<pre>';
    if (!$type == null) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo '</pre>';
    echo PHP_EOL . PHP_EOL;
    
}

/**
 * Decodes any of the varchars stored in the database into readable text (e.g. Articles.title)
 *
 * @param string $html_entity_string The string extracted from the database
 */
function decode_html_entity_from_database($html_entity_string){
    return html_entity_decode($html_entity_string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function start_timer()
{
    return microtime(true);
}

function end_timer($start_time)
{
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    return $execution_time;
}
