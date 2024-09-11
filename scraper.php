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

// define variables
$output_array = [];

// get all sources from the database
if ($output_type === 'database') {
    $source_repository = new \App\SourceRepository($database_connection_details);
    $sources = $source_repository->getAllSources();
    $source_repository->close();
    if (empty($sources)) {
        die('No sources found in database.');
    }
}
$sources_count = count($sources);
// echo 'sources length before = ' . $sources_count . PHP_EOL;
// echo 'sources = ' . PHP_EOL;
// pp($sources);

//temporarily filter array for only maple leafs
if ($output_type === 'database') {
    $sources = array_filter($sources, function ($value, $index) {
        return $index === 3;
    }, ARRAY_FILTER_USE_BOTH);
    $sources_count = count($sources);
    // echo 'sources length after = ' . $sources_count . PHP_EOL;
    // echo 'sources = ' . PHP_EOL;
    // pp($sources);
}

// lets loop through the sources
foreach ($sources as $source) {
    // echo 'source = ' . PHP_EOL;
    // pp($source);

    if ($output_type === 'database') {
        $source_url = $source['url'];
        $source_id = $source['id'];
    } else {
        $source_url = $source;
    }

    $parsed_array = (new \App\Parser($source_url, $user_agent))->parse()->getResponse();
    // echo 'parsed_array = ' . PHP_EOL;
    // pp($parsed_array);

    $source_domain = str_replace(['https://', 'http://', 'www.'], '', $source_url);
    // echo 'source_domain = ' . PHP_EOL;
    // pp($source_domain);

    // merge the parsed array with the output array
    if (!empty($parsed_array)) {
        if ($output_type === 'database') {
            $output_array[$source_id] = $parsed_array;
        } else {
            $output_array[$source_domain] = $parsed_array;
        }
    }

    // sleep between requests
    sleep(get_config('sleep_between_requests'));
    // echo PHP_EOL;
    // echo PHP_EOL;
}

// check if output array is empty
if (empty($output_array)) {
    die('No results found');
}

// echo 'output_array = ' . PHP_EOL;
// pp($output_array);

switch ($output_type) {
    case 'json':
        header('Content-Type: application/json');
        echo json_encode($output_array);
        break;

    case 'database':
        echo 'Output type specified as database' . PHP_EOL;
        $article_repository = new \App\ArticleRepository($database_connection_details);
        // Fetch all existing articles from the database, grouped by source_id
        $existing_articles = $article_repository->getAllArticlesGroupedBySourceAndUrl();
        $existing_articles_length = count($existing_articles);
        echo 'existing_articles length = ' . $existing_articles_length . PHP_EOL;
        echo 'existing_articles = ' . PHP_EOL;
        pp($existing_articles);


        foreach ($output_array as $source_id => $articles) {
            // echo 'source_id = ' . $source_id . PHP_EOL;
            // $articles_length = count($articles);
            // echo 'articles length = ' . $articles_length . PHP_EOL;
            // echo 'articles = ' . PHP_EOL;
            // pp($articles);

            foreach ($articles as $article) {
                $article_url = $article['url'];
                echo 'source_id = ' . $source_id . PHP_EOL;
                echo 'article_url = ' . $article_url . PHP_EOL;
                // if article does not already exist in the database
                if (!array_key_exists($source_id, $existing_articles) || !array_key_exists($article_url, $existing_articles[$source_id])) {
                    echo 'article does not exist, inserting into db...' . PHP_EOL;
                    $article['source_id'] = $source_id;
                    $article_repository->insertArticle($article);
                    break;
                } else {
                    echo 'article already exists in db' . PHP_EOL;
                }
            }
        }
        $article_repository->close();
        break;

    default:
        echo 'Output type has not been specified.' . PHP_EOL;
        break;
}
exit;
