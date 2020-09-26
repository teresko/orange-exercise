<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$locator = new FileLocator(__DIR__ . '/../config');


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
}

// dumping the routed values with other request parameters .. because lazy
foreach ($parameters as $key => $value) {
    $request->attributes->set($key, $value);
}

$command = $request->getMethod() . $request->get('action');


var_dump($request->get('resource') . ' :: ' . $command);
