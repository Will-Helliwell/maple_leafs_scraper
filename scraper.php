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


// get config details
$sources = get_config('sources');
$user_agent = get_config('user_agent');
$database_connection_details = get_config('database_connection_details');
$output_type = get_config('output_type');

// // test query
$database = new \App\DatabaseConnection($database_connection_details);
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
    echo 'source = ' . PHP_EOL;
    pp($source);

    $parsed_array = (new \App\Parser($source, $user_agent))->parse()->getResponse();
    echo 'parsed_array = ' . PHP_EOL;
    pp($parsed_array);

    $source_domain = str_replace(['https://', 'http://', 'www.'], '', $source);
    echo 'source_domain = ' . PHP_EOL;
    pp($source_domain);
	
    // merge the parsed array with the output array
    if(!empty($parsed_array)) {
        $output_array[$source_domain] = $parsed_array;
    }

    // sleep between requests
    sleep(get_config('sleep_between_requests'));
    echo PHP_EOL;
    echo PHP_EOL;
}

// check if output array is empty
if(empty($output_array)) {
    die('No results found');
}

switch ($output_type) {
    case 'json':
         // add header
        header('Content-Type: application/json');
        echo json_encode($output_array);
        
        break;
    
    case 'database':
        echo 'Output type specified as database' . PHP_EOL;
        exit;
        break;
    
    default:
        echo 'Output type has not been specified.' . PHP_EOL;
        break;
}
exit;