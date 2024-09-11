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

// get config
$user_agent = get_config('user_agent');
$database_connection_details = get_config('database_connection_details');
$output_type = get_config('output_type');

// main script steps
$output_array = [];
$sources = ($output_type === 'database') ? getSources($database_connection_details) : get_config('sources');
echo 'sources = ' . PHP_EOL;
pp($sources);
processSources($sources, $user_agent, $output_type, $output_array);
outputResults($output_array, $output_type, $database_connection_details);

/**
 * Retrieves sources from the database
 *
 * @param array $dbDetails The database connection details.
 * @return array The filtered sources.
 */
function getSources($dbDetails)
{

    $source_repository = new \App\SourceRepository($dbDetails);
    $sources = $source_repository->getAllSources();
    $source_repository->close();
    if (empty($sources)) {
        die('No sources found in database.');
    }

    return filterSources($sources);
}

function filterSources($sources)
{
    return array_filter($sources, function ($value, $index) {
        return $index === 3;
    }, ARRAY_FILTER_USE_BOTH);

    return $sources;
}

/**
 * Processes each source by parsing it and populating the output array.
 *
 * @param array $sources The sources to process.
 * @param string $user_agent The user agent to use for requests.
 * @param string $output_type The type of output ('database' or other).
 * @param array &$output_array The array to populate with parsed data.
 */
function processSources($sources, $user_agent, $output_type, &$output_array)
{
    foreach ($sources as $source) {
        $source_url = ($output_type === 'database') ? $source['url'] : $source;
        $source_id = ($output_type === 'database') ? $source['id'] : null;

        $parsed_array = (new \App\Parser($source_url, $user_agent))->parse()->getResponse();
        $source_domain = str_replace(['https://', 'http://', 'www.'], '', $source_url);

        if (!empty($parsed_array)) {
            if ($output_type === 'database') {
                $output_array[$source_id] = $parsed_array;
            } else {
                $output_array[$source_domain] = $parsed_array;
            }
        }

        sleep(get_config('sleep_between_requests'));
    }
}

/**
 * Outputs the results based on the specified output type.
 *
 * @param array $output_array The array of parsed data.
 * @param string $output_type The type of output ('json' or 'database').
 * @param array $dbDetails The database connection details for 'database' output type.
 */
function outputResults($output_array, $output_type, $dbDetails)
{
    if (empty($output_array)) {
        die('No results found');
    }

    switch ($output_type) {
        case 'json':
            header('Content-Type: application/json');
            echo json_encode($output_array);
            break;

        case 'database':
            echo 'Output type specified as database' . PHP_EOL;
            $article_repository = new \App\ArticleRepository($dbDetails);
            $existing_articles = $article_repository->getAllArticlesGroupedBySourceAndUrl();

            foreach ($output_array as $source_id => $articles) {
                foreach ($articles as $article) {
                    echo 'article = ' . PHP_EOL;
                    pp($article);
                    $article_url = $article['url'];
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
}
exit;
