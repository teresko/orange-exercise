<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing;
use Symfony\Component\DependencyInjection;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$request = Request::createFromGlobals();
$locator = new FileLocator(__DIR__ . '/../config');


// configuration for dependency injection container
$container = new DependencyInjection\ContainerBuilder;
$container->setParameter('path.root', __DIR__ . '/..');

$loader = new DependencyInjection\Loader\YamlFileLoader($container, $locator);
$loader->load('dependencies.yaml');
$container->compile();


// routing
$loader = new Routing\Loader\YamlFileLoader($locator);
$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher(
    $loader->load('routing.yml'),
    $context
);

try {
    $parameters = $matcher->match($request->getPathInfo());
} catch (Routing\Exception\ResourceNotFoundException $e) {
    // handle unsupported API endpoint
    var_dump($e); exit;
}

// dumping the routed values with other request parameters .. because lazy
foreach ($parameters as $key => $value) {
    $request->attributes->set($key, $value);
}


// dispatching to application
try {
    $resource = $container->get($request->get('resource'));
    $command = $request->getMethod() . $request->get('action');

    $data = $resource->{$command}($request) + ['status' => 'ok'];
} catch (Exception $exception) {
    $data = [
        'status' => 'error',
        'message' => $exception->getMessage(),
    ];
}

$response = new JsonResponse($data);
$response->send();
