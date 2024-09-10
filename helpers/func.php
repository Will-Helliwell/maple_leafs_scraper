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