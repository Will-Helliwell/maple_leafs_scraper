<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// define root and config
define('ROOT', __DIR__ . '/');
define('CONFIG', require_once ROOT . 'config.php');

// requirements
require_once ROOT . 'helpers/func.php';
require_once ROOT . 'vendor/autoload.php';
require_once ROOT . 'database/database.php';


// get config
$sources = get_config('sources');

// get user agent
$user_agent = get_config('user_agent');

$database = new Database('localhost', 'root', '', 'maple_leafs_scraper_will_test');
$rows = $database->fetchAll("SELECT * FROM test_table");
foreach ($rows as $row) {
    print_r($row);
}
$database->close();

if(empty($sources)) {
    die('No sources found in config.php');
}

$output_array = [];

// lets loop through the sources
foreach ($sources as $source) {
    // echo 'source = ' . PHP_EOL;
    // pp($source);

    $parsed_array = (new \App\Parser($source, $user_agent))->parse()->getResponse();
    // echo 'parsed_array = ' . PHP_EOL;
    // pp($parsed_array);

    $source_domain = str_replace(['https://', 'http://', 'www.'], '', $source);
    // echo 'source_domain = ' . PHP_EOL;
    // pp($source_domain);
	
    // merge the parsed array with the output array
    if(!empty($parsed_array)) {
        $output_array[$source_domain] = $parsed_array;
    }

    // sleep between requests
    sleep(get_config('sleep_between_requests'));
    // echo PHP_EOL;
    // echo PHP_EOL;
}

// check if output array is empty
if(empty($output_array)) {
    die('No results found');
}

// check if output type is json
if(get_config('output_type') === 'json') {
    // add header
    header('Content-Type: application/json');
    echo json_encode($output_array);
    exit;
}

// simply print the output array
pp($output_array);
exit();