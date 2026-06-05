<?php


declare(strict_types=1);

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

use App\Database\Database;
use App\Repositories\UrlRepository;
use App\Services\UrlShortenerService;
use App\Controllers\UrlController;

/**
 * Load environment variables
 */
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/**
 * Dependency Injection (manual)
 */
$db = Database::connect();

$repository = new UrlRepository($db);

$service = new UrlShortenerService($repository);

$controller = new UrlController($service);

/**
 * Register routes
 */
$routes = require __DIR__ . '/../routes/api.php';

$dispatcher = simpleDispatcher(
    function (RouteCollector $r) use ($routes) {

        foreach ($routes as $route) {
            [$method, $uri, $handler] = $route;

            $r->addRoute(
                $method,
                $uri,
                $handler
            );
        }
    }
);

/**
 * Current request
 */
$httpMethod = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];

/**
 * Remove query string
 */
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

/**
 * Dispatch route
 */
$routeInfo = $dispatcher->dispatch(
    $httpMethod,
    $uri
);

switch ($routeInfo[0]) {

    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);

        echo 'Route not found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);

        echo 'Method not allowed';
        break;

    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];

        $vars = $routeInfo[2];

        switch ($handler) {

            case 'shorten':
                $controller->shorten();
                break;

            case 'redirect':
                $controller->redirect(
                    $vars['code']
                );
                break;
        }

        break;
}